<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActionTargetEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var faction_targetedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    faction_targetedit = currentForm = new ew.Form("faction_targetedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "action_target")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.action_target)
        ew.vars.tables.action_target = currentTable;
    faction_targetedit.addFields([
        ["action_target_id", [fields.action_target_id.visible && fields.action_target_id.required ? ew.Validators.required(fields.action_target_id.caption) : null, ew.Validators.integer], fields.action_target_id.isInvalid],
        ["action_id", [fields.action_id.visible && fields.action_id.required ? ew.Validators.required(fields.action_id.caption) : null, ew.Validators.integer], fields.action_id.isInvalid],
        ["target_id", [fields.target_id.visible && fields.target_id.required ? ew.Validators.required(fields.target_id.caption) : null, ew.Validators.integer], fields.target_id.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = faction_targetedit,
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
    faction_targetedit.validate = function () {
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
    faction_targetedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faction_targetedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("faction_targetedit");
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
<form name="faction_targetedit" id="faction_targetedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="action_target">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->action_target_id->Visible) { // action_target_id ?>
    <div id="r_action_target_id" class="form-group row">
        <label id="elh_action_target_action_target_id" for="x_action_target_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_target_id->caption() ?><?= $Page->action_target_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->action_target_id->cellAttributes() ?>>
<input type="<?= $Page->action_target_id->getInputTextType() ?>" data-table="action_target" data-field="x_action_target_id" name="x_action_target_id" id="x_action_target_id" size="30" placeholder="<?= HtmlEncode($Page->action_target_id->getPlaceHolder()) ?>" value="<?= $Page->action_target_id->EditValue ?>"<?= $Page->action_target_id->editAttributes() ?> aria-describedby="x_action_target_id_help">
<?= $Page->action_target_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_target_id->getErrorMessage() ?></div>
<input type="hidden" data-table="action_target" data-field="x_action_target_id" data-hidden="1" name="o_action_target_id" id="o_action_target_id" value="<?= HtmlEncode($Page->action_target_id->OldValue ?? $Page->action_target_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
    <div id="r_action_id" class="form-group row">
        <label id="elh_action_target_action_id" for="x_action_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_id->caption() ?><?= $Page->action_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->action_id->cellAttributes() ?>>
<span id="el_action_target_action_id">
<input type="<?= $Page->action_id->getInputTextType() ?>" data-table="action_target" data-field="x_action_id" name="x_action_id" id="x_action_id" size="30" placeholder="<?= HtmlEncode($Page->action_id->getPlaceHolder()) ?>" value="<?= $Page->action_id->EditValue ?>"<?= $Page->action_id->editAttributes() ?> aria-describedby="x_action_id_help">
<?= $Page->action_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
    <div id="r_target_id" class="form-group row">
        <label id="elh_action_target_target_id" for="x_target_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_id->caption() ?><?= $Page->target_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->target_id->cellAttributes() ?>>
<span id="el_action_target_target_id">
<input type="<?= $Page->target_id->getInputTextType() ?>" data-table="action_target" data-field="x_target_id" name="x_target_id" id="x_target_id" size="30" placeholder="<?= HtmlEncode($Page->target_id->getPlaceHolder()) ?>" value="<?= $Page->target_id->EditValue ?>"<?= $Page->target_id->editAttributes() ?> aria-describedby="x_target_id_help">
<?= $Page->target_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id" class="form-group row">
        <label id="elh_action_target_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_id->cellAttributes() ?>>
<span id="el_action_target_group_id">
<input type="<?= $Page->group_id->getInputTextType() ?>" data-table="action_target" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>" value="<?= $Page->group_id->EditValue ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
<?= $Page->group_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("action_target");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
