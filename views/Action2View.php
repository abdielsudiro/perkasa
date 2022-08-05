<?php

namespace PHPMaker2021\perkasa2;

// Page object
$Action2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var faction2view;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    faction2view = currentForm = new ew.Form("faction2view", "view");
    loadjs.done("faction2view");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.action2) ew.vars.tables.action2 = <?= JsonEncode(GetClientVar("tables", "action2")) ?>;
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
<form name="faction2view" id="faction2view" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="action2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->action_id->Visible) { // action_id ?>
    <tr id="r_action_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action2_action_id"><?= $Page->action_id->caption() ?></span></td>
        <td data-name="action_id" <?= $Page->action_id->cellAttributes() ?>>
<span id="el_action2_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->action_type_id->Visible) { // action_type_id ?>
    <tr id="r_action_type_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action2_action_type_id"><?= $Page->action_type_id->caption() ?></span></td>
        <td data-name="action_type_id" <?= $Page->action_type_id->cellAttributes() ?>>
<span id="el_action2_action_type_id">
<span<?= $Page->action_type_id->viewAttributes() ?>>
<?= $Page->action_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <tr id="r_process_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action2_process_id"><?= $Page->process_id->caption() ?></span></td>
        <td data-name="process_id" <?= $Page->process_id->cellAttributes() ?>>
<span id="el_action2_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action2_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name" <?= $Page->name->cellAttributes() ?>>
<span id="el_action2_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_action2_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description" <?= $Page->description->cellAttributes() ?>>
<span id="el_action2_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
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
