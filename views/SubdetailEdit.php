<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubdetailEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsubdetailedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fsubdetailedit = currentForm = new ew.Form("fsubdetailedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "subdetail")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.subdetail)
        ew.vars.tables.subdetail = currentTable;
    fsubdetailedit.addFields([
        ["subdetail_id", [fields.subdetail_id.visible && fields.subdetail_id.required ? ew.Validators.required(fields.subdetail_id.caption) : null, ew.Validators.integer], fields.subdetail_id.isInvalid],
        ["id_detail", [fields.id_detail.visible && fields.id_detail.required ? ew.Validators.required(fields.id_detail.caption) : null, ew.Validators.integer], fields.id_detail.isInvalid],
        ["detail", [fields.detail.visible && fields.detail.required ? ew.Validators.required(fields.detail.caption) : null], fields.detail.isInvalid],
        ["volum", [fields.volum.visible && fields.volum.required ? ew.Validators.required(fields.volum.caption) : null, ew.Validators.float], fields.volum.isInvalid],
        ["sbm", [fields.sbm.visible && fields.sbm.required ? ew.Validators.required(fields.sbm.caption) : null, ew.Validators.float], fields.sbm.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsubdetailedit,
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
    fsubdetailedit.validate = function () {
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
    fsubdetailedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsubdetailedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fsubdetailedit");
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
<form name="fsubdetailedit" id="fsubdetailedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subdetail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->subdetail_id->Visible) { // subdetail_id ?>
    <div id="r_subdetail_id" class="form-group row">
        <label id="elh_subdetail_subdetail_id" for="x_subdetail_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subdetail_id->caption() ?><?= $Page->subdetail_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subdetail_id->cellAttributes() ?>>
<input type="<?= $Page->subdetail_id->getInputTextType() ?>" data-table="subdetail" data-field="x_subdetail_id" name="x_subdetail_id" id="x_subdetail_id" size="30" placeholder="<?= HtmlEncode($Page->subdetail_id->getPlaceHolder()) ?>" value="<?= $Page->subdetail_id->EditValue ?>"<?= $Page->subdetail_id->editAttributes() ?> aria-describedby="x_subdetail_id_help">
<?= $Page->subdetail_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subdetail_id->getErrorMessage() ?></div>
<input type="hidden" data-table="subdetail" data-field="x_subdetail_id" data-hidden="1" name="o_subdetail_id" id="o_subdetail_id" value="<?= HtmlEncode($Page->subdetail_id->OldValue ?? $Page->subdetail_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_detail->Visible) { // id_detail ?>
    <div id="r_id_detail" class="form-group row">
        <label id="elh_subdetail_id_detail" for="x_id_detail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_detail->caption() ?><?= $Page->id_detail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_detail->cellAttributes() ?>>
<span id="el_subdetail_id_detail">
<input type="<?= $Page->id_detail->getInputTextType() ?>" data-table="subdetail" data-field="x_id_detail" name="x_id_detail" id="x_id_detail" size="30" placeholder="<?= HtmlEncode($Page->id_detail->getPlaceHolder()) ?>" value="<?= $Page->id_detail->EditValue ?>"<?= $Page->id_detail->editAttributes() ?> aria-describedby="x_id_detail_help">
<?= $Page->id_detail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_detail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <div id="r_detail" class="form-group row">
        <label id="elh_subdetail_detail" for="x_detail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->detail->caption() ?><?= $Page->detail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->detail->cellAttributes() ?>>
<span id="el_subdetail_detail">
<textarea data-table="subdetail" data-field="x_detail" name="x_detail" id="x_detail" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->detail->getPlaceHolder()) ?>"<?= $Page->detail->editAttributes() ?> aria-describedby="x_detail_help"><?= $Page->detail->EditValue ?></textarea>
<?= $Page->detail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->detail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <div id="r_volum" class="form-group row">
        <label id="elh_subdetail_volum" for="x_volum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->volum->caption() ?><?= $Page->volum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->volum->cellAttributes() ?>>
<span id="el_subdetail_volum">
<input type="<?= $Page->volum->getInputTextType() ?>" data-table="subdetail" data-field="x_volum" name="x_volum" id="x_volum" size="30" placeholder="<?= HtmlEncode($Page->volum->getPlaceHolder()) ?>" value="<?= $Page->volum->EditValue ?>"<?= $Page->volum->editAttributes() ?> aria-describedby="x_volum_help">
<?= $Page->volum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->volum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <div id="r_sbm" class="form-group row">
        <label id="elh_subdetail_sbm" for="x_sbm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sbm->caption() ?><?= $Page->sbm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sbm->cellAttributes() ?>>
<span id="el_subdetail_sbm">
<input type="<?= $Page->sbm->getInputTextType() ?>" data-table="subdetail" data-field="x_sbm" name="x_sbm" id="x_sbm" size="30" placeholder="<?= HtmlEncode($Page->sbm->getPlaceHolder()) ?>" value="<?= $Page->sbm->EditValue ?>"<?= $Page->sbm->editAttributes() ?> aria-describedby="x_sbm_help">
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
    ew.addEventHandlers("subdetail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
