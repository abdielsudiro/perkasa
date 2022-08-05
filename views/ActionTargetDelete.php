<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActionTargetDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var faction_targetdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    faction_targetdelete = currentForm = new ew.Form("faction_targetdelete", "delete");
    loadjs.done("faction_targetdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.action_target) ew.vars.tables.action_target = <?= JsonEncode(GetClientVar("tables", "action_target")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="faction_targetdelete" id="faction_targetdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="action_target">
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
<?php if ($Page->action_target_id->Visible) { // action_target_id ?>
        <th class="<?= $Page->action_target_id->headerCellClass() ?>"><span id="elh_action_target_action_target_id" class="action_target_action_target_id"><?= $Page->action_target_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
        <th class="<?= $Page->action_id->headerCellClass() ?>"><span id="elh_action_target_action_id" class="action_target_action_id"><?= $Page->action_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
        <th class="<?= $Page->target_id->headerCellClass() ?>"><span id="elh_action_target_target_id" class="action_target_target_id"><?= $Page->target_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_action_target_group_id" class="action_target_group_id"><?= $Page->group_id->caption() ?></span></th>
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
<?php if ($Page->action_target_id->Visible) { // action_target_id ?>
        <td <?= $Page->action_target_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_action_target_action_target_id" class="action_target_action_target_id">
<span<?= $Page->action_target_id->viewAttributes() ?>>
<?= $Page->action_target_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
        <td <?= $Page->action_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_action_target_action_id" class="action_target_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
        <td <?= $Page->target_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_action_target_target_id" class="action_target_target_id">
<span<?= $Page->target_id->viewAttributes() ?>>
<?= $Page->target_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td <?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_action_target_group_id" class="action_target_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
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
