<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KomponenDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkomponendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkomponendelete = currentForm = new ew.Form("fkomponendelete", "delete");
    loadjs.done("fkomponendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.komponen) ew.vars.tables.komponen = <?= JsonEncode(GetClientVar("tables", "komponen")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkomponendelete" id="fkomponendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komponen">
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
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
        <th class="<?= $Page->kode_komponen->headerCellClass() ?>"><span id="elh_komponen_kode_komponen" class="komponen_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <th class="<?= $Page->kode_ro->headerCellClass() ?>"><span id="elh_komponen_kode_ro" class="komponen_kode_ro"><?= $Page->kode_ro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_komponen->Visible) { // nama_komponen ?>
        <th class="<?= $Page->nama_komponen->headerCellClass() ?>"><span id="elh_komponen_nama_komponen" class="komponen_nama_komponen"><?= $Page->nama_komponen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_komponen_id" class="komponen_id"><?= $Page->id->caption() ?></span></th>
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
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
        <td <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komponen_kode_komponen" class="komponen_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
        <td <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komponen_kode_ro" class="komponen_kode_ro">
<span<?= $Page->kode_ro->viewAttributes() ?>>
<?= $Page->kode_ro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_komponen->Visible) { // nama_komponen ?>
        <td <?= $Page->nama_komponen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komponen_nama_komponen" class="komponen_nama_komponen">
<span<?= $Page->nama_komponen->viewAttributes() ?>>
<?= $Page->nama_komponen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komponen_id" class="komponen_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
