<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ReviewerNoteView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freviewer_noteview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    freviewer_noteview = currentForm = new ew.Form("freviewer_noteview", "view");
    loadjs.done("freviewer_noteview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.reviewer_note) ew.vars.tables.reviewer_note = <?= JsonEncode(GetClientVar("tables", "reviewer_note")) ?>;
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
<form name="freviewer_noteview" id="freviewer_noteview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reviewer_note">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
    <tr id="r_reviewer_note_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reviewer_note_reviewer_note_id"><?= $Page->reviewer_note_id->caption() ?></span></td>
        <td data-name="reviewer_note_id" <?= $Page->reviewer_note_id->cellAttributes() ?>>
<span id="el_reviewer_note_reviewer_note_id">
<span<?= $Page->reviewer_note_id->viewAttributes() ?>>
<?= $Page->reviewer_note_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reviewer_note->Visible) { // reviewer_note ?>
    <tr id="r_reviewer_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reviewer_note_reviewer_note"><?= $Page->reviewer_note->caption() ?></span></td>
        <td data-name="reviewer_note" <?= $Page->reviewer_note->cellAttributes() ?>>
<span id="el_reviewer_note_reviewer_note">
<span<?= $Page->reviewer_note->viewAttributes() ?>>
<?= $Page->reviewer_note->getViewValue() ?></span>
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
