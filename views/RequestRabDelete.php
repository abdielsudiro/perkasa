<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestRabDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_rabdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frequest_rabdelete = currentForm = new ew.Form("frequest_rabdelete", "delete");
    loadjs.done("frequest_rabdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.request_rab) ew.vars.tables.request_rab = <?= JsonEncode(GetClientVar("tables", "request_rab")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frequest_rabdelete" id="frequest_rabdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_rab">
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
<?php if ($Page->request_rab_id->Visible) { // request_rab_id ?>
        <th class="<?= $Page->request_rab_id->headerCellClass() ?>"><span id="elh_request_rab_request_rab_id" class="request_rab_request_rab_id"><?= $Page->request_rab_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
        <th class="<?= $Page->id_rab->headerCellClass() ?>"><span id="elh_request_rab_id_rab" class="request_rab_id_rab"><?= $Page->id_rab->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_request_rab_request_id" class="request_rab_request_id"><?= $Page->request_id->caption() ?></span></th>
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
<?php if ($Page->request_rab_id->Visible) { // request_rab_id ?>
        <td <?= $Page->request_rab_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_rab_request_rab_id" class="request_rab_request_rab_id">
<span<?= $Page->request_rab_id->viewAttributes() ?>>
<?= $Page->request_rab_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
        <td <?= $Page->id_rab->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_rab_id_rab" class="request_rab_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td <?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_request_rab_request_id" class="request_rab_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
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
