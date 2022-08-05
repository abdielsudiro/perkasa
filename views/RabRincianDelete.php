<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabRincianDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_rinciandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frab_rinciandelete = currentForm = new ew.Form("frab_rinciandelete", "delete");
    loadjs.done("frab_rinciandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.rab_rincian) ew.vars.tables.rab_rincian = <?= JsonEncode(GetClientVar("tables", "rab_rincian")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frab_rinciandelete" id="frab_rinciandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_rincian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <th class="<?= $Page->rab_rincian_id->headerCellClass() ?>"><span id="elh_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id"><?= $Page->rab_rincian_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th class="<?= $Page->uraian->headerCellClass() ?>"><span id="elh_rab_rincian_uraian" class="rab_rincian_uraian"><?= $Page->uraian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <th class="<?= $Page->volum->headerCellClass() ?>"><span id="elh_rab_rincian_volum" class="rab_rincian_volum"><?= $Page->volum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th class="<?= $Page->satuan->headerCellClass() ?>"><span id="elh_rab_rincian_satuan" class="rab_rincian_satuan"><?= $Page->satuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <th class="<?= $Page->sbm->headerCellClass() ?>"><span id="elh_rab_rincian_sbm" class="rab_rincian_sbm"><?= $Page->sbm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <th class="<?= $Page->kode_akun->headerCellClass() ?>"><span id="elh_rab_rincian_kode_akun" class="rab_rincian_kode_akun"><?= $Page->kode_akun->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <th class="<?= $Page->subtotal->headerCellClass() ?>"><span id="elh_rab_rincian_subtotal" class="rab_rincian_subtotal"><?= $Page->subtotal->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td <?= $Page->rab_rincian_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id">
<span<?= $Page->rab_rincian_id->viewAttributes() ?>>
<?= $Page->rab_rincian_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <td <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_uraian" class="rab_rincian_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <td <?= $Page->volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_volum" class="rab_rincian_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <td <?= $Page->satuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_satuan" class="rab_rincian_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <td <?= $Page->sbm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_sbm" class="rab_rincian_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_kode_akun" class="rab_rincian_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <td <?= $Page->subtotal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_rincian_subtotal" class="rab_rincian_subtotal">
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
