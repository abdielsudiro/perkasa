<?php

namespace PHPMaker2021\perkasa2;

// Page object
$KomponenAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkomponenadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fkomponenadd = currentForm = new ew.Form("fkomponenadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "komponen")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.komponen)
        ew.vars.tables.komponen = currentTable;
    fkomponenadd.addFields([
        ["kode_komponen", [fields.kode_komponen.visible && fields.kode_komponen.required ? ew.Validators.required(fields.kode_komponen.caption) : null], fields.kode_komponen.isInvalid],
        ["kode_ro", [fields.kode_ro.visible && fields.kode_ro.required ? ew.Validators.required(fields.kode_ro.caption) : null], fields.kode_ro.isInvalid],
        ["nama_komponen", [fields.nama_komponen.visible && fields.nama_komponen.required ? ew.Validators.required(fields.nama_komponen.caption) : null], fields.nama_komponen.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkomponenadd,
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
    fkomponenadd.validate = function () {
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
    fkomponenadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkomponenadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkomponenadd.lists.kode_ro = <?= $Page->kode_ro->toClientList($Page) ?>;
    loadjs.done("fkomponenadd");
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
<form name="fkomponenadd" id="fkomponenadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komponen">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <div id="r_kode_komponen" class="form-group row">
        <label id="elh_komponen_kode_komponen" for="x_kode_komponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_komponen->caption() ?><?= $Page->kode_komponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_komponen_kode_komponen">
<input type="<?= $Page->kode_komponen->getInputTextType() ?>" data-table="komponen" data-field="x_kode_komponen" name="x_kode_komponen" id="x_kode_komponen" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_komponen->getPlaceHolder()) ?>" value="<?= $Page->kode_komponen->EditValue ?>"<?= $Page->kode_komponen->editAttributes() ?> aria-describedby="x_kode_komponen_help">
<?= $Page->kode_komponen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_komponen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <div id="r_kode_ro" class="form-group row">
        <label id="elh_komponen_kode_ro" for="x_kode_ro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_ro->caption() ?><?= $Page->kode_ro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_komponen_kode_ro">
    <select
        id="x_kode_ro"
        name="x_kode_ro"
        class="form-control ew-select<?= $Page->kode_ro->isInvalidClass() ?>"
        data-select2-id="komponen_x_kode_ro"
        data-table="komponen"
        data-field="x_kode_ro"
        data-value-separator="<?= $Page->kode_ro->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_ro->getPlaceHolder()) ?>"
        <?= $Page->kode_ro->editAttributes() ?>>
        <?= $Page->kode_ro->selectOptionListHtml("x_kode_ro") ?>
    </select>
    <?= $Page->kode_ro->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_ro->getErrorMessage() ?></div>
<?= $Page->kode_ro->Lookup->getParamTag($Page, "p_x_kode_ro") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='komponen_x_kode_ro']"),
        options = { name: "x_kode_ro", selectId: "komponen_x_kode_ro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.komponen.fields.kode_ro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_komponen->Visible) { // nama_komponen ?>
    <div id="r_nama_komponen" class="form-group row">
        <label id="elh_komponen_nama_komponen" for="x_nama_komponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_komponen->caption() ?><?= $Page->nama_komponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_komponen->cellAttributes() ?>>
<span id="el_komponen_nama_komponen">
<input type="<?= $Page->nama_komponen->getInputTextType() ?>" data-table="komponen" data-field="x_nama_komponen" name="x_nama_komponen" id="x_nama_komponen" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_komponen->getPlaceHolder()) ?>" value="<?= $Page->nama_komponen->EditValue ?>"<?= $Page->nama_komponen->editAttributes() ?> aria-describedby="x_nama_komponen_help">
<?= $Page->nama_komponen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_komponen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_komponen_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_komponen_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="komponen" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
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
    ew.addEventHandlers("komponen");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
