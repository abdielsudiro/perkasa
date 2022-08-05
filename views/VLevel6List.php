<?php

namespace PHPMaker2021\perkasa2;

// Page object
$VLevel6List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fv_level_6list;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fv_level_6list = currentForm = new ew.Form("fv_level_6list", "list");
    fv_level_6list.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fv_level_6list");
});
var fv_level_6listsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fv_level_6listsrch = currentSearchForm = new ew.Form("fv_level_6listsrch");

    // Dynamic selection lists

    // Filters
    fv_level_6listsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fv_level_6listsrch");
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
<form name="fv_level_6listsrch" id="fv_level_6listsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fv_level_6listsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_level_6">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_level_6">
<form name="fv_level_6list" id="fv_level_6list" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="v_level_6">
<div id="gmp_v_level_6" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_v_level_6list" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_v_level_6_id" class="v_level_6_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <th data-name="kode" class="<?= $Page->kode->headerCellClass() ?>"><div id="elh_v_level_6_kode" class="v_level_6_kode"><?= $Page->renderSort($Page->kode) ?></div></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th data-name="uraian" class="<?= $Page->uraian->headerCellClass() ?>"><div id="elh_v_level_6_uraian" class="v_level_6_uraian"><?= $Page->renderSort($Page->uraian) ?></div></th>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <th data-name="level" class="<?= $Page->level->headerCellClass() ?>"><div id="elh_v_level_6_level" class="v_level_6_level"><?= $Page->renderSort($Page->level) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level1->Visible) { // uraian_level1 ?>
        <th data-name="uraian_level1" class="<?= $Page->uraian_level1->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level1" class="v_level_6_uraian_level1"><?= $Page->renderSort($Page->uraian_level1) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level2->Visible) { // uraian_level2 ?>
        <th data-name="uraian_level2" class="<?= $Page->uraian_level2->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level2" class="v_level_6_uraian_level2"><?= $Page->renderSort($Page->uraian_level2) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level3->Visible) { // uraian_level3 ?>
        <th data-name="uraian_level3" class="<?= $Page->uraian_level3->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level3" class="v_level_6_uraian_level3"><?= $Page->renderSort($Page->uraian_level3) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level4->Visible) { // uraian_level4 ?>
        <th data-name="uraian_level4" class="<?= $Page->uraian_level4->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level4" class="v_level_6_uraian_level4"><?= $Page->renderSort($Page->uraian_level4) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level5->Visible) { // uraian_level5 ?>
        <th data-name="uraian_level5" class="<?= $Page->uraian_level5->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level5" class="v_level_6_uraian_level5"><?= $Page->renderSort($Page->uraian_level5) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level6->Visible) { // uraian_level6 ?>
        <th data-name="uraian_level6" class="<?= $Page->uraian_level6->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level6" class="v_level_6_uraian_level6"><?= $Page->renderSort($Page->uraian_level6) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_level7->Visible) { // uraian_level7 ?>
        <th data-name="uraian_level7" class="<?= $Page->uraian_level7->headerCellClass() ?>"><div id="elh_v_level_6_uraian_level7" class="v_level_6_uraian_level7"><?= $Page->renderSort($Page->uraian_level7) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_v_level_6", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode->Visible) { // kode ?>
        <td data-name="kode" <?= $Page->kode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->level->Visible) { // level ?>
        <td data-name="level" <?= $Page->level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level1->Visible) { // uraian_level1 ?>
        <td data-name="uraian_level1" <?= $Page->uraian_level1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level1">
<span<?= $Page->uraian_level1->viewAttributes() ?>>
<?= $Page->uraian_level1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level2->Visible) { // uraian_level2 ?>
        <td data-name="uraian_level2" <?= $Page->uraian_level2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level2">
<span<?= $Page->uraian_level2->viewAttributes() ?>>
<?= $Page->uraian_level2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level3->Visible) { // uraian_level3 ?>
        <td data-name="uraian_level3" <?= $Page->uraian_level3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level3">
<span<?= $Page->uraian_level3->viewAttributes() ?>>
<?= $Page->uraian_level3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level4->Visible) { // uraian_level4 ?>
        <td data-name="uraian_level4" <?= $Page->uraian_level4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level4">
<span<?= $Page->uraian_level4->viewAttributes() ?>>
<?= $Page->uraian_level4->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level5->Visible) { // uraian_level5 ?>
        <td data-name="uraian_level5" <?= $Page->uraian_level5->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level5">
<span<?= $Page->uraian_level5->viewAttributes() ?>>
<?= $Page->uraian_level5->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level6->Visible) { // uraian_level6 ?>
        <td data-name="uraian_level6" <?= $Page->uraian_level6->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level6">
<span<?= $Page->uraian_level6->viewAttributes() ?>>
<?= $Page->uraian_level6->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_level7->Visible) { // uraian_level7 ?>
        <td data-name="uraian_level7" <?= $Page->uraian_level7->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_level_6_uraian_level7">
<span<?= $Page->uraian_level7->viewAttributes() ?>>
<?= $Page->uraian_level7->getViewValue() ?></span>
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
    ew.addEventHandlers("v_level_6");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
