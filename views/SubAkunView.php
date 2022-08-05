<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubAkunView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsub_akunview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsub_akunview = currentForm = new ew.Form("fsub_akunview", "view");
    loadjs.done("fsub_akunview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.sub_akun) ew.vars.tables.sub_akun = <?= JsonEncode(GetClientVar("tables", "sub_akun")) ?>;
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
<form name="fsub_akunview" id="fsub_akunview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sub_akun">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->detail_id->Visible) { // detail_id ?>
    <tr id="r_detail_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_akun_detail_id"><?= $Page->detail_id->caption() ?></span></td>
        <td data-name="detail_id" <?= $Page->detail_id->cellAttributes() ?>>
<span id="el_sub_akun_detail_id">
<span<?= $Page->detail_id->viewAttributes() ?>>
<?= $Page->detail_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
    <tr id="r_kode_akun">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_akun_kode_akun"><?= $Page->kode_akun->caption() ?></span></td>
        <td data-name="kode_akun" <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el_sub_akun_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <tr id="r_detail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_akun_detail"><?= $Page->detail->caption() ?></span></td>
        <td data-name="detail" <?= $Page->detail->cellAttributes() ?>>
<span id="el_sub_akun_detail">
<span<?= $Page->detail->viewAttributes() ?>>
<?= $Page->detail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <tr id="r_volum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_akun_volum"><?= $Page->volum->caption() ?></span></td>
        <td data-name="volum" <?= $Page->volum->cellAttributes() ?>>
<span id="el_sub_akun_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <tr id="r_sbm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sub_akun_sbm"><?= $Page->sbm->caption() ?></span></td>
        <td data-name="sbm" <?= $Page->sbm->cellAttributes() ?>>
<span id="el_sub_akun_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
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
