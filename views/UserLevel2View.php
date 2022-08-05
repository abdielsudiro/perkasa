<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserLevel2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fuser_level2view;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fuser_level2view = currentForm = new ew.Form("fuser_level2view", "view");
    loadjs.done("fuser_level2view");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.user_level2) ew.vars.tables.user_level2 = <?= JsonEncode(GetClientVar("tables", "user_level2")) ?>;
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
<form name="fuser_level2view" id="fuser_level2view" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user_level2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->user_level_id->Visible) { // user_level_id ?>
    <tr id="r_user_level_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level2_user_level_id"><?= $Page->user_level_id->caption() ?></span></td>
        <td data-name="user_level_id" <?= $Page->user_level_id->cellAttributes() ?>>
<span id="el_user_level2_user_level_id">
<span<?= $Page->user_level_id->viewAttributes() ?>>
<?= $Page->user_level_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_level_name->Visible) { // user_level_name ?>
    <tr id="r_user_level_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level2_user_level_name"><?= $Page->user_level_name->caption() ?></span></td>
        <td data-name="user_level_name" <?= $Page->user_level_name->cellAttributes() ?>>
<span id="el_user_level2_user_level_name">
<span<?= $Page->user_level_name->viewAttributes() ?>>
<?= $Page->user_level_name->getViewValue() ?></span>
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
