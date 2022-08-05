<?php

namespace PHPMaker2021\perkasa2;

// Page object
$Request2Delete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest2delete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frequest2delete = currentForm = new ew.Form("frequest2delete", "delete");
    loadjs.done("frequest2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.request2) ew.vars.tables.request2 = <?= JsonEncode(GetClientVar("tables", "request2")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest2delete" id="frequest2delete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request2">
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_request2_request_id" class="request2_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <th class="<?= $Page->process_id->headerCellClass() ?>"><span id="elh_request2_process_id" class="request2_process_id"><?= $Page->process_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->title->Visible) { // title ?>
        <th class="<?= $Page->title->headerCellClass() ?>"><span id="elh_request2_title" class="request2_title"><?= $Page->title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_requested->Visible) { // date_requested ?>
        <th class="<?= $Page->date_requested->headerCellClass() ?>"><span id="elh_request2_date_requested" class="request2_date_requested"><?= $Page->date_requested->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_request2_user_id" class="request2_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_request2__username" class="request2__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
        <th class="<?= $Page->current_state_id->headerCellClass() ?>"><span id="elh_request2_current_state_id" class="request2_current_state_id"><?= $Page->current_state_id->caption() ?></span></th>
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_request_id" class="request2_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
        <td <?= $Page->process_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_process_id" class="request2_process_id">
<span<?= $Page->process_id->viewAttributes() ?>>
<?= $Page->process_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->title->Visible) { // title ?>
        <td <?= $Page->title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_title" class="request2_title">
<span<?= $Page->title->viewAttributes() ?>>
<?= $Page->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_requested->Visible) { // date_requested ?>
        <td <?= $Page->date_requested->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_date_requested" class="request2_date_requested">
<span<?= $Page->date_requested->viewAttributes() ?>>
<?= $Page->date_requested->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td <?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_user_id" class="request2_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2__username" class="request2__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
        <td <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request2_current_state_id" class="request2_current_state_id">
<span<?= $Page->current_state_id->viewAttributes() ?>>
<?= $Page->current_state_id->getViewValue() ?></span>
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
