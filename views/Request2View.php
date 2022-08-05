<?php

namespace PHPMaker2021\perkasa2;

// Page object
$Request2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest2view;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frequest2view = currentForm = new ew.Form("frequest2view", "view");
    loadjs.done("frequest2view");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.request2) ew.vars.tables.request2 = <?= JsonEncode(GetClientVar("tables", "request2")) ?>;
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
<form name="frequest2view" id="frequest2view" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id" <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request2_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <tr id="r_process_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_process_id"><?= $Page->process_id->caption() ?></span></td>
        <td data-name="process_id" <?= $Page->process_id->cellAttributes() ?>>
<span id="el_request2_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->title->Visible) { // title ?>
    <tr id="r_title">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_title"><?= $Page->title->caption() ?></span></td>
        <td data-name="title" <?= $Page->title->cellAttributes() ?>>
<span id="el_request2_title">
<span<?= $Page->title->viewAttributes() ?>>
<?= $Page->title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_requested->Visible) { // date_requested ?>
    <tr id="r_date_requested">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_date_requested"><?= $Page->date_requested->caption() ?></span></td>
        <td data-name="date_requested" <?= $Page->date_requested->cellAttributes() ?>>
<span id="el_request2_date_requested">
<span<?= $Page->date_requested->viewAttributes() ?>>
<?= $Page->date_requested->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id" <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request2_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el_request2__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
    <tr id="r_current_state_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_request2_current_state_id"><?= $Page->current_state_id->caption() ?></span></td>
        <td data-name="current_state_id" <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el_request2_current_state_id">
<span<?= $Page->current_state_id->viewAttributes() ?>>
<?= $Page->current_state_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("request_rab", explode(",", $Page->getCurrentDetailTable())) && $request_rab->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_rab", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestRabGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_note", explode(",", $Page->getCurrentDetailTable())) && $request_note->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_note", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestNoteGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_stakeholder", explode(",", $Page->getCurrentDetailTable())) && $request_stakeholder->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_stakeholder", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestStakeholderGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_action", explode(",", $Page->getCurrentDetailTable())) && $request_action->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestActionGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_data", explode(",", $Page->getCurrentDetailTable())) && $request_data->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_data", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestDataGrid.php" ?>
<?php } ?>
<?php
    if (in_array("process", explode(",", $Page->getCurrentDetailTable())) && $process->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("process", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ProcessGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_file", explode(",", $Page->getCurrentDetailTable())) && $request_file->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_file", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestFileGrid.php" ?>
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
