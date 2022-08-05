<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ProgramView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fprogramview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fprogramview = currentForm = new ew.Form("fprogramview", "view");
    loadjs.done("fprogramview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.program) ew.vars.tables.program = <?= JsonEncode(GetClientVar("tables", "program")) ?>;
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
<form name="fprogramview" id="fprogramview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="program">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kode_program->Visible) { // kode_program ?>
    <tr id="r_kode_program">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_program_kode_program"><?= $Page->kode_program->caption() ?></span></td>
        <td data-name="kode_program" <?= $Page->kode_program->cellAttributes() ?>>
<span id="el_program_kode_program">
<span<?= $Page->kode_program->viewAttributes() ?>>
<?= $Page->kode_program->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_program->Visible) { // nama_program ?>
    <tr id="r_nama_program">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_program_nama_program"><?= $Page->nama_program->caption() ?></span></td>
        <td data-name="nama_program" <?= $Page->nama_program->cellAttributes() ?>>
<span id="el_program_nama_program">
<span<?= $Page->nama_program->viewAttributes() ?>>
<?= $Page->nama_program->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_program_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_program_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
