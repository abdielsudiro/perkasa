<?php

namespace PHPMaker2021\perkasa2;

// Page object
$StatusesDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstatusesdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fstatusesdelete = currentForm = new ew.Form("fstatusesdelete", "delete");
    loadjs.done("fstatusesdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.statuses) ew.vars.tables.statuses = <?= JsonEncode(GetClientVar("tables", "statuses")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fstatusesdelete" id="fstatusesdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="statuses">
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
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
        <th class="<?= $Page->id_statuses->headerCellClass() ?>"><span id="elh_statuses_id_statuses" class="statuses_id_statuses"><?= $Page->id_statuses->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_status->Visible) { // nama_status ?>
        <th class="<?= $Page->nama_status->headerCellClass() ?>"><span id="elh_statuses_nama_status" class="statuses_nama_status"><?= $Page->nama_status->caption() ?></span></th>
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
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
        <td <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_statuses_id_statuses" class="statuses_id_statuses">
<span<?= $Page->id_statuses->viewAttributes() ?>>
<?= $Page->id_statuses->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_status->Visible) { // nama_status ?>
        <td <?= $Page->nama_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_statuses_nama_status" class="statuses_nama_status">
<span<?= $Page->nama_status->viewAttributes() ?>>
<?= $Page->nama_status->getViewValue() ?></span>
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
