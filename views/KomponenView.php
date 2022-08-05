<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KomponenView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkomponenview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkomponenview = currentForm = new ew.Form("fkomponenview", "view");
    loadjs.done("fkomponenview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.komponen) ew.vars.tables.komponen = <?= JsonEncode(GetClientVar("tables", "komponen")) ?>;
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
<form name="fkomponenview" id="fkomponenview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komponen">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <tr id="r_kode_komponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komponen_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></td>
        <td data-name="kode_komponen" <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_komponen_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <tr id="r_kode_ro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komponen_kode_ro"><?= $Page->kode_ro->caption() ?></span></td>
        <td data-name="kode_ro" <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_komponen_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_komponen->Visible) { // nama_komponen ?>
    <tr id="r_nama_komponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komponen_nama_komponen"><?= $Page->nama_komponen->caption() ?></span></td>
        <td data-name="nama_komponen" <?= $Page->nama_komponen->cellAttributes() ?>>
<span id="el_komponen_nama_komponen">
<span<?= $Page->nama_komponen->viewAttributes() ?>>
<?= $Page->nama_komponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komponen_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_komponen_id">
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
