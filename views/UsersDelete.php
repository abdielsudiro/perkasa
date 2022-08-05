<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UsersDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusersdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
    loadjs.done("fusersdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.users) ew.vars.tables.users = <?= JsonEncode(GetClientVar("tables", "users")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
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
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_users__username" class="users__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_lengkap->Visible) { // nama_lengkap ?>
        <th class="<?= $Page->nama_lengkap->headerCellClass() ?>"><span id="elh_users_nama_lengkap" class="users_nama_lengkap"><?= $Page->nama_lengkap->caption() ?></span></th>
<?php } ?>
<?php if ($Page->satker->Visible) { // satker ?>
        <th class="<?= $Page->satker->headerCellClass() ?>"><span id="elh_users_satker" class="users_satker"><?= $Page->satker->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><span id="elh_users_nip" class="users_nip"><?= $Page->nip->caption() ?></span></th>
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
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users__username" class="users__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_lengkap->Visible) { // nama_lengkap ?>
        <td <?= $Page->nama_lengkap->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_nama_lengkap" class="users_nama_lengkap">
<span<?= $Page->nama_lengkap->viewAttributes() ?>>
<?= $Page->nama_lengkap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->satker->Visible) { // satker ?>
        <td <?= $Page->satker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_satker" class="users_satker">
<span<?= $Page->satker->viewAttributes() ?>>
<?= $Page->satker->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <td <?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_nip" class="users_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
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
