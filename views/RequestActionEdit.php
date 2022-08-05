<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestActionEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_actionedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frequest_actionedit = currentForm = new ew.Form("frequest_actionedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_action")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_action)
        ew.vars.tables.request_action = currentTable;
    frequest_actionedit.addFields([
        ["request_action_id", [fields.request_action_id.visible && fields.request_action_id.required ? ew.Validators.required(fields.request_action_id.caption) : null, ew.Validators.integer], fields.request_action_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["action_id", [fields.action_id.visible && fields.action_id.required ? ew.Validators.required(fields.action_id.caption) : null, ew.Validators.integer], fields.action_id.isInvalid],
        ["transition_id", [fields.transition_id.visible && fields.transition_id.required ? ew.Validators.required(fields.transition_id.caption) : null, ew.Validators.integer], fields.transition_id.isInvalid],
        ["is_active", [fields.is_active.visible && fields.is_active.required ? ew.Validators.required(fields.is_active.caption) : null], fields.is_active.isInvalid],
        ["is_complete", [fields.is_complete.visible && fields.is_complete.required ? ew.Validators.required(fields.is_complete.caption) : null], fields.is_complete.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_actionedit,
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
    frequest_actionedit.validate = function () {
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
    frequest_actionedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_actionedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frequest_actionedit.lists.is_active = <?= $Page->is_active->toClientList($Page) ?>;
    frequest_actionedit.lists.is_complete = <?= $Page->is_complete->toClientList($Page) ?>;
    loadjs.done("frequest_actionedit");
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
<form name="frequest_actionedit" id="frequest_actionedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_action">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "request2") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="request2">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
    <div id="r_request_action_id" class="form-group row">
        <label id="elh_request_action_request_action_id" for="x_request_action_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_action_id->caption() ?><?= $Page->request_action_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_action_id->cellAttributes() ?>>
<input type="<?= $Page->request_action_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_action_id" name="x_request_action_id" id="x_request_action_id" size="30" placeholder="<?= HtmlEncode($Page->request_action_id->getPlaceHolder()) ?>" value="<?= $Page->request_action_id->EditValue ?>"<?= $Page->request_action_id->editAttributes() ?> aria-describedby="x_request_action_id_help">
<?= $Page->request_action_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_action_id->getErrorMessage() ?></div>
<input type="hidden" data-table="request_action" data-field="x_request_action_id" data-hidden="1" name="o_request_action_id" id="o_request_action_id" value="<?= HtmlEncode($Page->request_action_id->OldValue ?? $Page->request_action_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id" class="form-group row">
        <label id="elh_request_action_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->request_id->getSessionValue() != "") { ?>
<span id="el_request_action_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_request_id" name="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_request_action_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" data-table="request_action" data-field="x_request_id" name="x_request_id" id="x_request_id" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" value="<?= $Page->request_id->EditValue ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
    <div id="r_action_id" class="form-group row">
        <label id="elh_request_action_action_id" for="x_action_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_id->caption() ?><?= $Page->action_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->action_id->cellAttributes() ?>>
<span id="el_request_action_action_id">
<input type="<?= $Page->action_id->getInputTextType() ?>" data-table="request_action" data-field="x_action_id" name="x_action_id" id="x_action_id" size="30" placeholder="<?= HtmlEncode($Page->action_id->getPlaceHolder()) ?>" value="<?= $Page->action_id->EditValue ?>"<?= $Page->action_id->editAttributes() ?> aria-describedby="x_action_id_help">
<?= $Page->action_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
    <div id="r_transition_id" class="form-group row">
        <label id="elh_request_action_transition_id" for="x_transition_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transition_id->caption() ?><?= $Page->transition_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->transition_id->cellAttributes() ?>>
<span id="el_request_action_transition_id">
<input type="<?= $Page->transition_id->getInputTextType() ?>" data-table="request_action" data-field="x_transition_id" name="x_transition_id" id="x_transition_id" size="30" placeholder="<?= HtmlEncode($Page->transition_id->getPlaceHolder()) ?>" value="<?= $Page->transition_id->EditValue ?>"<?= $Page->transition_id->editAttributes() ?> aria-describedby="x_transition_id_help">
<?= $Page->transition_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transition_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <div id="r_is_active" class="form-group row">
        <label id="elh_request_action_is_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_active->caption() ?><?= $Page->is_active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->is_active->cellAttributes() ?>>
<span id="el_request_action_is_active">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->is_active->isInvalidClass() ?>" data-table="request_action" data-field="x_is_active" name="x_is_active[]" id="x_is_active_350671" value="1"<?= ConvertToBool($Page->is_active->CurrentValue) ? " checked" : "" ?><?= $Page->is_active->editAttributes() ?> aria-describedby="x_is_active_help">
    <label class="custom-control-label" for="x_is_active_350671"></label>
</div>
<?= $Page->is_active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->is_active->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
    <div id="r_is_complete" class="form-group row">
        <label id="elh_request_action_is_complete" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_complete->caption() ?><?= $Page->is_complete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->is_complete->cellAttributes() ?>>
<span id="el_request_action_is_complete">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->is_complete->isInvalidClass() ?>" data-table="request_action" data-field="x_is_complete" name="x_is_complete[]" id="x_is_complete_715709" value="1"<?= ConvertToBool($Page->is_complete->CurrentValue) ? " checked" : "" ?><?= $Page->is_complete->editAttributes() ?> aria-describedby="x_is_complete_help">
    <label class="custom-control-label" for="x_is_complete_715709"></label>
</div>
<?= $Page->is_complete->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->is_complete->getErrorMessage() ?></div>
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
    ew.addEventHandlers("request_action");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
