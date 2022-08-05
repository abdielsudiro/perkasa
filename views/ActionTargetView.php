<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActionTargetView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var faction_targetview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    faction_targetview = currentForm = new ew.Form("faction_targetview", "view");
    loadjs.done("faction_targetview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.action_target) ew.vars.tables.action_target = <?= JsonEncode(GetClientVar("tables", "action_target")) ?>;
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
<form name="faction_targetview" id="faction_targetview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="action_target">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->action_target_id->Visible) { // action_target_id ?>
    <tr id="r_action_target_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action_target_action_target_id"><?= $Page->action_target_id->caption() ?></span></td>
        <td data-name="action_target_id" <?= $Page->action_target_id->cellAttributes() ?>>
<span id="el_action_target_action_target_id">
<span<?= $Page->action_target_id->viewAttributes() ?>>
<?= $Page->action_target_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
    <tr id="r_action_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action_target_action_id"><?= $Page->action_id->caption() ?></span></td>
        <td data-name="action_id" <?= $Page->action_id->cellAttributes() ?>>
<span id="el_action_target_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
    <tr id="r_target_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action_target_target_id"><?= $Page->target_id->caption() ?></span></td>
        <td data-name="target_id" <?= $Page->target_id->cellAttributes() ?>>
<span id="el_action_target_target_id">
<span<?= $Page->target_id->viewAttributes() ?>>
<?= $Page->target_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action_target_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id" <?= $Page->group_id->cellAttributes() ?>>
<span id="el_action_target_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
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
