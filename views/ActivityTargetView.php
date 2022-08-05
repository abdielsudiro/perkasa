<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActivityTargetView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var factivity_targetview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    factivity_targetview = currentForm = new ew.Form("factivity_targetview", "view");
    loadjs.done("factivity_targetview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.activity_target) ew.vars.tables.activity_target = <?= JsonEncode(GetClientVar("tables", "activity_target")) ?>;
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
<form name="factivity_targetview" id="factivity_targetview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="activity_target">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->activity_target_id->Visible) { // activity_target_id ?>
    <tr id="r_activity_target_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_target_activity_target_id"><?= $Page->activity_target_id->caption() ?></span></td>
        <td data-name="activity_target_id" <?= $Page->activity_target_id->cellAttributes() ?>>
<span id="el_activity_target_activity_target_id">
<span<?= $Page->activity_target_id->viewAttributes() ?>>
<?= $Page->activity_target_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->activity_id->Visible) { // activity_id ?>
    <tr id="r_activity_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_target_activity_id"><?= $Page->activity_id->caption() ?></span></td>
        <td data-name="activity_id" <?= $Page->activity_id->cellAttributes() ?>>
<span id="el_activity_target_activity_id">
<span<?= $Page->activity_id->viewAttributes() ?>>
<?= $Page->activity_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
    <tr id="r_target_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_target_target_id"><?= $Page->target_id->caption() ?></span></td>
        <td data-name="target_id" <?= $Page->target_id->cellAttributes() ?>>
<span id="el_activity_target_target_id">
<span<?= $Page->target_id->viewAttributes() ?>>
<?= $Page->target_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_target_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id" <?= $Page->group_id->cellAttributes() ?>>
<span id="el_activity_target_group_id">
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
