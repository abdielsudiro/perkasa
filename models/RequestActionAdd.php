<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RequestActionAdd extends RequestAction
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'request_action';

    // Page object name
    public $PageObjName = "RequestActionAdd";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (request_action)
        if (!isset($GLOBALS["request_action"]) || get_class($GLOBALS["request_action"]) == PROJECT_NAMESPACE . "request_action") {
            $GLOBALS["request_action"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'request_action');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("request_action"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "RequestActionView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['request_action_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->request_action_id->setVisibility();
        $this->request_id->setVisibility();
        $this->action_id->setVisibility();
        $this->transition_id->setVisibility();
        $this->is_active->setVisibility();
        $this->is_complete->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("request_action_id") ?? Route("request_action_id")) !== null) {
                $this->request_action_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("RequestActionList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "RequestActionList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "RequestActionView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->request_action_id->CurrentValue = null;
        $this->request_action_id->OldValue = $this->request_action_id->CurrentValue;
        $this->request_id->CurrentValue = null;
        $this->request_id->OldValue = $this->request_id->CurrentValue;
        $this->action_id->CurrentValue = null;
        $this->action_id->OldValue = $this->action_id->CurrentValue;
        $this->transition_id->CurrentValue = null;
        $this->transition_id->OldValue = $this->transition_id->CurrentValue;
        $this->is_active->CurrentValue = null;
        $this->is_active->OldValue = $this->is_active->CurrentValue;
        $this->is_complete->CurrentValue = null;
        $this->is_complete->OldValue = $this->is_complete->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'request_action_id' first before field var 'x_request_action_id'
        $val = $CurrentForm->hasValue("request_action_id") ? $CurrentForm->getValue("request_action_id") : $CurrentForm->getValue("x_request_action_id");
        if (!$this->request_action_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->request_action_id->Visible = false; // Disable update for API request
            } else {
                $this->request_action_id->setFormValue($val);
            }
        }

        // Check field name 'request_id' first before field var 'x_request_id'
        $val = $CurrentForm->hasValue("request_id") ? $CurrentForm->getValue("request_id") : $CurrentForm->getValue("x_request_id");
        if (!$this->request_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->request_id->Visible = false; // Disable update for API request
            } else {
                $this->request_id->setFormValue($val);
            }
        }

        // Check field name 'action_id' first before field var 'x_action_id'
        $val = $CurrentForm->hasValue("action_id") ? $CurrentForm->getValue("action_id") : $CurrentForm->getValue("x_action_id");
        if (!$this->action_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->action_id->Visible = false; // Disable update for API request
            } else {
                $this->action_id->setFormValue($val);
            }
        }

        // Check field name 'transition_id' first before field var 'x_transition_id'
        $val = $CurrentForm->hasValue("transition_id") ? $CurrentForm->getValue("transition_id") : $CurrentForm->getValue("x_transition_id");
        if (!$this->transition_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->transition_id->Visible = false; // Disable update for API request
            } else {
                $this->transition_id->setFormValue($val);
            }
        }

        // Check field name 'is_active' first before field var 'x_is_active'
        $val = $CurrentForm->hasValue("is_active") ? $CurrentForm->getValue("is_active") : $CurrentForm->getValue("x_is_active");
        if (!$this->is_active->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->is_active->Visible = false; // Disable update for API request
            } else {
                $this->is_active->setFormValue($val);
            }
        }

        // Check field name 'is_complete' first before field var 'x_is_complete'
        $val = $CurrentForm->hasValue("is_complete") ? $CurrentForm->getValue("is_complete") : $CurrentForm->getValue("x_is_complete");
        if (!$this->is_complete->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->is_complete->Visible = false; // Disable update for API request
            } else {
                $this->is_complete->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->request_action_id->CurrentValue = $this->request_action_id->FormValue;
        $this->request_id->CurrentValue = $this->request_id->FormValue;
        $this->action_id->CurrentValue = $this->action_id->FormValue;
        $this->transition_id->CurrentValue = $this->transition_id->FormValue;
        $this->is_active->CurrentValue = $this->is_active->FormValue;
        $this->is_complete->CurrentValue = $this->is_complete->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->request_action_id->setDbValue($row['request_action_id']);
        $this->request_id->setDbValue($row['request_id']);
        $this->action_id->setDbValue($row['action_id']);
        $this->transition_id->setDbValue($row['transition_id']);
        $this->is_active->setDbValue($row['is_active']);
        $this->is_complete->setDbValue($row['is_complete']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['request_action_id'] = $this->request_action_id->CurrentValue;
        $row['request_id'] = $this->request_id->CurrentValue;
        $row['action_id'] = $this->action_id->CurrentValue;
        $row['transition_id'] = $this->transition_id->CurrentValue;
        $row['is_active'] = $this->is_active->CurrentValue;
        $row['is_complete'] = $this->is_complete->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // request_action_id

        // request_id

        // action_id

        // transition_id

        // is_active

        // is_complete
        if ($this->RowType == ROWTYPE_VIEW) {
            // request_action_id
            $this->request_action_id->ViewValue = $this->request_action_id->CurrentValue;
            $this->request_action_id->ViewValue = FormatNumber($this->request_action_id->ViewValue, 0, -2, -2, -2);
            $this->request_action_id->ViewCustomAttributes = "";

            // request_id
            $this->request_id->ViewValue = $this->request_id->CurrentValue;
            $this->request_id->ViewValue = FormatNumber($this->request_id->ViewValue, 0, -2, -2, -2);
            $this->request_id->ViewCustomAttributes = "";

            // action_id
            $this->action_id->ViewValue = $this->action_id->CurrentValue;
            $this->action_id->ViewValue = FormatNumber($this->action_id->ViewValue, 0, -2, -2, -2);
            $this->action_id->ViewCustomAttributes = "";

            // transition_id
            $this->transition_id->ViewValue = $this->transition_id->CurrentValue;
            $this->transition_id->ViewValue = FormatNumber($this->transition_id->ViewValue, 0, -2, -2, -2);
            $this->transition_id->ViewCustomAttributes = "";

            // is_active
            if (ConvertToBool($this->is_active->CurrentValue)) {
                $this->is_active->ViewValue = $this->is_active->tagCaption(1) != "" ? $this->is_active->tagCaption(1) : "Yes";
            } else {
                $this->is_active->ViewValue = $this->is_active->tagCaption(2) != "" ? $this->is_active->tagCaption(2) : "No";
            }
            $this->is_active->ViewCustomAttributes = "";

            // is_complete
            if (ConvertToBool($this->is_complete->CurrentValue)) {
                $this->is_complete->ViewValue = $this->is_complete->tagCaption(1) != "" ? $this->is_complete->tagCaption(1) : "Yes";
            } else {
                $this->is_complete->ViewValue = $this->is_complete->tagCaption(2) != "" ? $this->is_complete->tagCaption(2) : "No";
            }
            $this->is_complete->ViewCustomAttributes = "";

            // request_action_id
            $this->request_action_id->LinkCustomAttributes = "";
            $this->request_action_id->HrefValue = "";
            $this->request_action_id->TooltipValue = "";

            // request_id
            $this->request_id->LinkCustomAttributes = "";
            $this->request_id->HrefValue = "";
            $this->request_id->TooltipValue = "";

            // action_id
            $this->action_id->LinkCustomAttributes = "";
            $this->action_id->HrefValue = "";
            $this->action_id->TooltipValue = "";

            // transition_id
            $this->transition_id->LinkCustomAttributes = "";
            $this->transition_id->HrefValue = "";
            $this->transition_id->TooltipValue = "";

            // is_active
            $this->is_active->LinkCustomAttributes = "";
            $this->is_active->HrefValue = "";
            $this->is_active->TooltipValue = "";

            // is_complete
            $this->is_complete->LinkCustomAttributes = "";
            $this->is_complete->HrefValue = "";
            $this->is_complete->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // request_action_id
            $this->request_action_id->EditAttrs["class"] = "form-control";
            $this->request_action_id->EditCustomAttributes = "";
            $this->request_action_id->EditValue = HtmlEncode($this->request_action_id->CurrentValue);
            $this->request_action_id->PlaceHolder = RemoveHtml($this->request_action_id->caption());

            // request_id
            $this->request_id->EditAttrs["class"] = "form-control";
            $this->request_id->EditCustomAttributes = "";
            if ($this->request_id->getSessionValue() != "") {
                $this->request_id->CurrentValue = GetForeignKeyValue($this->request_id->getSessionValue());
                $this->request_id->ViewValue = $this->request_id->CurrentValue;
                $this->request_id->ViewValue = FormatNumber($this->request_id->ViewValue, 0, -2, -2, -2);
                $this->request_id->ViewCustomAttributes = "";
            } else {
                $this->request_id->EditValue = HtmlEncode($this->request_id->CurrentValue);
                $this->request_id->PlaceHolder = RemoveHtml($this->request_id->caption());
            }

            // action_id
            $this->action_id->EditAttrs["class"] = "form-control";
            $this->action_id->EditCustomAttributes = "";
            $this->action_id->EditValue = HtmlEncode($this->action_id->CurrentValue);
            $this->action_id->PlaceHolder = RemoveHtml($this->action_id->caption());

            // transition_id
            $this->transition_id->EditAttrs["class"] = "form-control";
            $this->transition_id->EditCustomAttributes = "";
            $this->transition_id->EditValue = HtmlEncode($this->transition_id->CurrentValue);
            $this->transition_id->PlaceHolder = RemoveHtml($this->transition_id->caption());

            // is_active
            $this->is_active->EditCustomAttributes = "";
            $this->is_active->EditValue = $this->is_active->options(false);
            $this->is_active->PlaceHolder = RemoveHtml($this->is_active->caption());

            // is_complete
            $this->is_complete->EditCustomAttributes = "";
            $this->is_complete->EditValue = $this->is_complete->options(false);
            $this->is_complete->PlaceHolder = RemoveHtml($this->is_complete->caption());

            // Add refer script

            // request_action_id
            $this->request_action_id->LinkCustomAttributes = "";
            $this->request_action_id->HrefValue = "";

            // request_id
            $this->request_id->LinkCustomAttributes = "";
            $this->request_id->HrefValue = "";

            // action_id
            $this->action_id->LinkCustomAttributes = "";
            $this->action_id->HrefValue = "";

            // transition_id
            $this->transition_id->LinkCustomAttributes = "";
            $this->transition_id->HrefValue = "";

            // is_active
            $this->is_active->LinkCustomAttributes = "";
            $this->is_active->HrefValue = "";

            // is_complete
            $this->is_complete->LinkCustomAttributes = "";
            $this->is_complete->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->request_action_id->Required) {
            if (!$this->request_action_id->IsDetailKey && EmptyValue($this->request_action_id->FormValue)) {
                $this->request_action_id->addErrorMessage(str_replace("%s", $this->request_action_id->caption(), $this->request_action_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->request_action_id->FormValue)) {
            $this->request_action_id->addErrorMessage($this->request_action_id->getErrorMessage(false));
        }
        if ($this->request_id->Required) {
            if (!$this->request_id->IsDetailKey && EmptyValue($this->request_id->FormValue)) {
                $this->request_id->addErrorMessage(str_replace("%s", $this->request_id->caption(), $this->request_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->request_id->FormValue)) {
            $this->request_id->addErrorMessage($this->request_id->getErrorMessage(false));
        }
        if ($this->action_id->Required) {
            if (!$this->action_id->IsDetailKey && EmptyValue($this->action_id->FormValue)) {
                $this->action_id->addErrorMessage(str_replace("%s", $this->action_id->caption(), $this->action_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->action_id->FormValue)) {
            $this->action_id->addErrorMessage($this->action_id->getErrorMessage(false));
        }
        if ($this->transition_id->Required) {
            if (!$this->transition_id->IsDetailKey && EmptyValue($this->transition_id->FormValue)) {
                $this->transition_id->addErrorMessage(str_replace("%s", $this->transition_id->caption(), $this->transition_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->transition_id->FormValue)) {
            $this->transition_id->addErrorMessage($this->transition_id->getErrorMessage(false));
        }
        if ($this->is_active->Required) {
            if ($this->is_active->FormValue == "") {
                $this->is_active->addErrorMessage(str_replace("%s", $this->is_active->caption(), $this->is_active->RequiredErrorMessage));
            }
        }
        if ($this->is_complete->Required) {
            if ($this->is_complete->FormValue == "") {
                $this->is_complete->addErrorMessage(str_replace("%s", $this->is_complete->caption(), $this->is_complete->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Check referential integrity for master table 'request_action'
        $validMasterRecord = true;
        $masterFilter = $this->sqlMasterFilter_request2();
        if (strval($this->request_id->CurrentValue) != "") {
            $masterFilter = str_replace("@request_id@", AdjustSql($this->request_id->CurrentValue, "DB"), $masterFilter);
        } else {
            $validMasterRecord = false;
        }
        if ($validMasterRecord) {
            $rsmaster = Container("request2")->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "request", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // request_action_id
        $this->request_action_id->setDbValueDef($rsnew, $this->request_action_id->CurrentValue, 0, false);

        // request_id
        $this->request_id->setDbValueDef($rsnew, $this->request_id->CurrentValue, null, false);

        // action_id
        $this->action_id->setDbValueDef($rsnew, $this->action_id->CurrentValue, null, false);

        // transition_id
        $this->transition_id->setDbValueDef($rsnew, $this->transition_id->CurrentValue, null, false);

        // is_active
        $tmpBool = $this->is_active->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->is_active->setDbValueDef($rsnew, $tmpBool, null, false);

        // is_complete
        $tmpBool = $this->is_complete->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->is_complete->setDbValueDef($rsnew, $tmpBool, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['request_action_id']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "request2") {
                $validMaster = true;
                $masterTbl = Container("request2");
                if (($parm = Get("fk_request_id", Get("request_id"))) !== null) {
                    $masterTbl->request_id->setQueryStringValue($parm);
                    $this->request_id->setQueryStringValue($masterTbl->request_id->QueryStringValue);
                    $this->request_id->setSessionValue($this->request_id->QueryStringValue);
                    if (!is_numeric($masterTbl->request_id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "request2") {
                $validMaster = true;
                $masterTbl = Container("request2");
                if (($parm = Post("fk_request_id", Post("request_id"))) !== null) {
                    $masterTbl->request_id->setFormValue($parm);
                    $this->request_id->setFormValue($masterTbl->request_id->FormValue);
                    $this->request_id->setSessionValue($this->request_id->FormValue);
                    if (!is_numeric($masterTbl->request_id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "request2") {
                if ($this->request_id->CurrentValue == "") {
                    $this->request_id->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("Dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RequestActionList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_is_active":
                    break;
                case "x_is_complete":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
