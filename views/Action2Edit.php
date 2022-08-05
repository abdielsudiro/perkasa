<?php

namespace PHPMaker2021\perkasa2;

// Page object
$Action2Edit = &$Page;
?>
<script>
var currentForm, currentPageID;
var faction2edit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    faction2edit = currentForm = new ew.Form("faction2edit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "action2")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.action2)
        ew.vars.tables.action2 = currentTable;
    faction2edit.addFields([
        ["action_id", [fields.action_id.visible && fields.action_id.required ? ew.Validators.required(fields.action_id.caption) : null, ew.Validators.integer], fields.action_id.isInvalid],
        ["action_type_id", [fields.action_type_id.visible && fields.action_type_id.required ? ew.Validators.required(fields.action_type_id.caption) : null, ew.Validators.integer], fields.action_type_id.isInvalid],
        ["process_id", [fields.process_id.visible && fields.process_id.required ? ew.Validators.required(fields.process_id.caption) : null, ew.Validators.integer], fields.process_id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = faction2edit,
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
    faction2edit.validate = function () {
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
    faction2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faction2edit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("faction2edit");
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
<form name="faction2edit" id="faction2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="action2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->action_id->Visible) { // action_id ?>
    <div id="r_action_id" class="form-group row">
        <label id="elh_action2_action_id" for="x_action_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_id->caption() ?><?= $Page->action_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->action_id->cellAttributes() ?>>
<input type="<?= $Page->action_id->getInputTextType() ?>" data-table="action2" data-field="x_action_id" name="x_action_id" id="x_action_id" size="30" placeholder="<?= HtmlEncode($Page->action_id->getPlaceHolder()) ?>" value="<?= $Page->action_id->EditValue ?>"<?= $Page->action_id->editAttributes() ?> aria-describedby="x_action_id_help">
<?= $Page->action_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_id->getErrorMessage() ?></div>
<input type="hidden" data-table="action2" data-field="x_action_id" data-hidden="1" name="o_action_id" id="o_action_id" value="<?= HtmlEncode($Page->action_id->OldValue ?? $Page->action_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->action_type_id->Visible) { // action_type_id ?>
    <div id="r_action_type_id" class="form-group row">
        <label id="elh_action2_action_type_id" for="x_action_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_type_id->caption() ?><?= $Page->action_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->action_type_id->cellAttributes() ?>>
<span id="el_action2_action_type_id">
<input type="<?= $Page->action_type_id->getInputTextType() ?>" data-table="action2" data-field="x_action_type_id" name="x_action_type_id" id="x_action_type_id" size="30" placeholder="<?= HtmlEncode($Page->action_type_id->getPlaceHolder()) ?>" value="<?= $Page->action_type_id->EditValue ?>"<?= $Page->action_type_id->editAttributes() ?> aria-describedby="x_action_type_id_help">
<?= $Page->action_type_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_type_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <div id="r_process_id" class="form-group row">
        <label id="elh_action2_process_id" for="x_process_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->process_id->caption() ?><?= $Page->process_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->process_id->cellAttributes() ?>>
<span id="el_action2_process_id">
<input type="<?= $Page->process_id->getInputTextType() ?>" data-table="action2" data-field="x_process_id" name="x_process_id" id="x_process_id" size="30" placeholder="<?= HtmlEncode($Page->process_id->getPlaceHolder()) ?>" value="<?= $Page->process_id->EditValue ?>"<?= $Page->process_id->editAttributes() ?> aria-describedby="x_process_id_help">
<?= $Page->process_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->process_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name" class="form-group row">
        <label id="elh_action2_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name->cellAttributes() ?>>
<span id="el_action2_name">
<input type="<?= $Page->name->getInputTextType() ?>" data-table="action2" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" value="<?= $Page->name->EditValue ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description" class="form-group row">
        <label id="elh_action2_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->description->cellAttributes() ?>>
<span id="el_action2_description">
<input type="<?= $Page->description->getInputTextType() ?>" data-table="action2" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>" value="<?= $Page->description->EditValue ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
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
    ew.addEventHandlers("action2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
