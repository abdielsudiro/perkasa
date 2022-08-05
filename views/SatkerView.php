<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SatkerView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsatkerview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsatkerview = currentForm = new ew.Form("fsatkerview", "view");
    loadjs.done("fsatkerview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.satker) ew.vars.tables.satker = <?= JsonEncode(GetClientVar("tables", "satker")) ?>;
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
<form name="fsatkerview" id="fsatkerview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="satker">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <tr id="r_satker_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_satker_satker_id"><?= $Page->satker_id->caption() ?></span></td>
        <td data-name="satker_id" <?= $Page->satker_id->cellAttributes() ?>>
<span id="el_satker_satker_id">
<span<?= $Page->satker_id->viewAttributes() ?>>
<?= $Page->satker_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
    <tr id="r_unit_org_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_satker_unit_org_id"><?= $Page->unit_org_id->caption() ?></span></td>
        <td data-name="unit_org_id" <?= $Page->unit_org_id->cellAttributes() ?>>
<span id="el_satker_unit_org_id">
<span<?= $Page->unit_org_id->viewAttributes() ?>>
<?= $Page->unit_org_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { // nama_satker ?>
    <tr id="r_nama_satker">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_satker_nama_satker"><?= $Page->nama_satker->caption() ?></span></td>
        <td data-name="nama_satker" <?= $Page->nama_satker->cellAttributes() ?>>
<span id="el_satker_nama_satker">
<span<?= $Page->nama_satker->viewAttributes() ?>>
<?= $Page->nama_satker->getViewValue() ?></span>
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
