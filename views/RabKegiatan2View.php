<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabKegiatan2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_kegiatan2view;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frab_kegiatan2view = currentForm = new ew.Form("frab_kegiatan2view", "view");
    loadjs.done("frab_kegiatan2view");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab_kegiatan2) ew.vars.tables.rab_kegiatan2 = <?= JsonEncode(GetClientVar("tables", "rab_kegiatan2")) ?>;
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
<form name="frab_kegiatan2view" id="frab_kegiatan2view" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_kegiatan2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->rab_kegiatan_id->Visible) { // rab_kegiatan_id ?>
    <tr id="r_rab_kegiatan_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_rab_kegiatan_id"><?= $Page->rab_kegiatan_id->caption() ?></span></td>
        <td data-name="rab_kegiatan_id" <?= $Page->rab_kegiatan_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_rab_kegiatan_id">
<span<?= $Page->rab_kegiatan_id->viewAttributes() ?>>
<?= $Page->rab_kegiatan_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <tr id="r_satker_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_satker_id"><?= $Page->satker_id->caption() ?></span></td>
        <td data-name="satker_id" <?= $Page->satker_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_satker_id">
<span<?= $Page->satker_id->viewAttributes() ?>>
<?= $Page->satker_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <tr id="r_kode_kegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></td>
        <td data-name="kode_kegiatan" <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <tr id="r_kode_kro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_kode_kro"><?= $Page->kode_kro->caption() ?></span></td>
        <td data-name="kode_kro" <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <tr id="r_kode_ro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_kode_ro"><?= $Page->kode_ro->caption() ?></span></td>
        <td data-name="kode_ro" <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <tr id="r_kode_komponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></td>
        <td data-name="kode_komponen" <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <tr id="r_kode_subkomponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_kode_subkomponen"><?= $Page->kode_subkomponen->caption() ?></span></td>
        <td data-name="kode_subkomponen" <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_subkomponen">
<span<?= $Page->kode_subkomponen->viewAttributes() ?>>
<?= $Page->kode_subkomponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_biaya->Visible) { // total_biaya ?>
    <tr id="r_total_biaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_total_biaya"><?= $Page->total_biaya->caption() ?></span></td>
        <td data-name="total_biaya" <?= $Page->total_biaya->cellAttributes() ?>>
<span id="el_rab_kegiatan2_total_biaya">
<span<?= $Page->total_biaya->viewAttributes() ?>>
<?= $Page->total_biaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
    <tr id="r_reviewer_note_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_reviewer_note_id"><?= $Page->reviewer_note_id->caption() ?></span></td>
        <td data-name="reviewer_note_id" <?= $Page->reviewer_note_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_reviewer_note_id">
<span<?= $Page->reviewer_note_id->viewAttributes() ?>>
<?= $Page->reviewer_note_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
    <tr id="r_approval_note_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kegiatan2_approval_note_id"><?= $Page->approval_note_id->caption() ?></span></td>
        <td data-name="approval_note_id" <?= $Page->approval_note_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_approval_note_id">
<span<?= $Page->approval_note_id->viewAttributes() ?>>
<?= $Page->approval_note_id->getViewValue() ?></span>
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
