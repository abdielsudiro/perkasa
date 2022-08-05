<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for rab
 */
class Rab extends DbTable
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
    public $id_rab;
    public $status;
    public $satker_id;
    public $kode_program;
    public $kode_kegiatan;
    public $kode_kro;
    public $kode_komponen;
    public $kode_subkomponen;
    public $kode_ro;
    public $filename;
    public $request_file_id;
    public $id_statuses;
    public $isApprovalAgree;
    public $isPenelaahAgree;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'rab';
        $this->TableName = 'rab';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`rab`";
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

        // id_rab
        $this->id_rab = new DbField('rab', 'rab', 'x_id_rab', 'id_rab', '`id_rab`', '`id_rab`', 3, 11, -1, false, '`id_rab`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_rab->IsAutoIncrement = true; // Autoincrement field
        $this->id_rab->IsPrimaryKey = true; // Primary key field
        $this->id_rab->IsForeignKey = true; // Foreign key field
        $this->id_rab->Sortable = true; // Allow sort
        $this->id_rab->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_rab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_rab->Param, "CustomMsg");
        $this->Fields['id_rab'] = &$this->id_rab;

        // status
        $this->status = new DbField('rab', 'rab', 'x_status', 'status', '`status`', '`status`', 200, 255, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status->Sortable = false; // Allow sort
        $this->status->Lookup = new Lookup('status', 'rab', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->status->OptionCount = 3;
        $this->status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status->Param, "CustomMsg");
        $this->Fields['status'] = &$this->status;

        // satker_id
        $this->satker_id = new DbField('rab', 'rab', 'x_satker_id', 'satker_id', '`satker_id`', '`satker_id`', 200, 120, -1, false, '`satker_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->satker_id->Sortable = true; // Allow sort
        $this->satker_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->satker_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->satker_id->Lookup = new Lookup('satker_id', 'satker', false, 'satker_id', ["nama_satker","","",""], [], [], [], [], [], [], '', '');
        $this->satker_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->satker_id->Param, "CustomMsg");
        $this->Fields['satker_id'] = &$this->satker_id;

        // kode_program
        $this->kode_program = new DbField('rab', 'rab', 'x_kode_program', 'kode_program', '`kode_program`', '`kode_program`', 200, 120, -1, false, '`kode_program`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_program->Sortable = true; // Allow sort
        $this->kode_program->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_program->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_program->Lookup = new Lookup('kode_program', 'program', false, 'kode_program', ["nama_program","","",""], [], ["x_kode_kegiatan"], [], [], [], [], '', '');
        $this->kode_program->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_program->Param, "CustomMsg");
        $this->Fields['kode_program'] = &$this->kode_program;

        // kode_kegiatan
        $this->kode_kegiatan = new DbField('rab', 'rab', 'x_kode_kegiatan', 'kode_kegiatan', '`kode_kegiatan`', '`kode_kegiatan`', 200, 120, -1, false, '`kode_kegiatan`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_kegiatan->Sortable = true; // Allow sort
        $this->kode_kegiatan->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_kegiatan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_kegiatan->Lookup = new Lookup('kode_kegiatan', 'kegiatan', false, 'kode_kegiatan', ["nama_kegiatan","","",""], ["x_kode_program"], ["x_kode_kro"], ["kode_program"], ["x_kode_program"], [], [], '', '');
        $this->kode_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_kegiatan->Param, "CustomMsg");
        $this->Fields['kode_kegiatan'] = &$this->kode_kegiatan;

        // kode_kro
        $this->kode_kro = new DbField('rab', 'rab', 'x_kode_kro', 'kode_kro', '`kode_kro`', '`kode_kro`', 200, 120, -1, false, '`kode_kro`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_kro->Sortable = true; // Allow sort
        $this->kode_kro->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_kro->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_kro->Lookup = new Lookup('kode_kro', 'kro', false, 'kode_kro', ["nama_kro","","",""], ["x_kode_kegiatan"], ["x_kode_ro"], ["kode_kegiatan"], ["x_kode_kegiatan"], [], [], '', '');
        $this->kode_kro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_kro->Param, "CustomMsg");
        $this->Fields['kode_kro'] = &$this->kode_kro;

        // kode_komponen
        $this->kode_komponen = new DbField('rab', 'rab', 'x_kode_komponen', 'kode_komponen', '`kode_komponen`', '`kode_komponen`', 200, 120, -1, false, '`kode_komponen`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_komponen->Sortable = true; // Allow sort
        $this->kode_komponen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_komponen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_komponen->Lookup = new Lookup('kode_komponen', 'komponen', false, 'kode_komponen', ["nama_komponen","","",""], ["x_kode_ro"], ["x_kode_subkomponen"], ["kode_ro"], ["x_kode_ro"], [], [], '', '');
        $this->kode_komponen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_komponen->Param, "CustomMsg");
        $this->Fields['kode_komponen'] = &$this->kode_komponen;

        // kode_subkomponen
        $this->kode_subkomponen = new DbField('rab', 'rab', 'x_kode_subkomponen', 'kode_subkomponen', '`kode_subkomponen`', '`kode_subkomponen`', 200, 120, -1, false, '`kode_subkomponen`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_subkomponen->Sortable = true; // Allow sort
        $this->kode_subkomponen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_subkomponen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_subkomponen->Lookup = new Lookup('kode_subkomponen', 'subkomponen', false, 'kode_subkomponen', ["nama_subkomponen","","",""], ["x_kode_komponen"], [], ["kode_komponen"], ["x_kode_komponen"], [], [], '', '');
        $this->kode_subkomponen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_subkomponen->Param, "CustomMsg");
        $this->Fields['kode_subkomponen'] = &$this->kode_subkomponen;

        // kode_ro
        $this->kode_ro = new DbField('rab', 'rab', 'x_kode_ro', 'kode_ro', '`kode_ro`', '`kode_ro`', 200, 120, -1, false, '`kode_ro`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_ro->Sortable = true; // Allow sort
        $this->kode_ro->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_ro->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_ro->Lookup = new Lookup('kode_ro', 'ro', false, 'kode_ro', ["nama_ro","","",""], ["x_kode_kro"], ["x_kode_komponen"], ["kode_kro"], ["x_kode_kro"], [], [], '', '');
        $this->kode_ro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_ro->Param, "CustomMsg");
        $this->Fields['kode_ro'] = &$this->kode_ro;

        // filename
        $this->filename = new DbField('rab', 'rab', 'x_filename', 'filename', '`filename`', '`filename`', 200, 100, -1, true, '`filename`', false, false, false, 'FORMATTED TEXT', 'FILE');
        $this->filename->Sortable = false; // Allow sort
        $this->filename->UploadMultiple = true;
        $this->filename->Upload->UploadMultiple = true;
        $this->filename->UploadMaxFileCount = 0;
        $this->filename->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->filename->Param, "CustomMsg");
        $this->Fields['filename'] = &$this->filename;

        // request_file_id
        $this->request_file_id = new DbField('rab', 'rab', 'x_request_file_id', 'request_file_id', '`request_file_id`', '`request_file_id`', 3, 11, -1, false, '`request_file_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->request_file_id->Sortable = false; // Allow sort
        $this->request_file_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->request_file_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->request_file_id->Param, "CustomMsg");
        $this->Fields['request_file_id'] = &$this->request_file_id;

        // id_statuses
        $this->id_statuses = new DbField('rab', 'rab', 'x_id_statuses', 'id_statuses', '`id_statuses`', '`id_statuses`', 3, 11, -1, false, '`id_statuses`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_statuses->Sortable = true; // Allow sort
        $this->id_statuses->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_statuses->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_statuses->Param, "CustomMsg");
        $this->Fields['id_statuses'] = &$this->id_statuses;

        // isApprovalAgree
        $this->isApprovalAgree = new DbField('rab', 'rab', 'x_isApprovalAgree', 'isApprovalAgree', '`isApprovalAgree`', '`isApprovalAgree`', 200, 10, -1, false, '`isApprovalAgree`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isApprovalAgree->Sortable = true; // Allow sort
        $this->isApprovalAgree->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isApprovalAgree->Param, "CustomMsg");
        $this->Fields['isApprovalAgree'] = &$this->isApprovalAgree;

        // isPenelaahAgree
        $this->isPenelaahAgree = new DbField('rab', 'rab', 'x_isPenelaahAgree', 'isPenelaahAgree', '`isPenelaahAgree`', '`isPenelaahAgree`', 200, 10, -1, false, '`isPenelaahAgree`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isPenelaahAgree->Sortable = true; // Allow sort
        $this->isPenelaahAgree->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isPenelaahAgree->Param, "CustomMsg");
        $this->Fields['isPenelaahAgree'] = &$this->isPenelaahAgree;
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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "rab_file") {
            $detailUrl = Container("rab_file")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_rab", $this->id_rab->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "rab_note_penelaah") {
            $detailUrl = Container("rab_note_penelaah")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_rab", $this->id_rab->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "rab_note_penyetuju") {
            $detailUrl = Container("rab_note_penyetuju")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_rab", $this->id_rab->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "rab_rincian") {
            $detailUrl = Container("rab_rincian")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id_rab", $this->id_rab->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "RabList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`rab`";
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
            // Get insert id if necessary
            $this->id_rab->setDbValue($conn->lastInsertId());
            $rs['id_rab'] = $this->id_rab->DbValue;
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
            if (array_key_exists('id_rab', $rs)) {
                AddFilter($where, QuotedName('id_rab', $this->Dbid) . '=' . QuotedValue($rs['id_rab'], $this->id_rab->DataType, $this->Dbid));
            }
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
        $this->id_rab->DbValue = $row['id_rab'];
        $this->status->DbValue = $row['status'];
        $this->satker_id->DbValue = $row['satker_id'];
        $this->kode_program->DbValue = $row['kode_program'];
        $this->kode_kegiatan->DbValue = $row['kode_kegiatan'];
        $this->kode_kro->DbValue = $row['kode_kro'];
        $this->kode_komponen->DbValue = $row['kode_komponen'];
        $this->kode_subkomponen->DbValue = $row['kode_subkomponen'];
        $this->kode_ro->DbValue = $row['kode_ro'];
        $this->filename->Upload->DbValue = $row['filename'];
        $this->request_file_id->DbValue = $row['request_file_id'];
        $this->id_statuses->DbValue = $row['id_statuses'];
        $this->isApprovalAgree->DbValue = $row['isApprovalAgree'];
        $this->isPenelaahAgree->DbValue = $row['isPenelaahAgree'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['filename']) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $row['filename']);
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->filename->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->filename->oldPhysicalUploadPath() . $oldFile);
            }
        }
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_rab` = @id_rab@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_rab->CurrentValue : $this->id_rab->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_rab->CurrentValue = $keys[0];
            } else {
                $this->id_rab->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_rab', $row) ? $row['id_rab'] : null;
        } else {
            $val = $this->id_rab->OldValue !== null ? $this->id_rab->OldValue : $this->id_rab->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_rab@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("RabList");
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
        if ($pageName == "RabView") {
            return $Language->phrase("View");
        } elseif ($pageName == "RabEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "RabAdd") {
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
                return "RabView";
            case Config("API_ADD_ACTION"):
                return "RabAdd";
            case Config("API_EDIT_ACTION"):
                return "RabEdit";
            case Config("API_DELETE_ACTION"):
                return "RabDelete";
            case Config("API_LIST_ACTION"):
                return "RabList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "RabList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("RabView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RabView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "RabAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "RabAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("RabEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RabEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("RabAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RabAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("RabDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_rab:" . JsonEncode($this->id_rab->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_rab->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_rab->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("id_rab") ?? Route("id_rab")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
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
            if ($setCurrent) {
                $this->id_rab->CurrentValue = $key;
            } else {
                $this->id_rab->OldValue = $key;
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
        $this->id_rab->setDbValue($row['id_rab']);
        $this->status->setDbValue($row['status']);
        $this->satker_id->setDbValue($row['satker_id']);
        $this->kode_program->setDbValue($row['kode_program']);
        $this->kode_kegiatan->setDbValue($row['kode_kegiatan']);
        $this->kode_kro->setDbValue($row['kode_kro']);
        $this->kode_komponen->setDbValue($row['kode_komponen']);
        $this->kode_subkomponen->setDbValue($row['kode_subkomponen']);
        $this->kode_ro->setDbValue($row['kode_ro']);
        $this->filename->Upload->DbValue = $row['filename'];
        $this->filename->setDbValue($this->filename->Upload->DbValue);
        $this->request_file_id->setDbValue($row['request_file_id']);
        $this->id_statuses->setDbValue($row['id_statuses']);
        $this->isApprovalAgree->setDbValue($row['isApprovalAgree']);
        $this->isPenelaahAgree->setDbValue($row['isPenelaahAgree']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_rab

        // status
        $this->status->CellCssStyle = "white-space: nowrap;";

        // satker_id

        // kode_program

        // kode_kegiatan

        // kode_kro

        // kode_komponen

        // kode_subkomponen

        // kode_ro

        // filename
        $this->filename->CellCssStyle = "white-space: nowrap;";

        // request_file_id
        $this->request_file_id->CellCssStyle = "white-space: nowrap;";

        // id_statuses

        // isApprovalAgree

        // isPenelaahAgree

        // id_rab
        $this->id_rab->ViewValue = $this->id_rab->CurrentValue;
        $this->id_rab->ViewValue = FormatNumber($this->id_rab->ViewValue, 0, 0, 0, 0);
        $this->id_rab->ViewCustomAttributes = "";

        // status
        if (strval($this->status->CurrentValue) != "") {
            $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
        } else {
            $this->status->ViewValue = null;
        }
        $this->status->ViewCustomAttributes = "";

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

        // kode_program
        $curVal = trim(strval($this->kode_program->CurrentValue));
        if ($curVal != "") {
            $this->kode_program->ViewValue = $this->kode_program->lookupCacheOption($curVal);
            if ($this->kode_program->ViewValue === null) { // Lookup from database
                $filterWrk = "`kode_program`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->kode_program->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->kode_program->Lookup->renderViewRow($rswrk[0]);
                    $this->kode_program->ViewValue = $this->kode_program->displayValue($arwrk);
                } else {
                    $this->kode_program->ViewValue = $this->kode_program->CurrentValue;
                }
            }
        } else {
            $this->kode_program->ViewValue = null;
        }
        $this->kode_program->ViewCustomAttributes = "";

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

        // filename
        if (!EmptyValue($this->filename->Upload->DbValue)) {
            $this->filename->ViewValue = $this->filename->Upload->DbValue;
        } else {
            $this->filename->ViewValue = "";
        }
        $this->filename->ViewCustomAttributes = "";

        // request_file_id
        $this->request_file_id->ViewValue = $this->request_file_id->CurrentValue;
        $this->request_file_id->ViewValue = FormatNumber($this->request_file_id->ViewValue, 0, 0, 0, 0);
        $this->request_file_id->ViewCustomAttributes = "";

        // id_statuses
        $this->id_statuses->ViewValue = $this->id_statuses->CurrentValue;
        $this->id_statuses->ViewValue = FormatNumber($this->id_statuses->ViewValue, 0, -2, -2, -2);
        $this->id_statuses->ViewCustomAttributes = "";

        // isApprovalAgree
        $this->isApprovalAgree->ViewValue = $this->isApprovalAgree->CurrentValue;
        $this->isApprovalAgree->ViewCustomAttributes = "";

        // isPenelaahAgree
        $this->isPenelaahAgree->ViewValue = $this->isPenelaahAgree->CurrentValue;
        $this->isPenelaahAgree->ViewCustomAttributes = "";

        // id_rab
        $this->id_rab->LinkCustomAttributes = "";
        $this->id_rab->HrefValue = "";
        $this->id_rab->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // satker_id
        $this->satker_id->LinkCustomAttributes = "";
        $this->satker_id->HrefValue = "";
        $this->satker_id->TooltipValue = "";

        // kode_program
        $this->kode_program->LinkCustomAttributes = "";
        $this->kode_program->HrefValue = "";
        $this->kode_program->TooltipValue = "";

        // kode_kegiatan
        $this->kode_kegiatan->LinkCustomAttributes = "";
        $this->kode_kegiatan->HrefValue = "";
        $this->kode_kegiatan->TooltipValue = "";

        // kode_kro
        $this->kode_kro->LinkCustomAttributes = "";
        $this->kode_kro->HrefValue = "";
        $this->kode_kro->TooltipValue = "";

        // kode_komponen
        $this->kode_komponen->LinkCustomAttributes = "";
        $this->kode_komponen->HrefValue = "";
        $this->kode_komponen->TooltipValue = "";

        // kode_subkomponen
        $this->kode_subkomponen->LinkCustomAttributes = "";
        $this->kode_subkomponen->HrefValue = "";
        $this->kode_subkomponen->TooltipValue = "";

        // kode_ro
        $this->kode_ro->LinkCustomAttributes = "";
        $this->kode_ro->HrefValue = "";
        $this->kode_ro->TooltipValue = "";

        // filename
        $this->filename->LinkCustomAttributes = "";
        $this->filename->HrefValue = "";
        $this->filename->ExportHrefValue = $this->filename->UploadPath . $this->filename->Upload->DbValue;
        $this->filename->TooltipValue = "";

        // request_file_id
        $this->request_file_id->LinkCustomAttributes = "";
        $this->request_file_id->HrefValue = "";
        $this->request_file_id->TooltipValue = "";

        // id_statuses
        $this->id_statuses->LinkCustomAttributes = "";
        $this->id_statuses->HrefValue = "";
        $this->id_statuses->TooltipValue = "";

        // isApprovalAgree
        $this->isApprovalAgree->LinkCustomAttributes = "";
        $this->isApprovalAgree->HrefValue = "";
        $this->isApprovalAgree->TooltipValue = "";

        // isPenelaahAgree
        $this->isPenelaahAgree->LinkCustomAttributes = "";
        $this->isPenelaahAgree->HrefValue = "";
        $this->isPenelaahAgree->TooltipValue = "";

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

        // id_rab
        $this->id_rab->EditAttrs["class"] = "form-control";
        $this->id_rab->EditCustomAttributes = "";
        $this->id_rab->EditValue = $this->id_rab->CurrentValue;
        $this->id_rab->EditValue = FormatNumber($this->id_rab->EditValue, 0, 0, 0, 0);
        $this->id_rab->ViewCustomAttributes = "";

        // status
        $this->status->EditCustomAttributes = "";
        $this->status->EditValue = $this->status->options(false);
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // satker_id
        $this->satker_id->EditAttrs["class"] = "form-control";
        $this->satker_id->EditCustomAttributes = "";
        $this->satker_id->PlaceHolder = RemoveHtml($this->satker_id->caption());

        // kode_program
        $this->kode_program->EditAttrs["class"] = "form-control";
        $this->kode_program->EditCustomAttributes = "";
        $this->kode_program->PlaceHolder = RemoveHtml($this->kode_program->caption());

        // kode_kegiatan
        $this->kode_kegiatan->EditAttrs["class"] = "form-control";
        $this->kode_kegiatan->EditCustomAttributes = "";
        $this->kode_kegiatan->PlaceHolder = RemoveHtml($this->kode_kegiatan->caption());

        // kode_kro
        $this->kode_kro->EditAttrs["class"] = "form-control";
        $this->kode_kro->EditCustomAttributes = "";
        $this->kode_kro->PlaceHolder = RemoveHtml($this->kode_kro->caption());

        // kode_komponen
        $this->kode_komponen->EditAttrs["class"] = "form-control";
        $this->kode_komponen->EditCustomAttributes = "";
        $this->kode_komponen->PlaceHolder = RemoveHtml($this->kode_komponen->caption());

        // kode_subkomponen
        $this->kode_subkomponen->EditAttrs["class"] = "form-control";
        $this->kode_subkomponen->EditCustomAttributes = "";
        $this->kode_subkomponen->PlaceHolder = RemoveHtml($this->kode_subkomponen->caption());

        // kode_ro
        $this->kode_ro->EditAttrs["class"] = "form-control";
        $this->kode_ro->EditCustomAttributes = "";
        $this->kode_ro->PlaceHolder = RemoveHtml($this->kode_ro->caption());

        // filename
        $this->filename->EditAttrs["class"] = "form-control";
        $this->filename->EditCustomAttributes = "";
        if (!EmptyValue($this->filename->Upload->DbValue)) {
            $this->filename->EditValue = $this->filename->Upload->DbValue;
        } else {
            $this->filename->EditValue = "";
        }
        if (!EmptyValue($this->filename->CurrentValue)) {
            $this->filename->Upload->FileName = $this->filename->CurrentValue;
        }

        // request_file_id
        $this->request_file_id->EditAttrs["class"] = "form-control";
        $this->request_file_id->EditCustomAttributes = "";
        $this->request_file_id->EditValue = $this->request_file_id->CurrentValue;
        $this->request_file_id->PlaceHolder = RemoveHtml($this->request_file_id->caption());

        // id_statuses
        $this->id_statuses->EditAttrs["class"] = "form-control";
        $this->id_statuses->EditCustomAttributes = "";
        $this->id_statuses->EditValue = $this->id_statuses->CurrentValue;
        $this->id_statuses->PlaceHolder = RemoveHtml($this->id_statuses->caption());

        // isApprovalAgree
        $this->isApprovalAgree->EditAttrs["class"] = "form-control";
        $this->isApprovalAgree->EditCustomAttributes = "";
        if (!$this->isApprovalAgree->Raw) {
            $this->isApprovalAgree->CurrentValue = HtmlDecode($this->isApprovalAgree->CurrentValue);
        }
        $this->isApprovalAgree->EditValue = $this->isApprovalAgree->CurrentValue;
        $this->isApprovalAgree->PlaceHolder = RemoveHtml($this->isApprovalAgree->caption());

        // isPenelaahAgree
        $this->isPenelaahAgree->EditAttrs["class"] = "form-control";
        $this->isPenelaahAgree->EditCustomAttributes = "";
        if (!$this->isPenelaahAgree->Raw) {
            $this->isPenelaahAgree->CurrentValue = HtmlDecode($this->isPenelaahAgree->CurrentValue);
        }
        $this->isPenelaahAgree->EditValue = $this->isPenelaahAgree->CurrentValue;
        $this->isPenelaahAgree->PlaceHolder = RemoveHtml($this->isPenelaahAgree->caption());

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
                    $doc->exportCaption($this->id_rab);
                    $doc->exportCaption($this->satker_id);
                    $doc->exportCaption($this->kode_program);
                    $doc->exportCaption($this->kode_kegiatan);
                    $doc->exportCaption($this->kode_kro);
                    $doc->exportCaption($this->kode_komponen);
                    $doc->exportCaption($this->kode_subkomponen);
                    $doc->exportCaption($this->kode_ro);
                    $doc->exportCaption($this->filename);
                    $doc->exportCaption($this->id_statuses);
                    $doc->exportCaption($this->isApprovalAgree);
                    $doc->exportCaption($this->isPenelaahAgree);
                } else {
                    $doc->exportCaption($this->id_rab);
                    $doc->exportCaption($this->satker_id);
                    $doc->exportCaption($this->kode_program);
                    $doc->exportCaption($this->kode_kegiatan);
                    $doc->exportCaption($this->kode_kro);
                    $doc->exportCaption($this->kode_komponen);
                    $doc->exportCaption($this->kode_subkomponen);
                    $doc->exportCaption($this->kode_ro);
                    $doc->exportCaption($this->id_statuses);
                    $doc->exportCaption($this->isApprovalAgree);
                    $doc->exportCaption($this->isPenelaahAgree);
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
                        $doc->exportField($this->id_rab);
                        $doc->exportField($this->satker_id);
                        $doc->exportField($this->kode_program);
                        $doc->exportField($this->kode_kegiatan);
                        $doc->exportField($this->kode_kro);
                        $doc->exportField($this->kode_komponen);
                        $doc->exportField($this->kode_subkomponen);
                        $doc->exportField($this->kode_ro);
                        $doc->exportField($this->filename);
                        $doc->exportField($this->id_statuses);
                        $doc->exportField($this->isApprovalAgree);
                        $doc->exportField($this->isPenelaahAgree);
                    } else {
                        $doc->exportField($this->id_rab);
                        $doc->exportField($this->satker_id);
                        $doc->exportField($this->kode_program);
                        $doc->exportField($this->kode_kegiatan);
                        $doc->exportField($this->kode_kro);
                        $doc->exportField($this->kode_komponen);
                        $doc->exportField($this->kode_subkomponen);
                        $doc->exportField($this->kode_ro);
                        $doc->exportField($this->id_statuses);
                        $doc->exportField($this->isApprovalAgree);
                        $doc->exportField($this->isPenelaahAgree);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'filename') {
            $fldName = "filename";
            $fileNameFld = "filename";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id_rab->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssoc($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, 100, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
        // Insert record
        // NOTE: Modify your SQL here, replace the table name, field name and field values
    	//$myResult = ExecuteUpdate("INSERT INTO rab (status) VALUES ('menunggu')");
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
    // Update record
    // NOTE: Modify your SQL here, replace the table name, field name and field values
    	$myResult = ExecuteUpdate("UPDATE rab SET id_statuses=1 WHERE status is NULL");

    	//function Row_Deleted(&$rs) {
        	// Assume ForeignKeyField is of integer type
        //	ExecuteUpdate("DELETE FROM DetailTable WHERE ForeignKeyField=" . $rs["PrimaryKeyField"]);
        //}
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
