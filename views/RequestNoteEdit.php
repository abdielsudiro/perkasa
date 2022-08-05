<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestNoteEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_noteedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frequest_noteedit = currentForm = new ew.Form("frequest_noteedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_note")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_note)
        ew.vars.tables.request_note = currentTable;
    frequest_noteedit.addFields([
        ["request_note_id", [fields.request_note_id.visible && fields.request_note_id.required ? ew.Validators.required(fields.request_note_id.caption) : null, ew.Validators.integer], fields.request_note_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
        ["note", [fields.note.visible && fields.note.required ? ew.Validators.required(fields.note.caption) : null], fields.note.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_noteedit,
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
    frequest_noteedit.validate = function () {
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
    frequest_noteedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_noteedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frequest_noteedit");
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
<form name="frequest_noteedit" id="frequest_noteedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_note">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "request2") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="request2">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->request_note_id->Visible) { // request_note_id ?>
    <div id="r_request_note_id" class="form-group row">
        <label id="elh_request_note_request_note_id" for="x_request_note_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_note_id->caption() ?><?= $Page->request_note_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_note_id->cellAttributes() ?>>
<input type="<?= $Page->request_note_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_note_id" name="x_request_note_id" id="x_request_note_id" size="30" placeholder="<?= HtmlEncode($Page->request_note_id->getPlaceHolder()) ?>" value="<?= $Page->request_note_id->EditValue ?>"<?= $Page->request_note_id->editAttributes() ?> aria-describedby="x_request_note_id_help">
<?= $Page->request_note_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_note_id->getErrorMessage() ?></div>
<input type="hidden" data-table="request_note" data-field="x_request_note_id" data-hidden="1" name="o_request_note_id" id="o_request_note_id" value="<?= HtmlEncode($Page->request_note_id->OldValue ?? $Page->request_note_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id" class="form-group row">
        <label id="elh_request_note_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->request_id->getSessionValue() != "") { ?>
<span id="el_request_note_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_request_id" name="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_request_note_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" data-table="request_note" data-field="x_request_id" name="x_request_id" id="x_request_id" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" value="<?= $Page->request_id->EditValue ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id" class="form-group row">
        <label id="elh_request_note_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request_note_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" data-table="request_note" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" value="<?= $Page->user_id->EditValue ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->note->Visible) { // note ?>
    <div id="r_note" class="form-group row">
        <label id="elh_request_note_note" for="x_note" class="<?= $Page->LeftColumnClass ?>"><?= $Page->note->caption() ?><?= $Page->note->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->note->cellAttributes() ?>>
<span id="el_request_note_note">
<textarea data-table="request_note" data-field="x_note" name="x_note" id="x_note" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->note->getPlaceHolder()) ?>"<?= $Page->note->editAttributes() ?> aria-describedby="x_note_help"><?= $Page->note->EditValue ?></textarea>
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
    ew.addEventHandlers("request_note");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
