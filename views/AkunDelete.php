<?php

namespace PHPMaker2021\perkasa2;

// Page object
$AkunDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fakundelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fakundelete = currentForm = new ew.Form("fakundelete", "delete");
    loadjs.done("fakundelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.akun) ew.vars.tables.akun = <?= JsonEncode(GetClientVar("tables", "akun")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fakundelete" id="fakundelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="akun">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_akun_id" class="akun_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <th class="<?= $Page->kode->headerCellClass() ?>"><span id="elh_akun_kode" class="akun_kode"><?= $Page->kode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th class="<?= $Page->uraian->headerCellClass() ?>"><span id="elh_akun_uraian" class="akun_uraian"><?= $Page->uraian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <th class="<?= $Page->parent_id->headerCellClass() ?>"><span id="elh_akun_parent_id" class="akun_parent_id"><?= $Page->parent_id->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_akun_id" class="akun_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
        <td <?= $Page->kode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_akun_kode" class="akun_kode">
<span<?= $Page->kode->viewAttributes() ?>>
<?= $Page->kode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <td <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_akun_uraian" class="akun_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <td <?= $Page->parent_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_akun_parent_id" class="akun_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
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
