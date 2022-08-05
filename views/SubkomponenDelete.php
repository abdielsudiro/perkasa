<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubkomponenDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsubkomponendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fsubkomponendelete = currentForm = new ew.Form("fsubkomponendelete", "delete");
    loadjs.done("fsubkomponendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.subkomponen) ew.vars.tables.subkomponen = <?= JsonEncode(GetClientVar("tables", "subkomponen")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsubkomponendelete" id="fsubkomponendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subkomponen">
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
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
        <th class="<?= $Page->kode_subkomponen->headerCellClass() ?>"><span id="elh_subkomponen_kode_subkomponen" class="subkomponen_kode_subkomponen"><?= $Page->kode_subkomponen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
        <th class="<?= $Page->kode_komponen->headerCellClass() ?>"><span id="elh_subkomponen_kode_komponen" class="subkomponen_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_subkomponen->Visible) { // nama_subkomponen ?>
        <th class="<?= $Page->nama_subkomponen->headerCellClass() ?>"><span id="elh_subkomponen_nama_subkomponen" class="subkomponen_nama_subkomponen"><?= $Page->nama_subkomponen->caption() ?></span></th>
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
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
        <td <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subkomponen_kode_subkomponen" class="subkomponen_kode_subkomponen">
<span<?= $Page->kode_subkomponen->viewAttributes() ?>>
<?= $Page->kode_subkomponen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
        <td <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subkomponen_kode_komponen" class="subkomponen_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_subkomponen->Visible) { // nama_subkomponen ?>
        <td <?= $Page->nama_subkomponen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subkomponen_nama_subkomponen" class="subkomponen_nama_subkomponen">
<span<?= $Page->nama_subkomponen->viewAttributes() ?>>
<?= $Page->nama_subkomponen->getViewValue() ?></span>
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
