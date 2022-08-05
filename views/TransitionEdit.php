<?php

namespace PHPMaker2021\perkasa2;

// Page object
$TransitionEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftransitionedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftransitionedit = currentForm = new ew.Form("ftransitionedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "transition")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.transition)
        ew.vars.tables.transition = currentTable;
    ftransitionedit.addFields([
        ["transition_id", [fields.transition_id.visible && fields.transition_id.required ? ew.Validators.required(fields.transition_id.caption) : null, ew.Validators.integer], fields.transition_id.isInvalid],
        ["process_id", [fields.process_id.visible && fields.process_id.required ? ew.Validators.required(fields.process_id.caption) : null, ew.Validators.integer], fields.process_id.isInvalid],
        ["current_state_id", [fields.current_state_id.visible && fields.current_state_id.required ? ew.Validators.required(fields.current_state_id.caption) : null, ew.Validators.integer], fields.current_state_id.isInvalid],
        ["next_state_id", [fields.next_state_id.visible && fields.next_state_id.required ? ew.Validators.required(fields.next_state_id.caption) : null, ew.Validators.integer], fields.next_state_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftransitionedit,
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
    ftransitionedit.validate = function () {
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
    ftransitionedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransitionedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftransitionedit");
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
<form name="ftransitionedit" id="ftransitionedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transition">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->transition_id->Visible) { // transition_id ?>
    <div id="r_transition_id" class="form-group row">
        <label id="elh_transition_transition_id" for="x_transition_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transition_id->caption() ?><?= $Page->transition_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->transition_id->cellAttributes() ?>>
<input type="<?= $Page->transition_id->getInputTextType() ?>" data-table="transition" data-field="x_transition_id" name="x_transition_id" id="x_transition_id" size="30" placeholder="<?= HtmlEncode($Page->transition_id->getPlaceHolder()) ?>" value="<?= $Page->transition_id->EditValue ?>"<?= $Page->transition_id->editAttributes() ?> aria-describedby="x_transition_id_help">
<?= $Page->transition_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transition_id->getErrorMessage() ?></div>
<input type="hidden" data-table="transition" data-field="x_transition_id" data-hidden="1" name="o_transition_id" id="o_transition_id" value="<?= HtmlEncode($Page->transition_id->OldValue ?? $Page->transition_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <div id="r_process_id" class="form-group row">
        <label id="elh_transition_process_id" for="x_process_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->process_id->caption() ?><?= $Page->process_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->process_id->cellAttributes() ?>>
<span id="el_transition_process_id">
<input type="<?= $Page->process_id->getInputTextType() ?>" data-table="transition" data-field="x_process_id" name="x_process_id" id="x_process_id" size="30" placeholder="<?= HtmlEncode($Page->process_id->getPlaceHolder()) ?>" value="<?= $Page->process_id->EditValue ?>"<?= $Page->process_id->editAttributes() ?> aria-describedby="x_process_id_help">
<?= $Page->process_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->process_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
    <div id="r_current_state_id" class="form-group row">
        <label id="elh_transition_current_state_id" for="x_current_state_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->current_state_id->caption() ?><?= $Page->current_state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el_transition_current_state_id">
<input type="<?= $Page->current_state_id->getInputTextType() ?>" data-table="transition" data-field="x_current_state_id" name="x_current_state_id" id="x_current_state_id" size="30" placeholder="<?= HtmlEncode($Page->current_state_id->getPlaceHolder()) ?>" value="<?= $Page->current_state_id->EditValue ?>"<?= $Page->current_state_id->editAttributes() ?> aria-describedby="x_current_state_id_help">
<?= $Page->current_state_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->current_state_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_state_id->Visible) { // next_state_id ?>
    <div id="r_next_state_id" class="form-group row">
        <label id="elh_transition_next_state_id" for="x_next_state_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_state_id->caption() ?><?= $Page->next_state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->next_state_id->cellAttributes() ?>>
<span id="el_transition_next_state_id">
<input type="<?= $Page->next_state_id->getInputTextType() ?>" data-table="transition" data-field="x_next_state_id" name="x_next_state_id" id="x_next_state_id" size="30" placeholder="<?= HtmlEncode($Page->next_state_id->getPlaceHolder()) ?>" value="<?= $Page->next_state_id->EditValue ?>"<?= $Page->next_state_id->editAttributes() ?> aria-describedby="x_next_state_id_help">
<?= $Page->next_state_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_state_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("transition");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
