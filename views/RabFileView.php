<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabFileView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_fileview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frab_fileview = currentForm = new ew.Form("frab_fileview", "view");
    loadjs.done("frab_fileview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    ew.PDFObjectOptions={width:"940px",height:"800px",pdfOpenParams:{toolbar:1}};
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab_file) ew.vars.tables.rab_file = <?= JsonEncode(GetClientVar("tables", "rab_file")) ?>;
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
<form name="frab_fileview" id="frab_fileview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_file">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_rab_file->Visible) { // id_rab_file ?>
    <tr id="r_id_rab_file">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_file_id_rab_file"><?= $Page->id_rab_file->caption() ?></span></td>
        <td data-name="id_rab_file" <?= $Page->id_rab_file->cellAttributes() ?>>
<span id="el_rab_file_id_rab_file">
<span<?= $Page->id_rab_file->viewAttributes() ?>>
<?= $Page->id_rab_file->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <tr id="r_id_rab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_file_id_rab"><?= $Page->id_rab->caption() ?></span></td>
        <td data-name="id_rab" <?= $Page->id_rab->cellAttributes() ?>>
<span id="el_rab_file_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <tr id="r_filename">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_file_filename"><?= $Page->filename->caption() ?></span></td>
        <td data-name="filename" <?= $Page->filename->cellAttributes() ?>>
<span id="el_rab_file_filename">
<span>
<?= GetFileViewTag($Page->filename, $Page->filename->getViewValue(), false) ?>
</span>
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
