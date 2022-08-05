<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestFileDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_filedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frequest_filedelete = currentForm = new ew.Form("frequest_filedelete", "delete");
    loadjs.done("frequest_filedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.request_file) ew.vars.tables.request_file = <?= JsonEncode(GetClientVar("tables", "request_file")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest_filedelete" id="frequest_filedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_file">
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
<?php if ($Page->request_file_id->Visible) { // request_file_id ?>
        <th class="<?= $Page->request_file_id->headerCellClass() ?>"><span id="elh_request_file_request_file_id" class="request_file_request_file_id"><?= $Page->request_file_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_request_file_request_id" class="request_file_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_request_file_user_id" class="request_file_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
        <th class="<?= $Page->date_uploaded->headerCellClass() ?>"><span id="elh_request_file_date_uploaded" class="request_file_date_uploaded"><?= $Page->date_uploaded->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
        <th class="<?= $Page->file_name->headerCellClass() ?>"><span id="elh_request_file_file_name" class="request_file_file_name"><?= $Page->file_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_content->Visible) { // file_content ?>
        <th class="<?= $Page->file_content->headerCellClass() ?>"><span id="elh_request_file_file_content" class="request_file_file_content"><?= $Page->file_content->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mime_type->Visible) { // mime_type ?>
        <th class="<?= $Page->mime_type->headerCellClass() ?>"><span id="elh_request_file_mime_type" class="request_file_mime_type"><?= $Page->mime_type->caption() ?></span></th>
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
<?php if ($Page->request_file_id->Visible) { // request_file_id ?>
        <td <?= $Page->request_file_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_request_file_id" class="request_file_request_file_id">
<span<?= $Page->request_file_id->viewAttributes() ?>>
<?= $Page->request_file_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_request_id" class="request_file_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td <?= $Page->user_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_user_id" class="request_file_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
        <td <?= $Page->date_uploaded->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_date_uploaded" class="request_file_date_uploaded">
<span<?= $Page->date_uploaded->viewAttributes() ?>>
<?= $Page->date_uploaded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
        <td <?= $Page->file_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_file_name" class="request_file_file_name">
<span<?= $Page->file_name->viewAttributes() ?>>
<?= $Page->file_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_content->Visible) { // file_content ?>
        <td <?= $Page->file_content->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_file_content" class="request_file_file_content">
<span<?= $Page->file_content->viewAttributes() ?>>
<?= $Page->file_content->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mime_type->Visible) { // mime_type ?>
        <td <?= $Page->mime_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_file_mime_type" class="request_file_mime_type">
<span<?= $Page->mime_type->viewAttributes() ?>>
<?= $Page->mime_type->getViewValue() ?></span>
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
