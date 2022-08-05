<?php

namespace PHPMaker2021\perkasa2;

// Page object
$PenelaahNoteEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpenelaah_noteedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpenelaah_noteedit = currentForm = new ew.Form("fpenelaah_noteedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "penelaah_note")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.penelaah_note)
        ew.vars.tables.penelaah_note = currentTable;
    fpenelaah_noteedit.addFields([
        ["approval_note_id", [fields.approval_note_id.visible && fields.approval_note_id.required ? ew.Validators.required(fields.approval_note_id.caption) : null, ew.Validators.integer], fields.approval_note_id.isInvalid],
        ["approval_note", [fields.approval_note.visible && fields.approval_note.required ? ew.Validators.required(fields.approval_note.caption) : null], fields.approval_note.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpenelaah_noteedit,
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
    fpenelaah_noteedit.validate = function () {
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

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fpenelaah_noteedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenelaah_noteedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpenelaah_noteedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenelaah_noteedit" id="fpenelaah_noteedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penelaah_note">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
    <div id="r_approval_note_id" class="form-group row">
        <label id="elh_penelaah_note_approval_note_id" for="x_approval_note_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->approval_note_id->caption() ?><?= $Page->approval_note_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->approval_note_id->cellAttributes() ?>>
<input type="<?= $Page->approval_note_id->getInputTextType() ?>" data-table="penelaah_note" data-field="x_approval_note_id" name="x_approval_note_id" id="x_approval_note_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->approval_note_id->getPlaceHolder()) ?>" value="<?= $Page->approval_note_id->EditValue ?>"<?= $Page->approval_note_id->editAttributes() ?> aria-describedby="x_approval_note_id_help">
<?= $Page->approval_note_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->approval_note_id->getErrorMessage() ?></div>
<input type="hidden" data-table="penelaah_note" data-field="x_approval_note_id" data-hidden="1" name="o_approval_note_id" id="o_approval_note_id" value="<?= HtmlEncode($Page->approval_note_id->OldValue ?? $Page->approval_note_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->approval_note->Visible) { // approval_note ?>
    <div id="r_approval_note" class="form-group row">
        <label id="elh_penelaah_note_approval_note" for="x_approval_note" class="<?= $Page->LeftColumnClass ?>"><?= $Page->approval_note->caption() ?><?= $Page->approval_note->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->approval_note->cellAttributes() ?>>
<span id="el_penelaah_note_approval_note">
<textarea data-table="penelaah_note" data-field="x_approval_note" name="x_approval_note" id="x_approval_note" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->approval_note->getPlaceHolder()) ?>"<?= $Page->approval_note->editAttributes() ?> aria-describedby="x_approval_note_help"><?= $Page->approval_note->EditValue ?></textarea>
<?= $Page->approval_note->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->approval_note->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("penelaah_note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
