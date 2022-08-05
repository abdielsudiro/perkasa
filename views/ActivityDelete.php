<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActivityDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var factivitydelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    factivitydelete = currentForm = new ew.Form("factivitydelete", "delete");
    loadjs.done("factivitydelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.activity) ew.vars.tables.activity = <?= JsonEncode(GetClientVar("tables", "activity")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="factivitydelete" id="factivitydelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="activity">
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
<?php if ($Page->activity_id->Visible) { // activity_id ?>
        <th class="<?= $Page->activity_id->headerCellClass() ?>"><span id="elh_activity_activity_id" class="activity_activity_id"><?= $Page->activity_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->activity_type_id->Visible) { // activity_type_id ?>
        <th class="<?= $Page->activity_type_id->headerCellClass() ?>"><span id="elh_activity_activity_type_id" class="activity_activity_type_id"><?= $Page->activity_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <th class="<?= $Page->process_id->headerCellClass() ?>"><span id="elh_activity_process_id" class="activity_process_id"><?= $Page->process_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_activity_name" class="activity_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_activity_description" class="activity_description"><?= $Page->description->caption() ?></span></th>
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
<?php if ($Page->activity_id->Visible) { // activity_id ?>
        <td <?= $Page->activity_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_activity_activity_id" class="activity_activity_id">
<span<?= $Page->activity_id->viewAttributes() ?>>
<?= $Page->activity_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->activity_type_id->Visible) { // activity_type_id ?>
        <td <?= $Page->activity_type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_activity_activity_type_id" class="activity_activity_type_id">
<span<?= $Page->activity_type_id->viewAttributes() ?>>
<?= $Page->activity_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <td <?= $Page->process_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_activity_process_id" class="activity_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td <?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_activity_name" class="activity_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td <?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_activity_description" class="activity_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
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
