<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UserlevelpermissionsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fuserlevelpermissionsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fuserlevelpermissionsedit = currentForm = new ew.Form("fuserlevelpermissionsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "userlevelpermissions")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.userlevelpermissions)
        ew.vars.tables.userlevelpermissions = currentTable;
    fuserlevelpermissionsedit.addFields([
        ["userlevelid", [fields.userlevelid.visible && fields.userlevelid.required ? ew.Validators.required(fields.userlevelid.caption) : null, ew.Validators.integer], fields.userlevelid.isInvalid],
        ["_tablename", [fields._tablename.visible && fields._tablename.required ? ew.Validators.required(fields._tablename.caption) : null], fields._tablename.isInvalid],
        ["_permission", [fields._permission.visible && fields._permission.required ? ew.Validators.required(fields._permission.caption) : null, ew.Validators.integer], fields._permission.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fuserlevelpermissionsedit,
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
    fuserlevelpermissionsedit.validate = function () {
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
    fuserlevelpermissionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuserlevelpermissionsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fuserlevelpermissionsedit");
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
<form name="fuserlevelpermissionsedit" id="fuserlevelpermissionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
    <div id="r_userlevelid" class="form-group row">
        <label id="elh_userlevelpermissions_userlevelid" for="x_userlevelid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->userlevelid->caption() ?><?= $Page->userlevelid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->userlevelid->cellAttributes() ?>>
<input type="<?= $Page->userlevelid->getInputTextType() ?>" data-table="userlevelpermissions" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->userlevelid->getPlaceHolder()) ?>" value="<?= $Page->userlevelid->EditValue ?>"<?= $Page->userlevelid->editAttributes() ?> aria-describedby="x_userlevelid_help">
<?= $Page->userlevelid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->userlevelid->getErrorMessage() ?></div>
<input type="hidden" data-table="userlevelpermissions" data-field="x_userlevelid" data-hidden="1" name="o_userlevelid" id="o_userlevelid" value="<?= HtmlEncode($Page->userlevelid->OldValue ?? $Page->userlevelid->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_tablename->Visible) { // tablename ?>
    <div id="r__tablename" class="form-group row">
        <label id="elh_userlevelpermissions__tablename" for="x__tablename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_tablename->caption() ?><?= $Page->_tablename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_tablename->cellAttributes() ?>>
<input type="<?= $Page->_tablename->getInputTextType() ?>" data-table="userlevelpermissions" data-field="x__tablename" name="x__tablename" id="x__tablename" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->_tablename->getPlaceHolder()) ?>" value="<?= $Page->_tablename->EditValue ?>"<?= $Page->_tablename->editAttributes() ?> aria-describedby="x__tablename_help">
<?= $Page->_tablename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_tablename->getErrorMessage() ?></div>
<input type="hidden" data-table="userlevelpermissions" data-field="x__tablename" data-hidden="1" name="o__tablename" id="o__tablename" value="<?= HtmlEncode($Page->_tablename->OldValue ?? $Page->_tablename->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_permission->Visible) { // permission ?>
    <div id="r__permission" class="form-group row">
        <label id="elh_userlevelpermissions__permission" for="x__permission" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_permission->caption() ?><?= $Page->_permission->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_permission->cellAttributes() ?>>
<span id="el_userlevelpermissions__permission">
<input type="<?= $Page->_permission->getInputTextType() ?>" data-table="userlevelpermissions" data-field="x__permission" name="x__permission" id="x__permission" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->_permission->getPlaceHolder()) ?>" value="<?= $Page->_permission->EditValue ?>"<?= $Page->_permission->editAttributes() ?> aria-describedby="x__permission_help">
<?= $Page->_permission->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_permission->getErrorMessage() ?></div>
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
    ew.addEventHandlers("userlevelpermissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
