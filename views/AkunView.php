<?php

namespace PHPMaker2021\perkasa2;

// Page object
$AkunView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fakunview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fakunview = currentForm = new ew.Form("fakunview", "view");
    loadjs.done("fakunview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.akun) ew.vars.tables.akun = <?= JsonEncode(GetClientVar("tables", "akun")) ?>;
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
<form name="fakunview" id="fakunview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="akun">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_akun_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_akun_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <tr id="r_kode">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_akun_kode"><?= $Page->kode->caption() ?></span></td>
        <td data-name="kode" <?= $Page->kode->cellAttributes() ?>>
<span id="el_akun_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <tr id="r_uraian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_akun_uraian"><?= $Page->uraian->caption() ?></span></td>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el_akun_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <tr id="r_parent_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_akun_parent_id"><?= $Page->parent_id->caption() ?></span></td>
        <td data-name="parent_id" <?= $Page->parent_id->cellAttributes() ?>>
<span id="el_akun_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isSubAccount->Visible) { // isSubAccount ?>
    <tr id="r_isSubAccount">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_akun_isSubAccount"><?= $Page->isSubAccount->caption() ?></span></td>
        <td data-name="isSubAccount" <?= $Page->isSubAccount->cellAttributes() ?>>
<span id="el_akun_isSubAccount">
<span<?= $Page->isSubAccount->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_isSubAccount_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->isSubAccount->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->isSubAccount->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_isSubAccount_<?= $Page->RowCount ?>"></label>
</div></span>
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
