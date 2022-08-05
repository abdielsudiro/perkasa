<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabNotePenyetujuView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_note_penyetujuview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frab_note_penyetujuview = currentForm = new ew.Form("frab_note_penyetujuview", "view");
    loadjs.done("frab_note_penyetujuview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab_note_penyetuju) ew.vars.tables.rab_note_penyetuju = <?= JsonEncode(GetClientVar("tables", "rab_note_penyetuju")) ?>;
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
<form name="frab_note_penyetujuview" id="frab_note_penyetujuview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_note_penyetuju">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->note->Visible) { // note ?>
    <tr id="r_note">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_note_penyetuju_note"><?= $Page->note->caption() ?></span></td>
        <td data-name="note" <?= $Page->note->cellAttributes() ?>>
<span id="el_rab_note_penyetuju_note">
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
