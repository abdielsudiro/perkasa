<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubkomponenView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsubkomponenview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsubkomponenview = currentForm = new ew.Form("fsubkomponenview", "view");
    loadjs.done("fsubkomponenview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.subkomponen) ew.vars.tables.subkomponen = <?= JsonEncode(GetClientVar("tables", "subkomponen")) ?>;
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
<form name="fsubkomponenview" id="fsubkomponenview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subkomponen">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <tr id="r_kode_subkomponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subkomponen_kode_subkomponen"><?= $Page->kode_subkomponen->caption() ?></span></td>
        <td data-name="kode_subkomponen" <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el_subkomponen_kode_subkomponen">
<span<?= $Page->kode_subkomponen->viewAttributes() ?>>
<?= $Page->kode_subkomponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <tr id="r_kode_komponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subkomponen_kode_komponen"><?= $Page->kode_komponen->caption() ?></span></td>
        <td data-name="kode_komponen" <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_subkomponen_kode_komponen">
<span<?= $Page->kode_komponen->viewAttributes() ?>>
<?= $Page->kode_komponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_subkomponen->Visible) { // nama_subkomponen ?>
    <tr id="r_nama_subkomponen">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subkomponen_nama_subkomponen"><?= $Page->nama_subkomponen->caption() ?></span></td>
        <td data-name="nama_subkomponen" <?= $Page->nama_subkomponen->cellAttributes() ?>>
<span id="el_subkomponen_nama_subkomponen">
<span<?= $Page->nama_subkomponen->viewAttributes() ?>>
<?= $Page->nama_subkomponen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
