<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RabKegiatan2Add extends RabKegiatan2
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'rab_kegiatan2';

    // Page object name
    public $PageObjName = "RabKegiatan2Add";

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

        // Table object (rab_kegiatan2)
        if (!isset($GLOBALS["rab_kegiatan2"]) || get_class($GLOBALS["rab_kegiatan2"]) == PROJECT_NAMESPACE . "rab_kegiatan2") {
            $GLOBALS["rab_kegiatan2"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'rab_kegiatan2');
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
                $doc = new $class(Container("rab_kegiatan2"));
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
                    if ($pageName == "RabKegiatan2View") {
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
            $key .= @$ar['rab_kegiatan_id'];
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
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->rab_kegiatan_id->Visible = false;
        }
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
        $this->rab_kegiatan_id->Visible = false;
        $this->satker_id->setVisibility();
        $this->kode_kegiatan->setVisibility();
        $this->kode_kro->setVisibility();
        $this->kode_ro->setVisibility();
        $this->kode_komponen->setVisibility();
        $this->kode_subkomponen->setVisibility();
        $this->total_biaya->setVisibility();
        $this->reviewer_note_id->setVisibility();
        $this->approval_note_id->setVisibility();
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
        $this->setupLookupOptions($this->satker_id);
        $this->setupLookupOptions($this->kode_kegiatan);
        $this->setupLookupOptions($this->kode_kro);
        $this->setupLookupOptions($this->kode_ro);
        $this->setupLookupOptions($this->kode_komponen);
        $this->setupLookupOptions($this->kode_subkomponen);
        $this->setupLookupOptions($this->reviewer_note_id);
        $this->setupLookupOptions($this->approval_note_id);

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
            if (($keyValue = Get("rab_kegiatan_id") ?? Route("rab_kegiatan_id")) !== null) {
                $this->rab_kegiatan_id->setQueryStringValue($keyValue);
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
                    $this->terminate("RabKegiatan2List"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "RabKegiatan2List") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "RabKegiatan2View") {
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
        $this->rab_kegiatan_id->CurrentValue = null;
        $this->rab_kegiatan_id->OldValue = $this->rab_kegiatan_id->CurrentValue;
        $this->satker_id->CurrentValue = null;
        $this->satker_id->OldValue = $this->satker_id->CurrentValue;
        $this->kode_kegiatan->CurrentValue = null;
        $this->kode_kegiatan->OldValue = $this->kode_kegiatan->CurrentValue;
        $this->kode_kro->CurrentValue = null;
        $this->kode_kro->OldValue = $this->kode_kro->CurrentValue;
        $this->kode_ro->CurrentValue = null;
        $this->kode_ro->OldValue = $this->kode_ro->CurrentValue;
        $this->kode_komponen->CurrentValue = null;
        $this->kode_komponen->OldValue = $this->kode_komponen->CurrentValue;
        $this->kode_subkomponen->CurrentValue = null;
        $this->kode_subkomponen->OldValue = $this->kode_subkomponen->CurrentValue;
        $this->total_biaya->CurrentValue = null;
        $this->total_biaya->OldValue = $this->total_biaya->CurrentValue;
        $this->reviewer_note_id->CurrentValue = null;
        $this->reviewer_note_id->OldValue = $this->reviewer_note_id->CurrentValue;
        $this->approval_note_id->CurrentValue = null;
        $this->approval_note_id->OldValue = $this->approval_note_id->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'satker_id' first before field var 'x_satker_id'
        $val = $CurrentForm->hasValue("satker_id") ? $CurrentForm->getValue("satker_id") : $CurrentForm->getValue("x_satker_id");
        if (!$this->satker_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->satker_id->Visible = false; // Disable update for API request
            } else {
                $this->satker_id->setFormValue($val);
            }
        }

        // Check field name 'kode_kegiatan' first before field var 'x_kode_kegiatan'
        $val = $CurrentForm->hasValue("kode_kegiatan") ? $CurrentForm->getValue("kode_kegiatan") : $CurrentForm->getValue("x_kode_kegiatan");
        if (!$this->kode_kegiatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_kegiatan->Visible = false; // Disable update for API request
            } else {
                $this->kode_kegiatan->setFormValue($val);
            }
        }

        // Check field name 'kode_kro' first before field var 'x_kode_kro'
        $val = $CurrentForm->hasValue("kode_kro") ? $CurrentForm->getValue("kode_kro") : $CurrentForm->getValue("x_kode_kro");
        if (!$this->kode_kro->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_kro->Visible = false; // Disable update for API request
            } else {
                $this->kode_kro->setFormValue($val);
            }
        }

        // Check field name 'kode_ro' first before field var 'x_kode_ro'
        $val = $CurrentForm->hasValue("kode_ro") ? $CurrentForm->getValue("kode_ro") : $CurrentForm->getValue("x_kode_ro");
        if (!$this->kode_ro->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_ro->Visible = false; // Disable update for API request
            } else {
                $this->kode_ro->setFormValue($val);
            }
        }

        // Check field name 'kode_komponen' first before field var 'x_kode_komponen'
        $val = $CurrentForm->hasValue("kode_komponen") ? $CurrentForm->getValue("kode_komponen") : $CurrentForm->getValue("x_kode_komponen");
        if (!$this->kode_komponen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_komponen->Visible = false; // Disable update for API request
            } else {
                $this->kode_komponen->setFormValue($val);
            }
        }

        // Check field name 'kode_subkomponen' first before field var 'x_kode_subkomponen'
        $val = $CurrentForm->hasValue("kode_subkomponen") ? $CurrentForm->getValue("kode_subkomponen") : $CurrentForm->getValue("x_kode_subkomponen");
        if (!$this->kode_subkomponen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_subkomponen->Visible = false; // Disable update for API request
            } else {
                $this->kode_subkomponen->setFormValue($val);
            }
        }

        // Check field name 'total_biaya' first before field var 'x_total_biaya'
        $val = $CurrentForm->hasValue("total_biaya") ? $CurrentForm->getValue("total_biaya") : $CurrentForm->getValue("x_total_biaya");
        if (!$this->total_biaya->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total_biaya->Visible = false; // Disable update for API request
            } else {
                $this->total_biaya->setFormValue($val);
            }
        }

        // Check field name 'reviewer_note_id' first before field var 'x_reviewer_note_id'
        $val = $CurrentForm->hasValue("reviewer_note_id") ? $CurrentForm->getValue("reviewer_note_id") : $CurrentForm->getValue("x_reviewer_note_id");
        if (!$this->reviewer_note_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reviewer_note_id->Visible = false; // Disable update for API request
            } else {
                $this->reviewer_note_id->setFormValue($val);
            }
        }

        // Check field name 'approval_note_id' first before field var 'x_approval_note_id'
        $val = $CurrentForm->hasValue("approval_note_id") ? $CurrentForm->getValue("approval_note_id") : $CurrentForm->getValue("x_approval_note_id");
        if (!$this->approval_note_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->approval_note_id->Visible = false; // Disable update for API request
            } else {
                $this->approval_note_id->setFormValue($val);
            }
        }

        // Check field name 'rab_kegiatan_id' first before field var 'x_rab_kegiatan_id'
        $val = $CurrentForm->hasValue("rab_kegiatan_id") ? $CurrentForm->getValue("rab_kegiatan_id") : $CurrentForm->getValue("x_rab_kegiatan_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->satker_id->CurrentValue = $this->satker_id->FormValue;
        $this->kode_kegiatan->CurrentValue = $this->kode_kegiatan->FormValue;
        $this->kode_kro->CurrentValue = $this->kode_kro->FormValue;
        $this->kode_ro->CurrentValue = $this->kode_ro->FormValue;
        $this->kode_komponen->CurrentValue = $this->kode_komponen->FormValue;
        $this->kode_subkomponen->CurrentValue = $this->kode_subkomponen->FormValue;
        $this->total_biaya->CurrentValue = $this->total_biaya->FormValue;
        $this->reviewer_note_id->CurrentValue = $this->reviewer_note_id->FormValue;
        $this->approval_note_id->CurrentValue = $this->approval_note_id->FormValue;
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
        $this->rab_kegiatan_id->setDbValue($row['rab_kegiatan_id']);
        $this->satker_id->setDbValue($row['satker_id']);
        $this->kode_kegiatan->setDbValue($row['kode_kegiatan']);
        $this->kode_kro->setDbValue($row['kode_kro']);
        $this->kode_ro->setDbValue($row['kode_ro']);
        $this->kode_komponen->setDbValue($row['kode_komponen']);
        $this->kode_subkomponen->setDbValue($row['kode_subkomponen']);
        $this->total_biaya->setDbValue($row['total_biaya']);
        $this->reviewer_note_id->setDbValue($row['reviewer_note_id']);
        $this->approval_note_id->setDbValue($row['approval_note_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['rab_kegiatan_id'] = $this->rab_kegiatan_id->CurrentValue;
        $row['satker_id'] = $this->satker_id->CurrentValue;
        $row['kode_kegiatan'] = $this->kode_kegiatan->CurrentValue;
        $row['kode_kro'] = $this->kode_kro->CurrentValue;
        $row['kode_ro'] = $this->kode_ro->CurrentValue;
        $row['kode_komponen'] = $this->kode_komponen->CurrentValue;
        $row['kode_subkomponen'] = $this->kode_subkomponen->CurrentValue;
        $row['total_biaya'] = $this->total_biaya->CurrentValue;
        $row['reviewer_note_id'] = $this->reviewer_note_id->CurrentValue;
        $row['approval_note_id'] = $this->approval_note_id->CurrentValue;
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
        if ($this->total_biaya->FormValue == $this->total_biaya->CurrentValue && is_numeric(ConvertToFloatString($this->total_biaya->CurrentValue))) {
            $this->total_biaya->CurrentValue = ConvertToFloatString($this->total_biaya->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // rab_kegiatan_id

        // satker_id

        // kode_kegiatan

        // kode_kro

        // kode_ro

        // kode_komponen

        // kode_subkomponen

        // total_biaya

        // reviewer_note_id

        // approval_note_id
        if ($this->RowType == ROWTYPE_VIEW) {
            // satker_id
            $curVal = trim(strval($this->satker_id->CurrentValue));
            if ($curVal != "") {
                $this->satker_id->ViewValue = $this->satker_id->lookupCacheOption($curVal);
                if ($this->satker_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`satker_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->satker_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->satker_id->Lookup->renderViewRow($rswrk[0]);
                        $this->satker_id->ViewValue = $this->satker_id->displayValue($arwrk);
                    } else {
                        $this->satker_id->ViewValue = $this->satker_id->CurrentValue;
                    }
                }
            } else {
                $this->satker_id->ViewValue = null;
            }
            $this->satker_id->ViewCustomAttributes = "";

            // kode_kegiatan
            $curVal = trim(strval($this->kode_kegiatan->CurrentValue));
            if ($curVal != "") {
                $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->lookupCacheOption($curVal);
                if ($this->kode_kegiatan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_kegiatan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->kode_kegiatan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_kegiatan->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->displayValue($arwrk);
                    } else {
                        $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->CurrentValue;
                    }
                }
            } else {
                $this->kode_kegiatan->ViewValue = null;
            }
            $this->kode_kegiatan->ViewCustomAttributes = "";

            // kode_kro
            $curVal = trim(strval($this->kode_kro->CurrentValue));
            if ($curVal != "") {
                $this->kode_kro->ViewValue = $this->kode_kro->lookupCacheOption($curVal);
                if ($this->kode_kro->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_kro`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->kode_kro->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_kro->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_kro->ViewValue = $this->kode_kro->displayValue($arwrk);
                    } else {
                        $this->kode_kro->ViewValue = $this->kode_kro->CurrentValue;
                    }
                }
            } else {
                $this->kode_kro->ViewValue = null;
            }
            $this->kode_kro->ViewCustomAttributes = "";

            // kode_ro
            $curVal = trim(strval($this->kode_ro->CurrentValue));
            if ($curVal != "") {
                $this->kode_ro->ViewValue = $this->kode_ro->lookupCacheOption($curVal);
                if ($this->kode_ro->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_ro`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->kode_ro->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_ro->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_ro->ViewValue = $this->kode_ro->displayValue($arwrk);
                    } else {
                        $this->kode_ro->ViewValue = $this->kode_ro->CurrentValue;
                    }
                }
            } else {
                $this->kode_ro->ViewValue = null;
            }
            $this->kode_ro->ViewCustomAttributes = "";

            // kode_komponen
            $curVal = trim(strval($this->kode_komponen->CurrentValue));
            if ($curVal != "") {
                $this->kode_komponen->ViewValue = $this->kode_komponen->lookupCacheOption($curVal);
                if ($this->kode_komponen->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_komponen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->kode_komponen->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_komponen->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_komponen->ViewValue = $this->kode_komponen->displayValue($arwrk);
                    } else {
                        $this->kode_komponen->ViewValue = $this->kode_komponen->CurrentValue;
                    }
                }
            } else {
                $this->kode_komponen->ViewValue = null;
            }
            $this->kode_komponen->ViewCustomAttributes = "";

            // kode_subkomponen
            $curVal = trim(strval($this->kode_subkomponen->CurrentValue));
            if ($curVal != "") {
                $this->kode_subkomponen->ViewValue = $this->kode_subkomponen->lookupCacheOption($curVal);
                if ($this->kode_subkomponen->ViewValue === null) { // Lookup from database
                    $filterWrk = "`kode_subkomponen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->kode_subkomponen->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_subkomponen->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_subkomponen->ViewValue = $this->kode_subkomponen->displayValue($arwrk);
                    } else {
                        $this->kode_subkomponen->ViewValue = $this->kode_subkomponen->CurrentValue;
                    }
                }
            } else {
                $this->kode_subkomponen->ViewValue = null;
            }
            $this->kode_subkomponen->ViewCustomAttributes = "";

            // total_biaya
            $this->total_biaya->ViewValue = $this->total_biaya->CurrentValue;
            $this->total_biaya->ViewValue = FormatNumber($this->total_biaya->ViewValue, 2, -2, -2, -2);
            $this->total_biaya->ViewCustomAttributes = "";

            // reviewer_note_id
            $curVal = trim(strval($this->reviewer_note_id->CurrentValue));
            if ($curVal != "") {
                $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->lookupCacheOption($curVal);
                if ($this->reviewer_note_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`reviewer_note_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->reviewer_note_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->reviewer_note_id->Lookup->renderViewRow($rswrk[0]);
                        $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->displayValue($arwrk);
                    } else {
                        $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->CurrentValue;
                    }
                }
            } else {
                $this->reviewer_note_id->ViewValue = null;
            }
            $this->reviewer_note_id->ViewCustomAttributes = "";

            // approval_note_id
            $curVal = trim(strval($this->approval_note_id->CurrentValue));
            if ($curVal != "") {
                $this->approval_note_id->ViewValue = $this->approval_note_id->lookupCacheOption($curVal);
                if ($this->approval_note_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`approval_note_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->approval_note_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->approval_note_id->Lookup->renderViewRow($rswrk[0]);
                        $this->approval_note_id->ViewValue = $this->approval_note_id->displayValue($arwrk);
                    } else {
                        $this->approval_note_id->ViewValue = $this->approval_note_id->CurrentValue;
                    }
                }
            } else {
                $this->approval_note_id->ViewValue = null;
            }
            $this->approval_note_id->ViewCustomAttributes = "";

            // satker_id
            $this->satker_id->LinkCustomAttributes = "";
            $this->satker_id->HrefValue = "";
            $this->satker_id->TooltipValue = "";

            // kode_kegiatan
            $this->kode_kegiatan->LinkCustomAttributes = "";
            $this->kode_kegiatan->HrefValue = "";
            $this->kode_kegiatan->TooltipValue = "";

            // kode_kro
            $this->kode_kro->LinkCustomAttributes = "";
            $this->kode_kro->HrefValue = "";
            $this->kode_kro->TooltipValue = "";

            // kode_ro
            $this->kode_ro->LinkCustomAttributes = "";
            $this->kode_ro->HrefValue = "";
            $this->kode_ro->TooltipValue = "";

            // kode_komponen
            $this->kode_komponen->LinkCustomAttributes = "";
            $this->kode_komponen->HrefValue = "";
            $this->kode_komponen->TooltipValue = "";

            // kode_subkomponen
            $this->kode_subkomponen->LinkCustomAttributes = "";
            $this->kode_subkomponen->HrefValue = "";
            $this->kode_subkomponen->TooltipValue = "";

            // total_biaya
            $this->total_biaya->LinkCustomAttributes = "";
            $this->total_biaya->HrefValue = "";
            $this->total_biaya->TooltipValue = "";

            // reviewer_note_id
            $this->reviewer_note_id->LinkCustomAttributes = "";
            $this->reviewer_note_id->HrefValue = "";
            $this->reviewer_note_id->TooltipValue = "";

            // approval_note_id
            $this->approval_note_id->LinkCustomAttributes = "";
            $this->approval_note_id->HrefValue = "";
            $this->approval_note_id->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // satker_id
            $this->satker_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->satker_id->CurrentValue));
            if ($curVal != "") {
                $this->satker_id->ViewValue = $this->satker_id->lookupCacheOption($curVal);
            } else {
                $this->satker_id->ViewValue = $this->satker_id->Lookup !== null && is_array($this->satker_id->Lookup->Options) ? $curVal : null;
            }
            if ($this->satker_id->ViewValue !== null) { // Load from cache
                $this->satker_id->EditValue = array_values($this->satker_id->Lookup->Options);
                if ($this->satker_id->ViewValue == "") {
                    $this->satker_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`satker_id`" . SearchString("=", $this->satker_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->satker_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->satker_id->Lookup->renderViewRow($rswrk[0]);
                    $this->satker_id->ViewValue = $this->satker_id->displayValue($arwrk);
                } else {
                    $this->satker_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->satker_id->EditValue = $arwrk;
            }
            $this->satker_id->PlaceHolder = RemoveHtml($this->satker_id->caption());

            // kode_kegiatan
            $this->kode_kegiatan->EditAttrs["class"] = "form-control";
            $this->kode_kegiatan->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_kegiatan->CurrentValue));
            if ($curVal != "") {
                $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->lookupCacheOption($curVal);
            } else {
                $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->Lookup !== null && is_array($this->kode_kegiatan->Lookup->Options) ? $curVal : null;
            }
            if ($this->kode_kegiatan->ViewValue !== null) { // Load from cache
                $this->kode_kegiatan->EditValue = array_values($this->kode_kegiatan->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_kegiatan`" . SearchString("=", $this->kode_kegiatan->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kode_kegiatan->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_kegiatan->EditValue = $arwrk;
            }
            $this->kode_kegiatan->PlaceHolder = RemoveHtml($this->kode_kegiatan->caption());

            // kode_kro
            $this->kode_kro->EditAttrs["class"] = "form-control";
            $this->kode_kro->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_kro->CurrentValue));
            if ($curVal != "") {
                $this->kode_kro->ViewValue = $this->kode_kro->lookupCacheOption($curVal);
            } else {
                $this->kode_kro->ViewValue = $this->kode_kro->Lookup !== null && is_array($this->kode_kro->Lookup->Options) ? $curVal : null;
            }
            if ($this->kode_kro->ViewValue !== null) { // Load from cache
                $this->kode_kro->EditValue = array_values($this->kode_kro->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_kro`" . SearchString("=", $this->kode_kro->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kode_kro->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_kro->EditValue = $arwrk;
            }
            $this->kode_kro->PlaceHolder = RemoveHtml($this->kode_kro->caption());

            // kode_ro
            $this->kode_ro->EditAttrs["class"] = "form-control";
            $this->kode_ro->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_ro->CurrentValue));
            if ($curVal != "") {
                $this->kode_ro->ViewValue = $this->kode_ro->lookupCacheOption($curVal);
            } else {
                $this->kode_ro->ViewValue = $this->kode_ro->Lookup !== null && is_array($this->kode_ro->Lookup->Options) ? $curVal : null;
            }
            if ($this->kode_ro->ViewValue !== null) { // Load from cache
                $this->kode_ro->EditValue = array_values($this->kode_ro->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_ro`" . SearchString("=", $this->kode_ro->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kode_ro->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_ro->EditValue = $arwrk;
            }
            $this->kode_ro->PlaceHolder = RemoveHtml($this->kode_ro->caption());

            // kode_komponen
            $this->kode_komponen->EditAttrs["class"] = "form-control";
            $this->kode_komponen->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_komponen->CurrentValue));
            if ($curVal != "") {
                $this->kode_komponen->ViewValue = $this->kode_komponen->lookupCacheOption($curVal);
            } else {
                $this->kode_komponen->ViewValue = $this->kode_komponen->Lookup !== null && is_array($this->kode_komponen->Lookup->Options) ? $curVal : null;
            }
            if ($this->kode_komponen->ViewValue !== null) { // Load from cache
                $this->kode_komponen->EditValue = array_values($this->kode_komponen->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_komponen`" . SearchString("=", $this->kode_komponen->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kode_komponen->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_komponen->EditValue = $arwrk;
            }
            $this->kode_komponen->PlaceHolder = RemoveHtml($this->kode_komponen->caption());

            // kode_subkomponen
            $this->kode_subkomponen->EditAttrs["class"] = "form-control";
            $this->kode_subkomponen->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_subkomponen->CurrentValue));
            if ($curVal != "") {
                $this->kode_subkomponen->ViewValue = $this->kode_subkomponen->lookupCacheOption($curVal);
            } else {
                $this->kode_subkomponen->ViewValue = $this->kode_subkomponen->Lookup !== null && is_array($this->kode_subkomponen->Lookup->Options) ? $curVal : null;
            }
            if ($this->kode_subkomponen->ViewValue !== null) { // Load from cache
                $this->kode_subkomponen->EditValue = array_values($this->kode_subkomponen->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`kode_subkomponen`" . SearchString("=", $this->kode_subkomponen->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->kode_subkomponen->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_subkomponen->EditValue = $arwrk;
            }
            $this->kode_subkomponen->PlaceHolder = RemoveHtml($this->kode_subkomponen->caption());

            // total_biaya
            $this->total_biaya->EditAttrs["class"] = "form-control";
            $this->total_biaya->EditCustomAttributes = "";
            $this->total_biaya->EditValue = HtmlEncode($this->total_biaya->CurrentValue);
            $this->total_biaya->PlaceHolder = RemoveHtml($this->total_biaya->caption());
            if (strval($this->total_biaya->EditValue) != "" && is_numeric($this->total_biaya->EditValue)) {
                $this->total_biaya->EditValue = FormatNumber($this->total_biaya->EditValue, -2, -2, -2, -2);
            }

            // reviewer_note_id
            $this->reviewer_note_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->reviewer_note_id->CurrentValue));
            if ($curVal != "") {
                $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->lookupCacheOption($curVal);
            } else {
                $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->Lookup !== null && is_array($this->reviewer_note_id->Lookup->Options) ? $curVal : null;
            }
            if ($this->reviewer_note_id->ViewValue !== null) { // Load from cache
                $this->reviewer_note_id->EditValue = array_values($this->reviewer_note_id->Lookup->Options);
                if ($this->reviewer_note_id->ViewValue == "") {
                    $this->reviewer_note_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`reviewer_note_id`" . SearchString("=", $this->reviewer_note_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->reviewer_note_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->reviewer_note_id->Lookup->renderViewRow($rswrk[0]);
                    $this->reviewer_note_id->ViewValue = $this->reviewer_note_id->displayValue($arwrk);
                } else {
                    $this->reviewer_note_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->reviewer_note_id->EditValue = $arwrk;
            }
            $this->reviewer_note_id->PlaceHolder = RemoveHtml($this->reviewer_note_id->caption());

            // approval_note_id
            $this->approval_note_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->approval_note_id->CurrentValue));
            if ($curVal != "") {
                $this->approval_note_id->ViewValue = $this->approval_note_id->lookupCacheOption($curVal);
            } else {
                $this->approval_note_id->ViewValue = $this->approval_note_id->Lookup !== null && is_array($this->approval_note_id->Lookup->Options) ? $curVal : null;
            }
            if ($this->approval_note_id->ViewValue !== null) { // Load from cache
                $this->approval_note_id->EditValue = array_values($this->approval_note_id->Lookup->Options);
                if ($this->approval_note_id->ViewValue == "") {
                    $this->approval_note_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`approval_note_id`" . SearchString("=", $this->approval_note_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->approval_note_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->approval_note_id->Lookup->renderViewRow($rswrk[0]);
                    $this->approval_note_id->ViewValue = $this->approval_note_id->displayValue($arwrk);
                } else {
                    $this->approval_note_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->approval_note_id->EditValue = $arwrk;
            }
            $this->approval_note_id->PlaceHolder = RemoveHtml($this->approval_note_id->caption());

            // Add refer script

            // satker_id
            $this->satker_id->LinkCustomAttributes = "";
            $this->satker_id->HrefValue = "";

            // kode_kegiatan
            $this->kode_kegiatan->LinkCustomAttributes = "";
            $this->kode_kegiatan->HrefValue = "";

            // kode_kro
            $this->kode_kro->LinkCustomAttributes = "";
            $this->kode_kro->HrefValue = "";

            // kode_ro
            $this->kode_ro->LinkCustomAttributes = "";
            $this->kode_ro->HrefValue = "";

            // kode_komponen
            $this->kode_komponen->LinkCustomAttributes = "";
            $this->kode_komponen->HrefValue = "";

            // kode_subkomponen
            $this->kode_subkomponen->LinkCustomAttributes = "";
            $this->kode_subkomponen->HrefValue = "";

            // total_biaya
            $this->total_biaya->LinkCustomAttributes = "";
            $this->total_biaya->HrefValue = "";

            // reviewer_note_id
            $this->reviewer_note_id->LinkCustomAttributes = "";
            $this->reviewer_note_id->HrefValue = "";

            // approval_note_id
            $this->approval_note_id->LinkCustomAttributes = "";
            $this->approval_note_id->HrefValue = "";
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
        if ($this->satker_id->Required) {
            if (!$this->satker_id->IsDetailKey && EmptyValue($this->satker_id->FormValue)) {
                $this->satker_id->addErrorMessage(str_replace("%s", $this->satker_id->caption(), $this->satker_id->RequiredErrorMessage));
            }
        }
        if ($this->kode_kegiatan->Required) {
            if (!$this->kode_kegiatan->IsDetailKey && EmptyValue($this->kode_kegiatan->FormValue)) {
                $this->kode_kegiatan->addErrorMessage(str_replace("%s", $this->kode_kegiatan->caption(), $this->kode_kegiatan->RequiredErrorMessage));
            }
        }
        if ($this->kode_kro->Required) {
            if (!$this->kode_kro->IsDetailKey && EmptyValue($this->kode_kro->FormValue)) {
                $this->kode_kro->addErrorMessage(str_replace("%s", $this->kode_kro->caption(), $this->kode_kro->RequiredErrorMessage));
            }
        }
        if ($this->kode_ro->Required) {
            if (!$this->kode_ro->IsDetailKey && EmptyValue($this->kode_ro->FormValue)) {
                $this->kode_ro->addErrorMessage(str_replace("%s", $this->kode_ro->caption(), $this->kode_ro->RequiredErrorMessage));
            }
        }
        if ($this->kode_komponen->Required) {
            if (!$this->kode_komponen->IsDetailKey && EmptyValue($this->kode_komponen->FormValue)) {
                $this->kode_komponen->addErrorMessage(str_replace("%s", $this->kode_komponen->caption(), $this->kode_komponen->RequiredErrorMessage));
            }
        }
        if ($this->kode_subkomponen->Required) {
            if (!$this->kode_subkomponen->IsDetailKey && EmptyValue($this->kode_subkomponen->FormValue)) {
                $this->kode_subkomponen->addErrorMessage(str_replace("%s", $this->kode_subkomponen->caption(), $this->kode_subkomponen->RequiredErrorMessage));
            }
        }
        if ($this->total_biaya->Required) {
            if (!$this->total_biaya->IsDetailKey && EmptyValue($this->total_biaya->FormValue)) {
                $this->total_biaya->addErrorMessage(str_replace("%s", $this->total_biaya->caption(), $this->total_biaya->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->total_biaya->FormValue)) {
            $this->total_biaya->addErrorMessage($this->total_biaya->getErrorMessage(false));
        }
        if ($this->reviewer_note_id->Required) {
            if (!$this->reviewer_note_id->IsDetailKey && EmptyValue($this->reviewer_note_id->FormValue)) {
                $this->reviewer_note_id->addErrorMessage(str_replace("%s", $this->reviewer_note_id->caption(), $this->reviewer_note_id->RequiredErrorMessage));
            }
        }
        if ($this->approval_note_id->Required) {
            if (!$this->approval_note_id->IsDetailKey && EmptyValue($this->approval_note_id->FormValue)) {
                $this->approval_note_id->addErrorMessage(str_replace("%s", $this->approval_note_id->caption(), $this->approval_note_id->RequiredErrorMessage));
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
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // satker_id
        $this->satker_id->setDbValueDef($rsnew, $this->satker_id->CurrentValue, null, false);

        // kode_kegiatan
        $this->kode_kegiatan->setDbValueDef($rsnew, $this->kode_kegiatan->CurrentValue, null, false);

        // kode_kro
        $this->kode_kro->setDbValueDef($rsnew, $this->kode_kro->CurrentValue, null, false);

        // kode_ro
        $this->kode_ro->setDbValueDef($rsnew, $this->kode_ro->CurrentValue, null, false);

        // kode_komponen
        $this->kode_komponen->setDbValueDef($rsnew, $this->kode_komponen->CurrentValue, null, false);

        // kode_subkomponen
        $this->kode_subkomponen->setDbValueDef($rsnew, $this->kode_subkomponen->CurrentValue, null, false);

        // total_biaya
        $this->total_biaya->setDbValueDef($rsnew, $this->total_biaya->CurrentValue, null, false);

        // reviewer_note_id
        $this->reviewer_note_id->setDbValueDef($rsnew, $this->reviewer_note_id->CurrentValue, null, false);

        // approval_note_id
        $this->approval_note_id->setDbValueDef($rsnew, $this->approval_note_id->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("RabKegiatan2List"), "", $this->TableVar, true);
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
                case "x_satker_id":
                    break;
                case "x_kode_kegiatan":
                    break;
                case "x_kode_kro":
                    break;
                case "x_kode_ro":
                    break;
                case "x_kode_komponen":
                    break;
                case "x_kode_subkomponen":
                    break;
                case "x_reviewer_note_id":
                    break;
                case "x_approval_note_id":
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
