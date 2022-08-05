<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RoView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    froview = currentForm = new ew.Form("froview", "view");
    loadjs.done("froview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.ro) ew.vars.tables.ro = <?= JsonEncode(GetClientVar("tables", "ro")) ?>;
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
<form name="froview" id="froview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ro">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <tr id="r_kode_ro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ro_kode_ro"><?= $Page->kode_ro->caption() ?></span></td>
        <td data-name="kode_ro" <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_ro_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <tr id="r_kode_kro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ro_kode_kro"><?= $Page->kode_kro->caption() ?></span></td>
        <td data-name="kode_kro" <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_ro_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_ro->Visible) { // nama_ro ?>
    <tr id="r_nama_ro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ro_nama_ro"><?= $Page->nama_ro->caption() ?></span></td>
        <td data-name="nama_ro" <?= $Page->nama_ro->cellAttributes() ?>>
<span id="el_ro_nama_ro">
<span<?= $Page->nama_ro->viewAttributes() ?>>
<?= $Page->nama_ro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ro_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_ro_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
