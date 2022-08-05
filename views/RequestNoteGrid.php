<?php

namespace PHPMaker2021\perkasa2;

// Set up and run Grid object
$Grid = Container("RequestNoteGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frequest_notegrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    frequest_notegrid = new ew.Form("frequest_notegrid", "grid");
    frequest_notegrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_note")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_note)
        ew.vars.tables.request_note = currentTable;
    frequest_notegrid.addFields([
        ["request_note_id", [fields.request_note_id.visible && fields.request_note_id.required ? ew.Validators.required(fields.request_note_id.caption) : null, ew.Validators.integer], fields.request_note_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_notegrid,
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
    frequest_notegrid.validate = function () {
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
    frequest_notegrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "request_note_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "request_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "user_id", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    frequest_notegrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_notegrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frequest_notegrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_note">
<div id="frequest_notegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_request_note" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_request_notegrid" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Grid->request_note_id->Visible) { // request_note_id ?>
        <th data-name="request_note_id" class="<?= $Grid->request_note_id->headerCellClass() ?>"><div id="elh_request_note_request_note_id" class="request_note_request_note_id"><?= $Grid->renderSort($Grid->request_note_id) ?></div></th>
<?php } ?>
<?php if ($Grid->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Grid->request_id->headerCellClass() ?>"><div id="elh_request_note_request_id" class="request_note_request_id"><?= $Grid->renderSort($Grid->request_id) ?></div></th>
<?php } ?>
<?php if ($Grid->user_id->Visible) { // user_id ?>
        <th data-name="user_id" class="<?= $Grid->user_id->headerCellClass() ?>"><div id="elh_request_note_user_id" class="request_note_user_id"><?= $Grid->renderSort($Grid->user_id) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_request_note", "data-rowtype" => $Grid->RowType]);

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
    <?php if ($Grid->request_note_id->Visible) { // request_note_id ?>
        <td data-name="request_note_id" <?= $Grid->request_note_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_note_id" class="form-group">
<input type="<?= $Grid->request_note_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_note_id" name="x<?= $Grid->RowIndex ?>_request_note_id" id="x<?= $Grid->RowIndex ?>_request_note_id" size="30" placeholder="<?= HtmlEncode($Grid->request_note_id->getPlaceHolder()) ?>" value="<?= $Grid->request_note_id->EditValue ?>"<?= $Grid->request_note_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_note_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_note_id" id="o<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Grid->request_note_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_note_id" name="x<?= $Grid->RowIndex ?>_request_note_id" id="x<?= $Grid->RowIndex ?>_request_note_id" size="30" placeholder="<?= HtmlEncode($Grid->request_note_id->getPlaceHolder()) ?>" value="<?= $Grid->request_note_id->EditValue ?>"<?= $Grid->request_note_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_note_id->getErrorMessage() ?></div>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_note_id" id="o<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->OldValue ?? $Grid->request_note_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_note_id">
<span<?= $Grid->request_note_id->viewAttributes() ?>>
<?= $Grid->request_note_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="frequest_notegrid$x<?= $Grid->RowIndex ?>_request_note_id" id="frequest_notegrid$x<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->FormValue) ?>">
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="frequest_notegrid$o<?= $Grid->RowIndex ?>_request_note_id" id="frequest_notegrid$o<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_note_id" id="x<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id" <?= $Grid->request_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="request_note" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_id" class="form-group">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_id" class="form-group">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<?= $Grid->request_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_note" data-field="x_request_id" data-hidden="1" name="frequest_notegrid$x<?= $Grid->RowIndex ?>_request_id" id="frequest_notegrid$x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<input type="hidden" data-table="request_note" data-field="x_request_id" data-hidden="1" name="frequest_notegrid$o<?= $Grid->RowIndex ?>_request_id" id="frequest_notegrid$o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->user_id->Visible) { // user_id ?>
        <td data-name="user_id" <?= $Grid->user_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_user_id" class="form-group">
<input type="<?= $Grid->user_id->getInputTextType() ?>" data-table="request_note" data-field="x_user_id" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" size="30" placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" value="<?= $Grid->user_id->EditValue ?>"<?= $Grid->user_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="request_note" data-field="x_user_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_user_id" id="o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_user_id" class="form-group">
<input type="<?= $Grid->user_id->getInputTextType() ?>" data-table="request_note" data-field="x_user_id" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" size="30" placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" value="<?= $Grid->user_id->EditValue ?>"<?= $Grid->user_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_request_note_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<?= $Grid->user_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="request_note" data-field="x_user_id" data-hidden="1" name="frequest_notegrid$x<?= $Grid->RowIndex ?>_user_id" id="frequest_notegrid$x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->FormValue) ?>">
<input type="hidden" data-table="request_note" data-field="x_user_id" data-hidden="1" name="frequest_notegrid$o<?= $Grid->RowIndex ?>_user_id" id="frequest_notegrid$o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
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
loadjs.ready(["frequest_notegrid","load"], function () {
    frequest_notegrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_request_note", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->request_note_id->Visible) { // request_note_id ?>
        <td data-name="request_note_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_note_request_note_id" class="form-group request_note_request_note_id">
<input type="<?= $Grid->request_note_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_note_id" name="x<?= $Grid->RowIndex ?>_request_note_id" id="x<?= $Grid->RowIndex ?>_request_note_id" size="30" placeholder="<?= HtmlEncode($Grid->request_note_id->getPlaceHolder()) ?>" value="<?= $Grid->request_note_id->EditValue ?>"<?= $Grid->request_note_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_note_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_note_request_note_id" class="form-group request_note_request_note_id">
<span<?= $Grid->request_note_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_note_id->getDisplayValue($Grid->request_note_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_note_id" id="x<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_note_id" id="o<?= $Grid->RowIndex ?>_request_note_id" value="<?= HtmlEncode($Grid->request_note_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->request_id->Visible) { // request_id ?>
        <td data-name="request_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->request_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_request_note_request_id" class="form-group request_note_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_request_id" name="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_request_note_request_id" class="form-group request_note_request_id">
<input type="<?= $Grid->request_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_id" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" size="30" placeholder="<?= HtmlEncode($Grid->request_id->getPlaceHolder()) ?>" value="<?= $Grid->request_id->EditValue ?>"<?= $Grid->request_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_request_note_request_id" class="form-group request_note_request_id">
<span<?= $Grid->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->request_id->getDisplayValue($Grid->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_note" data-field="x_request_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_request_id" id="x<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_note" data-field="x_request_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_request_id" id="o<?= $Grid->RowIndex ?>_request_id" value="<?= HtmlEncode($Grid->request_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->user_id->Visible) { // user_id ?>
        <td data-name="user_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_request_note_user_id" class="form-group request_note_user_id">
<input type="<?= $Grid->user_id->getInputTextType() ?>" data-table="request_note" data-field="x_user_id" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" size="30" placeholder="<?= HtmlEncode($Grid->user_id->getPlaceHolder()) ?>" value="<?= $Grid->user_id->EditValue ?>"<?= $Grid->user_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->user_id->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_note_user_id" class="form-group request_note_user_id">
<span<?= $Grid->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->user_id->getDisplayValue($Grid->user_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_note" data-field="x_user_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_user_id" id="x<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_note" data-field="x_user_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_user_id" id="o<?= $Grid->RowIndex ?>_user_id" value="<?= HtmlEncode($Grid->user_id->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["frequest_notegrid","load"], function() {
    frequest_notegrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="frequest_notegrid">
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
    ew.addEventHandlers("request_note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
