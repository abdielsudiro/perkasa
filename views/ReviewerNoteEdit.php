<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ReviewerNoteEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var freviewer_noteedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    freviewer_noteedit = currentForm = new ew.Form("freviewer_noteedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "reviewer_note")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.reviewer_note)
        ew.vars.tables.reviewer_note = currentTable;
    freviewer_noteedit.addFields([
        ["reviewer_note_id", [fields.reviewer_note_id.visible && fields.reviewer_note_id.required ? ew.Validators.required(fields.reviewer_note_id.caption) : null, ew.Validators.integer], fields.reviewer_note_id.isInvalid],
        ["reviewer_note", [fields.reviewer_note.visible && fields.reviewer_note.required ? ew.Validators.required(fields.reviewer_note.caption) : null], fields.reviewer_note.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = freviewer_noteedit,
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
    freviewer_noteedit.validate = function () {
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
    freviewer_noteedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freviewer_noteedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("freviewer_noteedit");
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
<form name="freviewer_noteedit" id="freviewer_noteedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reviewer_note">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
    <div id="r_reviewer_note_id" class="form-group row">
        <label id="elh_reviewer_note_reviewer_note_id" for="x_reviewer_note_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reviewer_note_id->caption() ?><?= $Page->reviewer_note_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->reviewer_note_id->cellAttributes() ?>>
<input type="<?= $Page->reviewer_note_id->getInputTextType() ?>" data-table="reviewer_note" data-field="x_reviewer_note_id" name="x_reviewer_note_id" id="x_reviewer_note_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->reviewer_note_id->getPlaceHolder()) ?>" value="<?= $Page->reviewer_note_id->EditValue ?>"<?= $Page->reviewer_note_id->editAttributes() ?> aria-describedby="x_reviewer_note_id_help">
<?= $Page->reviewer_note_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reviewer_note_id->getErrorMessage() ?></div>
<input type="hidden" data-table="reviewer_note" data-field="x_reviewer_note_id" data-hidden="1" name="o_reviewer_note_id" id="o_reviewer_note_id" value="<?= HtmlEncode($Page->reviewer_note_id->OldValue ?? $Page->reviewer_note_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reviewer_note->Visible) { // reviewer_note ?>
    <div id="r_reviewer_note" class="form-group row">
        <label id="elh_reviewer_note_reviewer_note" for="x_reviewer_note" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reviewer_note->caption() ?><?= $Page->reviewer_note->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->reviewer_note->cellAttributes() ?>>
<span id="el_reviewer_note_reviewer_note">
<textarea data-table="reviewer_note" data-field="x_reviewer_note" name="x_reviewer_note" id="x_reviewer_note" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->reviewer_note->getPlaceHolder()) ?>"<?= $Page->reviewer_note->editAttributes() ?> aria-describedby="x_reviewer_note_help"><?= $Page->reviewer_note->EditValue ?></textarea>
<?= $Page->reviewer_note->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reviewer_note->getErrorMessage() ?></div>
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
    ew.addEventHandlers("reviewer_note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
