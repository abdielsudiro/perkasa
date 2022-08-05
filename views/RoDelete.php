<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RoDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frodelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frodelete = currentForm = new ew.Form("frodelete", "delete");
    loadjs.done("frodelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.ro) ew.vars.tables.ro = <?= JsonEncode(GetClientVar("tables", "ro")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frodelete" id="frodelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ro">
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
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <th class="<?= $Page->kode_ro->headerCellClass() ?>"><span id="elh_ro_kode_ro" class="ro_kode_ro"><?= $Page->kode_ro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <th class="<?= $Page->kode_kro->headerCellClass() ?>"><span id="elh_ro_kode_kro" class="ro_kode_kro"><?= $Page->kode_kro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_ro->Visible) { // nama_ro ?>
        <th class="<?= $Page->nama_ro->headerCellClass() ?>"><span id="elh_ro_nama_ro" class="ro_nama_ro"><?= $Page->nama_ro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_ro_id" class="ro_id"><?= $Page->id->caption() ?></span></th>
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
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <td <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ro_kode_ro" class="ro_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <td <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ro_kode_kro" class="ro_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_ro->Visible) { // nama_ro ?>
        <td <?= $Page->nama_ro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ro_nama_ro" class="ro_nama_ro">
<span<?= $Page->nama_ro->viewAttributes() ?>>
<?= $Page->nama_ro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ro_id" class="ro_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
