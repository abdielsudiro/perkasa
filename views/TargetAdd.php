<?php

namespace PHPMaker2021\perkasa2;

// Page object
$TargetAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftargetadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftargetadd = currentForm = new ew.Form("ftargetadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "target")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.target)
        ew.vars.tables.target = currentTable;
    ftargetadd.addFields([
        ["target_id", [fields.target_id.visible && fields.target_id.required ? ew.Validators.required(fields.target_id.caption) : null, ew.Validators.integer], fields.target_id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftargetadd,
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
    ftargetadd.validate = function () {
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
    ftargetadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftargetadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftargetadd");
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
<form name="ftargetadd" id="ftargetadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="target">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->target_id->Visible) { // target_id ?>
    <div id="r_target_id" class="form-group row">
        <label id="elh_target_target_id" for="x_target_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_id->caption() ?><?= $Page->target_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->target_id->cellAttributes() ?>>
<span id="el_target_target_id">
<input type="<?= $Page->target_id->getInputTextType() ?>" data-table="target" data-field="x_target_id" name="x_target_id" id="x_target_id" size="30" placeholder="<?= HtmlEncode($Page->target_id->getPlaceHolder()) ?>" value="<?= $Page->target_id->EditValue ?>"<?= $Page->target_id->editAttributes() ?> aria-describedby="x_target_id_help">
<?= $Page->target_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name" class="form-group row">
        <label id="elh_target_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name->cellAttributes() ?>>
<span id="el_target_name">
<input type="<?= $Page->name->getInputTextType() ?>" data-table="target" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" value="<?= $Page->name->EditValue ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description" class="form-group row">
        <label id="elh_target_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->description->cellAttributes() ?>>
<span id="el_target_description">
<input type="<?= $Page->description->getInputTextType() ?>" data-table="target" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>" value="<?= $Page->description->EditValue ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
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
    ew.addEventHandlers("target");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
