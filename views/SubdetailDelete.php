<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubdetailDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsubdetaildelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fsubdetaildelete = currentForm = new ew.Form("fsubdetaildelete", "delete");
    loadjs.done("fsubdetaildelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.subdetail) ew.vars.tables.subdetail = <?= JsonEncode(GetClientVar("tables", "subdetail")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsubdetaildelete" id="fsubdetaildelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subdetail">
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
<?php if ($Page->subdetail_id->Visible) { // subdetail_id ?>
        <th class="<?= $Page->subdetail_id->headerCellClass() ?>"><span id="elh_subdetail_subdetail_id" class="subdetail_subdetail_id"><?= $Page->subdetail_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_detail->Visible) { // id_detail ?>
        <th class="<?= $Page->id_detail->headerCellClass() ?>"><span id="elh_subdetail_id_detail" class="subdetail_id_detail"><?= $Page->id_detail->caption() ?></span></th>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <th class="<?= $Page->volum->headerCellClass() ?>"><span id="elh_subdetail_volum" class="subdetail_volum"><?= $Page->volum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <th class="<?= $Page->sbm->headerCellClass() ?>"><span id="elh_subdetail_sbm" class="subdetail_sbm"><?= $Page->sbm->caption() ?></span></th>
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
<?php if ($Page->subdetail_id->Visible) { // subdetail_id ?>
        <td <?= $Page->subdetail_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subdetail_subdetail_id" class="subdetail_subdetail_id">
<span<?= $Page->subdetail_id->viewAttributes() ?>>
<?= $Page->subdetail_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_detail->Visible) { // id_detail ?>
        <td <?= $Page->id_detail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subdetail_id_detail" class="subdetail_id_detail">
<span<?= $Page->id_detail->viewAttributes() ?>>
<?= $Page->id_detail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <td <?= $Page->volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subdetail_volum" class="subdetail_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <td <?= $Page->sbm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_subdetail_sbm" class="subdetail_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
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
