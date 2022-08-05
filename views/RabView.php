<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frabview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frabview = currentForm = new ew.Form("frabview", "view");
    loadjs.done("frabview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.rab) ew.vars.tables.rab = <?= JsonEncode(GetClientVar("tables", "rab")) ?>;
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
<form name="frabview" id="frabview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <tr id="r_id_rab">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_id_rab"><?= $Page->id_rab->caption() ?></span></td>
        <td data-name="id_rab" <?= $Page->id_rab->cellAttributes() ?>>
<span id="el_rab_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <tr id="r_satker_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_satker_id"><?= $Page->satker_id->caption() ?></span></td>
        <td data-name="satker_id" <?= $Page->satker_id->cellAttributes() ?>>
<span id="el_rab_satker_id">
<span<?= $Page->satker_id->viewAttributes() ?>>
<?= $Page->satker_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_program->Visible) { // kode_program ?>
    <tr id="r_kode_program">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_program"><?= $Page->kode_program->caption() ?></span></td>
        <td data-name="kode_program" <?= $Page->kode_program->cellAttributes() ?>>
<span id="el_rab_kode_program">
<span<?= $Page->kode_program->viewAttributes() ?>>
<?= $Page->kode_program->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <tr id="r_kode_kegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></td>
        <td data-name="kode_kegiatan" <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_rab_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <tr id="r_kode_kro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_kro"><?= $Page->kode_kro->caption() ?></span></td>
        <td data-name="kode_kro" <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_rab_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <tr id="r_kode_komponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></td>
        <td data-name="kode_komponen" <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_rab_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <tr id="r_kode_subkomponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_subkomponen"><?= $Page->kode_subkomponen->caption() ?></span></td>
        <td data-name="kode_subkomponen" <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el_rab_kode_subkomponen">
<span<?= $Page->kode_subkomponen->viewAttributes() ?>>
<?= $Page->kode_subkomponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <tr id="r_kode_ro">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_kode_ro"><?= $Page->kode_ro->caption() ?></span></td>
        <td data-name="kode_ro" <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_rab_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <tr id="r_filename">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_filename"><?= $Page->filename->caption() ?></span></td>
        <td data-name="filename" <?= $Page->filename->cellAttributes() ?>>
<span id="el_rab_filename">
<span<?= $Page->filename->viewAttributes() ?>>
<?= GetFileViewTag($Page->filename, $Page->filename->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
    <tr id="r_id_statuses">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_id_statuses"><?= $Page->id_statuses->caption() ?></span></td>
        <td data-name="id_statuses" <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el_rab_id_statuses">
<span<?= $Page->id_statuses->viewAttributes() ?>>
<?= $Page->id_statuses->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isApprovalAgree->Visible) { // isApprovalAgree ?>
    <tr id="r_isApprovalAgree">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_isApprovalAgree"><?= $Page->isApprovalAgree->caption() ?></span></td>
        <td data-name="isApprovalAgree" <?= $Page->isApprovalAgree->cellAttributes() ?>>
<span id="el_rab_isApprovalAgree">
<span<?= $Page->isApprovalAgree->viewAttributes() ?>>
<?= $Page->isApprovalAgree->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isPenelaahAgree->Visible) { // isPenelaahAgree ?>
    <tr id="r_isPenelaahAgree">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_rab_isPenelaahAgree"><?= $Page->isPenelaahAgree->caption() ?></span></td>
        <td data-name="isPenelaahAgree" <?= $Page->isPenelaahAgree->cellAttributes() ?>>
<span id="el_rab_isPenelaahAgree">
<span<?= $Page->isPenelaahAgree->viewAttributes() ?>>
<?= $Page->isPenelaahAgree->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("rab_file", explode(",", $Page->getCurrentDetailTable())) && $rab_file->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_file", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabFileGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_note_penelaah", explode(",", $Page->getCurrentDetailTable())) && $rab_note_penelaah->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_note_penelaah", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabNotePenelaahGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_note_penyetuju", explode(",", $Page->getCurrentDetailTable())) && $rab_note_penyetuju->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_note_penyetuju", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabNotePenyetujuGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_rincian", explode(",", $Page->getCurrentDetailTable())) && $rab_rincian->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_rincian", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabRincianGrid.php" ?>
<?php } ?>
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
