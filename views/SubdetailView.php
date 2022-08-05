<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubdetailView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsubdetailview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsubdetailview = currentForm = new ew.Form("fsubdetailview", "view");
    loadjs.done("fsubdetailview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.subdetail) ew.vars.tables.subdetail = <?= JsonEncode(GetClientVar("tables", "subdetail")) ?>;
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
<form name="fsubdetailview" id="fsubdetailview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subdetail">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->subdetail_id->Visible) { // subdetail_id ?>
    <tr id="r_subdetail_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subdetail_subdetail_id"><?= $Page->subdetail_id->caption() ?></span></td>
        <td data-name="subdetail_id" <?= $Page->subdetail_id->cellAttributes() ?>>
<span id="el_subdetail_subdetail_id">
<span<?= $Page->subdetail_id->viewAttributes() ?>>
<?= $Page->subdetail_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_detail->Visible) { // id_detail ?>
    <tr id="r_id_detail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subdetail_id_detail"><?= $Page->id_detail->caption() ?></span></td>
        <td data-name="id_detail" <?= $Page->id_detail->cellAttributes() ?>>
<span id="el_subdetail_id_detail">
<span<?= $Page->id_detail->viewAttributes() ?>>
<?= $Page->id_detail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <tr id="r_detail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subdetail_detail"><?= $Page->detail->caption() ?></span></td>
        <td data-name="detail" <?= $Page->detail->cellAttributes() ?>>
<span id="el_subdetail_detail">
<span<?= $Page->detail->viewAttributes() ?>>
<?= $Page->detail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <tr id="r_volum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subdetail_volum"><?= $Page->volum->caption() ?></span></td>
        <td data-name="volum" <?= $Page->volum->cellAttributes() ?>>
<span id="el_subdetail_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <tr id="r_sbm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subdetail_sbm"><?= $Page->sbm->caption() ?></span></td>
        <td data-name="sbm" <?= $Page->sbm->cellAttributes() ?>>
<span id="el_subdetail_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
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
