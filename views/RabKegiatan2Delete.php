<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabKegiatan2Delete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_kegiatan2delete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frab_kegiatan2delete = currentForm = new ew.Form("frab_kegiatan2delete", "delete");
    loadjs.done("frab_kegiatan2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.rab_kegiatan2) ew.vars.tables.rab_kegiatan2 = <?= JsonEncode(GetClientVar("tables", "rab_kegiatan2")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frab_kegiatan2delete" id="frab_kegiatan2delete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_kegiatan2">
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
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <th class="<?= $Page->kode_kegiatan->headerCellClass() ?>"><span id="elh_rab_kegiatan2_kode_kegiatan" class="rab_kegiatan2_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <th class="<?= $Page->kode_kro->headerCellClass() ?>"><span id="elh_rab_kegiatan2_kode_kro" class="rab_kegiatan2_kode_kro"><?= $Page->kode_kro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <th class="<?= $Page->kode_ro->headerCellClass() ?>"><span id="elh_rab_kegiatan2_kode_ro" class="rab_kegiatan2_kode_ro"><?= $Page->kode_ro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_biaya->Visible) { // total_biaya ?>
        <th class="<?= $Page->total_biaya->headerCellClass() ?>"><span id="elh_rab_kegiatan2_total_biaya" class="rab_kegiatan2_total_biaya"><?= $Page->total_biaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
        <th class="<?= $Page->reviewer_note_id->headerCellClass() ?>"><span id="elh_rab_kegiatan2_reviewer_note_id" class="rab_kegiatan2_reviewer_note_id"><?= $Page->reviewer_note_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
        <th class="<?= $Page->approval_note_id->headerCellClass() ?>"><span id="elh_rab_kegiatan2_approval_note_id" class="rab_kegiatan2_approval_note_id"><?= $Page->approval_note_id->caption() ?></span></th>
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
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <td <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_kegiatan" class="rab_kegiatan2_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <td <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_kro" class="rab_kegiatan2_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <td <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_kode_ro" class="rab_kegiatan2_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_biaya->Visible) { // total_biaya ?>
        <td <?= $Page->total_biaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_total_biaya" class="rab_kegiatan2_total_biaya">
<span<?= $Page->total_biaya->viewAttributes() ?>>
<?= $Page->total_biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
        <td <?= $Page->reviewer_note_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_reviewer_note_id" class="rab_kegiatan2_reviewer_note_id">
<span<?= $Page->reviewer_note_id->viewAttributes() ?>>
<?= $Page->reviewer_note_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
        <td <?= $Page->approval_note_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kegiatan2_approval_note_id" class="rab_kegiatan2_approval_note_id">
<span<?= $Page->approval_note_id->viewAttributes() ?>>
<?= $Page->approval_note_id->getViewValue() ?></span>
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
