<?php

namespace PHPMaker2021\perkasa2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for rab_kegiatan2
 */
class RabKegiatan2 extends DbTable
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
    public $rab_kegiatan_id;
    public $satker_id;
    public $kode_kegiatan;
    public $kode_kro;
    public $kode_ro;
    public $kode_komponen;
    public $kode_subkomponen;
    public $total_biaya;
    public $reviewer_note_id;
    public $approval_note_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'rab_kegiatan2';
        $this->TableName = 'rab_kegiatan2';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`rab_kegiatan2`";
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

        // rab_kegiatan_id
        $this->rab_kegiatan_id = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_rab_kegiatan_id', 'rab_kegiatan_id', '`rab_kegiatan_id`', '`rab_kegiatan_id`', 3, 11, -1, false, '`rab_kegiatan_id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->rab_kegiatan_id->IsAutoIncrement = true; // Autoincrement field
        $this->rab_kegiatan_id->IsPrimaryKey = true; // Primary key field
        $this->rab_kegiatan_id->Sortable = false; // Allow sort
        $this->rab_kegiatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rab_kegiatan_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rab_kegiatan_id->Param, "CustomMsg");
        $this->Fields['rab_kegiatan_id'] = &$this->rab_kegiatan_id;

        // satker_id
        $this->satker_id = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_satker_id', 'satker_id', '`satker_id`', '`satker_id`', 3, 11, -1, false, '`satker_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->satker_id->Sortable = false; // Allow sort
        $this->satker_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->satker_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->satker_id->Lookup = new Lookup('satker_id', 'satker', false, 'satker_id', ["nama_satker","","",""], [], [], [], [], [], [], '', '');
        $this->satker_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->satker_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->satker_id->Param, "CustomMsg");
        $this->Fields['satker_id'] = &$this->satker_id;

        // kode_kegiatan
        $this->kode_kegiatan = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_kode_kegiatan', 'kode_kegiatan', '`kode_kegiatan`', '`kode_kegiatan`', 200, 120, -1, false, '`kode_kegiatan`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_kegiatan->Sortable = false; // Allow sort
        $this->kode_kegiatan->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_kegiatan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_kegiatan->Lookup = new Lookup('kode_kegiatan', 'kegiatan', false, 'kode_kegiatan', ["nama_kegiatan","","",""], [], ["x_kode_kro"], [], [], [], [], '', '');
        $this->kode_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_kegiatan->Param, "CustomMsg");
        $this->Fields['kode_kegiatan'] = &$this->kode_kegiatan;

        // kode_kro
        $this->kode_kro = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_kode_kro', 'kode_kro', '`kode_kro`', '`kode_kro`', 200, 120, -1, false, '`kode_kro`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_kro->Sortable = false; // Allow sort
        $this->kode_kro->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_kro->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_kro->Lookup = new Lookup('kode_kro', 'kro', false, 'kode_kro', ["nama_kro","","",""], ["x_kode_kegiatan"], ["x_kode_ro"], ["kode_kegiatan"], ["x_kode_kegiatan"], [], [], '', '');
        $this->kode_kro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_kro->Param, "CustomMsg");
        $this->Fields['kode_kro'] = &$this->kode_kro;

        // kode_ro
        $this->kode_ro = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_kode_ro', 'kode_ro', '`kode_ro`', '`kode_ro`', 200, 120, -1, false, '`kode_ro`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_ro->Sortable = false; // Allow sort
        $this->kode_ro->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_ro->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_ro->Lookup = new Lookup('kode_ro', 'ro', false, 'kode_ro', ["nama_ro","","",""], ["x_kode_kro"], ["x_kode_komponen"], ["kode_kro"], ["x_kode_kro"], [], [], '', '');
        $this->kode_ro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_ro->Param, "CustomMsg");
        $this->Fields['kode_ro'] = &$this->kode_ro;

        // kode_komponen
        $this->kode_komponen = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_kode_komponen', 'kode_komponen', '`kode_komponen`', '`kode_komponen`', 200, 120, -1, false, '`kode_komponen`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_komponen->Sortable = false; // Allow sort
        $this->kode_komponen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_komponen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_komponen->Lookup = new Lookup('kode_komponen', 'komponen', false, 'kode_komponen', ["nama_komponen","","",""], ["x_kode_ro"], ["x_kode_subkomponen"], ["kode_ro"], ["x_kode_ro"], [], [], '', '');
        $this->kode_komponen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_komponen->Param, "CustomMsg");
        $this->Fields['kode_komponen'] = &$this->kode_komponen;

        // kode_subkomponen
        $this->kode_subkomponen = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_kode_subkomponen', 'kode_subkomponen', '`kode_subkomponen`', '`kode_subkomponen`', 200, 120, -1, false, '`kode_subkomponen`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->kode_subkomponen->Sortable = false; // Allow sort
        $this->kode_subkomponen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_subkomponen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_subkomponen->Lookup = new Lookup('kode_subkomponen', 'subkomponen', false, 'kode_subkomponen', ["nama_subkomponen","","",""], ["x_kode_komponen"], [], ["kode_komponen"], ["x_kode_komponen"], [], [], '', '');
        $this->kode_subkomponen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kode_subkomponen->Param, "CustomMsg");
        $this->Fields['kode_subkomponen'] = &$this->kode_subkomponen;

        // total_biaya
        $this->total_biaya = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_total_biaya', 'total_biaya', '`total_biaya`', '`total_biaya`', 5, 15, -1, false, '`total_biaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->total_biaya->Sortable = true; // Allow sort
        $this->total_biaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->total_biaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->total_biaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->total_biaya->Param, "CustomMsg");
        $this->Fields['total_biaya'] = &$this->total_biaya;

        // reviewer_note_id
        $this->reviewer_note_id = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_reviewer_note_id', 'reviewer_note_id', '`reviewer_note_id`', '`reviewer_note_id`', 3, 11, -1, false, '`reviewer_note_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->reviewer_note_id->Sortable = true; // Allow sort
        $this->reviewer_note_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->reviewer_note_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->reviewer_note_id->Lookup = new Lookup('reviewer_note_id', 'reviewer_note', false, 'reviewer_note_id', ["reviewer_note","","",""], [], [], [], [], [], [], '', '');
        $this->reviewer_note_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->reviewer_note_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->reviewer_note_id->Param, "CustomMsg");
        $this->Fields['reviewer_note_id'] = &$this->reviewer_note_id;

        // approval_note_id
        $this->approval_note_id = new DbField('rab_kegiatan2', 'rab_kegiatan2', 'x_approval_note_id', 'approval_note_id', '`approval_note_id`', '`approval_note_id`', 3, 11, -1, false, '`approval_note_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->approval_note_id->Sortable = true; // Allow sort
        $this->approval_note_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->approval_note_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->approval_note_id->Lookup = new Lookup('approval_note_id', 'penelaah_note', false, 'approval_note_id', ["approval_note","","",""], [], [], [], [], [], [], '', '');
        $this->approval_note_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->approval_note_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->approval_note_id->Param, "CustomMsg");
        $this->Fields['approval_note_id'] = &$this->approval_note_id;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`rab_kegiatan2`";
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
            $this->rab_kegiatan_id->setDbValue($conn->lastInsertId());
            $rs['rab_kegiatan_id'] = $this->rab_kegiatan_id->DbValue;
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
            if (array_key_exists('rab_kegiatan_id', $rs)) {
                AddFilter($where, QuotedName('rab_kegiatan_id', $this->Dbid) . '=' . QuotedValue($rs['rab_kegiatan_id'], $this->rab_kegiatan_id->DataType, $this->Dbid));
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
        $this->rab_kegiatan_id->DbValue = $row['rab_kegiatan_id'];
        $this->satker_id->DbValue = $row['satker_id'];
        $this->kode_kegiatan->DbValue = $row['kode_kegiatan'];
        $this->kode_kro->DbValue = $row['kode_kro'];
        $this->kode_ro->DbValue = $row['kode_ro'];
        $this->kode_komponen->DbValue = $row['kode_komponen'];
        $this->kode_subkomponen->DbValue = $row['kode_subkomponen'];
        $this->total_biaya->DbValue = $row['total_biaya'];
        $this->reviewer_note_id->DbValue = $row['reviewer_note_id'];
        $this->approval_note_id->DbValue = $row['approval_note_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`rab_kegiatan_id` = @rab_kegiatan_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->rab_kegiatan_id->CurrentValue : $this->rab_kegiatan_id->OldValue;
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
                $this->rab_kegiatan_id->CurrentValue = $keys[0];
            } else {
                $this->rab_kegiatan_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('rab_kegiatan_id', $row) ? $row['rab_kegiatan_id'] : null;
        } else {
            $val = $this->rab_kegiatan_id->OldValue !== null ? $this->rab_kegiatan_id->OldValue : $this->rab_kegiatan_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@rab_kegiatan_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("RabKegiatan2List");
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
        if ($pageName == "RabKegiatan2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "RabKegiatan2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "RabKegiatan2Add") {
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
                return "RabKegiatan2View";
            case Config("API_ADD_ACTION"):
                return "RabKegiatan2Add";
            case Config("API_EDIT_ACTION"):
                return "RabKegiatan2Edit";
            case Config("API_DELETE_ACTION"):
                return "RabKegiatan2Delete";
            case Config("API_LIST_ACTION"):
                return "RabKegiatan2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "RabKegiatan2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("RabKegiatan2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RabKegiatan2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "RabKegiatan2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "RabKegiatan2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("RabKegiatan2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("RabKegiatan2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("RabKegiatan2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "rab_kegiatan_id:" . JsonEncode($this->rab_kegiatan_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->rab_kegiatan_id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->rab_kegiatan_id->CurrentValue);
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
            if (($keyValue = Param("rab_kegiatan_id") ?? Route("rab_kegiatan_id")) !== null) {
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
                $this->rab_kegiatan_id->CurrentValue = $key;
            } else {
                $this->rab_kegiatan_id->OldValue = $key;
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // rab_kegiatan_id
        $this->rab_kegiatan_id->CellCssStyle = "white-space: nowrap;";

        // satker_id
        $this->satker_id->CellCssStyle = "white-space: nowrap;";

        // kode_kegiatan
        $this->kode_kegiatan->CellCssStyle = "white-space: nowrap;";

        // kode_kro
        $this->kode_kro->CellCssStyle = "white-space: nowrap;";

        // kode_ro
        $this->kode_ro->CellCssStyle = "white-space: nowrap;";

        // kode_komponen
        $this->kode_komponen->CellCssStyle = "white-space: nowrap;";

        // kode_subkomponen
        $this->kode_subkomponen->CellCssStyle = "white-space: nowrap;";

        // total_biaya

        // reviewer_note_id

        // approval_note_id

        // rab_kegiatan_id
        $this->rab_kegiatan_id->ViewValue = $this->rab_kegiatan_id->CurrentValue;
        $this->rab_kegiatan_id->ViewCustomAttributes = "";

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

        // rab_kegiatan_id
        $this->rab_kegiatan_id->LinkCustomAttributes = "";
        $this->rab_kegiatan_id->HrefValue = "";
        $this->rab_kegiatan_id->TooltipValue = "";

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

        // rab_kegiatan_id
        $this->rab_kegiatan_id->EditAttrs["class"] = "form-control";
        $this->rab_kegiatan_id->EditCustomAttributes = "";
        $this->rab_kegiatan_id->EditValue = $this->rab_kegiatan_id->CurrentValue;
        $this->rab_kegiatan_id->ViewCustomAttributes = "";

        // satker_id
        $this->satker_id->EditAttrs["class"] = "form-control";
        $this->satker_id->EditCustomAttributes = "";
        $this->satker_id->PlaceHolder = RemoveHtml($this->satker_id->caption());

        // kode_kegiatan
        $this->kode_kegiatan->EditAttrs["class"] = "form-control";
        $this->kode_kegiatan->EditCustomAttributes = "";
        $this->kode_kegiatan->PlaceHolder = RemoveHtml($this->kode_kegiatan->caption());

        // kode_kro
        $this->kode_kro->EditAttrs["class"] = "form-control";
        $this->kode_kro->EditCustomAttributes = "";
        $this->kode_kro->PlaceHolder = RemoveHtml($this->kode_kro->caption());

        // kode_ro
        $this->kode_ro->EditAttrs["class"] = "form-control";
        $this->kode_ro->EditCustomAttributes = "";
        $this->kode_ro->PlaceHolder = RemoveHtml($this->kode_ro->caption());

        // kode_komponen
        $this->kode_komponen->EditAttrs["class"] = "form-control";
        $this->kode_komponen->EditCustomAttributes = "";
        $this->kode_komponen->PlaceHolder = RemoveHtml($this->kode_komponen->caption());

        // kode_subkomponen
        $this->kode_subkomponen->EditAttrs["class"] = "form-control";
        $this->kode_subkomponen->EditCustomAttributes = "";
        $this->kode_subkomponen->PlaceHolder = RemoveHtml($this->kode_subkomponen->caption());

        // total_biaya
        $this->total_biaya->EditAttrs["class"] = "form-control";
        $this->total_biaya->EditCustomAttributes = "";
        $this->total_biaya->EditValue = $this->total_biaya->CurrentValue;
        $this->total_biaya->PlaceHolder = RemoveHtml($this->total_biaya->caption());
        if (strval($this->total_biaya->EditValue) != "" && is_numeric($this->total_biaya->EditValue)) {
            $this->total_biaya->EditValue = FormatNumber($this->total_biaya->EditValue, -2, -2, -2, -2);
        }

        // reviewer_note_id
        $this->reviewer_note_id->EditAttrs["class"] = "form-control";
        $this->reviewer_note_id->EditCustomAttributes = "";
        $this->reviewer_note_id->PlaceHolder = RemoveHtml($this->reviewer_note_id->caption());

        // approval_note_id
        $this->approval_note_id->EditAttrs["class"] = "form-control";
        $this->approval_note_id->EditCustomAttributes = "";
        $this->approval_note_id->PlaceHolder = RemoveHtml($this->approval_note_id->caption());

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
                    $doc->exportCaption($this->rab_kegiatan_id);
                    $doc->exportCaption($this->satker_id);
                    $doc->exportCaption($this->kode_kegiatan);
                    $doc->exportCaption($this->kode_kro);
                    $doc->exportCaption($this->kode_ro);
                    $doc->exportCaption($this->kode_komponen);
                    $doc->exportCaption($this->kode_subkomponen);
                    $doc->exportCaption($this->total_biaya);
                    $doc->exportCaption($this->reviewer_note_id);
                    $doc->exportCaption($this->approval_note_id);
                } else {
                    $doc->exportCaption($this->total_biaya);
                    $doc->exportCaption($this->reviewer_note_id);
                    $doc->exportCaption($this->approval_note_id);
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
                        $doc->exportField($this->rab_kegiatan_id);
                        $doc->exportField($this->satker_id);
                        $doc->exportField($this->kode_kegiatan);
                        $doc->exportField($this->kode_kro);
                        $doc->exportField($this->kode_ro);
                        $doc->exportField($this->kode_komponen);
                        $doc->exportField($this->kode_subkomponen);
                        $doc->exportField($this->total_biaya);
                        $doc->exportField($this->reviewer_note_id);
                        $doc->exportField($this->approval_note_id);
                    } else {
                        $doc->exportField($this->total_biaya);
                        $doc->exportField($this->reviewer_note_id);
                        $doc->exportField($this->approval_note_id);
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
