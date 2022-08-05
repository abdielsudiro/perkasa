<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RoAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var froadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    froadd = currentForm = new ew.Form("froadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "ro")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.ro)
        ew.vars.tables.ro = currentTable;
    froadd.addFields([
        ["kode_ro", [fields.kode_ro.visible && fields.kode_ro.required ? ew.Validators.required(fields.kode_ro.caption) : null], fields.kode_ro.isInvalid],
        ["kode_kro", [fields.kode_kro.visible && fields.kode_kro.required ? ew.Validators.required(fields.kode_kro.caption) : null], fields.kode_kro.isInvalid],
        ["nama_ro", [fields.nama_ro.visible && fields.nama_ro.required ? ew.Validators.required(fields.nama_ro.caption) : null], fields.nama_ro.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = froadd,
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
    froadd.validate = function () {
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
    froadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    froadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    froadd.lists.kode_kro = <?= $Page->kode_kro->toClientList($Page) ?>;
    loadjs.done("froadd");
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
<form name="froadd" id="froadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ro">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <div id="r_kode_ro" class="form-group row">
        <label id="elh_ro_kode_ro" for="x_kode_ro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_ro->caption() ?><?= $Page->kode_ro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_ro_kode_ro">
<input type="<?= $Page->kode_ro->getInputTextType() ?>" data-table="ro" data-field="x_kode_ro" name="x_kode_ro" id="x_kode_ro" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_ro->getPlaceHolder()) ?>" value="<?= $Page->kode_ro->EditValue ?>"<?= $Page->kode_ro->editAttributes() ?> aria-describedby="x_kode_ro_help">
<?= $Page->kode_ro->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_ro->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <div id="r_kode_kro" class="form-group row">
        <label id="elh_ro_kode_kro" for="x_kode_kro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kro->caption() ?><?= $Page->kode_kro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_ro_kode_kro">
    <select
        id="x_kode_kro"
        name="x_kode_kro"
        class="form-control ew-select<?= $Page->kode_kro->isInvalidClass() ?>"
        data-select2-id="ro_x_kode_kro"
        data-table="ro"
        data-field="x_kode_kro"
        data-value-separator="<?= $Page->kode_kro->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_kro->getPlaceHolder()) ?>"
        <?= $Page->kode_kro->editAttributes() ?>>
        <?= $Page->kode_kro->selectOptionListHtml("x_kode_kro") ?>
    </select>
    <?= $Page->kode_kro->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_kro->getErrorMessage() ?></div>
<?= $Page->kode_kro->Lookup->getParamTag($Page, "p_x_kode_kro") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='ro_x_kode_kro']"),
        options = { name: "x_kode_kro", selectId: "ro_x_kode_kro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.ro.fields.kode_kro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_ro->Visible) { // nama_ro ?>
    <div id="r_nama_ro" class="form-group row">
        <label id="elh_ro_nama_ro" for="x_nama_ro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_ro->caption() ?><?= $Page->nama_ro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_ro->cellAttributes() ?>>
<span id="el_ro_nama_ro">
<input type="<?= $Page->nama_ro->getInputTextType() ?>" data-table="ro" data-field="x_nama_ro" name="x_nama_ro" id="x_nama_ro" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_ro->getPlaceHolder()) ?>" value="<?= $Page->nama_ro->EditValue ?>"<?= $Page->nama_ro->editAttributes() ?> aria-describedby="x_nama_ro_help">
<?= $Page->nama_ro->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_ro->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_ro_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_ro_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="ro" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
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
    ew.addEventHandlers("ro");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
