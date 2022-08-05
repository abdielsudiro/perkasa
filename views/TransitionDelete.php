<?php

namespace PHPMaker2021\perkasa2;

// Page object
$TransitionDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftransitiondelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftransitiondelete = currentForm = new ew.Form("ftransitiondelete", "delete");
    loadjs.done("ftransitiondelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.transition) ew.vars.tables.transition = <?= JsonEncode(GetClientVar("tables", "transition")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftransitiondelete" id="ftransitiondelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transition">
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
<?php if ($Page->transition_id->Visible) { // transition_id ?>
        <th class="<?= $Page->transition_id->headerCellClass() ?>"><span id="elh_transition_transition_id" class="transition_transition_id"><?= $Page->transition_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <th class="<?= $Page->process_id->headerCellClass() ?>"><span id="elh_transition_process_id" class="transition_process_id"><?= $Page->process_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
        <th class="<?= $Page->current_state_id->headerCellClass() ?>"><span id="elh_transition_current_state_id" class="transition_current_state_id"><?= $Page->current_state_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_state_id->Visible) { // next_state_id ?>
        <th class="<?= $Page->next_state_id->headerCellClass() ?>"><span id="elh_transition_next_state_id" class="transition_next_state_id"><?= $Page->next_state_id->caption() ?></span></th>
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
<?php if ($Page->transition_id->Visible) { // transition_id ?>
        <td <?= $Page->transition_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transition_transition_id" class="transition_transition_id">
<span<?= $Page->transition_id->viewAttributes() ?>>
<?= $Page->transition_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <td <?= $Page->process_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transition_process_id" class="transition_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
        <td <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transition_current_state_id" class="transition_current_state_id">
<span<?= $Page->current_state_id->viewAttributes() ?>>
<?= $Page->current_state_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_state_id->Visible) { // next_state_id ?>
        <td <?= $Page->next_state_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_transition_next_state_id" class="transition_next_state_id">
<span<?= $Page->next_state_id->viewAttributes() ?>>
<?= $Page->next_state_id->getViewValue() ?></span>
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
