<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KroView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkroview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkroview = currentForm = new ew.Form("fkroview", "view");
    loadjs.done("fkroview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.kro) ew.vars.tables.kro = <?= JsonEncode(GetClientVar("tables", "kro")) ?>;
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
<form name="fkroview" id="fkroview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kro">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <tr id="r_kode_kro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kro_kode_kro"><?= $Page->kode_kro->caption() ?></span></td>
        <td data-name="kode_kro" <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_kro_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <tr id="r_kode_kegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kro_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></td>
        <td data-name="kode_kegiatan" <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_kro_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_kro->Visible) { // nama_kro ?>
    <tr id="r_nama_kro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kro_nama_kro"><?= $Page->nama_kro->caption() ?></span></td>
        <td data-name="nama_kro" <?= $Page->nama_kro->cellAttributes() ?>>
<span id="el_kro_nama_kro">
<span<?= $Page->nama_kro->viewAttributes() ?>>
<?= $Page->nama_kro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kro_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_kro_id">
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
