<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestNoteDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_notedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frequest_notedelete = currentForm = new ew.Form("frequest_notedelete", "delete");
    loadjs.done("frequest_notedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.request_note) ew.vars.tables.request_note = <?= JsonEncode(GetClientVar("tables", "request_note")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest_notedelete" id="frequest_notedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_note">
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
<?php if ($Page->request_note_id->Visible) { // request_note_id ?>
        <th class="<?= $Page->request_note_id->headerCellClass() ?>"><span id="elh_request_note_request_note_id" class="request_note_request_note_id"><?= $Page->request_note_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_request_note_request_id" class="request_note_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_request_note_user_id" class="request_note_user_id"><?= $Page->user_id->caption() ?></span></th>
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
<?php if ($Page->request_note_id->Visible) { // request_note_id ?>
        <td <?= $Page->request_note_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_note_request_note_id" class="request_note_request_note_id">
<span<?= $Page->request_note_id->viewAttributes() ?>>
<?= $Page->request_note_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_note_request_id" class="request_note_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td <?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_note_user_id" class="request_note_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
