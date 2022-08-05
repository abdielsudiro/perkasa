<?php

namespace PHPMaker2021\perkasa2;

// Page object
$DetailDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdetaildelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdetaildelete = currentForm = new ew.Form("fdetaildelete", "delete");
    loadjs.done("fdetaildelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.detail) ew.vars.tables.detail = <?= JsonEncode(GetClientVar("tables", "detail")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdetaildelete" id="fdetaildelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="detail">
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
<?php if ($Page->detail_id->Visible) { // detail_id ?>
        <th class="<?= $Page->detail_id->headerCellClass() ?>"><span id="elh_detail_detail_id" class="detail_detail_id"><?= $Page->detail_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <th class="<?= $Page->kode_akun->headerCellClass() ?>"><span id="elh_detail_kode_akun" class="detail_kode_akun"><?= $Page->kode_akun->caption() ?></span></th>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <th class="<?= $Page->volum->headerCellClass() ?>"><span id="elh_detail_volum" class="detail_volum"><?= $Page->volum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <th class="<?= $Page->sbm->headerCellClass() ?>"><span id="elh_detail_sbm" class="detail_sbm"><?= $Page->sbm->caption() ?></span></th>
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
<?php if ($Page->detail_id->Visible) { // detail_id ?>
        <td <?= $Page->detail_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_detail_detail_id" class="detail_detail_id">
<span<?= $Page->detail_id->viewAttributes() ?>>
<?= $Page->detail_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_detail_kode_akun" class="detail_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <td <?= $Page->volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_detail_volum" class="detail_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <td <?= $Page->sbm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_detail_sbm" class="detail_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
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
