<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserLevel2Add = &$Page;
?>
<script>
var currentForm, currentPageID;
var fuser_level2add;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fuser_level2add = currentForm = new ew.Form("fuser_level2add", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "user_level2")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.user_level2)
        ew.vars.tables.user_level2 = currentTable;
    fuser_level2add.addFields([
        ["user_level_id", [fields.user_level_id.visible && fields.user_level_id.required ? ew.Validators.required(fields.user_level_id.caption) : null, ew.Validators.integer], fields.user_level_id.isInvalid],
        ["user_level_name", [fields.user_level_name.visible && fields.user_level_name.required ? ew.Validators.required(fields.user_level_name.caption) : null], fields.user_level_name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fuser_level2add,
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
    fuser_level2add.validate = function () {
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
    fuser_level2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuser_level2add.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fuser_level2add");
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
<form name="fuser_level2add" id="fuser_level2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="user_level2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->user_level_id->Visible) { // user_level_id ?>
    <div id="r_user_level_id" class="form-group row">
        <label id="elh_user_level2_user_level_id" for="x_user_level_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_level_id->caption() ?><?= $Page->user_level_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_level_id->cellAttributes() ?>>
<span id="el_user_level2_user_level_id">
<input type="<?= $Page->user_level_id->getInputTextType() ?>" data-table="user_level2" data-field="x_user_level_id" name="x_user_level_id" id="x_user_level_id" size="30" placeholder="<?= HtmlEncode($Page->user_level_id->getPlaceHolder()) ?>" value="<?= $Page->user_level_id->EditValue ?>"<?= $Page->user_level_id->editAttributes() ?> aria-describedby="x_user_level_id_help">
<?= $Page->user_level_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_level_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_level_name->Visible) { // user_level_name ?>
    <div id="r_user_level_name" class="form-group row">
        <label id="elh_user_level2_user_level_name" for="x_user_level_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_level_name->caption() ?><?= $Page->user_level_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_level_name->cellAttributes() ?>>
<span id="el_user_level2_user_level_name">
<input type="<?= $Page->user_level_name->getInputTextType() ?>" data-table="user_level2" data-field="x_user_level_name" name="x_user_level_name" id="x_user_level_name" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->user_level_name->getPlaceHolder()) ?>" value="<?= $Page->user_level_name->EditValue ?>"<?= $Page->user_level_name->editAttributes() ?> aria-describedby="x_user_level_name_help">
<?= $Page->user_level_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_level_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("user_level2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
