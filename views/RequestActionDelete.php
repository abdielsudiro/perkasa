<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestActionDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_actiondelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frequest_actiondelete = currentForm = new ew.Form("frequest_actiondelete", "delete");
    loadjs.done("frequest_actiondelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.request_action) ew.vars.tables.request_action = <?= JsonEncode(GetClientVar("tables", "request_action")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest_actiondelete" id="frequest_actiondelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_action">
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
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
        <th class="<?= $Page->request_action_id->headerCellClass() ?>"><span id="elh_request_action_request_action_id" class="request_action_request_action_id"><?= $Page->request_action_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_request_action_request_id" class="request_action_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
        <th class="<?= $Page->action_id->headerCellClass() ?>"><span id="elh_request_action_action_id" class="request_action_action_id"><?= $Page->action_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
        <th class="<?= $Page->transition_id->headerCellClass() ?>"><span id="elh_request_action_transition_id" class="request_action_transition_id"><?= $Page->transition_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <th class="<?= $Page->is_active->headerCellClass() ?>"><span id="elh_request_action_is_active" class="request_action_is_active"><?= $Page->is_active->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
        <th class="<?= $Page->is_complete->headerCellClass() ?>"><span id="elh_request_action_is_complete" class="request_action_is_complete"><?= $Page->is_complete->caption() ?></span></th>
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
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
        <td <?= $Page->request_action_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_request_action_id" class="request_action_request_action_id">
<span<?= $Page->request_action_id->viewAttributes() ?>>
<?= $Page->request_action_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_request_id" class="request_action_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
        <td <?= $Page->action_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_action_id" class="request_action_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
        <td <?= $Page->transition_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_transition_id" class="request_action_transition_id">
<span<?= $Page->transition_id->viewAttributes() ?>>
<?= $Page->transition_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <td <?= $Page->is_active->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_is_active" class="request_action_is_active">
<span<?= $Page->is_active->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_active_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_active->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_active->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_active_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
        <td <?= $Page->is_complete->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_action_is_complete" class="request_action_is_complete">
<span<?= $Page->is_complete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_complete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_complete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_complete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_complete_<?= $Page->RowCount ?>"></label>
</div></span>
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
