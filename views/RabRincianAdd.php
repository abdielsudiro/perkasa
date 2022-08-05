<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabRincianAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_rincianadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    frab_rincianadd = currentForm = new ew.Form("frab_rincianadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_rincian")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_rincian)
        ew.vars.tables.rab_rincian = currentTable;
    frab_rincianadd.addFields([
        ["uraian", [fields.uraian.visible && fields.uraian.required ? ew.Validators.required(fields.uraian.caption) : null], fields.uraian.isInvalid],
        ["volum", [fields.volum.visible && fields.volum.required ? ew.Validators.required(fields.volum.caption) : null, ew.Validators.integer], fields.volum.isInvalid],
        ["satuan", [fields.satuan.visible && fields.satuan.required ? ew.Validators.required(fields.satuan.caption) : null], fields.satuan.isInvalid],
        ["sbm", [fields.sbm.visible && fields.sbm.required ? ew.Validators.required(fields.sbm.caption) : null, ew.Validators.float], fields.sbm.isInvalid],
        ["kode_akun", [fields.kode_akun.visible && fields.kode_akun.required ? ew.Validators.required(fields.kode_akun.caption) : null], fields.kode_akun.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frab_rincianadd,
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
    frab_rincianadd.validate = function () {
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
    frab_rincianadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_rincianadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frab_rincianadd.lists.kode_akun = <?= $Page->kode_akun->toClientList($Page) ?>;
    loadjs.done("frab_rincianadd");
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
<form name="frab_rincianadd" id="frab_rincianadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_rincian">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "rab") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="rab">
<input type="hidden" name="fk_id_rab" value="<?= HtmlEncode($Page->id_rab->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->uraian->Visible) { // uraian ?>
    <div id="r_uraian" class="form-group row">
        <label id="elh_rab_rincian_uraian" for="x_uraian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uraian->caption() ?><?= $Page->uraian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->uraian->cellAttributes() ?>>
<span id="el_rab_rincian_uraian">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="rab_rincian" data-field="x_uraian" name="x_uraian" id="x_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?> aria-describedby="x_uraian_help">
<?= $Page->uraian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <div id="r_volum" class="form-group row">
        <label id="elh_rab_rincian_volum" for="x_volum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->volum->caption() ?><?= $Page->volum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->volum->cellAttributes() ?>>
<span id="el_rab_rincian_volum">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="rab_rincian" data-field="x_volum" name="x_volum" id="x_volum" size="10" maxlength="5" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?> aria-describedby="x_volum_help">
<?= $Page->volum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
    <div id="r_satuan" class="form-group row">
        <label id="elh_rab_rincian_satuan" for="x_satuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satuan->caption() ?><?= $Page->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satuan->cellAttributes() ?>>
<span id="el_rab_rincian_satuan">
<input type="<?= $Page->satuan->getInputTextType() ?>" data-table="rab_rincian" data-field="x_satuan" name="x_satuan" id="x_satuan" size="15" maxlength="15" placeholder="<?= HtmlEncode($Page->satuan->getPlaceHolder()) ?>" value="<?= $Page->satuan->EditValue ?>"<?= $Page->satuan->editAttributes() ?> aria-describedby="x_satuan_help">
<?= $Page->satuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->satuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <div id="r_sbm" class="form-group row">
        <label id="elh_rab_rincian_sbm" for="x_sbm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sbm->caption() ?><?= $Page->sbm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sbm->cellAttributes() ?>>
<span id="el_rab_rincian_sbm">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="rab_rincian" data-field="x_sbm" name="x_sbm" id="x_sbm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?> aria-describedby="x_sbm_help">
<?= $Page->sbm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sbm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
    <div id="r_kode_akun" class="form-group row">
        <label id="elh_rab_rincian_kode_akun" for="x_kode_akun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_akun->caption() ?><?= $Page->kode_akun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el_rab_rincian_kode_akun">
    <select
        id="x_kode_akun"
        name="x_kode_akun"
        class="form-control ew-select<?= $Page->kode_akun->isInvalidClass() ?>"
        data-select2-id="rab_rincian_x_kode_akun"
        data-table="rab_rincian"
        data-field="x_kode_akun"
        data-value-separator="<?= $Page->kode_akun->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_akun->getPlaceHolder()) ?>"
        <?= $Page->kode_akun->editAttributes() ?>>
        <?= $Page->kode_akun->selectOptionListHtml("x_kode_akun") ?>
    </select>
    <?= $Page->kode_akun->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_akun->getErrorMessage() ?></div>
<?= $Page->kode_akun->Lookup->getParamTag($Page, "p_x_kode_akun") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_rincian_x_kode_akun']"),
        options = { name: "x_kode_akun", selectId: "rab_rincian_x_kode_akun", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_rincian.fields.kode_akun.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->id_rab->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_id_rab" id="x_id_rab" value="<?= HtmlEncode(strval($Page->id_rab->getSessionValue())) ?>">
    <?php } ?>
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
    ew.addEventHandlers("rab_rincian");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
