<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DetailAdd extends Detail
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'detail';

    // Page object name
    public $PageObjName = "DetailAdd";

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

        // Table object (detail)
        if (!isset($GLOBALS["detail"]) || get_class($GLOBALS["detail"]) == PROJECT_NAMESPACE . "detail") {
            $GLOBALS["detail"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'detail');
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
                $doc = new $class(Container("detail"));
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
                    if ($pageName == "DetailView") {
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
            $key .= @$ar['detail_id'];
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
        $this->detail_id->setVisibility();
        $this->kode_akun->setVisibility();
        $this->detail->setVisibility();
        $this->volum->setVisibility();
        $this->sbm->setVisibility();
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
            if (($keyValue = Get("detail_id") ?? Route("detail_id")) !== null) {
                $this->detail_id->setQueryStringValue($keyValue);
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
                    $this->terminate("DetailList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "DetailList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "DetailView") {
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
        $this->detail_id->CurrentValue = null;
        $this->detail_id->OldValue = $this->detail_id->CurrentValue;
        $this->kode_akun->CurrentValue = null;
        $this->kode_akun->OldValue = $this->kode_akun->CurrentValue;
        $this->detail->CurrentValue = null;
        $this->detail->OldValue = $this->detail->CurrentValue;
        $this->volum->CurrentValue = null;
        $this->volum->OldValue = $this->volum->CurrentValue;
        $this->sbm->CurrentValue = null;
        $this->sbm->OldValue = $this->sbm->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'detail_id' first before field var 'x_detail_id'
        $val = $CurrentForm->hasValue("detail_id") ? $CurrentForm->getValue("detail_id") : $CurrentForm->getValue("x_detail_id");
        if (!$this->detail_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->detail_id->Visible = false; // Disable update for API request
            } else {
                $this->detail_id->setFormValue($val);
            }
        }

        // Check field name 'kode_akun' first before field var 'x_kode_akun'
        $val = $CurrentForm->hasValue("kode_akun") ? $CurrentForm->getValue("kode_akun") : $CurrentForm->getValue("x_kode_akun");
        if (!$this->kode_akun->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_akun->Visible = false; // Disable update for API request
            } else {
                $this->kode_akun->setFormValue($val);
            }
        }

        // Check field name 'detail' first before field var 'x_detail'
        $val = $CurrentForm->hasValue("detail") ? $CurrentForm->getValue("detail") : $CurrentForm->getValue("x_detail");
        if (!$this->detail->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->detail->Visible = false; // Disable update for API request
            } else {
                $this->detail->setFormValue($val);
            }
        }

        // Check field name 'volum' first before field var 'x_volum'
        $val = $CurrentForm->hasValue("volum") ? $CurrentForm->getValue("volum") : $CurrentForm->getValue("x_volum");
        if (!$this->volum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->volum->Visible = false; // Disable update for API request
            } else {
                $this->volum->setFormValue($val);
            }
        }

        // Check field name 'sbm' first before field var 'x_sbm'
        $val = $CurrentForm->hasValue("sbm") ? $CurrentForm->getValue("sbm") : $CurrentForm->getValue("x_sbm");
        if (!$this->sbm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sbm->Visible = false; // Disable update for API request
            } else {
                $this->sbm->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->detail_id->CurrentValue = $this->detail_id->FormValue;
        $this->kode_akun->CurrentValue = $this->kode_akun->FormValue;
        $this->detail->CurrentValue = $this->detail->FormValue;
        $this->volum->CurrentValue = $this->volum->FormValue;
        $this->sbm->CurrentValue = $this->sbm->FormValue;
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
        $this->detail_id->setDbValue($row['detail_id']);
        $this->kode_akun->setDbValue($row['kode_akun']);
        $this->detail->setDbValue($row['detail']);
        $this->volum->setDbValue($row['volum']);
        $this->sbm->setDbValue($row['sbm']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['detail_id'] = $this->detail_id->CurrentValue;
        $row['kode_akun'] = $this->kode_akun->CurrentValue;
        $row['detail'] = $this->detail->CurrentValue;
        $row['volum'] = $this->volum->CurrentValue;
        $row['sbm'] = $this->sbm->CurrentValue;
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

        // Convert decimal values if posted back
        if ($this->volum->FormValue == $this->volum->CurrentValue && is_numeric(ConvertToFloatString($this->volum->CurrentValue))) {
            $this->volum->CurrentValue = ConvertToFloatString($this->volum->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->sbm->FormValue == $this->sbm->CurrentValue && is_numeric(ConvertToFloatString($this->sbm->CurrentValue))) {
            $this->sbm->CurrentValue = ConvertToFloatString($this->sbm->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // detail_id

        // kode_akun

        // detail

        // volum

        // sbm
        if ($this->RowType == ROWTYPE_VIEW) {
            // detail_id
            $this->detail_id->ViewValue = $this->detail_id->CurrentValue;
            $this->detail_id->ViewValue = FormatNumber($this->detail_id->ViewValue, 0, -2, -2, -2);
            $this->detail_id->ViewCustomAttributes = "";

            // kode_akun
            $this->kode_akun->ViewValue = $this->kode_akun->CurrentValue;
            $this->kode_akun->ViewCustomAttributes = "";

            // detail
            $this->detail->ViewValue = $this->detail->CurrentValue;
            $this->detail->ViewCustomAttributes = "";

            // volum
            $this->volum->ViewValue = $this->volum->CurrentValue;
            $this->volum->ViewValue = FormatNumber($this->volum->ViewValue, 2, -2, -2, -2);
            $this->volum->ViewCustomAttributes = "";

            // sbm
            $this->sbm->ViewValue = $this->sbm->CurrentValue;
            $this->sbm->ViewValue = FormatNumber($this->sbm->ViewValue, 2, -2, -2, -2);
            $this->sbm->ViewCustomAttributes = "";

            // detail_id
            $this->detail_id->LinkCustomAttributes = "";
            $this->detail_id->HrefValue = "";
            $this->detail_id->TooltipValue = "";

            // kode_akun
            $this->kode_akun->LinkCustomAttributes = "";
            $this->kode_akun->HrefValue = "";
            $this->kode_akun->TooltipValue = "";

            // detail
            $this->detail->LinkCustomAttributes = "";
            $this->detail->HrefValue = "";
            $this->detail->TooltipValue = "";

            // volum
            $this->volum->LinkCustomAttributes = "";
            $this->volum->HrefValue = "";
            $this->volum->TooltipValue = "";

            // sbm
            $this->sbm->LinkCustomAttributes = "";
            $this->sbm->HrefValue = "";
            $this->sbm->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // detail_id
            $this->detail_id->EditAttrs["class"] = "form-control";
            $this->detail_id->EditCustomAttributes = "";
            $this->detail_id->EditValue = HtmlEncode($this->detail_id->CurrentValue);
            $this->detail_id->PlaceHolder = RemoveHtml($this->detail_id->caption());

            // kode_akun
            $this->kode_akun->EditAttrs["class"] = "form-control";
            $this->kode_akun->EditCustomAttributes = "";
            if (!$this->kode_akun->Raw) {
                $this->kode_akun->CurrentValue = HtmlDecode($this->kode_akun->CurrentValue);
            }
            $this->kode_akun->EditValue = HtmlEncode($this->kode_akun->CurrentValue);
            $this->kode_akun->PlaceHolder = RemoveHtml($this->kode_akun->caption());

            // detail
            $this->detail->EditAttrs["class"] = "form-control";
            $this->detail->EditCustomAttributes = "";
            $this->detail->EditValue = HtmlEncode($this->detail->CurrentValue);
            $this->detail->PlaceHolder = RemoveHtml($this->detail->caption());

            // volum
            $this->volum->EditAttrs["class"] = "form-control";
            $this->volum->EditCustomAttributes = "";
            $this->volum->EditValue = HtmlEncode($this->volum->CurrentValue);
            $this->volum->PlaceHolder = RemoveHtml($this->volum->caption());
            if (strval($this->volum->EditValue) != "" && is_numeric($this->volum->EditValue)) {
                $this->volum->EditValue = FormatNumber($this->volum->EditValue, -2, -2, -2, -2);
            }

            // sbm
            $this->sbm->EditAttrs["class"] = "form-control";
            $this->sbm->EditCustomAttributes = "";
            $this->sbm->EditValue = HtmlEncode($this->sbm->CurrentValue);
            $this->sbm->PlaceHolder = RemoveHtml($this->sbm->caption());
            if (strval($this->sbm->EditValue) != "" && is_numeric($this->sbm->EditValue)) {
                $this->sbm->EditValue = FormatNumber($this->sbm->EditValue, -2, -2, -2, -2);
            }

            // Add refer script

            // detail_id
            $this->detail_id->LinkCustomAttributes = "";
            $this->detail_id->HrefValue = "";

            // kode_akun
            $this->kode_akun->LinkCustomAttributes = "";
            $this->kode_akun->HrefValue = "";

            // detail
            $this->detail->LinkCustomAttributes = "";
            $this->detail->HrefValue = "";

            // volum
            $this->volum->LinkCustomAttributes = "";
            $this->volum->HrefValue = "";

            // sbm
            $this->sbm->LinkCustomAttributes = "";
            $this->sbm->HrefValue = "";
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
        if ($this->detail_id->Required) {
            if (!$this->detail_id->IsDetailKey && EmptyValue($this->detail_id->FormValue)) {
                $this->detail_id->addErrorMessage(str_replace("%s", $this->detail_id->caption(), $this->detail_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->detail_id->FormValue)) {
            $this->detail_id->addErrorMessage($this->detail_id->getErrorMessage(false));
        }
        if ($this->kode_akun->Required) {
            if (!$this->kode_akun->IsDetailKey && EmptyValue($this->kode_akun->FormValue)) {
                $this->kode_akun->addErrorMessage(str_replace("%s", $this->kode_akun->caption(), $this->kode_akun->RequiredErrorMessage));
            }
        }
        if ($this->detail->Required) {
            if (!$this->detail->IsDetailKey && EmptyValue($this->detail->FormValue)) {
                $this->detail->addErrorMessage(str_replace("%s", $this->detail->caption(), $this->detail->RequiredErrorMessage));
            }
        }
        if ($this->volum->Required) {
            if (!$this->volum->IsDetailKey && EmptyValue($this->volum->FormValue)) {
                $this->volum->addErrorMessage(str_replace("%s", $this->volum->caption(), $this->volum->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->volum->FormValue)) {
            $this->volum->addErrorMessage($this->volum->getErrorMessage(false));
        }
        if ($this->sbm->Required) {
            if (!$this->sbm->IsDetailKey && EmptyValue($this->sbm->FormValue)) {
                $this->sbm->addErrorMessage(str_replace("%s", $this->sbm->caption(), $this->sbm->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->sbm->FormValue)) {
            $this->sbm->addErrorMessage($this->sbm->getErrorMessage(false));
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
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // detail_id
        $this->detail_id->setDbValueDef($rsnew, $this->detail_id->CurrentValue, 0, false);

        // kode_akun
        $this->kode_akun->setDbValueDef($rsnew, $this->kode_akun->CurrentValue, null, false);

        // detail
        $this->detail->setDbValueDef($rsnew, $this->detail->CurrentValue, null, false);

        // volum
        $this->volum->setDbValueDef($rsnew, $this->volum->CurrentValue, null, false);

        // sbm
        $this->sbm->setDbValueDef($rsnew, $this->sbm->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['detail_id']) == "") {
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("Dashboard2");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("DetailList"), "", $this->TableVar, true);
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
