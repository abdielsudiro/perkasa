<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KegiatanAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkegiatanadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fkegiatanadd = currentForm = new ew.Form("fkegiatanadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "kegiatan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.kegiatan)
        ew.vars.tables.kegiatan = currentTable;
    fkegiatanadd.addFields([
        ["kode_kegiatan", [fields.kode_kegiatan.visible && fields.kode_kegiatan.required ? ew.Validators.required(fields.kode_kegiatan.caption) : null], fields.kode_kegiatan.isInvalid],
        ["kode_program", [fields.kode_program.visible && fields.kode_program.required ? ew.Validators.required(fields.kode_program.caption) : null], fields.kode_program.isInvalid],
        ["nama_kegiatan", [fields.nama_kegiatan.visible && fields.nama_kegiatan.required ? ew.Validators.required(fields.nama_kegiatan.caption) : null], fields.nama_kegiatan.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkegiatanadd,
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
    fkegiatanadd.validate = function () {
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
    fkegiatanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkegiatanadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkegiatanadd.lists.kode_program = <?= $Page->kode_program->toClientList($Page) ?>;
    loadjs.done("fkegiatanadd");
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
<form name="fkegiatanadd" id="fkegiatanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kegiatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <div id="r_kode_kegiatan" class="form-group row">
        <label id="elh_kegiatan_kode_kegiatan" for="x_kode_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kegiatan->caption() ?><?= $Page->kode_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_kegiatan_kode_kegiatan">
<input type="<?= $Page->kode_kegiatan->getInputTextType() ?>" data-table="kegiatan" data-field="x_kode_kegiatan" name="x_kode_kegiatan" id="x_kode_kegiatan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_kegiatan->getPlaceHolder()) ?>" value="<?= $Page->kode_kegiatan->EditValue ?>"<?= $Page->kode_kegiatan->editAttributes() ?> aria-describedby="x_kode_kegiatan_help">
<?= $Page->kode_kegiatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_kegiatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_program->Visible) { // kode_program ?>
    <div id="r_kode_program" class="form-group row">
        <label id="elh_kegiatan_kode_program" for="x_kode_program" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_program->caption() ?><?= $Page->kode_program->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_program->cellAttributes() ?>>
<span id="el_kegiatan_kode_program">
    <select
        id="x_kode_program"
        name="x_kode_program"
        class="form-control ew-select<?= $Page->kode_program->isInvalidClass() ?>"
        data-select2-id="kegiatan_x_kode_program"
        data-table="kegiatan"
        data-field="x_kode_program"
        data-value-separator="<?= $Page->kode_program->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_program->getPlaceHolder()) ?>"
        <?= $Page->kode_program->editAttributes() ?>>
        <?= $Page->kode_program->selectOptionListHtml("x_kode_program") ?>
    </select>
    <?= $Page->kode_program->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_program->getErrorMessage() ?></div>
<?= $Page->kode_program->Lookup->getParamTag($Page, "p_x_kode_program") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='kegiatan_x_kode_program']"),
        options = { name: "x_kode_program", selectId: "kegiatan_x_kode_program", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.kegiatan.fields.kode_program.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_kegiatan->Visible) { // nama_kegiatan ?>
    <div id="r_nama_kegiatan" class="form-group row">
        <label id="elh_kegiatan_nama_kegiatan" for="x_nama_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_kegiatan->caption() ?><?= $Page->nama_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_kegiatan->cellAttributes() ?>>
<span id="el_kegiatan_nama_kegiatan">
<input type="<?= $Page->nama_kegiatan->getInputTextType() ?>" data-table="kegiatan" data-field="x_nama_kegiatan" name="x_nama_kegiatan" id="x_nama_kegiatan" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_kegiatan->getPlaceHolder()) ?>" value="<?= $Page->nama_kegiatan->EditValue ?>"<?= $Page->nama_kegiatan->editAttributes() ?> aria-describedby="x_nama_kegiatan_help">
<?= $Page->nama_kegiatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_kegiatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_kegiatan_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_kegiatan_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="kegiatan" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("kegiatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
