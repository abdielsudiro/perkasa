<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frabdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frabdelete = currentForm = new ew.Form("frabdelete", "delete");
    loadjs.done("frabdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.rab) ew.vars.tables.rab = <?= JsonEncode(GetClientVar("tables", "rab")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="frabdelete" id="frabdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab">
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
<?php if ($Page->id_rab->Visible) { // id_rab ?>
        <th class="<?= $Page->id_rab->headerCellClass() ?>"><span id="elh_rab_id_rab" class="rab_id_rab"><?= $Page->id_rab->caption() ?></span></th>
<?php } ?>
<?php if ($Page->satker_id->Visible) { // satker_id ?>
        <th class="<?= $Page->satker_id->headerCellClass() ?>"><span id="elh_rab_satker_id" class="rab_satker_id"><?= $Page->satker_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <th class="<?= $Page->kode_kegiatan->headerCellClass() ?>"><span id="elh_rab_kode_kegiatan" class="rab_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
        <th class="<?= $Page->id_statuses->headerCellClass() ?>"><span id="elh_rab_id_statuses" class="rab_id_statuses"><?= $Page->id_statuses->caption() ?></span></th>
<?php } ?>
<?php if ($Page->isApprovalAgree->Visible) { // isApprovalAgree ?>
        <th class="<?= $Page->isApprovalAgree->headerCellClass() ?>"><span id="elh_rab_isApprovalAgree" class="rab_isApprovalAgree"><?= $Page->isApprovalAgree->caption() ?></span></th>
<?php } ?>
<?php if ($Page->isPenelaahAgree->Visible) { // isPenelaahAgree ?>
        <th class="<?= $Page->isPenelaahAgree->headerCellClass() ?>"><span id="elh_rab_isPenelaahAgree" class="rab_isPenelaahAgree"><?= $Page->isPenelaahAgree->caption() ?></span></th>
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
<?php if ($Page->id_rab->Visible) { // id_rab ?>
        <td <?= $Page->id_rab->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_id_rab" class="rab_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<?= $Page->id_rab->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->satker_id->Visible) { // satker_id ?>
        <td <?= $Page->satker_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_satker_id" class="rab_satker_id">
<span<?= $Page->satker_id->viewAttributes() ?>>
<?= $Page->satker_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <td <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_kode_kegiatan" class="rab_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
        <td <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_id_statuses" class="rab_id_statuses">
<span<?= $Page->id_statuses->viewAttributes() ?>>
<?= $Page->id_statuses->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->isApprovalAgree->Visible) { // isApprovalAgree ?>
        <td <?= $Page->isApprovalAgree->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_isApprovalAgree" class="rab_isApprovalAgree">
<span<?= $Page->isApprovalAgree->viewAttributes() ?>>
<?= $Page->isApprovalAgree->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->isPenelaahAgree->Visible) { // isPenelaahAgree ?>
        <td <?= $Page->isPenelaahAgree->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rab_isPenelaahAgree" class="rab_isPenelaahAgree">
<span<?= $Page->isPenelaahAgree->viewAttributes() ?>>
<?= $Page->isPenelaahAgree->getViewValue() ?></span>
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
