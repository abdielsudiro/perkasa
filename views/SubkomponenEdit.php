<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SubkomponenEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsubkomponenedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fsubkomponenedit = currentForm = new ew.Form("fsubkomponenedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "subkomponen")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.subkomponen)
        ew.vars.tables.subkomponen = currentTable;
    fsubkomponenedit.addFields([
        ["kode_subkomponen", [fields.kode_subkomponen.visible && fields.kode_subkomponen.required ? ew.Validators.required(fields.kode_subkomponen.caption) : null], fields.kode_subkomponen.isInvalid],
        ["kode_komponen", [fields.kode_komponen.visible && fields.kode_komponen.required ? ew.Validators.required(fields.kode_komponen.caption) : null], fields.kode_komponen.isInvalid],
        ["nama_subkomponen", [fields.nama_subkomponen.visible && fields.nama_subkomponen.required ? ew.Validators.required(fields.nama_subkomponen.caption) : null], fields.nama_subkomponen.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsubkomponenedit,
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
    fsubkomponenedit.validate = function () {
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
    fsubkomponenedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsubkomponenedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fsubkomponenedit");
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
<form name="fsubkomponenedit" id="fsubkomponenedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subkomponen">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <div id="r_kode_subkomponen" class="form-group row">
        <label id="elh_subkomponen_kode_subkomponen" for="x_kode_subkomponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_subkomponen->caption() ?><?= $Page->kode_subkomponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_subkomponen->cellAttributes() ?>>
<input type="<?= $Page->kode_subkomponen->getInputTextType() ?>" data-table="subkomponen" data-field="x_kode_subkomponen" name="x_kode_subkomponen" id="x_kode_subkomponen" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_subkomponen->getPlaceHolder()) ?>" value="<?= $Page->kode_subkomponen->EditValue ?>"<?= $Page->kode_subkomponen->editAttributes() ?> aria-describedby="x_kode_subkomponen_help">
<?= $Page->kode_subkomponen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_subkomponen->getErrorMessage() ?></div>
<input type="hidden" data-table="subkomponen" data-field="x_kode_subkomponen" data-hidden="1" name="o_kode_subkomponen" id="o_kode_subkomponen" value="<?= HtmlEncode($Page->kode_subkomponen->OldValue ?? $Page->kode_subkomponen->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <div id="r_kode_komponen" class="form-group row">
        <label id="elh_subkomponen_kode_komponen" for="x_kode_komponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_komponen->caption() ?><?= $Page->kode_komponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_subkomponen_kode_komponen">
<input type="<?= $Page->kode_komponen->getInputTextType() ?>" data-table="subkomponen" data-field="x_kode_komponen" name="x_kode_komponen" id="x_kode_komponen" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kode_komponen->getPlaceHolder()) ?>" value="<?= $Page->kode_komponen->EditValue ?>"<?= $Page->kode_komponen->editAttributes() ?> aria-describedby="x_kode_komponen_help">
<?= $Page->kode_komponen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_komponen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_subkomponen->Visible) { // nama_subkomponen ?>
    <div id="r_nama_subkomponen" class="form-group row">
        <label id="elh_subkomponen_nama_subkomponen" for="x_nama_subkomponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_subkomponen->caption() ?><?= $Page->nama_subkomponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_subkomponen->cellAttributes() ?>>
<span id="el_subkomponen_nama_subkomponen">
<input type="<?= $Page->nama_subkomponen->getInputTextType() ?>" data-table="subkomponen" data-field="x_nama_subkomponen" name="x_nama_subkomponen" id="x_nama_subkomponen" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->nama_subkomponen->getPlaceHolder()) ?>" value="<?= $Page->nama_subkomponen->EditValue ?>"<?= $Page->nama_subkomponen->editAttributes() ?> aria-describedby="x_nama_subkomponen_help">
<?= $Page->nama_subkomponen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_subkomponen->getErrorMessage() ?></div>
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
    ew.addEventHandlers("subkomponen");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
