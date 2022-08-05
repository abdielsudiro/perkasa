<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabRincianView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_rincianview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frab_rincianview = currentForm = new ew.Form("frab_rincianview", "view");
    loadjs.done("frab_rincianview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab_rincian) ew.vars.tables.rab_rincian = <?= JsonEncode(GetClientVar("tables", "rab_rincian")) ?>;
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
<form name="frab_rincianview" id="frab_rincianview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_rincian">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
    <tr id="r_rab_rincian_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_rab_rincian_id"><?= $Page->rab_rincian_id->caption() ?></span></td>
        <td data-name="rab_rincian_id" <?= $Page->rab_rincian_id->cellAttributes() ?>>
<span id="el_rab_rincian_rab_rincian_id">
<span<?= $Page->rab_rincian_id->viewAttributes() ?>>
<?= $Page->rab_rincian_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <tr id="r_uraian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_uraian"><?= $Page->uraian->caption() ?></span></td>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el_rab_rincian_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <tr id="r_volum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_volum"><?= $Page->volum->caption() ?></span></td>
        <td data-name="volum" <?= $Page->volum->cellAttributes() ?>>
<span id="el_rab_rincian_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
    <tr id="r_satuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_satuan"><?= $Page->satuan->caption() ?></span></td>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<span id="el_rab_rincian_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <tr id="r_sbm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_sbm"><?= $Page->sbm->caption() ?></span></td>
        <td data-name="sbm" <?= $Page->sbm->cellAttributes() ?>>
<span id="el_rab_rincian_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
    <tr id="r_kode_akun">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_kode_akun"><?= $Page->kode_akun->caption() ?></span></td>
        <td data-name="kode_akun" <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el_rab_rincian_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
    <tr id="r_subtotal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_rincian_subtotal"><?= $Page->subtotal->caption() ?></span></td>
        <td data-name="subtotal" <?= $Page->subtotal->cellAttributes() ?>>
<span id="el_rab_rincian_subtotal">
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
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
