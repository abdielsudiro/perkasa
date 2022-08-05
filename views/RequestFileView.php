<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestFileView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_fileview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frequest_fileview = currentForm = new ew.Form("frequest_fileview", "view");
    loadjs.done("frequest_fileview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.request_file) ew.vars.tables.request_file = <?= JsonEncode(GetClientVar("tables", "request_file")) ?>;
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
<form name="frequest_fileview" id="frequest_fileview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_file">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->request_file_id->Visible) { // request_file_id ?>
    <tr id="r_request_file_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_request_file_id"><?= $Page->request_file_id->caption() ?></span></td>
        <td data-name="request_file_id" <?= $Page->request_file_id->cellAttributes() ?>>
<span id="el_request_file_request_file_id">
<span<?= $Page->request_file_id->viewAttributes() ?>>
<?= $Page->request_file_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request_file_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id" <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request_file_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
    <tr id="r_date_uploaded">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_date_uploaded"><?= $Page->date_uploaded->caption() ?></span></td>
        <td data-name="date_uploaded" <?= $Page->date_uploaded->cellAttributes() ?>>
<span id="el_request_file_date_uploaded">
<span<?= $Page->date_uploaded->viewAttributes() ?>>
<?= $Page->date_uploaded->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
    <tr id="r_file_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_file_name"><?= $Page->file_name->caption() ?></span></td>
        <td data-name="file_name" <?= $Page->file_name->cellAttributes() ?>>
<span id="el_request_file_file_name">
<span<?= $Page->file_name->viewAttributes() ?>>
<?= $Page->file_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_content->Visible) { // file_content ?>
    <tr id="r_file_content">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_file_content"><?= $Page->file_content->caption() ?></span></td>
        <td data-name="file_content" <?= $Page->file_content->cellAttributes() ?>>
<span id="el_request_file_file_content">
<span<?= $Page->file_content->viewAttributes() ?>>
<?= $Page->file_content->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mime_type->Visible) { // mime_type ?>
    <tr id="r_mime_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_file_mime_type"><?= $Page->mime_type->caption() ?></span></td>
        <td data-name="mime_type" <?= $Page->mime_type->cellAttributes() ?>>
<span id="el_request_file_mime_type">
<span<?= $Page->mime_type->viewAttributes() ?>>
<?= $Page->mime_type->getViewValue() ?></span>
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
