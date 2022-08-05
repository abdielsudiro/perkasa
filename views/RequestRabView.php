<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestRabView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_rabview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frequest_rabview = currentForm = new ew.Form("frequest_rabview", "view");
    loadjs.done("frequest_rabview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.request_rab) ew.vars.tables.request_rab = <?= JsonEncode(GetClientVar("tables", "request_rab")) ?>;
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
<form name="frequest_rabview" id="frequest_rabview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_rab">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->request_rab_id->Visible) { // request_rab_id ?>
    <tr id="r_request_rab_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_rab_request_rab_id"><?= $Page->request_rab_id->caption() ?></span></td>
        <td data-name="request_rab_id" <?= $Page->request_rab_id->cellAttributes() ?>>
<span id="el_request_rab_request_rab_id">
<span<?= $Page->request_rab_id->viewAttributes() ?>>
<?= $Page->request_rab_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <tr id="r_id_rab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_rab_id_rab"><?= $Page->id_rab->caption() ?></span></td>
        <td data-name="id_rab" <?= $Page->id_rab->cellAttributes() ?>>
<span id="el_request_rab_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_rab_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request_rab_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
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
