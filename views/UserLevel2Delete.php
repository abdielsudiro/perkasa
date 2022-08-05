<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserLevel2Delete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fuser_level2delete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fuser_level2delete = currentForm = new ew.Form("fuser_level2delete", "delete");
    loadjs.done("fuser_level2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.user_level2) ew.vars.tables.user_level2 = <?= JsonEncode(GetClientVar("tables", "user_level2")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fuser_level2delete" id="fuser_level2delete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user_level2">
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
<?php if ($Page->user_level_id->Visible) { // user_level_id ?>
        <th class="<?= $Page->user_level_id->headerCellClass() ?>"><span id="elh_user_level2_user_level_id" class="user_level2_user_level_id"><?= $Page->user_level_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_level_name->Visible) { // user_level_name ?>
        <th class="<?= $Page->user_level_name->headerCellClass() ?>"><span id="elh_user_level2_user_level_name" class="user_level2_user_level_name"><?= $Page->user_level_name->caption() ?></span></th>
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
<?php if ($Page->user_level_id->Visible) { // user_level_id ?>
        <td <?= $Page->user_level_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_level2_user_level_id" class="user_level2_user_level_id">
<span<?= $Page->user_level_id->viewAttributes() ?>>
<?= $Page->user_level_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_level_name->Visible) { // user_level_name ?>
        <td <?= $Page->user_level_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_user_level2_user_level_name" class="user_level2_user_level_name">
<span<?= $Page->user_level_name->viewAttributes() ?>>
<?= $Page->user_level_name->getViewValue() ?></span>
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
