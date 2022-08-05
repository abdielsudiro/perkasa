<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabKegiatan2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_kegiatan2list;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    frab_kegiatan2list = currentForm = new ew.Form("frab_kegiatan2list", "list");
    frab_kegiatan2list.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("frab_kegiatan2list");
});
var frab_kegiatan2listsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    frab_kegiatan2listsrch = currentSearchForm = new ew.Form("frab_kegiatan2listsrch");

    // Dynamic selection lists

    // Filters
    frab_kegiatan2listsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("frab_kegiatan2listsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
    background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
    display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
    <div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
        <ul class="nav nav-tabs"></ul>
        <div class="tab-content"><!-- .tab-content -->
            <div class="tab-pane fade active show"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
    ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
    ew.PREVIEW_SINGLE_ROW = false;
    ew.PREVIEW_OVERLAY = false;
    loadjs(ew.PATH_BASE + "js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="frab_kegiatan2listsrch" id="frab_kegiatan2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="frab_kegiatan2listsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rab_kegiatan2">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rab_kegiatan2">
<form name="frab_kegiatan2list" id="frab_kegiatan2list" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_kegiatan2">
<div id="gmp_rab_kegiatan2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_rab_kegiatan2list" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <th data-name="kode_kegiatan" class="<?= $Page->kode_kegiatan->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_rab_kegiatan2_kode_kegiatan" class="rab_kegiatan2_kode_kegiatan"><?= $Page->renderSort($Page->kode_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <th data-name="kode_kro" class="<?= $Page->kode_kro->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_rab_kegiatan2_kode_kro" class="rab_kegiatan2_kode_kro"><?= $Page->renderSort($Page->kode_kro) ?></div></th>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <th data-name="kode_ro" class="<?= $Page->kode_ro->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_rab_kegiatan2_kode_ro" class="rab_kegiatan2_kode_ro"><?= $Page->renderSort($Page->kode_ro) ?></div></th>
<?php } ?>
<?php if ($Page->total_biaya->Visible) { // total_biaya ?>
        <th data-name="total_biaya" class="<?= $Page->total_biaya->headerCellClass() ?>"><div id="elh_rab_kegiatan2_total_biaya" class="rab_kegiatan2_total_biaya"><?= $Page->renderSort($Page->total_biaya) ?></div></th>
<?php } ?>
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
        <th data-name="reviewer_note_id" class="<?= $Page->reviewer_note_id->headerCellClass() ?>"><div id="elh_rab_kegiatan2_reviewer_note_id" class="rab_kegiatan2_reviewer_note_id"><?= $Page->renderSort($Page->reviewer_note_id) ?></div></th>
<?php } ?>
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
        <th data-name="approval_note_id" class="<?= $Page->approval_note_id->headerCellClass() ?>"><div id="elh_rab_kegiatan2_approval_note_id" class="rab_kegiatan2_approval_note_id"><?= $Page->renderSort($Page->approval_note_id) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_rab_kegiatan2", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <td data-name="kode_kegiatan" <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <td data-name="kode_kro" <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <td data-name="kode_ro" <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_biaya->Visible) { // total_biaya ?>
        <td data-name="total_biaya" <?= $Page->total_biaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_total_biaya">
<span<?= $Page->total_biaya->viewAttributes() ?>>
<?= $Page->total_biaya->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
        <td data-name="reviewer_note_id" <?= $Page->reviewer_note_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_reviewer_note_id">
<span<?= $Page->reviewer_note_id->viewAttributes() ?>>
<?= $Page->reviewer_note_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
        <td data-name="approval_note_id" <?= $Page->approval_note_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_approval_note_id">
<span<?= $Page->approval_note_id->viewAttributes() ?>>
<?= $Page->approval_note_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("rab_kegiatan2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
