<?php

namespace PHPMaker2021\perkasa2;

// Set up and run Grid object
$Grid = Container("RequestActionGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_actiongrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    frequest_actiongrid = new ew.Form("frequest_actiongrid", "grid");
    frequest_actiongrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_action")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_action)
        ew.vars.tables.request_action = currentTable;
    frequest_actiongrid.addFields([
        ["request_action_id", [fields.request_action_id.visible && fields.request_action_id.required ? ew.Validators.required(fields.request_action_id.caption) : null, ew.Validators.integer], fields.request_action_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["action_id", [fields.action_id.visible && fields.action_id.required ? ew.Validators.required(fields.action_id.caption) : null, ew.Validators.integer], fields.action_id.isInvalid],
        ["transition_id", [fields.transition_id.visible && fields.transition_id.required ? ew.Validators.required(fields.transition_id.caption) : null, ew.Validators.integer], fields.transition_id.isInvalid],
        ["is_active", [fields.is_active.visible && fields.is_active.required ? ew.Validators.required(fields.is_active.caption) : null], fields.is_active.isInvalid],
        ["is_complete", [fields.is_complete.visible && fields.is_complete.required ? ew.Validators.required(fields.is_complete.caption) : null], fields.is_complete.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_actiongrid,
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
    frequest_actiongrid.validate = function () {
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
    frequest_actiongrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "request_action_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "request_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "action_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "transition_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "is_active[]", true))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "is_complete[]", true))
            return false;
        return true;
    }

    // Form_CustomValidate
    frequest_actiongrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_actiongrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frequest_actiongrid.lists.is_active = <?= $Grid->is_active->toClientList($Grid) ?>;
    frequest_actiongrid.lists.is_complete = <?= $Grid->is_complete->toClientList($Grid) ?>;
    loadjs.done("frequest_actiongrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_action">
<div id="frequest_actiongrid" class="ew-form ew-list-form form-inline">
<div id="gmp_request_action" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_request_actiongrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->request_action_id->Visible) { // request_action_id ?>
        <th data-name="request_action_id" class="<?= $Grid->request_action_id->headerCellClass() ?>"><div id="elh_request_action_request_action_id" class="request_action_request_action_id"><?= $Grid->renderSort($Grid->request_action_id) ?></div></th>
<?php } ?>
<?php if ($Grid->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Grid->request_id->headerCellClass() ?>"><div id="elh_request_action_request_id" class="request_action_request_id"><?= $Grid->renderSort($Grid->request_id) ?></div></th>
<?php } ?>
<?php if ($Grid->action_id->Visible) { // action_id ?>
        <th data-name="action_id" class="<?= $Grid->action_id->headerCellClass() ?>"><div id="elh_request_action_action_id" class="request_action_action_id"><?= $Grid->renderSort($Grid->action_id) ?></div></th>
<?php } ?>
<?php if ($Grid->transition_id->Visible) { // transition_id ?>
        <th data-name="transition_id" class="<?= $Grid->transition_id->headerCellClass() ?>"><div id="elh_request_action_transition_id" class="request_action_transition_id"><?= $Grid->renderSort($Grid->transition_id) ?></div></th>
<?php } ?>
<?php if ($Grid->is_active->Visible) { // is_active ?>
        <th data-name="is_active" class="<?= $Grid->is_active->headerCellClass() ?>"><div id="elh_request_action_is_active" class="request_action_is_active"><?= $Grid->renderSort($Grid->is_active) ?></div></th>
<?php } ?>
<?php if ($Grid->is_complete->Visible) { // is_complete ?>
        <th data-name="is_complete" class="<?= $Grid->is_complete->headerCellClass() ?>"><div id="elh_request_action_is_complete" class="request_action_is_complete"><?= $Grid->renderSort($Grid->is_complete) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_request_action", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->request_action_id->Visible) { // request_action_id ?>
        <td data-name="request_action_id" <?= $Grid->request_action_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_action_id" class="form-group">
<input type="<?= $Grid->request_action_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_action_id" name="x<?= $Grid->RowIndex ?>_request_action_id" id="x<?= $Grid->RowIndex ?>_request_action_id" size="30" placeholder="<?= HtmlEncode($Grid->request_action_id->getPlaceHolder()) ?>" value="<?= $Grid->request_action_id->EditValue ?>"<?= $Grid->request_action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_action_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_action_id" id="o<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Grid->request_action_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_action_id" name="x<?= $Grid->RowIndex ?>_request_action_id" id="x<?= $Grid->RowIndex ?>_request_action_id" size="30" placeholder="<?= HtmlEncode($Grid->request_action_id->getPlaceHolder()) ?>" value="<?= $Grid->request_action_id->EditValue ?>"<?= $Grid->request_action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_action_id->getErrorMessage() ?></div>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_action_id" id="o<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->OldValue ?? $Grid->request_action_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_action_id">
<span<?= $Grid->request_action_id->viewAttributes() ?>>
<?= $Grid->request_action_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_request_action_id" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_request_action_id" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_action_id" id="x<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id" <?= $Grid->request_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<?= $Grid->request_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_request_id" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_request_id" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_request_id" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_request_id" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->action_id->Visible) { // action_id ?>
        <td data-name="action_id" <?= $Grid->action_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_action_id" class="form-group">
<input type="<?= $Grid->action_id->getInputTextType() ?>" data-table="request_action" data-field="x_action_id" name="x<?= $Grid->RowIndex ?>_action_id" id="x<?= $Grid->RowIndex ?>_action_id" size="30" placeholder="<?= HtmlEncode($Grid->action_id->getPlaceHolder()) ?>" value="<?= $Grid->action_id->EditValue ?>"<?= $Grid->action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->action_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_action" data-field="x_action_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_action_id" id="o<?= $Grid->RowIndex ?>_action_id" value="<?= HtmlEncode($Grid->action_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_action_id" class="form-group">
<input type="<?= $Grid->action_id->getInputTextType() ?>" data-table="request_action" data-field="x_action_id" name="x<?= $Grid->RowIndex ?>_action_id" id="x<?= $Grid->RowIndex ?>_action_id" size="30" placeholder="<?= HtmlEncode($Grid->action_id->getPlaceHolder()) ?>" value="<?= $Grid->action_id->EditValue ?>"<?= $Grid->action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->action_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_action_id">
<span<?= $Grid->action_id->viewAttributes() ?>>
<?= $Grid->action_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_action_id" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_action_id" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_action_id" value="<?= HtmlEncode($Grid->action_id->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_action_id" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_action_id" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_action_id" value="<?= HtmlEncode($Grid->action_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->transition_id->Visible) { // transition_id ?>
        <td data-name="transition_id" <?= $Grid->transition_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_transition_id" class="form-group">
<input type="<?= $Grid->transition_id->getInputTextType() ?>" data-table="request_action" data-field="x_transition_id" name="x<?= $Grid->RowIndex ?>_transition_id" id="x<?= $Grid->RowIndex ?>_transition_id" size="30" placeholder="<?= HtmlEncode($Grid->transition_id->getPlaceHolder()) ?>" value="<?= $Grid->transition_id->EditValue ?>"<?= $Grid->transition_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->transition_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_action" data-field="x_transition_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_transition_id" id="o<?= $Grid->RowIndex ?>_transition_id" value="<?= HtmlEncode($Grid->transition_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_transition_id" class="form-group">
<input type="<?= $Grid->transition_id->getInputTextType() ?>" data-table="request_action" data-field="x_transition_id" name="x<?= $Grid->RowIndex ?>_transition_id" id="x<?= $Grid->RowIndex ?>_transition_id" size="30" placeholder="<?= HtmlEncode($Grid->transition_id->getPlaceHolder()) ?>" value="<?= $Grid->transition_id->EditValue ?>"<?= $Grid->transition_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->transition_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_transition_id">
<span<?= $Grid->transition_id->viewAttributes() ?>>
<?= $Grid->transition_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_transition_id" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_transition_id" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_transition_id" value="<?= HtmlEncode($Grid->transition_id->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_transition_id" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_transition_id" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_transition_id" value="<?= HtmlEncode($Grid->transition_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->is_active->Visible) { // is_active ?>
        <td data-name="is_active" <?= $Grid->is_active->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_active" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_active->isInvalidClass() ?>" data-table="request_action" data-field="x_is_active" name="x<?= $Grid->RowIndex ?>_is_active[]" id="x<?= $Grid->RowIndex ?>_is_active_901317" value="1"<?= ConvertToBool($Grid->is_active->CurrentValue) ? " checked" : "" ?><?= $Grid->is_active->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_active_901317"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_active->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_action" data-field="x_is_active" data-hidden="1" name="o<?= $Grid->RowIndex ?>_is_active[]" id="o<?= $Grid->RowIndex ?>_is_active[]" value="<?= HtmlEncode($Grid->is_active->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_active" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_active->isInvalidClass() ?>" data-table="request_action" data-field="x_is_active" name="x<?= $Grid->RowIndex ?>_is_active[]" id="x<?= $Grid->RowIndex ?>_is_active_346048" value="1"<?= ConvertToBool($Grid->is_active->CurrentValue) ? " checked" : "" ?><?= $Grid->is_active->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_active_346048"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_active->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_active">
<span<?= $Grid->is_active->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_active_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->is_active->getViewValue() ?>" disabled<?php if (ConvertToBool($Grid->is_active->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_active_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_is_active" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_is_active" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_is_active" value="<?= HtmlEncode($Grid->is_active->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_is_active" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_is_active[]" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_is_active[]" value="<?= HtmlEncode($Grid->is_active->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->is_complete->Visible) { // is_complete ?>
        <td data-name="is_complete" <?= $Grid->is_complete->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_complete" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_complete->isInvalidClass() ?>" data-table="request_action" data-field="x_is_complete" name="x<?= $Grid->RowIndex ?>_is_complete[]" id="x<?= $Grid->RowIndex ?>_is_complete_529268" value="1"<?= ConvertToBool($Grid->is_complete->CurrentValue) ? " checked" : "" ?><?= $Grid->is_complete->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_complete_529268"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_complete->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_action" data-field="x_is_complete" data-hidden="1" name="o<?= $Grid->RowIndex ?>_is_complete[]" id="o<?= $Grid->RowIndex ?>_is_complete[]" value="<?= HtmlEncode($Grid->is_complete->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_complete" class="form-group">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_complete->isInvalidClass() ?>" data-table="request_action" data-field="x_is_complete" name="x<?= $Grid->RowIndex ?>_is_complete[]" id="x<?= $Grid->RowIndex ?>_is_complete_197554" value="1"<?= ConvertToBool($Grid->is_complete->CurrentValue) ? " checked" : "" ?><?= $Grid->is_complete->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_complete_197554"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_complete->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_action_is_complete">
<span<?= $Grid->is_complete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_complete_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->is_complete->getViewValue() ?>" disabled<?php if (ConvertToBool($Grid->is_complete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_complete_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_action" data-field="x_is_complete" data-hidden="1" name="frequest_actiongrid$x<?= $Grid->RowIndex ?>_is_complete" id="frequest_actiongrid$x<?= $Grid->RowIndex ?>_is_complete" value="<?= HtmlEncode($Grid->is_complete->FormValue) ?>">
<input type="hidden" data-table="request_action" data-field="x_is_complete" data-hidden="1" name="frequest_actiongrid$o<?= $Grid->RowIndex ?>_is_complete[]" id="frequest_actiongrid$o<?= $Grid->RowIndex ?>_is_complete[]" value="<?= HtmlEncode($Grid->is_complete->OldValue) ?>">
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
loadjs.ready(["frequest_actiongrid","load"], function () {
    frequest_actiongrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_request_action", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->request_action_id->Visible) { // request_action_id ?>
        <td data-name="request_action_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_action_request_action_id" class="form-group request_action_request_action_id">
<input type="<?= $Grid->request_action_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_action_id" name="x<?= $Grid->RowIndex ?>_request_action_id" id="x<?= $Grid->RowIndex ?>_request_action_id" size="30" placeholder="<?= HtmlEncode($Grid->request_action_id->getPlaceHolder()) ?>" value="<?= $Grid->request_action_id->EditValue ?>"<?= $Grid->request_action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_action_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_action_request_action_id" class="form-group request_action_request_action_id">
<span<?= $Grid->request_action_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_action_id->getDisplayValue($Grid->request_action_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_action_id" id="x<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_action_id" id="o<?= $Grid->RowIndex ?>_request_action_id" value="<?= HtmlEncode($Grid->request_action_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_request_action_request_id" class="form-group request_action_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_request_action_request_id" class="form-group request_action_request_id">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_request_action_request_id" class="form-group request_action_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_request_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->action_id->Visible) { // action_id ?>
        <td data-name="action_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_action_action_id" class="form-group request_action_action_id">
<input type="<?= $Grid->action_id->getInputTextType() ?>" data-table="request_action" data-field="x_action_id" name="x<?= $Grid->RowIndex ?>_action_id" id="x<?= $Grid->RowIndex ?>_action_id" size="30" placeholder="<?= HtmlEncode($Grid->action_id->getPlaceHolder()) ?>" value="<?= $Grid->action_id->EditValue ?>"<?= $Grid->action_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->action_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_action_action_id" class="form-group request_action_action_id">
<span<?= $Grid->action_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->action_id->getDisplayValue($Grid->action_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_action_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_action_id" id="x<?= $Grid->RowIndex ?>_action_id" value="<?= HtmlEncode($Grid->action_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_action_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_action_id" id="o<?= $Grid->RowIndex ?>_action_id" value="<?= HtmlEncode($Grid->action_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->transition_id->Visible) { // transition_id ?>
        <td data-name="transition_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_action_transition_id" class="form-group request_action_transition_id">
<input type="<?= $Grid->transition_id->getInputTextType() ?>" data-table="request_action" data-field="x_transition_id" name="x<?= $Grid->RowIndex ?>_transition_id" id="x<?= $Grid->RowIndex ?>_transition_id" size="30" placeholder="<?= HtmlEncode($Grid->transition_id->getPlaceHolder()) ?>" value="<?= $Grid->transition_id->EditValue ?>"<?= $Grid->transition_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->transition_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_action_transition_id" class="form-group request_action_transition_id">
<span<?= $Grid->transition_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->transition_id->getDisplayValue($Grid->transition_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_transition_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_transition_id" id="x<?= $Grid->RowIndex ?>_transition_id" value="<?= HtmlEncode($Grid->transition_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_transition_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_transition_id" id="o<?= $Grid->RowIndex ?>_transition_id" value="<?= HtmlEncode($Grid->transition_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->is_active->Visible) { // is_active ?>
        <td data-name="is_active">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_action_is_active" class="form-group request_action_is_active">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_active->isInvalidClass() ?>" data-table="request_action" data-field="x_is_active" name="x<?= $Grid->RowIndex ?>_is_active[]" id="x<?= $Grid->RowIndex ?>_is_active_735139" value="1"<?= ConvertToBool($Grid->is_active->CurrentValue) ? " checked" : "" ?><?= $Grid->is_active->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_active_735139"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_active->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_action_is_active" class="form-group request_action_is_active">
<span<?= $Grid->is_active->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_active_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->is_active->ViewValue ?>" disabled<?php if (ConvertToBool($Grid->is_active->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_active_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_is_active" data-hidden="1" name="x<?= $Grid->RowIndex ?>_is_active" id="x<?= $Grid->RowIndex ?>_is_active" value="<?= HtmlEncode($Grid->is_active->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_is_active" data-hidden="1" name="o<?= $Grid->RowIndex ?>_is_active[]" id="o<?= $Grid->RowIndex ?>_is_active[]" value="<?= HtmlEncode($Grid->is_active->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->is_complete->Visible) { // is_complete ?>
        <td data-name="is_complete">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_action_is_complete" class="form-group request_action_is_complete">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Grid->is_complete->isInvalidClass() ?>" data-table="request_action" data-field="x_is_complete" name="x<?= $Grid->RowIndex ?>_is_complete[]" id="x<?= $Grid->RowIndex ?>_is_complete_360981" value="1"<?= ConvertToBool($Grid->is_complete->CurrentValue) ? " checked" : "" ?><?= $Grid->is_complete->editAttributes() ?>>
    <label class="custom-control-label" for="x<?= $Grid->RowIndex ?>_is_complete_360981"></label>
</div>
<div class="invalid-feedback"><?= $Grid->is_complete->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_action_is_complete" class="form-group request_action_is_complete">
<span<?= $Grid->is_complete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_complete_<?= $Grid->RowCount ?>" class="custom-control-input" value="<?= $Grid->is_complete->ViewValue ?>" disabled<?php if (ConvertToBool($Grid->is_complete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_complete_<?= $Grid->RowCount ?>"></label>
</div></span>
</span>
<input type="hidden" data-table="request_action" data-field="x_is_complete" data-hidden="1" name="x<?= $Grid->RowIndex ?>_is_complete" id="x<?= $Grid->RowIndex ?>_is_complete" value="<?= HtmlEncode($Grid->is_complete->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_action" data-field="x_is_complete" data-hidden="1" name="o<?= $Grid->RowIndex ?>_is_complete[]" id="o<?= $Grid->RowIndex ?>_is_complete[]" value="<?= HtmlEncode($Grid->is_complete->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["frequest_actiongrid","load"], function() {
    frequest_actiongrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="frequest_actiongrid">
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
    ew.addEventHandlers("request_action");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
