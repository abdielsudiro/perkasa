<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestFileList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_filelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    frequest_filelist = currentForm = new ew.Form("frequest_filelist", "list");
    frequest_filelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("frequest_filelist");
});
var frequest_filelistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    frequest_filelistsrch = currentSearchForm = new ew.Form("frequest_filelistsrch");

    // Dynamic selection lists

    // Filters
    frequest_filelistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("frequest_filelistsrch");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "request2") {
    if ($Page->MasterRecordExists) {
        include_once "views/Request2Master.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="frequest_filelistsrch" id="frequest_filelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="frequest_filelistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="request_file">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_file">
<form name="frequest_filelist" id="frequest_filelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_file">
<?php if ($Page->getCurrentMasterTable() == "request2" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="request2">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_request_file" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_request_filelist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->request_file_id->Visible) { // request_file_id ?>
        <th data-name="request_file_id" class="<?= $Page->request_file_id->headerCellClass() ?>"><div id="elh_request_file_request_file_id" class="request_file_request_file_id"><?= $Page->renderSort($Page->request_file_id) ?></div></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Page->request_id->headerCellClass() ?>"><div id="elh_request_file_request_id" class="request_file_request_id"><?= $Page->renderSort($Page->request_id) ?></div></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Page->user_id->headerCellClass() ?>"><div id="elh_request_file_user_id" class="request_file_user_id"><?= $Page->renderSort($Page->user_id) ?></div></th>
<?php } ?>
<?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
        <th data-name="date_uploaded" class="<?= $Page->date_uploaded->headerCellClass() ?>"><div id="elh_request_file_date_uploaded" class="request_file_date_uploaded"><?= $Page->renderSort($Page->date_uploaded) ?></div></th>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
        <th data-name="file_name" class="<?= $Page->file_name->headerCellClass() ?>"><div id="elh_request_file_file_name" class="request_file_file_name"><?= $Page->renderSort($Page->file_name) ?></div></th>
<?php } ?>
<?php if ($Page->file_content->Visible) { // file_content ?>
        <th data-name="file_content" class="<?= $Page->file_content->headerCellClass() ?>"><div id="elh_request_file_file_content" class="request_file_file_content"><?= $Page->renderSort($Page->file_content) ?></div></th>
<?php } ?>
<?php if ($Page->mime_type->Visible) { // mime_type ?>
        <th data-name="mime_type" class="<?= $Page->mime_type->headerCellClass() ?>"><div id="elh_request_file_mime_type" class="request_file_mime_type"><?= $Page->renderSort($Page->mime_type) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_request_file", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->request_file_id->Visible) { // request_file_id ?>
        <td data-name="request_file_id" <?= $Page->request_file_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_request_file_id">
<span<?= $Page->request_file_id->viewAttributes() ?>>
<?= $Page->request_file_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->request_id->Visible) { // request_id ?>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user_id->Visible) { // user_id ?>
        <td data-name="user_id" <?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
        <td data-name="date_uploaded" <?= $Page->date_uploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_date_uploaded">
<span<?= $Page->date_uploaded->viewAttributes() ?>>
<?= $Page->date_uploaded->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->file_name->Visible) { // file_name ?>
        <td data-name="file_name" <?= $Page->file_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_file_name">
<span<?= $Page->file_name->viewAttributes() ?>>
<?= $Page->file_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->file_content->Visible) { // file_content ?>
        <td data-name="file_content" <?= $Page->file_content->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_file_content">
<span<?= $Page->file_content->viewAttributes() ?>>
<?= $Page->file_content->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mime_type->Visible) { // mime_type ?>
        <td data-name="mime_type" <?= $Page->mime_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_mime_type">
<span<?= $Page->mime_type->viewAttributes() ?>>
<?= $Page->mime_type->getViewValue() ?></span>
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
    ew.addEventHandlers("request_file");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
