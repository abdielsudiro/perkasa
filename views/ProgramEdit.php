<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ProgramEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fprogramedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fprogramedit = currentForm = new ew.Form("fprogramedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "program")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.program)
        ew.vars.tables.program = currentTable;
    fprogramedit.addFields([
        ["kode_program", [fields.kode_program.visible && fields.kode_program.required ? ew.Validators.required(fields.kode_program.caption) : null], fields.kode_program.isInvalid],
        ["nama_program", [fields.nama_program.visible && fields.nama_program.required ? ew.Validators.required(fields.nama_program.caption) : null], fields.nama_program.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fprogramedit,
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
    fprogramedit.validate = function () {
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
    fprogramedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fprogramedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fprogramedit");
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
<form name="fprogramedit" id="fprogramedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="program">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->kode_program->Visible) { // kode_program ?>
    <div id="r_kode_program" class="form-group row">
        <label id="elh_program_kode_program" for="x_kode_program" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_program->caption() ?><?= $Page->kode_program->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_program->cellAttributes() ?>>
<span id="el_program_kode_program">
<input type="<?= $Page->kode_program->getInputTextType() ?>" data-table="program" data-field="x_kode_program" name="x_kode_program" id="x_kode_program" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_program->getPlaceHolder()) ?>" value="<?= $Page->kode_program->EditValue ?>"<?= $Page->kode_program->editAttributes() ?> aria-describedby="x_kode_program_help">
<?= $Page->kode_program->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_program->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_program->Visible) { // nama_program ?>
    <div id="r_nama_program" class="form-group row">
        <label id="elh_program_nama_program" for="x_nama_program" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_program->caption() ?><?= $Page->nama_program->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_program->cellAttributes() ?>>
<span id="el_program_nama_program">
<input type="<?= $Page->nama_program->getInputTextType() ?>" data-table="program" data-field="x_nama_program" name="x_nama_program" id="x_nama_program" size="80" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_program->getPlaceHolder()) ?>" value="<?= $Page->nama_program->EditValue ?>"<?= $Page->nama_program->editAttributes() ?> aria-describedby="x_nama_program_help">
<?= $Page->nama_program->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_program->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_program_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<input type="<?= $Page->id->getInputTextType() ?>" data-table="program" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="program" data-field="x_id" data-hidden="1" name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("program");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
