<?php

namespace PHPMaker2021\perkasa2;

// Page object
$AkunAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fakunadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fakunadd = currentForm = new ew.Form("fakunadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "akun")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.akun)
        ew.vars.tables.akun = currentTable;
    fakunadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
        ["kode", [fields.kode.visible && fields.kode.required ? ew.Validators.required(fields.kode.caption) : null], fields.kode.isInvalid],
        ["uraian", [fields.uraian.visible && fields.uraian.required ? ew.Validators.required(fields.uraian.caption) : null], fields.uraian.isInvalid],
        ["parent_id", [fields.parent_id.visible && fields.parent_id.required ? ew.Validators.required(fields.parent_id.caption) : null], fields.parent_id.isInvalid],
        ["isSubAccount", [fields.isSubAccount.visible && fields.isSubAccount.required ? ew.Validators.required(fields.isSubAccount.caption) : null], fields.isSubAccount.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fakunadd,
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
    fakunadd.validate = function () {
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
    fakunadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fakunadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fakunadd.lists.parent_id = <?= $Page->parent_id->toClientList($Page) ?>;
    fakunadd.lists.isSubAccount = <?= $Page->isSubAccount->toClientList($Page) ?>;
    loadjs.done("fakunadd");
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
<form name="fakunadd" id="fakunadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="akun">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_akun_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_akun_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="akun" data-field="x_id" name="x_id" id="x_id" size="30" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
    <div id="r_kode" class="form-group row">
        <label id="elh_akun_kode" for="x_kode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode->caption() ?><?= $Page->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode->cellAttributes() ?>>
<span id="el_akun_kode">
<input type="<?= $Page->kode->getInputTextType() ?>" data-table="akun" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>" value="<?= $Page->kode->EditValue ?>"<?= $Page->kode->editAttributes() ?> aria-describedby="x_kode_help">
<?= $Page->kode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <div id="r_uraian" class="form-group row">
        <label id="elh_akun_uraian" for="x_uraian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uraian->caption() ?><?= $Page->uraian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->uraian->cellAttributes() ?>>
<span id="el_akun_uraian">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="akun" data-field="x_uraian" name="x_uraian" id="x_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?> aria-describedby="x_uraian_help">
<?= $Page->uraian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <div id="r_parent_id" class="form-group row">
        <label id="elh_akun_parent_id" for="x_parent_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parent_id->caption() ?><?= $Page->parent_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->parent_id->cellAttributes() ?>>
<span id="el_akun_parent_id">
    <select
        id="x_parent_id"
        name="x_parent_id"
        class="form-control ew-select<?= $Page->parent_id->isInvalidClass() ?>"
        data-select2-id="akun_x_parent_id"
        data-table="akun"
        data-field="x_parent_id"
        data-value-separator="<?= $Page->parent_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->parent_id->getPlaceHolder()) ?>"
        <?= $Page->parent_id->editAttributes() ?>>
        <?= $Page->parent_id->selectOptionListHtml("x_parent_id") ?>
    </select>
    <?= $Page->parent_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->parent_id->getErrorMessage() ?></div>
<?= $Page->parent_id->Lookup->getParamTag($Page, "p_x_parent_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='akun_x_parent_id']"),
        options = { name: "x_parent_id", selectId: "akun_x_parent_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.akun.fields.parent_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isSubAccount->Visible) { // isSubAccount ?>
    <div id="r_isSubAccount" class="form-group row">
        <label id="elh_akun_isSubAccount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isSubAccount->caption() ?><?= $Page->isSubAccount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->isSubAccount->cellAttributes() ?>>
<span id="el_akun_isSubAccount">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->isSubAccount->isInvalidClass() ?>" data-table="akun" data-field="x_isSubAccount" name="x_isSubAccount[]" id="x_isSubAccount_218022" value="1"<?= ConvertToBool($Page->isSubAccount->CurrentValue) ? " checked" : "" ?><?= $Page->isSubAccount->editAttributes() ?> aria-describedby="x_isSubAccount_help">
    <label class="custom-control-label" for="x_isSubAccount_218022"></label>
</div>
<?= $Page->isSubAccount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isSubAccount->getErrorMessage() ?></div>
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
    ew.addEventHandlers("akun");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
