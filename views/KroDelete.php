<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KroDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkrodelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkrodelete = currentForm = new ew.Form("fkrodelete", "delete");
    loadjs.done("fkrodelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.kro) ew.vars.tables.kro = <?= JsonEncode(GetClientVar("tables", "kro")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkrodelete" id="fkrodelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kro">
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
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <th class="<?= $Page->kode_kro->headerCellClass() ?>"><span id="elh_kro_kode_kro" class="kro_kode_kro"><?= $Page->kode_kro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <th class="<?= $Page->kode_kegiatan->headerCellClass() ?>"><span id="elh_kro_kode_kegiatan" class="kro_kode_kegiatan"><?= $Page->kode_kegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_kro->Visible) { // nama_kro ?>
        <th class="<?= $Page->nama_kro->headerCellClass() ?>"><span id="elh_kro_nama_kro" class="kro_nama_kro"><?= $Page->nama_kro->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_kro_id" class="kro_id"><?= $Page->id->caption() ?></span></th>
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
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
        <td <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kro_kode_kro" class="kro_kode_kro">
<span<?= $Page->kode_kro->viewAttributes() ?>>
<?= $Page->kode_kro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <td <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kro_kode_kegiatan" class="kro_kode_kegiatan">
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_kro->Visible) { // nama_kro ?>
        <td <?= $Page->nama_kro->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kro_nama_kro" class="kro_nama_kro">
<span<?= $Page->nama_kro->viewAttributes() ?>>
<?= $Page->nama_kro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kro_id" class="kro_id">
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
