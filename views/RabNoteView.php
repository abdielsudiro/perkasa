<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabNoteView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_noteview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frab_noteview = currentForm = new ew.Form("frab_noteview", "view");
    loadjs.done("frab_noteview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab_note) ew.vars.tables.rab_note = <?= JsonEncode(GetClientVar("tables", "rab_note")) ?>;
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
<form name="frab_noteview" id="frab_noteview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_note">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_rab_note->Visible) { // id_rab_note ?>
    <tr id="r_id_rab_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_note_id_rab_note"><?= $Page->id_rab_note->caption() ?></span></td>
        <td data-name="id_rab_note" <?= $Page->id_rab_note->cellAttributes() ?>>
<span id="el_rab_note_id_rab_note">
<span<?= $Page->id_rab_note->viewAttributes() ?>>
<?= $Page->id_rab_note->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <tr id="r_id_rab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_note_id_rab"><?= $Page->id_rab->caption() ?></span></td>
        <td data-name="id_rab" <?= $Page->id_rab->cellAttributes() ?>>
<span id="el_rab_note_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->note->Visible) { // note ?>
    <tr id="r_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_note_note"><?= $Page->note->caption() ?></span></td>
        <td data-name="note" <?= $Page->note->cellAttributes() ?>>
<span id="el_rab_note_note">
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
