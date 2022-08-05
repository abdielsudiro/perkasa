<?php

namespace PHPMaker2021\perkasa2;

// Page object
$StatusesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fstatusesview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fstatusesview = currentForm = new ew.Form("fstatusesview", "view");
    loadjs.done("fstatusesview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.statuses) ew.vars.tables.statuses = <?= JsonEncode(GetClientVar("tables", "statuses")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fstatusesview" id="fstatusesview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="statuses">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
    <tr id="r_id_statuses">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_statuses_id_statuses"><?= $Page->id_statuses->caption() ?></span></td>
        <td data-name="id_statuses" <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el_statuses_id_statuses">
<span<?= $Page->id_statuses->viewAttributes() ?>>
<?= $Page->id_statuses->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_status->Visible) { // nama_status ?>
    <tr id="r_nama_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_statuses_nama_status"><?= $Page->nama_status->caption() ?></span></td>
        <td data-name="nama_status" <?= $Page->nama_status->cellAttributes() ?>>
<span id="el_statuses_nama_status">
<span<?= $Page->nama_status->viewAttributes() ?>>
<?= $Page->nama_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
