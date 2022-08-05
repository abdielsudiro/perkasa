<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubAkunAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsub_akunadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fsub_akunadd = currentForm = new ew.Form("fsub_akunadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "sub_akun")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.sub_akun)
        ew.vars.tables.sub_akun = currentTable;
    fsub_akunadd.addFields([
        ["detail_id", [fields.detail_id.visible && fields.detail_id.required ? ew.Validators.required(fields.detail_id.caption) : null, ew.Validators.integer], fields.detail_id.isInvalid],
        ["kode_akun", [fields.kode_akun.visible && fields.kode_akun.required ? ew.Validators.required(fields.kode_akun.caption) : null], fields.kode_akun.isInvalid],
        ["detail", [fields.detail.visible && fields.detail.required ? ew.Validators.required(fields.detail.caption) : null], fields.detail.isInvalid],
        ["volum", [fields.volum.visible && fields.volum.required ? ew.Validators.required(fields.volum.caption) : null, ew.Validators.float], fields.volum.isInvalid],
        ["sbm", [fields.sbm.visible && fields.sbm.required ? ew.Validators.required(fields.sbm.caption) : null, ew.Validators.float], fields.sbm.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsub_akunadd,
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
    fsub_akunadd.validate = function () {
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
    fsub_akunadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsub_akunadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fsub_akunadd");
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
<form name="fsub_akunadd" id="fsub_akunadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sub_akun">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->detail_id->Visible) { // detail_id ?>
    <div id="r_detail_id" class="form-group row">
        <label id="elh_sub_akun_detail_id" for="x_detail_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->detail_id->caption() ?><?= $Page->detail_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->detail_id->cellAttributes() ?>>
<span id="el_sub_akun_detail_id">
<input type="<?= $Page->detail_id->getInputTextType() ?>" data-table="sub_akun" data-field="x_detail_id" name="x_detail_id" id="x_detail_id" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->detail_id->getPlaceHolder()) ?>" value="<?= $Page->detail_id->EditValue ?>"<?= $Page->detail_id->editAttributes() ?> aria-describedby="x_detail_id_help">
<?= $Page->detail_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->detail_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
    <div id="r_kode_akun" class="form-group row">
        <label id="elh_sub_akun_kode_akun" for="x_kode_akun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_akun->caption() ?><?= $Page->kode_akun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_akun->cellAttributes() ?>>
<span id="el_sub_akun_kode_akun">
<input type="<?= $Page->kode_akun->getInputTextType() ?>" data-table="sub_akun" data-field="x_kode_akun" name="x_kode_akun" id="x_kode_akun" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_akun->getPlaceHolder()) ?>" value="<?= $Page->kode_akun->EditValue ?>"<?= $Page->kode_akun->editAttributes() ?> aria-describedby="x_kode_akun_help">
<?= $Page->kode_akun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_akun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <div id="r_detail" class="form-group row">
        <label id="elh_sub_akun_detail" for="x_detail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->detail->caption() ?><?= $Page->detail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->detail->cellAttributes() ?>>
<span id="el_sub_akun_detail">
<textarea data-table="sub_akun" data-field="x_detail" name="x_detail" id="x_detail" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->detail->getPlaceHolder()) ?>"<?= $Page->detail->editAttributes() ?> aria-describedby="x_detail_help"><?= $Page->detail->EditValue ?></textarea>
<?= $Page->detail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->detail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <div id="r_volum" class="form-group row">
        <label id="elh_sub_akun_volum" for="x_volum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->volum->caption() ?><?= $Page->volum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->volum->cellAttributes() ?>>
<span id="el_sub_akun_volum">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="sub_akun" data-field="x_volum" name="x_volum" id="x_volum" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?> aria-describedby="x_volum_help">
<?= $Page->volum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <div id="r_sbm" class="form-group row">
        <label id="elh_sub_akun_sbm" for="x_sbm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sbm->caption() ?><?= $Page->sbm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sbm->cellAttributes() ?>>
<span id="el_sub_akun_sbm">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="sub_akun" data-field="x_sbm" name="x_sbm" id="x_sbm" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?> aria-describedby="x_sbm_help">
<?= $Page->sbm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sbm->getErrorMessage() ?></div>
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
    ew.addEventHandlers("sub_akun");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
