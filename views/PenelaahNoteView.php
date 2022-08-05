<?php

namespace PHPMaker2021\perkasa2;

// Page object
$PenelaahNoteView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpenelaah_noteview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpenelaah_noteview = currentForm = new ew.Form("fpenelaah_noteview", "view");
    loadjs.done("fpenelaah_noteview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.penelaah_note) ew.vars.tables.penelaah_note = <?= JsonEncode(GetClientVar("tables", "penelaah_note")) ?>;
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
<form name="fpenelaah_noteview" id="fpenelaah_noteview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penelaah_note">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
    <tr id="r_approval_note_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penelaah_note_approval_note_id"><?= $Page->approval_note_id->caption() ?></span></td>
        <td data-name="approval_note_id" <?= $Page->approval_note_id->cellAttributes() ?>>
<span id="el_penelaah_note_approval_note_id">
<span<?= $Page->approval_note_id->viewAttributes() ?>>
<?= $Page->approval_note_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->approval_note->Visible) { // approval_note ?>
    <tr id="r_approval_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penelaah_note_approval_note"><?= $Page->approval_note->caption() ?></span></td>
        <td data-name="approval_note" <?= $Page->approval_note->cellAttributes() ?>>
<span id="el_penelaah_note_approval_note">
<span<?= $Page->approval_note->viewAttributes() ?>>
<?= $Page->approval_note->getViewValue() ?></span>
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
