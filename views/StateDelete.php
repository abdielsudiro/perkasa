<?php

namespace PHPMaker2021\perkasa2;

// Page object
$StateDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstatedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fstatedelete = currentForm = new ew.Form("fstatedelete", "delete");
    loadjs.done("fstatedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.state) ew.vars.tables.state = <?= JsonEncode(GetClientVar("tables", "state")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fstatedelete" id="fstatedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="state">
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
<?php if ($Page->state_id->Visible) { // state_id ?>
        <th class="<?= $Page->state_id->headerCellClass() ?>"><span id="elh_state_state_id" class="state_state_id"><?= $Page->state_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->state_type_id->Visible) { // state_type_id ?>
        <th class="<?= $Page->state_type_id->headerCellClass() ?>"><span id="elh_state_state_type_id" class="state_state_type_id"><?= $Page->state_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <th class="<?= $Page->process_id->headerCellClass() ?>"><span id="elh_state_process_id" class="state_process_id"><?= $Page->process_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_state_name" class="state_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_state_description" class="state_description"><?= $Page->description->caption() ?></span></th>
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
<?php if ($Page->state_id->Visible) { // state_id ?>
        <td <?= $Page->state_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_state_state_id" class="state_state_id">
<span<?= $Page->state_id->viewAttributes() ?>>
<?= $Page->state_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->state_type_id->Visible) { // state_type_id ?>
        <td <?= $Page->state_type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_state_state_type_id" class="state_state_type_id">
<span<?= $Page->state_type_id->viewAttributes() ?>>
<?= $Page->state_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <td <?= $Page->process_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_state_process_id" class="state_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td <?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_state_name" class="state_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td <?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_state_description" class="state_description">
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
