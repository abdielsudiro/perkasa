<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabNoteEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_noteedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frab_noteedit = currentForm = new ew.Form("frab_noteedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_note")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_note)
        ew.vars.tables.rab_note = currentTable;
    frab_noteedit.addFields([
        ["id_rab_note", [fields.id_rab_note.visible && fields.id_rab_note.required ? ew.Validators.required(fields.id_rab_note.caption) : null], fields.id_rab_note.isInvalid],
        ["id_rab", [fields.id_rab.visible && fields.id_rab.required ? ew.Validators.required(fields.id_rab.caption) : null, ew.Validators.integer], fields.id_rab.isInvalid],
        ["note", [fields.note.visible && fields.note.required ? ew.Validators.required(fields.note.caption) : null], fields.note.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frab_noteedit,
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
    frab_noteedit.validate = function () {
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
    frab_noteedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_noteedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frab_noteedit");
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
<form name="frab_noteedit" id="frab_noteedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_note">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "rab") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rab">
<input type="hidden" name="fk_id_rab" value="<?= HtmlEncode($Page->id_rab->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_rab_note->Visible) { // id_rab_note ?>
    <div id="r_id_rab_note" class="form-group row">
        <label id="elh_rab_note_id_rab_note" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_rab_note->caption() ?><?= $Page->id_rab_note->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_rab_note->cellAttributes() ?>>
<span id="el_rab_note_id_rab_note">
<span<?= $Page->id_rab_note->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_rab_note->getDisplayValue($Page->id_rab_note->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_note" data-field="x_id_rab_note" data-hidden="1" name="x_id_rab_note" id="x_id_rab_note" value="<?= HtmlEncode($Page->id_rab_note->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <div id="r_id_rab" class="form-group row">
        <label id="elh_rab_note_id_rab" for="x_id_rab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_rab->caption() ?><?= $Page->id_rab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_rab->cellAttributes() ?>>
<?php if ($Page->id_rab->getSessionValue() != "") { ?>
<span id="el_rab_note_id_rab">
<span<?= $Page->id_rab->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_rab->getDisplayValue($Page->id_rab->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_id_rab" name="x_id_rab" value="<?= HtmlEncode($Page->id_rab->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_rab_note_id_rab">
<input type="<?= $Page->id_rab->getInputTextType() ?>" data-table="rab_note" data-field="x_id_rab" name="x_id_rab" id="x_id_rab" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id_rab->getPlaceHolder()) ?>" value="<?= $Page->id_rab->EditValue ?>"<?= $Page->id_rab->editAttributes() ?> aria-describedby="x_id_rab_help">
<?= $Page->id_rab->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_rab->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->note->Visible) { // note ?>
    <div id="r_note" class="form-group row">
        <label id="elh_rab_note_note" for="x_note" class="<?= $Page->LeftColumnClass ?>"><?= $Page->note->caption() ?><?= $Page->note->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->note->cellAttributes() ?>>
<span id="el_rab_note_note">
<textarea data-table="rab_note" data-field="x_note" name="x_note" id="x_note" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->note->getPlaceHolder()) ?>"<?= $Page->note->editAttributes() ?> aria-describedby="x_note_help"><?= $Page->note->EditValue ?></textarea>
<?= $Page->note->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->note->getErrorMessage() ?></div>
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
    ew.addEventHandlers("rab_note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
