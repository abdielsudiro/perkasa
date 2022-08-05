<?php

namespace PHPMaker2021\perkasa2;

// Page object
$GroupEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgroupedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fgroupedit = currentForm = new ew.Form("fgroupedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "group")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.group)
        ew.vars.tables.group = currentTable;
    fgroupedit.addFields([
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid],
        ["process_id", [fields.process_id.visible && fields.process_id.required ? ew.Validators.required(fields.process_id.caption) : null, ew.Validators.integer], fields.process_id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fgroupedit,
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
    fgroupedit.validate = function () {
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
    fgroupedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgroupedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fgroupedit");
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
<form name="fgroupedit" id="fgroupedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="group">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id" class="form-group row">
        <label id="elh_group_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_id->cellAttributes() ?>>
<input type="<?= $Page->group_id->getInputTextType() ?>" data-table="group" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>" value="<?= $Page->group_id->EditValue ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
<?= $Page->group_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
<input type="hidden" data-table="group" data-field="x_group_id" data-hidden="1" name="o_group_id" id="o_group_id" value="<?= HtmlEncode($Page->group_id->OldValue ?? $Page->group_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <div id="r_process_id" class="form-group row">
        <label id="elh_group_process_id" for="x_process_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->process_id->caption() ?><?= $Page->process_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->process_id->cellAttributes() ?>>
<span id="el_group_process_id">
<input type="<?= $Page->process_id->getInputTextType() ?>" data-table="group" data-field="x_process_id" name="x_process_id" id="x_process_id" size="30" placeholder="<?= HtmlEncode($Page->process_id->getPlaceHolder()) ?>" value="<?= $Page->process_id->EditValue ?>"<?= $Page->process_id->editAttributes() ?> aria-describedby="x_process_id_help">
<?= $Page->process_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->process_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name" class="form-group row">
        <label id="elh_group_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name->cellAttributes() ?>>
<span id="el_group_name">
<input type="<?= $Page->name->getInputTextType() ?>" data-table="group" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" value="<?= $Page->name->EditValue ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("group");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
