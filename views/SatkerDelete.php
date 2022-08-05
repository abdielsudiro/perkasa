<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SatkerDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsatkerdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fsatkerdelete = currentForm = new ew.Form("fsatkerdelete", "delete");
    loadjs.done("fsatkerdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.satker) ew.vars.tables.satker = <?= JsonEncode(GetClientVar("tables", "satker")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsatkerdelete" id="fsatkerdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="satker">
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
<?php if ($Page->satker_id->Visible) { // satker_id ?>
        <th class="<?= $Page->satker_id->headerCellClass() ?>"><span id="elh_satker_satker_id" class="satker_satker_id"><?= $Page->satker_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
        <th class="<?= $Page->unit_org_id->headerCellClass() ?>"><span id="elh_satker_unit_org_id" class="satker_unit_org_id"><?= $Page->unit_org_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { // nama_satker ?>
        <th class="<?= $Page->nama_satker->headerCellClass() ?>"><span id="elh_satker_nama_satker" class="satker_nama_satker"><?= $Page->nama_satker->caption() ?></span></th>
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
<?php if ($Page->satker_id->Visible) { // satker_id ?>
        <td <?= $Page->satker_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_satker_satker_id" class="satker_satker_id">
<span<?= $Page->satker_id->viewAttributes() ?>>
<?= $Page->satker_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
        <td <?= $Page->unit_org_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_satker_unit_org_id" class="satker_unit_org_id">
<span<?= $Page->unit_org_id->viewAttributes() ?>>
<?= $Page->unit_org_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { // nama_satker ?>
        <td <?= $Page->nama_satker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_satker_nama_satker" class="satker_nama_satker">
<span<?= $Page->nama_satker->viewAttributes() ?>>
<?= $Page->nama_satker->getViewValue() ?></span>
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
