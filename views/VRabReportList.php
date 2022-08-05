<?php

namespace PHPMaker2021\perkasa2;

// Page object
$VRabReportList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fv_rab_reportlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fv_rab_reportlist = currentForm = new ew.Form("fv_rab_reportlist", "list");
    fv_rab_reportlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fv_rab_reportlist");
});
var fv_rab_reportlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fv_rab_reportlistsrch = currentSearchForm = new ew.Form("fv_rab_reportlistsrch");

    // Dynamic selection lists

    // Filters
    fv_rab_reportlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fv_rab_reportlistsrch");
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
<form name="fv_rab_reportlistsrch" id="fv_rab_reportlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fv_rab_reportlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_rab_report">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_rab_report">
<form name="fv_rab_reportlist" id="fv_rab_reportlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="v_rab_report">
<div id="gmp_v_rab_report" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_v_rab_reportlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->nama_satker->Visible) { // nama_satker ?>
        <th data-name="nama_satker" class="<?= $Page->nama_satker->headerCellClass() ?>"><div id="elh_v_rab_report_nama_satker" class="v_rab_report_nama_satker"><?= $Page->renderSort($Page->nama_satker) ?></div></th>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <th data-name="kode_kegiatan" class="<?= $Page->kode_kegiatan->headerCellClass() ?>"><div id="elh_v_rab_report_kode_kegiatan" class="v_rab_report_kode_kegiatan"><?= $Page->renderSort($Page->kode_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th data-name="uraian" class="<?= $Page->uraian->headerCellClass() ?>"><div id="elh_v_rab_report_uraian" class="v_rab_report_uraian"><?= $Page->renderSort($Page->uraian) ?></div></th>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <th data-name="volum" class="<?= $Page->volum->headerCellClass() ?>"><div id="elh_v_rab_report_volum" class="v_rab_report_volum"><?= $Page->renderSort($Page->volum) ?></div></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th data-name="satuan" class="<?= $Page->satuan->headerCellClass() ?>"><div id="elh_v_rab_report_satuan" class="v_rab_report_satuan"><?= $Page->renderSort($Page->satuan) ?></div></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <th data-name="sbm" class="<?= $Page->sbm->headerCellClass() ?>"><div id="elh_v_rab_report_sbm" class="v_rab_report_sbm"><?= $Page->renderSort($Page->sbm) ?></div></th>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <th data-name="kode_akun" class="<?= $Page->kode_akun->headerCellClass() ?>"><div id="elh_v_rab_report_kode_akun" class="v_rab_report_kode_akun"><?= $Page->renderSort($Page->kode_akun) ?></div></th>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <th data-name="subtotal" class="<?= $Page->subtotal->headerCellClass() ?>"><div id="elh_v_rab_report_subtotal" class="v_rab_report_subtotal"><?= $Page->renderSort($Page->subtotal) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_v_rab_report", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->nama_satker->Visible) { // nama_satker ?>
        <td data-name="nama_satker" <?= $Page->nama_satker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_nama_satker">
<span<?= $Page->nama_satker->viewAttributes() ?>>
<?= $Page->nama_satker->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <td data-name="kode_kegiatan" <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->volum->Visible) { // volum ?>
        <td data-name="volum" <?= $Page->volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sbm->Visible) { // sbm ?>
        <td data-name="sbm" <?= $Page->sbm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun" <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal" <?= $Page->subtotal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_v_rab_report_subtotal">
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
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
    ew.addEventHandlers("v_rab_report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
