<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KroAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkroadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fkroadd = currentForm = new ew.Form("fkroadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "kro")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.kro)
        ew.vars.tables.kro = currentTable;
    fkroadd.addFields([
        ["kode_kro", [fields.kode_kro.visible && fields.kode_kro.required ? ew.Validators.required(fields.kode_kro.caption) : null], fields.kode_kro.isInvalid],
        ["kode_kegiatan", [fields.kode_kegiatan.visible && fields.kode_kegiatan.required ? ew.Validators.required(fields.kode_kegiatan.caption) : null], fields.kode_kegiatan.isInvalid],
        ["nama_kro", [fields.nama_kro.visible && fields.nama_kro.required ? ew.Validators.required(fields.nama_kro.caption) : null], fields.nama_kro.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkroadd,
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
    fkroadd.validate = function () {
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
    fkroadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkroadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkroadd.lists.kode_kegiatan = <?= $Page->kode_kegiatan->toClientList($Page) ?>;
    loadjs.done("fkroadd");
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
<form name="fkroadd" id="fkroadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kro">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <div id="r_kode_kro" class="form-group row">
        <label id="elh_kro_kode_kro" for="x_kode_kro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kro->caption() ?><?= $Page->kode_kro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_kro_kode_kro">
<input type="<?= $Page->kode_kro->getInputTextType() ?>" data-table="kro" data-field="x_kode_kro" name="x_kode_kro" id="x_kode_kro" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_kro->getPlaceHolder()) ?>" value="<?= $Page->kode_kro->EditValue ?>"<?= $Page->kode_kro->editAttributes() ?> aria-describedby="x_kode_kro_help">
<?= $Page->kode_kro->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_kro->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <div id="r_kode_kegiatan" class="form-group row">
        <label id="elh_kro_kode_kegiatan" for="x_kode_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kegiatan->caption() ?><?= $Page->kode_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_kro_kode_kegiatan">
    <select
        id="x_kode_kegiatan"
        name="x_kode_kegiatan"
        class="form-control ew-select<?= $Page->kode_kegiatan->isInvalidClass() ?>"
        data-select2-id="kro_x_kode_kegiatan"
        data-table="kro"
        data-field="x_kode_kegiatan"
        data-value-separator="<?= $Page->kode_kegiatan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_kegiatan->getPlaceHolder()) ?>"
        <?= $Page->kode_kegiatan->editAttributes() ?>>
        <?= $Page->kode_kegiatan->selectOptionListHtml("x_kode_kegiatan") ?>
    </select>
    <?= $Page->kode_kegiatan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_kegiatan->getErrorMessage() ?></div>
<?= $Page->kode_kegiatan->Lookup->getParamTag($Page, "p_x_kode_kegiatan") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='kro_x_kode_kegiatan']"),
        options = { name: "x_kode_kegiatan", selectId: "kro_x_kode_kegiatan", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.kro.fields.kode_kegiatan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_kro->Visible) { // nama_kro ?>
    <div id="r_nama_kro" class="form-group row">
        <label id="elh_kro_nama_kro" for="x_nama_kro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_kro->caption() ?><?= $Page->nama_kro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_kro->cellAttributes() ?>>
<span id="el_kro_nama_kro">
<input type="<?= $Page->nama_kro->getInputTextType() ?>" data-table="kro" data-field="x_nama_kro" name="x_nama_kro" id="x_nama_kro" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_kro->getPlaceHolder()) ?>" value="<?= $Page->nama_kro->EditValue ?>"<?= $Page->nama_kro->editAttributes() ?> aria-describedby="x_nama_kro_help">
<?= $Page->nama_kro->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_kro->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_kro_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_kro_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="kro" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
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
    ew.addEventHandlers("kro");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
