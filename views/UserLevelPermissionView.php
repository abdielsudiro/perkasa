<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserLevelPermissionView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fuser_level_permissionview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fuser_level_permissionview = currentForm = new ew.Form("fuser_level_permissionview", "view");
    loadjs.done("fuser_level_permissionview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.user_level_permission) ew.vars.tables.user_level_permission = <?= JsonEncode(GetClientVar("tables", "user_level_permission")) ?>;
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
<form name="fuser_level_permissionview" id="fuser_level_permissionview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user_level_permission">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->user_level_permission_id->Visible) { // user_level_permission_id ?>
    <tr id="r_user_level_permission_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level_permission_user_level_permission_id"><?= $Page->user_level_permission_id->caption() ?></span></td>
        <td data-name="user_level_permission_id" <?= $Page->user_level_permission_id->cellAttributes() ?>>
<span id="el_user_level_permission_user_level_permission_id">
<span<?= $Page->user_level_permission_id->viewAttributes() ?>>
<?= $Page->user_level_permission_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_level_id->Visible) { // user_level_id ?>
    <tr id="r_user_level_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level_permission_user_level_id"><?= $Page->user_level_id->caption() ?></span></td>
        <td data-name="user_level_id" <?= $Page->user_level_id->cellAttributes() ?>>
<span id="el_user_level_permission_user_level_id">
<span<?= $Page->user_level_id->viewAttributes() ?>>
<?= $Page->user_level_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->table_name->Visible) { // table_name ?>
    <tr id="r_table_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level_permission_table_name"><?= $Page->table_name->caption() ?></span></td>
        <td data-name="table_name" <?= $Page->table_name->cellAttributes() ?>>
<span id="el_user_level_permission_table_name">
<span<?= $Page->table_name->viewAttributes() ?>>
<?= $Page->table_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
    <tr id="r__permission">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level_permission__permission"><?= $Page->_permission->caption() ?></span></td>
        <td data-name="_permission" <?= $Page->_permission->cellAttributes() ?>>
<span id="el_user_level_permission__permission">
<span<?= $Page->_permission->viewAttributes() ?>>
<?= $Page->_permission->getViewValue() ?></span>
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
