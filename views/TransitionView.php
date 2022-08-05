<?php

namespace PHPMaker2021\perkasa2;

// Page object
$TransitionView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftransitionview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftransitionview = currentForm = new ew.Form("ftransitionview", "view");
    loadjs.done("ftransitionview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.transition) ew.vars.tables.transition = <?= JsonEncode(GetClientVar("tables", "transition")) ?>;
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
<form name="ftransitionview" id="ftransitionview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transition">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->transition_id->Visible) { // transition_id ?>
    <tr id="r_transition_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transition_transition_id"><?= $Page->transition_id->caption() ?></span></td>
        <td data-name="transition_id" <?= $Page->transition_id->cellAttributes() ?>>
<span id="el_transition_transition_id">
<span<?= $Page->transition_id->viewAttributes() ?>>
<?= $Page->transition_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <tr id="r_process_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transition_process_id"><?= $Page->process_id->caption() ?></span></td>
        <td data-name="process_id" <?= $Page->process_id->cellAttributes() ?>>
<span id="el_transition_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
    <tr id="r_current_state_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transition_current_state_id"><?= $Page->current_state_id->caption() ?></span></td>
        <td data-name="current_state_id" <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el_transition_current_state_id">
<span<?= $Page->current_state_id->viewAttributes() ?>>
<?= $Page->current_state_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_state_id->Visible) { // next_state_id ?>
    <tr id="r_next_state_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transition_next_state_id"><?= $Page->next_state_id->caption() ?></span></td>
        <td data-name="next_state_id" <?= $Page->next_state_id->cellAttributes() ?>>
<span id="el_transition_next_state_id">
<span<?= $Page->next_state_id->viewAttributes() ?>>
<?= $Page->next_state_id->getViewValue() ?></span>
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
