<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ActivityTargetAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var factivity_targetadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    factivity_targetadd = currentForm = new ew.Form("factivity_targetadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "activity_target")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.activity_target)
        ew.vars.tables.activity_target = currentTable;
    factivity_targetadd.addFields([
        ["activity_target_id", [fields.activity_target_id.visible && fields.activity_target_id.required ? ew.Validators.required(fields.activity_target_id.caption) : null, ew.Validators.integer], fields.activity_target_id.isInvalid],
        ["activity_id", [fields.activity_id.visible && fields.activity_id.required ? ew.Validators.required(fields.activity_id.caption) : null, ew.Validators.integer], fields.activity_id.isInvalid],
        ["target_id", [fields.target_id.visible && fields.target_id.required ? ew.Validators.required(fields.target_id.caption) : null, ew.Validators.integer], fields.target_id.isInvalid],
        ["group_id", [fields.group_id.visible && fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = factivity_targetadd,
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
    factivity_targetadd.validate = function () {
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
    factivity_targetadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    factivity_targetadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("factivity_targetadd");
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
<form name="factivity_targetadd" id="factivity_targetadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="activity_target">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->activity_target_id->Visible) { // activity_target_id ?>
    <div id="r_activity_target_id" class="form-group row">
        <label id="elh_activity_target_activity_target_id" for="x_activity_target_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->activity_target_id->caption() ?><?= $Page->activity_target_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->activity_target_id->cellAttributes() ?>>
<span id="el_activity_target_activity_target_id">
<input type="<?= $Page->activity_target_id->getInputTextType() ?>" data-table="activity_target" data-field="x_activity_target_id" name="x_activity_target_id" id="x_activity_target_id" size="30" placeholder="<?= HtmlEncode($Page->activity_target_id->getPlaceHolder()) ?>" value="<?= $Page->activity_target_id->EditValue ?>"<?= $Page->activity_target_id->editAttributes() ?> aria-describedby="x_activity_target_id_help">
<?= $Page->activity_target_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->activity_target_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->activity_id->Visible) { // activity_id ?>
    <div id="r_activity_id" class="form-group row">
        <label id="elh_activity_target_activity_id" for="x_activity_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->activity_id->caption() ?><?= $Page->activity_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->activity_id->cellAttributes() ?>>
<span id="el_activity_target_activity_id">
<input type="<?= $Page->activity_id->getInputTextType() ?>" data-table="activity_target" data-field="x_activity_id" name="x_activity_id" id="x_activity_id" size="30" placeholder="<?= HtmlEncode($Page->activity_id->getPlaceHolder()) ?>" value="<?= $Page->activity_id->EditValue ?>"<?= $Page->activity_id->editAttributes() ?> aria-describedby="x_activity_id_help">
<?= $Page->activity_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->activity_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_id->Visible) { // target_id ?>
    <div id="r_target_id" class="form-group row">
        <label id="elh_activity_target_target_id" for="x_target_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_id->caption() ?><?= $Page->target_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->target_id->cellAttributes() ?>>
<span id="el_activity_target_target_id">
<input type="<?= $Page->target_id->getInputTextType() ?>" data-table="activity_target" data-field="x_target_id" name="x_target_id" id="x_target_id" size="30" placeholder="<?= HtmlEncode($Page->target_id->getPlaceHolder()) ?>" value="<?= $Page->target_id->EditValue ?>"<?= $Page->target_id->editAttributes() ?> aria-describedby="x_target_id_help">
<?= $Page->target_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id" class="form-group row">
        <label id="elh_activity_target_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_id->cellAttributes() ?>>
<span id="el_activity_target_group_id">
<input type="<?= $Page->group_id->getInputTextType() ?>" data-table="activity_target" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>" value="<?= $Page->group_id->EditValue ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("activity_target");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
