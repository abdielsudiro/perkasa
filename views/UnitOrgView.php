<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UnitOrgView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var funit_orgview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    funit_orgview = currentForm = new ew.Form("funit_orgview", "view");
    loadjs.done("funit_orgview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.unit_org) ew.vars.tables.unit_org = <?= JsonEncode(GetClientVar("tables", "unit_org")) ?>;
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
<form name="funit_orgview" id="funit_orgview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="unit_org">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
    <tr id="r_unit_org_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_unit_org_unit_org_id"><?= $Page->unit_org_id->caption() ?></span></td>
        <td data-name="unit_org_id" <?= $Page->unit_org_id->cellAttributes() ?>>
<span id="el_unit_org_unit_org_id">
<span<?= $Page->unit_org_id->viewAttributes() ?>>
<?= $Page->unit_org_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_unit_org->Visible) { // nama_unit_org ?>
    <tr id="r_nama_unit_org">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_unit_org_nama_unit_org"><?= $Page->nama_unit_org->caption() ?></span></td>
        <td data-name="nama_unit_org" <?= $Page->nama_unit_org->cellAttributes() ?>>
<span id="el_unit_org_nama_unit_org">
<span<?= $Page->nama_unit_org->viewAttributes() ?>>
<?= $Page->nama_unit_org->getViewValue() ?></span>
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
