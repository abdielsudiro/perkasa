<?php

namespace PHPMaker2021\perkasa2;

// Set up and run Grid object
$Grid = Container("RabRincianGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_rinciangrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    frab_rinciangrid = new ew.Form("frab_rinciangrid", "grid");
    frab_rinciangrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_rincian")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_rincian)
        ew.vars.tables.rab_rincian = currentTable;
    frab_rinciangrid.addFields([
        ["rab_rincian_id", [fields.rab_rincian_id.visible && fields.rab_rincian_id.required ? ew.Validators.required(fields.rab_rincian_id.caption) : null], fields.rab_rincian_id.isInvalid],
        ["uraian", [fields.uraian.visible && fields.uraian.required ? ew.Validators.required(fields.uraian.caption) : null], fields.uraian.isInvalid],
        ["volum", [fields.volum.visible && fields.volum.required ? ew.Validators.required(fields.volum.caption) : null, ew.Validators.integer], fields.volum.isInvalid],
        ["satuan", [fields.satuan.visible && fields.satuan.required ? ew.Validators.required(fields.satuan.caption) : null], fields.satuan.isInvalid],
        ["sbm", [fields.sbm.visible && fields.sbm.required ? ew.Validators.required(fields.sbm.caption) : null, ew.Validators.float], fields.sbm.isInvalid],
        ["kode_akun", [fields.kode_akun.visible && fields.kode_akun.required ? ew.Validators.required(fields.kode_akun.caption) : null], fields.kode_akun.isInvalid],
        ["subtotal", [fields.subtotal.visible && fields.subtotal.required ? ew.Validators.required(fields.subtotal.caption) : null], fields.subtotal.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frab_rinciangrid,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    frab_rinciangrid.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    frab_rinciangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "uraian", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "volum", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "satuan", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "sbm", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "kode_akun", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "subtotal", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    frab_rinciangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_rinciangrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frab_rinciangrid.lists.kode_akun = <?= $Grid->kode_akun->toClientList($Grid) ?>;
    loadjs.done("frab_rinciangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rab_rincian">
<div id="frab_rinciangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_rab_rincian" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_rab_rinciangrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <th data-name="rab_rincian_id" class="<?= $Grid->rab_rincian_id->headerCellClass() ?>"><div id="elh_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id"><?= $Grid->renderSort($Grid->rab_rincian_id) ?></div></th>
<?php } ?>
<?php if ($Grid->uraian->Visible) { // uraian ?>
        <th data-name="uraian" class="<?= $Grid->uraian->headerCellClass() ?>"><div id="elh_rab_rincian_uraian" class="rab_rincian_uraian"><?= $Grid->renderSort($Grid->uraian) ?></div></th>
<?php } ?>
<?php if ($Grid->volum->Visible) { // volum ?>
        <th data-name="volum" class="<?= $Grid->volum->headerCellClass() ?>"><div id="elh_rab_rincian_volum" class="rab_rincian_volum"><?= $Grid->renderSort($Grid->volum) ?></div></th>
<?php } ?>
<?php if ($Grid->satuan->Visible) { // satuan ?>
        <th data-name="satuan" class="<?= $Grid->satuan->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_satuan" class="rab_rincian_satuan"><?= $Grid->renderSort($Grid->satuan) ?></div></th>
<?php } ?>
<?php if ($Grid->sbm->Visible) { // sbm ?>
        <th data-name="sbm" class="<?= $Grid->sbm->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_sbm" class="rab_rincian_sbm"><?= $Grid->renderSort($Grid->sbm) ?></div></th>
<?php } ?>
<?php if ($Grid->kode_akun->Visible) { // kode_akun ?>
        <th data-name="kode_akun" class="<?= $Grid->kode_akun->headerCellClass() ?>"><div id="elh_rab_rincian_kode_akun" class="rab_rincian_kode_akun"><?= $Grid->renderSort($Grid->kode_akun) ?></div></th>
<?php } ?>
<?php if ($Grid->subtotal->Visible) { // subtotal ?>
        <th data-name="subtotal" class="<?= $Grid->subtotal->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_subtotal" class="rab_rincian_subtotal"><?= $Grid->renderSort($Grid->subtotal) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_rab_rincian", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id" <?= $Grid->rab_rincian_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_rab_rincian_id" class="form-group"></span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rab_rincian_id" id="o<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_rab_rincian_id" class="form-group">
<span<?= $Grid->rab_rincian_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rab_rincian_id->getDisplayValue($Grid->rab_rincian_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rab_rincian_id" id="x<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_rab_rincian_id">
<span<?= $Grid->rab_rincian_id->viewAttributes() ?>>
<?= $Grid->rab_rincian_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_rab_rincian_id" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_rab_rincian_id" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rab_rincian_id" id="x<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->uraian->Visible) { // uraian ?>
        <td data-name="uraian" <?= $Grid->uraian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_uraian" class="form-group">
<input type="<?= $Grid->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Grid->RowIndex ?>_uraian" id="x<?= $Grid->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->uraian->getPlaceHolder()) ?>" value="<?= $Grid->uraian->EditValue ?>"<?= $Grid->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->uraian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_uraian" id="o<?= $Grid->RowIndex ?>_uraian" value="<?= HtmlEncode($Grid->uraian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_uraian" class="form-group">
<input type="<?= $Grid->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Grid->RowIndex ?>_uraian" id="x<?= $Grid->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->uraian->getPlaceHolder()) ?>" value="<?= $Grid->uraian->EditValue ?>"<?= $Grid->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->uraian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_uraian">
<span<?= $Grid->uraian->viewAttributes() ?>>
<?= $Grid->uraian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_uraian" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_uraian" value="<?= HtmlEncode($Grid->uraian->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_uraian" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_uraian" value="<?= HtmlEncode($Grid->uraian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->volum->Visible) { // volum ?>
        <td data-name="volum" <?= $Grid->volum->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_volum" class="form-group">
<input type="<?= $Grid->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Grid->RowIndex ?>_volum" id="x<?= $Grid->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Grid->volum->getPlaceHolder()) ?>" value="<?= $Grid->volum->EditValue ?>"<?= $Grid->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->volum->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="o<?= $Grid->RowIndex ?>_volum" id="o<?= $Grid->RowIndex ?>_volum" value="<?= HtmlEncode($Grid->volum->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_volum" class="form-group">
<input type="<?= $Grid->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Grid->RowIndex ?>_volum" id="x<?= $Grid->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Grid->volum->getPlaceHolder()) ?>" value="<?= $Grid->volum->EditValue ?>"<?= $Grid->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->volum->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_volum">
<span<?= $Grid->volum->viewAttributes() ?>>
<?= $Grid->volum->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_volum" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_volum" value="<?= HtmlEncode($Grid->volum->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_volum" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_volum" value="<?= HtmlEncode($Grid->volum->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->satuan->Visible) { // satuan ?>
        <td data-name="satuan" <?= $Grid->satuan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_satuan" class="form-group">
<input type="<?= $Grid->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Grid->RowIndex ?>_satuan" id="x<?= $Grid->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Grid->satuan->getPlaceHolder()) ?>" value="<?= $Grid->satuan->EditValue ?>"<?= $Grid->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->satuan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_satuan" id="o<?= $Grid->RowIndex ?>_satuan" value="<?= HtmlEncode($Grid->satuan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_satuan" class="form-group">
<input type="<?= $Grid->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Grid->RowIndex ?>_satuan" id="x<?= $Grid->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Grid->satuan->getPlaceHolder()) ?>" value="<?= $Grid->satuan->EditValue ?>"<?= $Grid->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->satuan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_satuan">
<span<?= $Grid->satuan->viewAttributes() ?>>
<?= $Grid->satuan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_satuan" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_satuan" value="<?= HtmlEncode($Grid->satuan->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_satuan" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_satuan" value="<?= HtmlEncode($Grid->satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sbm->Visible) { // sbm ?>
        <td data-name="sbm" <?= $Grid->sbm->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_sbm" class="form-group">
<input type="<?= $Grid->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Grid->RowIndex ?>_sbm" id="x<?= $Grid->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->sbm->getPlaceHolder()) ?>" value="<?= $Grid->sbm->EditValue ?>"<?= $Grid->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sbm->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sbm" id="o<?= $Grid->RowIndex ?>_sbm" value="<?= HtmlEncode($Grid->sbm->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_sbm" class="form-group">
<input type="<?= $Grid->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Grid->RowIndex ?>_sbm" id="x<?= $Grid->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->sbm->getPlaceHolder()) ?>" value="<?= $Grid->sbm->EditValue ?>"<?= $Grid->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sbm->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_sbm">
<span<?= $Grid->sbm->viewAttributes() ?>>
<?= $Grid->sbm->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_sbm" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_sbm" value="<?= HtmlEncode($Grid->sbm->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_sbm" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_sbm" value="<?= HtmlEncode($Grid->sbm->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun" <?= $Grid->kode_akun->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_kode_akun" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kode_akun"
        name="x<?= $Grid->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Grid->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Grid->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kode_akun->getPlaceHolder()) ?>"
        <?= $Grid->kode_akun->editAttributes() ?>>
        <?= $Grid->kode_akun->selectOptionListHtml("x{$Grid->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kode_akun->getErrorMessage() ?></div>
<?= $Grid->kode_akun->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kode_akun" id="o<?= $Grid->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Grid->kode_akun->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_kode_akun" class="form-group">
    <select
        id="x<?= $Grid->RowIndex ?>_kode_akun"
        name="x<?= $Grid->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Grid->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Grid->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kode_akun->getPlaceHolder()) ?>"
        <?= $Grid->kode_akun->editAttributes() ?>>
        <?= $Grid->kode_akun->selectOptionListHtml("x{$Grid->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kode_akun->getErrorMessage() ?></div>
<?= $Grid->kode_akun->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_kode_akun">
<span<?= $Grid->kode_akun->viewAttributes() ?>>
<?= $Grid->kode_akun->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_kode_akun" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Grid->kode_akun->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_kode_akun" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Grid->kode_akun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal" <?= $Grid->subtotal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_subtotal" class="form-group">
<input type="<?= $Grid->subtotal->getInputTextType() ?>" data-table="rab_rincian" data-field="x_subtotal" name="x<?= $Grid->RowIndex ?>_subtotal" id="x<?= $Grid->RowIndex ?>_subtotal" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->subtotal->getPlaceHolder()) ?>" value="<?= $Grid->subtotal->EditValue ?>"<?= $Grid->subtotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->subtotal->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_subtotal" id="o<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_subtotal" class="form-group">
<span<?= $Grid->subtotal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->subtotal->getDisplayValue($Grid->subtotal->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_subtotal" id="x<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_rab_rincian_subtotal">
<span<?= $Grid->subtotal->viewAttributes() ?>>
<?= $Grid->subtotal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="frab_rinciangrid$x<?= $Grid->RowIndex ?>_subtotal" id="frab_rinciangrid$x<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->FormValue) ?>">
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="frab_rinciangrid$o<?= $Grid->RowIndex ?>_subtotal" id="frab_rinciangrid$o<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frab_rinciangrid","load"], function () {
    frab_rinciangrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_rab_rincian", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_rab_rincian_id" class="form-group rab_rincian_rab_rincian_id"></span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_rab_rincian_id" class="form-group rab_rincian_rab_rincian_id">
<span<?= $Grid->rab_rincian_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->rab_rincian_id->getDisplayValue($Grid->rab_rincian_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_rab_rincian_id" id="x<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_rab_rincian_id" id="o<?= $Grid->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Grid->rab_rincian_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->uraian->Visible) { // uraian ?>
        <td data-name="uraian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_uraian" class="form-group rab_rincian_uraian">
<input type="<?= $Grid->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Grid->RowIndex ?>_uraian" id="x<?= $Grid->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->uraian->getPlaceHolder()) ?>" value="<?= $Grid->uraian->EditValue ?>"<?= $Grid->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->uraian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_uraian" class="form-group rab_rincian_uraian">
<span<?= $Grid->uraian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->uraian->getDisplayValue($Grid->uraian->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_uraian" id="x<?= $Grid->RowIndex ?>_uraian" value="<?= HtmlEncode($Grid->uraian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_uraian" id="o<?= $Grid->RowIndex ?>_uraian" value="<?= HtmlEncode($Grid->uraian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->volum->Visible) { // volum ?>
        <td data-name="volum">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_volum" class="form-group rab_rincian_volum">
<input type="<?= $Grid->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Grid->RowIndex ?>_volum" id="x<?= $Grid->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Grid->volum->getPlaceHolder()) ?>" value="<?= $Grid->volum->EditValue ?>"<?= $Grid->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->volum->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_volum" class="form-group rab_rincian_volum">
<span<?= $Grid->volum->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->volum->getDisplayValue($Grid->volum->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="x<?= $Grid->RowIndex ?>_volum" id="x<?= $Grid->RowIndex ?>_volum" value="<?= HtmlEncode($Grid->volum->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="o<?= $Grid->RowIndex ?>_volum" id="o<?= $Grid->RowIndex ?>_volum" value="<?= HtmlEncode($Grid->volum->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->satuan->Visible) { // satuan ?>
        <td data-name="satuan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_satuan" class="form-group rab_rincian_satuan">
<input type="<?= $Grid->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Grid->RowIndex ?>_satuan" id="x<?= $Grid->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Grid->satuan->getPlaceHolder()) ?>" value="<?= $Grid->satuan->EditValue ?>"<?= $Grid->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->satuan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_satuan" class="form-group rab_rincian_satuan">
<span<?= $Grid->satuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->satuan->getDisplayValue($Grid->satuan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_satuan" id="x<?= $Grid->RowIndex ?>_satuan" value="<?= HtmlEncode($Grid->satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_satuan" id="o<?= $Grid->RowIndex ?>_satuan" value="<?= HtmlEncode($Grid->satuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sbm->Visible) { // sbm ?>
        <td data-name="sbm">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_sbm" class="form-group rab_rincian_sbm">
<input type="<?= $Grid->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Grid->RowIndex ?>_sbm" id="x<?= $Grid->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->sbm->getPlaceHolder()) ?>" value="<?= $Grid->sbm->EditValue ?>"<?= $Grid->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sbm->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_sbm" class="form-group rab_rincian_sbm">
<span<?= $Grid->sbm->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sbm->getDisplayValue($Grid->sbm->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sbm" id="x<?= $Grid->RowIndex ?>_sbm" value="<?= HtmlEncode($Grid->sbm->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sbm" id="o<?= $Grid->RowIndex ?>_sbm" value="<?= HtmlEncode($Grid->sbm->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_kode_akun" class="form-group rab_rincian_kode_akun">
    <select
        id="x<?= $Grid->RowIndex ?>_kode_akun"
        name="x<?= $Grid->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Grid->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Grid->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->kode_akun->getPlaceHolder()) ?>"
        <?= $Grid->kode_akun->editAttributes() ?>>
        <?= $Grid->kode_akun->selectOptionListHtml("x{$Grid->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->kode_akun->getErrorMessage() ?></div>
<?= $Grid->kode_akun->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Grid->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Grid->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_kode_akun" class="form-group rab_rincian_kode_akun">
<span<?= $Grid->kode_akun->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kode_akun->getDisplayValue($Grid->kode_akun->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kode_akun" id="x<?= $Grid->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Grid->kode_akun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kode_akun" id="o<?= $Grid->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Grid->kode_akun->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_rab_rincian_subtotal" class="form-group rab_rincian_subtotal">
<input type="<?= $Grid->subtotal->getInputTextType() ?>" data-table="rab_rincian" data-field="x_subtotal" name="x<?= $Grid->RowIndex ?>_subtotal" id="x<?= $Grid->RowIndex ?>_subtotal" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->subtotal->getPlaceHolder()) ?>" value="<?= $Grid->subtotal->EditValue ?>"<?= $Grid->subtotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->subtotal->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_rab_rincian_subtotal" class="form-group rab_rincian_subtotal">
<span<?= $Grid->subtotal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->subtotal->getDisplayValue($Grid->subtotal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_subtotal" id="x<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_subtotal" id="o<?= $Grid->RowIndex ?>_subtotal" value="<?= HtmlEncode($Grid->subtotal->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["frab_rinciangrid","load"], function() {
    frab_rinciangrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
<?php
// Render aggregate row
$Grid->RowType = ROWTYPE_AGGREGATE;
$Grid->resetAttributes();
$Grid->renderRow();
?>
<?php if ($Grid->TotalRecords > 0 && $Grid->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Grid->renderListOptions();

// Render list options (footer, left)
$Grid->ListOptions->render("footer", "left");
?>
    <?php if ($Grid->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id" class="<?= $Grid->rab_rincian_id->footerCellClass() ?>"><span id="elf_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->uraian->Visible) { // uraian ?>
        <td data-name="uraian" class="<?= $Grid->uraian->footerCellClass() ?>"><span id="elf_rab_rincian_uraian" class="rab_rincian_uraian">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->volum->Visible) { // volum ?>
        <td data-name="volum" class="<?= $Grid->volum->footerCellClass() ?>"><span id="elf_rab_rincian_volum" class="rab_rincian_volum">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->satuan->Visible) { // satuan ?>
        <td data-name="satuan" class="<?= $Grid->satuan->footerCellClass() ?>"><span id="elf_rab_rincian_satuan" class="rab_rincian_satuan">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->sbm->Visible) { // sbm ?>
        <td data-name="sbm" class="<?= $Grid->sbm->footerCellClass() ?>"><span id="elf_rab_rincian_sbm" class="rab_rincian_sbm">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun" class="<?= $Grid->kode_akun->footerCellClass() ?>"><span id="elf_rab_rincian_kode_akun" class="rab_rincian_kode_akun">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Grid->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal" class="<?= $Grid->subtotal->footerCellClass() ?>"><span id="elf_rab_rincian_subtotal" class="rab_rincian_subtotal">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Grid->subtotal->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Grid->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frab_rinciangrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("rab_rincian");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
