<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestFileAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_fileadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    frequest_fileadd = currentForm = new ew.Form("frequest_fileadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_file")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_file)
        ew.vars.tables.request_file = currentTable;
    frequest_fileadd.addFields([
        ["request_file_id", [fields.request_file_id.visible && fields.request_file_id.required ? ew.Validators.required(fields.request_file_id.caption) : null, ew.Validators.integer], fields.request_file_id.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
        ["date_uploaded", [fields.date_uploaded.visible && fields.date_uploaded.required ? ew.Validators.required(fields.date_uploaded.caption) : null, ew.Validators.datetime(0)], fields.date_uploaded.isInvalid],
        ["file_name", [fields.file_name.visible && fields.file_name.required ? ew.Validators.required(fields.file_name.caption) : null], fields.file_name.isInvalid],
        ["file_content", [fields.file_content.visible && fields.file_content.required ? ew.Validators.required(fields.file_content.caption) : null], fields.file_content.isInvalid],
        ["mime_type", [fields.mime_type.visible && fields.mime_type.required ? ew.Validators.required(fields.mime_type.caption) : null], fields.mime_type.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_fileadd,
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
    frequest_fileadd.validate = function () {
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
    frequest_fileadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_fileadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frequest_fileadd");
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
<form name="frequest_fileadd" id="frequest_fileadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_file">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "request2") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="request2">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->request_file_id->Visible) { // request_file_id ?>
    <div id="r_request_file_id" class="form-group row">
        <label id="elh_request_file_request_file_id" for="x_request_file_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_file_id->caption() ?><?= $Page->request_file_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_file_id->cellAttributes() ?>>
<span id="el_request_file_request_file_id">
<input type="<?= $Page->request_file_id->getInputTextType() ?>" data-table="request_file" data-field="x_request_file_id" name="x_request_file_id" id="x_request_file_id" size="30" placeholder="<?= HtmlEncode($Page->request_file_id->getPlaceHolder()) ?>" value="<?= $Page->request_file_id->EditValue ?>"<?= $Page->request_file_id->editAttributes() ?> aria-describedby="x_request_file_id_help">
<?= $Page->request_file_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_file_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id" class="form-group row">
        <label id="elh_request_file_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->request_id->getSessionValue() != "") { ?>
<span id="el_request_file_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_request_id" name="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_request_file_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" data-table="request_file" data-field="x_request_id" name="x_request_id" id="x_request_id" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" value="<?= $Page->request_id->EditValue ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id" class="form-group row">
        <label id="elh_request_file_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request_file_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" data-table="request_file" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" value="<?= $Page->user_id->EditValue ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_uploaded->Visible) { // date_uploaded ?>
    <div id="r_date_uploaded" class="form-group row">
        <label id="elh_request_file_date_uploaded" for="x_date_uploaded" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_uploaded->caption() ?><?= $Page->date_uploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date_uploaded->cellAttributes() ?>>
<span id="el_request_file_date_uploaded">
<input type="<?= $Page->date_uploaded->getInputTextType() ?>" data-table="request_file" data-field="x_date_uploaded" name="x_date_uploaded" id="x_date_uploaded" placeholder="<?= HtmlEncode($Page->date_uploaded->getPlaceHolder()) ?>" value="<?= $Page->date_uploaded->EditValue ?>"<?= $Page->date_uploaded->editAttributes() ?> aria-describedby="x_date_uploaded_help">
<?= $Page->date_uploaded->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_uploaded->getErrorMessage() ?></div>
<?php if (!$Page->date_uploaded->ReadOnly && !$Page->date_uploaded->Disabled && !isset($Page->date_uploaded->EditAttrs["readonly"]) && !isset($Page->date_uploaded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frequest_fileadd", "datetimepicker"], function() {
    ew.createDateTimePicker("frequest_fileadd", "x_date_uploaded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
    <div id="r_file_name" class="form-group row">
        <label id="elh_request_file_file_name" for="x_file_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_name->caption() ?><?= $Page->file_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->file_name->cellAttributes() ?>>
<span id="el_request_file_file_name">
<input type="<?= $Page->file_name->getInputTextType() ?>" data-table="request_file" data-field="x_file_name" name="x_file_name" id="x_file_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->file_name->getPlaceHolder()) ?>" value="<?= $Page->file_name->EditValue ?>"<?= $Page->file_name->editAttributes() ?> aria-describedby="x_file_name_help">
<?= $Page->file_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_content->Visible) { // file_content ?>
    <div id="r_file_content" class="form-group row">
        <label id="elh_request_file_file_content" for="x_file_content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_content->caption() ?><?= $Page->file_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->file_content->cellAttributes() ?>>
<span id="el_request_file_file_content">
<input type="<?= $Page->file_content->getInputTextType() ?>" data-table="request_file" data-field="x_file_content" name="x_file_content" id="x_file_content" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->file_content->getPlaceHolder()) ?>" value="<?= $Page->file_content->EditValue ?>"<?= $Page->file_content->editAttributes() ?> aria-describedby="x_file_content_help">
<?= $Page->file_content->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_content->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mime_type->Visible) { // mime_type ?>
    <div id="r_mime_type" class="form-group row">
        <label id="elh_request_file_mime_type" for="x_mime_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mime_type->caption() ?><?= $Page->mime_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mime_type->cellAttributes() ?>>
<span id="el_request_file_mime_type">
<input type="<?= $Page->mime_type->getInputTextType() ?>" data-table="request_file" data-field="x_mime_type" name="x_mime_type" id="x_mime_type" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->mime_type->getPlaceHolder()) ?>" value="<?= $Page->mime_type->EditValue ?>"<?= $Page->mime_type->editAttributes() ?> aria-describedby="x_mime_type_help">
<?= $Page->mime_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mime_type->getErrorMessage() ?></div>
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
    ew.addEventHandlers("request_file");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
