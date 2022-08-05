<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabFileEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_fileedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frab_fileedit = currentForm = new ew.Form("frab_fileedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_file")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_file)
        ew.vars.tables.rab_file = currentTable;
    frab_fileedit.addFields([
        ["id_rab_file", [fields.id_rab_file.visible && fields.id_rab_file.required ? ew.Validators.required(fields.id_rab_file.caption) : null], fields.id_rab_file.isInvalid],
        ["filename", [fields.filename.visible && fields.filename.required ? ew.Validators.fileRequired(fields.filename.caption) : null], fields.filename.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frab_fileedit,
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
    frab_fileedit.validate = function () {
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
    frab_fileedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_fileedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frab_fileedit");
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
<form name="frab_fileedit" id="frab_fileedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_file">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "rab") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rab">
<input type="hidden" name="fk_id_rab" value="<?= HtmlEncode($Page->id_rab->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_rab_file->Visible) { // id_rab_file ?>
    <div id="r_id_rab_file" class="form-group row">
        <label id="elh_rab_file_id_rab_file" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_rab_file->caption() ?><?= $Page->id_rab_file->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_rab_file->cellAttributes() ?>>
<span id="el_rab_file_id_rab_file">
<span<?= $Page->id_rab_file->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_rab_file->getDisplayValue($Page->id_rab_file->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_file" data-field="x_id_rab_file" data-hidden="1" name="x_id_rab_file" id="x_id_rab_file" value="<?= HtmlEncode($Page->id_rab_file->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <div id="r_filename" class="form-group row">
        <label id="elh_rab_file_filename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->filename->caption() ?><?= $Page->filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->filename->cellAttributes() ?>>
<span id="el_rab_file_filename">
<div id="fd_x_filename">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->filename->title() ?>" data-table="rab_file" data-field="x_filename" name="x_filename" id="x_filename" lang="<?= CurrentLanguageID() ?>"<?= $Page->filename->editAttributes() ?><?= ($Page->filename->ReadOnly || $Page->filename->Disabled) ? " disabled" : "" ?> aria-describedby="x_filename_help">
        <label class="custom-file-label ew-file-label" for="x_filename"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->filename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->filename->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_filename" id= "fn_x_filename" value="<?= $Page->filename->Upload->FileName ?>">
<input type="hidden" name="fa_x_filename" id= "fa_x_filename" value="<?= (Post("fa_x_filename") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_filename" id= "fs_x_filename" value="150">
<input type="hidden" name="fx_x_filename" id= "fx_x_filename" value="<?= $Page->filename->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_filename" id= "fm_x_filename" value="<?= $Page->filename->UploadMaxFileSize ?>">
</div>
<table id="ft_x_filename" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("rab_file");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
