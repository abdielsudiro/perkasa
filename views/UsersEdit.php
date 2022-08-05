<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UsersEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusersedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fusersedit = currentForm = new ew.Form("fusersedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "users")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.users)
        ew.vars.tables.users = currentTable;
    fusersedit.addFields([
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
        ["user_level_permission_id", [fields.user_level_permission_id.visible && fields.user_level_permission_id.required ? ew.Validators.required(fields.user_level_permission_id.caption) : null], fields.user_level_permission_id.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["nama_lengkap", [fields.nama_lengkap.visible && fields.nama_lengkap.required ? ew.Validators.required(fields.nama_lengkap.caption) : null], fields.nama_lengkap.isInvalid],
        ["satker", [fields.satker.visible && fields.satker.required ? ew.Validators.required(fields.satker.caption) : null], fields.satker.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fusersedit,
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
    fusersedit.validate = function () {
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
    fusersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusersedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fusersedit.lists.user_level_permission_id = <?= $Page->user_level_permission_id->toClientList($Page) ?>;
    fusersedit.lists.satker = <?= $Page->satker->toClientList($Page) ?>;
    loadjs.done("fusersedit");
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
<form name="fusersedit" id="fusersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id" class="form-group row">
        <label id="elh_users_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_id->cellAttributes() ?>>
<input type="<?= $Page->user_id->getInputTextType() ?>" data-table="users" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" value="<?= $Page->user_id->EditValue ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
<input type="hidden" data-table="users" data-field="x_user_id" data-hidden="1" name="o_user_id" id="o_user_id" value="<?= HtmlEncode($Page->user_id->OldValue ?? $Page->user_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_level_permission_id->Visible) { // user_level_permission_id ?>
    <div id="r_user_level_permission_id" class="form-group row">
        <label id="elh_users_user_level_permission_id" for="x_user_level_permission_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_level_permission_id->caption() ?><?= $Page->user_level_permission_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_level_permission_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_user_level_permission_id">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->user_level_permission_id->getDisplayValue($Page->user_level_permission_id->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_users_user_level_permission_id">
    <select
        id="x_user_level_permission_id"
        name="x_user_level_permission_id"
        class="form-control ew-select<?= $Page->user_level_permission_id->isInvalidClass() ?>"
        data-select2-id="users_x_user_level_permission_id"
        data-table="users"
        data-field="x_user_level_permission_id"
        data-value-separator="<?= $Page->user_level_permission_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->user_level_permission_id->getPlaceHolder()) ?>"
        <?= $Page->user_level_permission_id->editAttributes() ?>>
        <?= $Page->user_level_permission_id->selectOptionListHtml("x_user_level_permission_id") ?>
    </select>
    <?= $Page->user_level_permission_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->user_level_permission_id->getErrorMessage() ?></div>
<?= $Page->user_level_permission_id->Lookup->getParamTag($Page, "p_x_user_level_permission_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='users_x_user_level_permission_id']"),
        options = { name: "x_user_level_permission_id", selectId: "users_x_user_level_permission_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.users.fields.user_level_permission_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_users__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_users__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="users" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<div class="input-group">
    <input type="password" name="x__password" id="x__password" autocomplete="new-password" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password rounded-right" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_lengkap->Visible) { // nama_lengkap ?>
    <div id="r_nama_lengkap" class="form-group row">
        <label id="elh_users_nama_lengkap" for="x_nama_lengkap" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_lengkap->caption() ?><?= $Page->nama_lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_lengkap->cellAttributes() ?>>
<span id="el_users_nama_lengkap">
<input type="<?= $Page->nama_lengkap->getInputTextType() ?>" data-table="users" data-field="x_nama_lengkap" name="x_nama_lengkap" id="x_nama_lengkap" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_lengkap->getPlaceHolder()) ?>" value="<?= $Page->nama_lengkap->EditValue ?>"<?= $Page->nama_lengkap->editAttributes() ?> aria-describedby="x_nama_lengkap_help">
<?= $Page->nama_lengkap->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_lengkap->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->satker->Visible) { // satker ?>
    <div id="r_satker" class="form-group row">
        <label id="elh_users_satker" for="x_satker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satker->caption() ?><?= $Page->satker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satker->cellAttributes() ?>>
<span id="el_users_satker">
    <select
        id="x_satker"
        name="x_satker"
        class="form-control ew-select<?= $Page->satker->isInvalidClass() ?>"
        data-select2-id="users_x_satker"
        data-table="users"
        data-field="x_satker"
        data-value-separator="<?= $Page->satker->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->satker->getPlaceHolder()) ?>"
        <?= $Page->satker->editAttributes() ?>>
        <?= $Page->satker->selectOptionListHtml("x_satker") ?>
    </select>
    <?= $Page->satker->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->satker->getErrorMessage() ?></div>
<?= $Page->satker->Lookup->getParamTag($Page, "p_x_satker") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='users_x_satker']"),
        options = { name: "x_satker", selectId: "users_x_satker", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.users.fields.satker.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip" class="form-group row">
        <label id="elh_users_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nip->cellAttributes() ?>>
<span id="el_users_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" data-table="users" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>" value="<?= $Page->nip->EditValue ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
