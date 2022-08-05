<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabRincianList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frab_rincianlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    frab_rincianlist = currentForm = new ew.Form("frab_rincianlist", "list");
    frab_rincianlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_rincian")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_rincian)
        ew.vars.tables.rab_rincian = currentTable;
    frab_rincianlist.addFields([
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
        var f = frab_rincianlist,
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
    frab_rincianlist.validate = function () {
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
        if (gridinsert && addcnt == 0) { // No row added
            ew.alert(ew.language.phrase("NoAddRecord"));
            return false;
        }
        return true;
    }

    // Check empty row
    frab_rincianlist.emptyRow = function (rowIndex) {
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
    frab_rincianlist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_rincianlist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frab_rincianlist.lists.kode_akun = <?= $Page->kode_akun->toClientList($Page) ?>;
    loadjs.done("frab_rincianlist");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
    background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
    display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
    <div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
        <ul class="nav nav-tabs"></ul>
        <div class="tab-content"><!-- .tab-content -->
            <div class="tab-pane fade active show"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
    ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
    ew.PREVIEW_SINGLE_ROW = false;
    ew.PREVIEW_OVERLAY = false;
    loadjs(ew.PATH_BASE + "js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "rab") {
    if ($Page->MasterRecordExists) {
        include_once "views/RabMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rab_rincian">
<form name="frab_rincianlist" id="frab_rincianlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_rincian">
<?php if ($Page->getCurrentMasterTable() == "rab" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rab">
<input type="hidden" name="fk_id_rab" value="<?= HtmlEncode($Page->id_rab->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_rab_rincian" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_rab_rincianlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <th data-name="rab_rincian_id" class="<?= $Page->rab_rincian_id->headerCellClass() ?>"><div id="elh_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id"><?= $Page->renderSort($Page->rab_rincian_id) ?></div></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th data-name="uraian" class="<?= $Page->uraian->headerCellClass() ?>"><div id="elh_rab_rincian_uraian" class="rab_rincian_uraian"><?= $Page->renderSort($Page->uraian) ?></div></th>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <th data-name="volum" class="<?= $Page->volum->headerCellClass() ?>"><div id="elh_rab_rincian_volum" class="rab_rincian_volum"><?= $Page->renderSort($Page->volum) ?></div></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th data-name="satuan" class="<?= $Page->satuan->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_satuan" class="rab_rincian_satuan"><?= $Page->renderSort($Page->satuan) ?></div></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <th data-name="sbm" class="<?= $Page->sbm->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_sbm" class="rab_rincian_sbm"><?= $Page->renderSort($Page->sbm) ?></div></th>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <th data-name="kode_akun" class="<?= $Page->kode_akun->headerCellClass() ?>"><div id="elh_rab_rincian_kode_akun" class="rab_rincian_kode_akun"><?= $Page->renderSort($Page->kode_akun) ?></div></th>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <th data-name="subtotal" class="<?= $Page->subtotal->headerCellClass() ?>" style="min-width: 15px;"><div id="elh_rab_rincian_subtotal" class="rab_rincian_subtotal"><?= $Page->renderSort($Page->subtotal) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
if ($Page->isGridAdd())
    $Page->RowIndex = 0;
if ($Page->isGridEdit())
    $Page->RowIndex = 0;
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;
        if ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm()) {
            $Page->RowIndex++;
            $CurrentForm->Index = $Page->RowIndex;
            if ($CurrentForm->hasValue($Page->FormActionName) && ($Page->isConfirm() || $Page->EventCancelled)) {
                $Page->RowAction = strval($CurrentForm->getValue($Page->FormActionName));
            } elseif ($Page->isGridAdd()) {
                $Page->RowAction = "insert";
            } else {
                $Page->RowAction = "";
            }
        }

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view
        if ($Page->isGridAdd()) { // Grid add
            $Page->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Page->isGridAdd() && $Page->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->isGridEdit()) { // Grid edit
            if ($Page->EventCancelled) {
                $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
            }
            if ($Page->RowAction == "insert") {
                $Page->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isGridEdit() && ($Page->RowType == ROWTYPE_EDIT || $Page->RowType == ROWTYPE_ADD) && $Page->EventCancelled) { // Update failed
            $Page->restoreCurrentRowFormValues($Page->RowIndex); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_rab_rincian", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Page->RowAction != "delete" && $Page->RowAction != "insertdelete" && !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())) {
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id" <?= $Page->rab_rincian_id->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_rab_rincian_id" class="form-group"></span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_rab_rincian_id" id="o<?= $Page->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Page->rab_rincian_id->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_rab_rincian_id" class="form-group">
<span<?= $Page->rab_rincian_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->rab_rincian_id->getDisplayValue($Page->rab_rincian_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_rab_rincian_id" id="x<?= $Page->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Page->rab_rincian_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_rab_rincian_id">
<span<?= $Page->rab_rincian_id->viewAttributes() ?>>
<?= $Page->rab_rincian_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="x<?= $Page->RowIndex ?>_rab_rincian_id" id="x<?= $Page->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Page->rab_rincian_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_uraian" class="form-group">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Page->RowIndex ?>_uraian" id="x<?= $Page->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="o<?= $Page->RowIndex ?>_uraian" id="o<?= $Page->RowIndex ?>_uraian" value="<?= HtmlEncode($Page->uraian->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_uraian" class="form-group">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Page->RowIndex ?>_uraian" id="x<?= $Page->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->volum->Visible) { // volum ?>
        <td data-name="volum" <?= $Page->volum->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_volum" class="form-group">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Page->RowIndex ?>_volum" id="x<?= $Page->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="o<?= $Page->RowIndex ?>_volum" id="o<?= $Page->RowIndex ?>_volum" value="<?= HtmlEncode($Page->volum->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_volum" class="form-group">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Page->RowIndex ?>_volum" id="x<?= $Page->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_volum">
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_satuan" class="form-group">
<input type="<?= $Page->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Page->RowIndex ?>_satuan" id="x<?= $Page->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Page->satuan->getPlaceHolder()) ?>" value="<?= $Page->satuan->EditValue ?>"<?= $Page->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->satuan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="o<?= $Page->RowIndex ?>_satuan" id="o<?= $Page->RowIndex ?>_satuan" value="<?= HtmlEncode($Page->satuan->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_satuan" class="form-group">
<input type="<?= $Page->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Page->RowIndex ?>_satuan" id="x<?= $Page->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Page->satuan->getPlaceHolder()) ?>" value="<?= $Page->satuan->EditValue ?>"<?= $Page->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->satuan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->sbm->Visible) { // sbm ?>
        <td data-name="sbm" <?= $Page->sbm->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_sbm" class="form-group">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Page->RowIndex ?>_sbm" id="x<?= $Page->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->sbm->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="o<?= $Page->RowIndex ?>_sbm" id="o<?= $Page->RowIndex ?>_sbm" value="<?= HtmlEncode($Page->sbm->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_sbm" class="form-group">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Page->RowIndex ?>_sbm" id="x<?= $Page->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->sbm->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_sbm">
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun" <?= $Page->kode_akun->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_kode_akun" class="form-group">
    <select
        id="x<?= $Page->RowIndex ?>_kode_akun"
        name="x<?= $Page->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Page->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Page->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Page->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_akun->getPlaceHolder()) ?>"
        <?= $Page->kode_akun->editAttributes() ?>>
        <?= $Page->kode_akun->selectOptionListHtml("x{$Page->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->kode_akun->getErrorMessage() ?></div>
<?= $Page->kode_akun->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Page->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Page->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Page->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="o<?= $Page->RowIndex ?>_kode_akun" id="o<?= $Page->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Page->kode_akun->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_kode_akun" class="form-group">
    <select
        id="x<?= $Page->RowIndex ?>_kode_akun"
        name="x<?= $Page->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Page->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Page->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Page->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_akun->getPlaceHolder()) ?>"
        <?= $Page->kode_akun->editAttributes() ?>>
        <?= $Page->kode_akun->selectOptionListHtml("x{$Page->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->kode_akun->getErrorMessage() ?></div>
<?= $Page->kode_akun->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Page->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Page->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Page->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_kode_akun">
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Page->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal" <?= $Page->subtotal->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_subtotal" class="form-group">
<input type="<?= $Page->subtotal->getInputTextType() ?>" data-table="rab_rincian" data-field="x_subtotal" name="x<?= $Page->RowIndex ?>_subtotal" id="x<?= $Page->RowIndex ?>_subtotal" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->subtotal->getPlaceHolder()) ?>" value="<?= $Page->subtotal->EditValue ?>"<?= $Page->subtotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->subtotal->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="o<?= $Page->RowIndex ?>_subtotal" id="o<?= $Page->RowIndex ?>_subtotal" value="<?= HtmlEncode($Page->subtotal->OldValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_subtotal" class="form-group">
<span<?= $Page->subtotal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->subtotal->getDisplayValue($Page->subtotal->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="x<?= $Page->RowIndex ?>_subtotal" id="x<?= $Page->RowIndex ?>_subtotal" value="<?= HtmlEncode($Page->subtotal->CurrentValue) ?>">
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_rab_rincian_subtotal">
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
</span>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frab_rincianlist","load"], function () {
    frab_rincianlist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Page->isGridAdd())
        if (!$Page->Recordset->EOF) {
            $Page->Recordset->moveNext();
        }
}
?>
<?php
    if ($Page->isGridAdd() || $Page->isGridEdit()) {
        $Page->RowIndex = '$rowindex$';
        $Page->loadRowValues();

        // Set row properties
        $Page->resetAttributes();
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowIndex, "id" => "r0_rab_rincian", "data-rowtype" => ROWTYPE_ADD]);
        $Page->RowAttrs->appendClass("ew-template");
        $Page->RowType = ROWTYPE_ADD;

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
        $Page->StartRowCount = 0;
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowIndex);
?>
    <?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id">
<span id="el$rowindex$_rab_rincian_rab_rincian_id" class="form-group rab_rincian_rab_rincian_id"></span>
<input type="hidden" data-table="rab_rincian" data-field="x_rab_rincian_id" data-hidden="1" name="o<?= $Page->RowIndex ?>_rab_rincian_id" id="o<?= $Page->RowIndex ?>_rab_rincian_id" value="<?= HtmlEncode($Page->rab_rincian_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian">
<span id="el$rowindex$_rab_rincian_uraian" class="form-group rab_rincian_uraian">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x<?= $Page->RowIndex ?>_uraian" id="x<?= $Page->RowIndex ?>_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_uraian" data-hidden="1" name="o<?= $Page->RowIndex ?>_uraian" id="o<?= $Page->RowIndex ?>_uraian" value="<?= HtmlEncode($Page->uraian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->volum->Visible) { // volum ?>
        <td data-name="volum">
<span id="el$rowindex$_rab_rincian_volum" class="form-group rab_rincian_volum">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x<?= $Page->RowIndex ?>_volum" id="x<?= $Page->RowIndex ?>_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_volum" data-hidden="1" name="o<?= $Page->RowIndex ?>_volum" id="o<?= $Page->RowIndex ?>_volum" value="<?= HtmlEncode($Page->volum->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan">
<span id="el$rowindex$_rab_rincian_satuan" class="form-group rab_rincian_satuan">
<input type="<?= $Page->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x<?= $Page->RowIndex ?>_satuan" id="x<?= $Page->RowIndex ?>_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Page->satuan->getPlaceHolder()) ?>" value="<?= $Page->satuan->EditValue ?>"<?= $Page->satuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->satuan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_satuan" data-hidden="1" name="o<?= $Page->RowIndex ?>_satuan" id="o<?= $Page->RowIndex ?>_satuan" value="<?= HtmlEncode($Page->satuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->sbm->Visible) { // sbm ?>
        <td data-name="sbm">
<span id="el$rowindex$_rab_rincian_sbm" class="form-group rab_rincian_sbm">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x<?= $Page->RowIndex ?>_sbm" id="x<?= $Page->RowIndex ?>_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->sbm->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_sbm" data-hidden="1" name="o<?= $Page->RowIndex ?>_sbm" id="o<?= $Page->RowIndex ?>_sbm" value="<?= HtmlEncode($Page->sbm->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun">
<span id="el$rowindex$_rab_rincian_kode_akun" class="form-group rab_rincian_kode_akun">
    <select
        id="x<?= $Page->RowIndex ?>_kode_akun"
        name="x<?= $Page->RowIndex ?>_kode_akun"
        class="form-control ew-select<?= $Page->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x<?= $Page->RowIndex ?>_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Page->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_akun->getPlaceHolder()) ?>"
        <?= $Page->kode_akun->editAttributes() ?>>
        <?= $Page->kode_akun->selectOptionListHtml("x{$Page->RowIndex}_kode_akun") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->kode_akun->getErrorMessage() ?></div>
<?= $Page->kode_akun->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x<?= $Page->RowIndex ?>_kode_akun']"),
        options = { name: "x<?= $Page->RowIndex ?>_kode_akun", selectId: "rab_rincian_x<?= $Page->RowIndex ?>_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_kode_akun" data-hidden="1" name="o<?= $Page->RowIndex ?>_kode_akun" id="o<?= $Page->RowIndex ?>_kode_akun" value="<?= HtmlEncode($Page->kode_akun->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Page->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal">
<span id="el$rowindex$_rab_rincian_subtotal" class="form-group rab_rincian_subtotal">
<input type="<?= $Page->subtotal->getInputTextType() ?>" data-table="rab_rincian" data-field="x_subtotal" name="x<?= $Page->RowIndex ?>_subtotal" id="x<?= $Page->RowIndex ?>_subtotal" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->subtotal->getPlaceHolder()) ?>" value="<?= $Page->subtotal->EditValue ?>"<?= $Page->subtotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->subtotal->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="rab_rincian" data-field="x_subtotal" data-hidden="1" name="o<?= $Page->RowIndex ?>_subtotal" id="o<?= $Page->RowIndex ?>_subtotal" value="<?= HtmlEncode($Page->subtotal->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowIndex);
?>
<script>
loadjs.ready(["frab_rincianlist","load"], function() {
    frab_rincianlist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
<?php
// Render aggregate row
$Page->RowType = ROWTYPE_AGGREGATE;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->TotalRecords > 0 && !$Page->isGridAdd() && !$Page->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (footer, left)
$Page->ListOptions->render("footer", "left");
?>
    <?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <td data-name="rab_rincian_id" class="<?= $Page->rab_rincian_id->footerCellClass() ?>"><span id="elf_rab_rincian_rab_rincian_id" class="rab_rincian_rab_rincian_id">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian" class="<?= $Page->uraian->footerCellClass() ?>"><span id="elf_rab_rincian_uraian" class="rab_rincian_uraian">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->volum->Visible) { // volum ?>
        <td data-name="volum" class="<?= $Page->volum->footerCellClass() ?>"><span id="elf_rab_rincian_volum" class="rab_rincian_volum">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan" class="<?= $Page->satuan->footerCellClass() ?>"><span id="elf_rab_rincian_satuan" class="rab_rincian_satuan">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->sbm->Visible) { // sbm ?>
        <td data-name="sbm" class="<?= $Page->sbm->footerCellClass() ?>"><span id="elf_rab_rincian_sbm" class="rab_rincian_sbm">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <td data-name="kode_akun" class="<?= $Page->kode_akun->footerCellClass() ?>"><span id="elf_rab_rincian_kode_akun" class="rab_rincian_kode_akun">
        &nbsp;
        </span></td>
    <?php } ?>
    <?php if ($Page->subtotal->Visible) { // subtotal ?>
        <td data-name="subtotal" class="<?= $Page->subtotal->footerCellClass() ?>"><span id="elf_rab_rincian_subtotal" class="rab_rincian_subtotal">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->subtotal->ViewValue ?></span>
        </span></td>
    <?php } ?>
<?php
// Render list options (footer, right)
$Page->ListOptions->render("footer", "right");
?>
    </tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Page->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
<?php if ($Page->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<?= $Page->MultiSelectKey ?>
<?php } ?>
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
