<?php

namespace PHPMaker2021\perkasa2;

// Set up and run Grid object
$Grid = Container("RequestDataGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_datagrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    frequest_datagrid = new ew.Form("frequest_datagrid", "grid");
    frequest_datagrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_data")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_data)
        ew.vars.tables.request_data = currentTable;
    frequest_datagrid.addFields([
        ["request_data_id", [fields.request_data_id.visible && fields.request_data_id.required ? ew.Validators.required(fields.request_data_id.caption) : null, ew.Validators.integer], fields.request_data_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["value", [fields.value.visible && fields.value.required ? ew.Validators.required(fields.value.caption) : null], fields.value.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_datagrid,
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
    frequest_datagrid.validate = function () {
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
    frequest_datagrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "request_data_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "request_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "name", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "value", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    frequest_datagrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_datagrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frequest_datagrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_data">
<div id="frequest_datagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_request_data" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_request_datagrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->request_data_id->Visible) { // request_data_id ?>
        <th data-name="request_data_id" class="<?= $Grid->request_data_id->headerCellClass() ?>"><div id="elh_request_data_request_data_id" class="request_data_request_data_id"><?= $Grid->renderSort($Grid->request_data_id) ?></div></th>
<?php } ?>
<?php if ($Grid->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Grid->request_id->headerCellClass() ?>"><div id="elh_request_data_request_id" class="request_data_request_id"><?= $Grid->renderSort($Grid->request_id) ?></div></th>
<?php } ?>
<?php if ($Grid->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Grid->name->headerCellClass() ?>"><div id="elh_request_data_name" class="request_data_name"><?= $Grid->renderSort($Grid->name) ?></div></th>
<?php } ?>
<?php if ($Grid->value->Visible) { // value ?>
        <th data-name="value" class="<?= $Grid->value->headerCellClass() ?>"><div id="elh_request_data_value" class="request_data_value"><?= $Grid->renderSort($Grid->value) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_request_data", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->request_data_id->Visible) { // request_data_id ?>
        <td data-name="request_data_id" <?= $Grid->request_data_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_data_id" class="form-group">
<input type="<?= $Grid->request_data_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_data_id" name="x<?= $Grid->RowIndex ?>_request_data_id" id="x<?= $Grid->RowIndex ?>_request_data_id" size="30" placeholder="<?= HtmlEncode($Grid->request_data_id->getPlaceHolder()) ?>" value="<?= $Grid->request_data_id->EditValue ?>"<?= $Grid->request_data_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_data_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_data_id" id="o<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Grid->request_data_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_data_id" name="x<?= $Grid->RowIndex ?>_request_data_id" id="x<?= $Grid->RowIndex ?>_request_data_id" size="30" placeholder="<?= HtmlEncode($Grid->request_data_id->getPlaceHolder()) ?>" value="<?= $Grid->request_data_id->EditValue ?>"<?= $Grid->request_data_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_data_id->getErrorMessage() ?></div>
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_data_id" id="o<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->OldValue ?? $Grid->request_data_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_data_id">
<span<?= $Grid->request_data_id->viewAttributes() ?>>
<?= $Grid->request_data_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="frequest_datagrid$x<?= $Grid->RowIndex ?>_request_data_id" id="frequest_datagrid$x<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->FormValue) ?>">
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="frequest_datagrid$o<?= $Grid->RowIndex ?>_request_data_id" id="frequest_datagrid$o<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_data_id" id="x<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id" <?= $Grid->request_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="request_data" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<?= $Grid->request_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_data" data-field="x_request_id" data-hidden="1" name="frequest_datagrid$x<?= $Grid->RowIndex ?>_request_id" id="frequest_datagrid$x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<input type="hidden" data-table="request_data" data-field="x_request_id" data-hidden="1" name="frequest_datagrid$o<?= $Grid->RowIndex ?>_request_id" id="frequest_datagrid$o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->name->Visible) { // name ?>
        <td data-name="name" <?= $Grid->name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_name" class="form-group">
<input type="<?= $Grid->name->getInputTextType() ?>" data-table="request_data" data-field="x_name" name="x<?= $Grid->RowIndex ?>_name" id="x<?= $Grid->RowIndex ?>_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->name->getPlaceHolder()) ?>" value="<?= $Grid->name->EditValue ?>"<?= $Grid->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_data" data-field="x_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_name" id="o<?= $Grid->RowIndex ?>_name" value="<?= HtmlEncode($Grid->name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_name" class="form-group">
<input type="<?= $Grid->name->getInputTextType() ?>" data-table="request_data" data-field="x_name" name="x<?= $Grid->RowIndex ?>_name" id="x<?= $Grid->RowIndex ?>_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->name->getPlaceHolder()) ?>" value="<?= $Grid->name->EditValue ?>"<?= $Grid->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_name">
<span<?= $Grid->name->viewAttributes() ?>>
<?= $Grid->name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_data" data-field="x_name" data-hidden="1" name="frequest_datagrid$x<?= $Grid->RowIndex ?>_name" id="frequest_datagrid$x<?= $Grid->RowIndex ?>_name" value="<?= HtmlEncode($Grid->name->FormValue) ?>">
<input type="hidden" data-table="request_data" data-field="x_name" data-hidden="1" name="frequest_datagrid$o<?= $Grid->RowIndex ?>_name" id="frequest_datagrid$o<?= $Grid->RowIndex ?>_name" value="<?= HtmlEncode($Grid->name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->value->Visible) { // value ?>
        <td data-name="value" <?= $Grid->value->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_value" class="form-group">
<input type="<?= $Grid->value->getInputTextType() ?>" data-table="request_data" data-field="x_value" name="x<?= $Grid->RowIndex ?>_value" id="x<?= $Grid->RowIndex ?>_value" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->value->getPlaceHolder()) ?>" value="<?= $Grid->value->EditValue ?>"<?= $Grid->value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_data" data-field="x_value" data-hidden="1" name="o<?= $Grid->RowIndex ?>_value" id="o<?= $Grid->RowIndex ?>_value" value="<?= HtmlEncode($Grid->value->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_value" class="form-group">
<input type="<?= $Grid->value->getInputTextType() ?>" data-table="request_data" data-field="x_value" name="x<?= $Grid->RowIndex ?>_value" id="x<?= $Grid->RowIndex ?>_value" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->value->getPlaceHolder()) ?>" value="<?= $Grid->value->EditValue ?>"<?= $Grid->value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_data_value">
<span<?= $Grid->value->viewAttributes() ?>>
<?= $Grid->value->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_data" data-field="x_value" data-hidden="1" name="frequest_datagrid$x<?= $Grid->RowIndex ?>_value" id="frequest_datagrid$x<?= $Grid->RowIndex ?>_value" value="<?= HtmlEncode($Grid->value->FormValue) ?>">
<input type="hidden" data-table="request_data" data-field="x_value" data-hidden="1" name="frequest_datagrid$o<?= $Grid->RowIndex ?>_value" id="frequest_datagrid$o<?= $Grid->RowIndex ?>_value" value="<?= HtmlEncode($Grid->value->OldValue) ?>">
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
loadjs.ready(["frequest_datagrid","load"], function () {
    frequest_datagrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_request_data", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->request_data_id->Visible) { // request_data_id ?>
        <td data-name="request_data_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_data_request_data_id" class="form-group request_data_request_data_id">
<input type="<?= $Grid->request_data_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_data_id" name="x<?= $Grid->RowIndex ?>_request_data_id" id="x<?= $Grid->RowIndex ?>_request_data_id" size="30" placeholder="<?= HtmlEncode($Grid->request_data_id->getPlaceHolder()) ?>" value="<?= $Grid->request_data_id->EditValue ?>"<?= $Grid->request_data_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_data_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_data_request_data_id" class="form-group request_data_request_data_id">
<span<?= $Grid->request_data_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_data_id->getDisplayValue($Grid->request_data_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_data_id" id="x<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_data" data-field="x_request_data_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_data_id" id="o<?= $Grid->RowIndex ?>_request_data_id" value="<?= HtmlEncode($Grid->request_data_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_request_data_request_id" class="form-group request_data_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_request_data_request_id" class="form-group request_data_request_id">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_data" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_request_data_request_id" class="form-group request_data_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_data" data-field="x_request_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_data" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->name->Visible) { // name ?>
        <td data-name="name">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_data_name" class="form-group request_data_name">
<input type="<?= $Grid->name->getInputTextType() ?>" data-table="request_data" data-field="x_name" name="x<?= $Grid->RowIndex ?>_name" id="x<?= $Grid->RowIndex ?>_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->name->getPlaceHolder()) ?>" value="<?= $Grid->name->EditValue ?>"<?= $Grid->name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->name->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_data_name" class="form-group request_data_name">
<span<?= $Grid->name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->name->getDisplayValue($Grid->name->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_data" data-field="x_name" data-hidden="1" name="x<?= $Grid->RowIndex ?>_name" id="x<?= $Grid->RowIndex ?>_name" value="<?= HtmlEncode($Grid->name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_data" data-field="x_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_name" id="o<?= $Grid->RowIndex ?>_name" value="<?= HtmlEncode($Grid->name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->value->Visible) { // value ?>
        <td data-name="value">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_data_value" class="form-group request_data_value">
<input type="<?= $Grid->value->getInputTextType() ?>" data-table="request_data" data-field="x_value" name="x<?= $Grid->RowIndex ?>_value" id="x<?= $Grid->RowIndex ?>_value" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->value->getPlaceHolder()) ?>" value="<?= $Grid->value->EditValue ?>"<?= $Grid->value->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_data_value" class="form-group request_data_value">
<span<?= $Grid->value->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->value->getDisplayValue($Grid->value->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_data" data-field="x_value" data-hidden="1" name="x<?= $Grid->RowIndex ?>_value" id="x<?= $Grid->RowIndex ?>_value" value="<?= HtmlEncode($Grid->value->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_data" data-field="x_value" data-hidden="1" name="o<?= $Grid->RowIndex ?>_value" id="o<?= $Grid->RowIndex ?>_value" value="<?= HtmlEncode($Grid->value->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["frequest_datagrid","load"], function() {
    frequest_datagrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
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
<input type="hidden" name="detailpage" value="frequest_datagrid">
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
    ew.addEventHandlers("request_data");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
