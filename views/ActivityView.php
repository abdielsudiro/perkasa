<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActivityView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var factivityview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    factivityview = currentForm = new ew.Form("factivityview", "view");
    loadjs.done("factivityview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.activity) ew.vars.tables.activity = <?= JsonEncode(GetClientVar("tables", "activity")) ?>;
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
<form name="factivityview" id="factivityview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->activity_id->Visible) { // activity_id ?>
    <tr id="r_activity_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_activity_id"><?= $Page->activity_id->caption() ?></span></td>
        <td data-name="activity_id" <?= $Page->activity_id->cellAttributes() ?>>
<span id="el_activity_activity_id">
<span<?= $Page->activity_id->viewAttributes() ?>>
<?= $Page->activity_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->activity_type_id->Visible) { // activity_type_id ?>
    <tr id="r_activity_type_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_activity_type_id"><?= $Page->activity_type_id->caption() ?></span></td>
        <td data-name="activity_type_id" <?= $Page->activity_type_id->cellAttributes() ?>>
<span id="el_activity_activity_type_id">
<span<?= $Page->activity_type_id->viewAttributes() ?>>
<?= $Page->activity_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <tr id="r_process_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_process_id"><?= $Page->process_id->caption() ?></span></td>
        <td data-name="process_id" <?= $Page->process_id->cellAttributes() ?>>
<span id="el_activity_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name" <?= $Page->name->cellAttributes() ?>>
<span id="el_activity_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_activity_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description" <?= $Page->description->cellAttributes() ?>>
<span id="el_activity_description">
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
