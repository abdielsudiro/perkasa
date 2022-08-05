<?php

namespace PHPMaker2021\perkasa2;

// Page object
$StateView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fstateview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fstateview = currentForm = new ew.Form("fstateview", "view");
    loadjs.done("fstateview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.state) ew.vars.tables.state = <?= JsonEncode(GetClientVar("tables", "state")) ?>;
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
<form name="fstateview" id="fstateview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="state">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->state_id->Visible) { // state_id ?>
    <tr id="r_state_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_state_state_id"><?= $Page->state_id->caption() ?></span></td>
        <td data-name="state_id" <?= $Page->state_id->cellAttributes() ?>>
<span id="el_state_state_id">
<span<?= $Page->state_id->viewAttributes() ?>>
<?= $Page->state_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->state_type_id->Visible) { // state_type_id ?>
    <tr id="r_state_type_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_state_state_type_id"><?= $Page->state_type_id->caption() ?></span></td>
        <td data-name="state_type_id" <?= $Page->state_type_id->cellAttributes() ?>>
<span id="el_state_state_type_id">
<span<?= $Page->state_type_id->viewAttributes() ?>>
<?= $Page->state_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <tr id="r_process_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_state_process_id"><?= $Page->process_id->caption() ?></span></td>
        <td data-name="process_id" <?= $Page->process_id->cellAttributes() ?>>
<span id="el_state_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_state_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name" <?= $Page->name->cellAttributes() ?>>
<span id="el_state_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_state_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description" <?= $Page->description->cellAttributes() ?>>
<span id="el_state_description">
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
