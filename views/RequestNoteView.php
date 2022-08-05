<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestNoteView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_noteview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frequest_noteview = currentForm = new ew.Form("frequest_noteview", "view");
    loadjs.done("frequest_noteview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.request_note) ew.vars.tables.request_note = <?= JsonEncode(GetClientVar("tables", "request_note")) ?>;
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
<form name="frequest_noteview" id="frequest_noteview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_note">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->request_note_id->Visible) { // request_note_id ?>
    <tr id="r_request_note_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_note_request_note_id"><?= $Page->request_note_id->caption() ?></span></td>
        <td data-name="request_note_id" <?= $Page->request_note_id->cellAttributes() ?>>
<span id="el_request_note_request_note_id">
<span<?= $Page->request_note_id->viewAttributes() ?>>
<?= $Page->request_note_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_note_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request_note_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_note_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id" <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request_note_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->note->Visible) { // note ?>
    <tr id="r_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request_note_note"><?= $Page->note->caption() ?></span></td>
        <td data-name="note" <?= $Page->note->cellAttributes() ?>>
<span id="el_request_note_note">
<span<?= $Page->note->viewAttributes() ?>>
<?= $Page->note->getViewValue() ?></span>
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
