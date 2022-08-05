<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for v_rab_report
 */
class VRabReport extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $nama_satker;
    public $kode_kegiatan;
    public $uraian;
    public $volum;
    public $satuan;
    public $sbm;
    public $kode_akun;
    public $subtotal;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_rab_report';
        $this->TableName = 'v_rab_report';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_rab_report`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // nama_satker
        $this->nama_satker = new DbField('v_rab_report', 'v_rab_report', 'x_nama_satker', 'nama_satker', '`nama_satker`', '`nama_satker`', 200, 70, -1, false, '`nama_satker`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_satker->Sortable = true; // Allow sort
        $this->nama_satker->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_satker->Param, "CustomMsg");
        $this->Fields['nama_satker'] = &$this->nama_satker;

        // kode_kegiatan
        $this->kode_kegiatan = new DbField('v_rab_report', 'v_rab_report', 'x_kode_kegiatan', 'kode_kegiatan', '`kode_kegiatan`', '`kode_kegiatan`', 200, 120, -1, false, '`kode_kegiatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kode_kegiatan->Sortable = true; // Allow sort
        $this->kode_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_kegiatan->Param, "CustomMsg");
        $this->Fields['kode_kegiatan'] = &$this->kode_kegiatan;

        // uraian
        $this->uraian = new DbField('v_rab_report', 'v_rab_report', 'x_uraian', 'uraian', '`uraian`', '`uraian`', 200, 255, -1, false, '`uraian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->uraian->Sortable = true; // Allow sort
        $this->uraian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->uraian->Param, "CustomMsg");
        $this->Fields['uraian'] = &$this->uraian;

        // volum
        $this->volum = new DbField('v_rab_report', 'v_rab_report', 'x_volum', 'volum', '`volum`', '`volum`', 3, 11, -1, false, '`volum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->volum->Sortable = true; // Allow sort
        $this->volum->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->volum->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->volum->Param, "CustomMsg");
        $this->Fields['volum'] = &$this->volum;

        // satuan
        $this->satuan = new DbField('v_rab_report', 'v_rab_report', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 200, 50, -1, false, '`satuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->satuan->Sortable = true; // Allow sort
        $this->satuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->satuan->Param, "CustomMsg");
        $this->Fields['satuan'] = &$this->satuan;

        // sbm
        $this->sbm = new DbField('v_rab_report', 'v_rab_report', 'x_sbm', 'sbm', '`sbm`', '`sbm`', 131, 15, -1, false, '`sbm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sbm->Sortable = true; // Allow sort
        $this->sbm->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->sbm->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->sbm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sbm->Param, "CustomMsg");
        $this->Fields['sbm'] = &$this->sbm;

        // kode_akun
        $this->kode_akun = new DbField('v_rab_report', 'v_rab_report', 'x_kode_akun', 'kode_akun', '`kode_akun`', '`kode_akun`', 200, 120, -1, false, '`kode_akun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kode_akun->Sortable = true; // Allow sort
        $this->kode_akun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_akun->Param, "CustomMsg");
        $this->Fields['kode_akun'] = &$this->kode_akun;

        // subtotal
        $this->subtotal = new DbField('v_rab_report', 'v_rab_report', 'x_subtotal', 'subtotal', '`subtotal`', '`subtotal`', 131, 15, -1, false, '`subtotal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->subtotal->Sortable = true; // Allow sort
        $this->subtotal->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->subtotal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->subtotal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->subtotal->Param, "CustomMsg");
        $this->Fields['subtotal'] = &$this->subtotal;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_rab_report`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->nama_satker->DbValue = $row['nama_satker'];
        $this->kode_kegiatan->DbValue = $row['kode_kegiatan'];
        $this->uraian->DbValue = $row['uraian'];
        $this->volum->DbValue = $row['volum'];
        $this->satuan->DbValue = $row['satuan'];
        $this->sbm->DbValue = $row['sbm'];
        $this->kode_akun->DbValue = $row['kode_akun'];
        $this->subtotal->DbValue = $row['subtotal'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("VRabReportList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "VRabReportView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VRabReportEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VRabReportAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "VRabReportView";
            case Config("API_ADD_ACTION"):
                return "VRabReportAdd";
            case Config("API_EDIT_ACTION"):
                return "VRabReportEdit";
            case Config("API_DELETE_ACTION"):
                return "VRabReportDelete";
            case Config("API_LIST_ACTION"):
                return "VRabReportList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VRabReportList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VRabReportView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VRabReportView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VRabReportAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VRabReportAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VRabReportEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("VRabReportAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("VRabReportDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->nama_satker->setDbValue($row['nama_satker']);
        $this->kode_kegiatan->setDbValue($row['kode_kegiatan']);
        $this->uraian->setDbValue($row['uraian']);
        $this->volum->setDbValue($row['volum']);
        $this->satuan->setDbValue($row['satuan']);
        $this->sbm->setDbValue($row['sbm']);
        $this->kode_akun->setDbValue($row['kode_akun']);
        $this->subtotal->setDbValue($row['subtotal']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nama_satker

        // kode_kegiatan

        // uraian

        // volum

        // satuan

        // sbm

        // kode_akun

        // subtotal

        // nama_satker
        $this->nama_satker->ViewValue = $this->nama_satker->CurrentValue;
        $this->nama_satker->ViewCustomAttributes = "";

        // kode_kegiatan
        $this->kode_kegiatan->ViewValue = $this->kode_kegiatan->CurrentValue;
        $this->kode_kegiatan->ViewCustomAttributes = "";

        // uraian
        $this->uraian->ViewValue = $this->uraian->CurrentValue;
        $this->uraian->ViewCustomAttributes = "";

        // volum
        $this->volum->ViewValue = $this->volum->CurrentValue;
        $this->volum->ViewValue = FormatNumber($this->volum->ViewValue, 0, -2, -2, -2);
        $this->volum->ViewCustomAttributes = "";

        // satuan
        $this->satuan->ViewValue = $this->satuan->CurrentValue;
        $this->satuan->ViewCustomAttributes = "";

        // sbm
        $this->sbm->ViewValue = $this->sbm->CurrentValue;
        $this->sbm->ViewValue = FormatNumber($this->sbm->ViewValue, 2, -2, -2, -2);
        $this->sbm->ViewCustomAttributes = "";

        // kode_akun
        $this->kode_akun->ViewValue = $this->kode_akun->CurrentValue;
        $this->kode_akun->ViewCustomAttributes = "";

        // subtotal
        $this->subtotal->ViewValue = $this->subtotal->CurrentValue;
        $this->subtotal->ViewValue = FormatNumber($this->subtotal->ViewValue, 2, -2, -2, -2);
        $this->subtotal->ViewCustomAttributes = "";

        // nama_satker
        $this->nama_satker->LinkCustomAttributes = "";
        $this->nama_satker->HrefValue = "";
        $this->nama_satker->TooltipValue = "";

        // kode_kegiatan
        $this->kode_kegiatan->LinkCustomAttributes = "";
        $this->kode_kegiatan->HrefValue = "";
        $this->kode_kegiatan->TooltipValue = "";

        // uraian
        $this->uraian->LinkCustomAttributes = "";
        $this->uraian->HrefValue = "";
        $this->uraian->TooltipValue = "";

        // volum
        $this->volum->LinkCustomAttributes = "";
        $this->volum->HrefValue = "";
        $this->volum->TooltipValue = "";

        // satuan
        $this->satuan->LinkCustomAttributes = "";
        $this->satuan->HrefValue = "";
        $this->satuan->TooltipValue = "";

        // sbm
        $this->sbm->LinkCustomAttributes = "";
        $this->sbm->HrefValue = "";
        $this->sbm->TooltipValue = "";

        // kode_akun
        $this->kode_akun->LinkCustomAttributes = "";
        $this->kode_akun->HrefValue = "";
        $this->kode_akun->TooltipValue = "";

        // subtotal
        $this->subtotal->LinkCustomAttributes = "";
        $this->subtotal->HrefValue = "";
        $this->subtotal->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // nama_satker
        $this->nama_satker->EditAttrs["class"] = "form-control";
        $this->nama_satker->EditCustomAttributes = "";
        if (!$this->nama_satker->Raw) {
            $this->nama_satker->CurrentValue = HtmlDecode($this->nama_satker->CurrentValue);
        }
        $this->nama_satker->EditValue = $this->nama_satker->CurrentValue;
        $this->nama_satker->PlaceHolder = RemoveHtml($this->nama_satker->caption());

        // kode_kegiatan
        $this->kode_kegiatan->EditAttrs["class"] = "form-control";
        $this->kode_kegiatan->EditCustomAttributes = "";
        if (!$this->kode_kegiatan->Raw) {
            $this->kode_kegiatan->CurrentValue = HtmlDecode($this->kode_kegiatan->CurrentValue);
        }
        $this->kode_kegiatan->EditValue = $this->kode_kegiatan->CurrentValue;
        $this->kode_kegiatan->PlaceHolder = RemoveHtml($this->kode_kegiatan->caption());

        // uraian
        $this->uraian->EditAttrs["class"] = "form-control";
        $this->uraian->EditCustomAttributes = "";
        if (!$this->uraian->Raw) {
            $this->uraian->CurrentValue = HtmlDecode($this->uraian->CurrentValue);
        }
        $this->uraian->EditValue = $this->uraian->CurrentValue;
        $this->uraian->PlaceHolder = RemoveHtml($this->uraian->caption());

        // volum
        $this->volum->EditAttrs["class"] = "form-control";
        $this->volum->EditCustomAttributes = "";
        $this->volum->EditValue = $this->volum->CurrentValue;
        $this->volum->PlaceHolder = RemoveHtml($this->volum->caption());

        // satuan
        $this->satuan->EditAttrs["class"] = "form-control";
        $this->satuan->EditCustomAttributes = "";
        if (!$this->satuan->Raw) {
            $this->satuan->CurrentValue = HtmlDecode($this->satuan->CurrentValue);
        }
        $this->satuan->EditValue = $this->satuan->CurrentValue;
        $this->satuan->PlaceHolder = RemoveHtml($this->satuan->caption());

        // sbm
        $this->sbm->EditAttrs["class"] = "form-control";
        $this->sbm->EditCustomAttributes = "";
        $this->sbm->EditValue = $this->sbm->CurrentValue;
        $this->sbm->PlaceHolder = RemoveHtml($this->sbm->caption());
        if (strval($this->sbm->EditValue) != "" && is_numeric($this->sbm->EditValue)) {
            $this->sbm->EditValue = FormatNumber($this->sbm->EditValue, -2, -2, -2, -2);
        }

        // kode_akun
        $this->kode_akun->EditAttrs["class"] = "form-control";
        $this->kode_akun->EditCustomAttributes = "";
        if (!$this->kode_akun->Raw) {
            $this->kode_akun->CurrentValue = HtmlDecode($this->kode_akun->CurrentValue);
        }
        $this->kode_akun->EditValue = $this->kode_akun->CurrentValue;
        $this->kode_akun->PlaceHolder = RemoveHtml($this->kode_akun->caption());

        // subtotal
        $this->subtotal->EditAttrs["class"] = "form-control";
        $this->subtotal->EditCustomAttributes = "";
        $this->subtotal->EditValue = $this->subtotal->CurrentValue;
        $this->subtotal->PlaceHolder = RemoveHtml($this->subtotal->caption());
        if (strval($this->subtotal->EditValue) != "" && is_numeric($this->subtotal->EditValue)) {
            $this->subtotal->EditValue = FormatNumber($this->subtotal->EditValue, -2, -2, -2, -2);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->nama_satker);
                    $doc->exportCaption($this->kode_kegiatan);
                    $doc->exportCaption($this->uraian);
                    $doc->exportCaption($this->volum);
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->sbm);
                    $doc->exportCaption($this->kode_akun);
                    $doc->exportCaption($this->subtotal);
                } else {
                    $doc->exportCaption($this->nama_satker);
                    $doc->exportCaption($this->kode_kegiatan);
                    $doc->exportCaption($this->uraian);
                    $doc->exportCaption($this->volum);
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->sbm);
                    $doc->exportCaption($this->kode_akun);
                    $doc->exportCaption($this->subtotal);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->nama_satker);
                        $doc->exportField($this->kode_kegiatan);
                        $doc->exportField($this->uraian);
                        $doc->exportField($this->volum);
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->sbm);
                        $doc->exportField($this->kode_akun);
                        $doc->exportField($this->subtotal);
                    } else {
                        $doc->exportField($this->nama_satker);
                        $doc->exportField($this->kode_kegiatan);
                        $doc->exportField($this->uraian);
                        $doc->exportField($this->volum);
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->sbm);
                        $doc->exportField($this->kode_akun);
                        $doc->exportField($this->subtotal);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}