<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserlevelpermissionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fuserlevelpermissionsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fuserlevelpermissionsview = currentForm = new ew.Form("fuserlevelpermissionsview", "view");
    loadjs.done("fuserlevelpermissionsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.userlevelpermissions) ew.vars.tables.userlevelpermissions = <?= JsonEncode(GetClientVar("tables", "userlevelpermissions")) ?>;
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
<form name="fuserlevelpermissionsview" id="fuserlevelpermissionsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
    <tr id="r_userlevelid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_userlevelid"><?= $Page->userlevelid->caption() ?></span></td>
        <td data-name="userlevelid" <?= $Page->userlevelid->cellAttributes() ?>>
<span id="el_userlevelpermissions_userlevelid">
<span<?= $Page->userlevelid->viewAttributes() ?>>
<?= $Page->userlevelid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
    <tr id="r__tablename">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions__tablename"><?= $Page->_tablename->caption() ?></span></td>
        <td data-name="_tablename" <?= $Page->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<span<?= $Page->_tablename->viewAttributes() ?>>
<?= $Page->_tablename->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
    <tr id="r__permission">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions__permission"><?= $Page->_permission->caption() ?></span></td>
        <td data-name="_permission" <?= $Page->_permission->cellAttributes() ?>>
<span id="el_userlevelpermissions__permission">
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
