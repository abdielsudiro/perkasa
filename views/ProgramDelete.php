<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ProgramDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fprogramdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fprogramdelete = currentForm = new ew.Form("fprogramdelete", "delete");
    loadjs.done("fprogramdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.program) ew.vars.tables.program = <?= JsonEncode(GetClientVar("tables", "program")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fprogramdelete" id="fprogramdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="program">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->kode_program->Visible) { // kode_program ?>
        <th class="<?= $Page->kode_program->headerCellClass() ?>"><span id="elh_program_kode_program" class="program_kode_program"><?= $Page->kode_program->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_program->Visible) { // nama_program ?>
        <th class="<?= $Page->nama_program->headerCellClass() ?>"><span id="elh_program_nama_program" class="program_nama_program"><?= $Page->nama_program->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_program_id" class="program_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->kode_program->Visible) { // kode_program ?>
        <td <?= $Page->kode_program->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_program_kode_program" class="program_kode_program">
<span<?= $Page->kode_program->viewAttributes() ?>>
<?= $Page->kode_program->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_program->Visible) { // nama_program ?>
        <td <?= $Page->nama_program->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_program_nama_program" class="program_nama_program">
<span<?= $Page->nama_program->viewAttributes() ?>>
<?= $Page->nama_program->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_program_id" class="program_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
