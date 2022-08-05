<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestActionView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_actionview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frequest_actionview = currentForm = new ew.Form("frequest_actionview", "view");
    loadjs.done("frequest_actionview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.request_action) ew.vars.tables.request_action = <?= JsonEncode(GetClientVar("tables", "request_action")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest_actionview" id="frequest_actionview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_action">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
    <tr id="r_request_action_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_request_action_id"><?= $Page->request_action_id->caption() ?></span></td>
        <td data-name="request_action_id" <?= $Page->request_action_id->cellAttributes() ?>>
<span id="el_request_action_request_action_id">
<span<?= $Page->request_action_id->viewAttributes() ?>>
<?= $Page->request_action_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request_action_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
    <tr id="r_action_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_action_id"><?= $Page->action_id->caption() ?></span></td>
        <td data-name="action_id" <?= $Page->action_id->cellAttributes() ?>>
<span id="el_request_action_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
    <tr id="r_transition_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_transition_id"><?= $Page->transition_id->caption() ?></span></td>
        <td data-name="transition_id" <?= $Page->transition_id->cellAttributes() ?>>
<span id="el_request_action_transition_id">
<span<?= $Page->transition_id->viewAttributes() ?>>
<?= $Page->transition_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <tr id="r_is_active">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_is_active"><?= $Page->is_active->caption() ?></span></td>
        <td data-name="is_active" <?= $Page->is_active->cellAttributes() ?>>
<span id="el_request_action_is_active">
<span<?= $Page->is_active->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_active_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_active->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_active->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_active_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
    <tr id="r_is_complete">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_action_is_complete"><?= $Page->is_complete->caption() ?></span></td>
        <td data-name="is_complete" <?= $Page->is_complete->cellAttributes() ?>>
<span id="el_request_action_is_complete">
<span<?= $Page->is_complete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_complete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_complete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_complete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_complete_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
