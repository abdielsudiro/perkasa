<?php

namespace PHPMaker2021\perkasa2;

// Page object
$SatkerEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsatkeredit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fsatkeredit = currentForm = new ew.Form("fsatkeredit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "satker")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.satker)
        ew.vars.tables.satker = currentTable;
    fsatkeredit.addFields([
        ["satker_id", [fields.satker_id.visible && fields.satker_id.required ? ew.Validators.required(fields.satker_id.caption) : null, ew.Validators.integer], fields.satker_id.isInvalid],
        ["unit_org_id", [fields.unit_org_id.visible && fields.unit_org_id.required ? ew.Validators.required(fields.unit_org_id.caption) : null], fields.unit_org_id.isInvalid],
        ["nama_satker", [fields.nama_satker.visible && fields.nama_satker.required ? ew.Validators.required(fields.nama_satker.caption) : null], fields.nama_satker.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsatkeredit,
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
    fsatkeredit.validate = function () {
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
    fsatkeredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsatkeredit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fsatkeredit.lists.unit_org_id = <?= $Page->unit_org_id->toClientList($Page) ?>;
    loadjs.done("fsatkeredit");
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
<form name="fsatkeredit" id="fsatkeredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="satker">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <div id="r_satker_id" class="form-group row">
        <label id="elh_satker_satker_id" for="x_satker_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satker_id->caption() ?><?= $Page->satker_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satker_id->cellAttributes() ?>>
<input type="<?= $Page->satker_id->getInputTextType() ?>" data-table="satker" data-field="x_satker_id" name="x_satker_id" id="x_satker_id" size="80" placeholder="<?= HtmlEncode($Page->satker_id->getPlaceHolder()) ?>" value="<?= $Page->satker_id->EditValue ?>"<?= $Page->satker_id->editAttributes() ?> aria-describedby="x_satker_id_help">
<?= $Page->satker_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->satker_id->getErrorMessage() ?></div>
<input type="hidden" data-table="satker" data-field="x_satker_id" data-hidden="1" name="o_satker_id" id="o_satker_id" value="<?= HtmlEncode($Page->satker_id->OldValue ?? $Page->satker_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
    <div id="r_unit_org_id" class="form-group row">
        <label id="elh_satker_unit_org_id" for="x_unit_org_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_org_id->caption() ?><?= $Page->unit_org_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->unit_org_id->cellAttributes() ?>>
<span id="el_satker_unit_org_id">
    <select
        id="x_unit_org_id"
        name="x_unit_org_id"
        class="form-control ew-select<?= $Page->unit_org_id->isInvalidClass() ?>"
        data-select2-id="satker_x_unit_org_id"
        data-table="satker"
        data-field="x_unit_org_id"
        data-value-separator="<?= $Page->unit_org_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->unit_org_id->getPlaceHolder()) ?>"
        <?= $Page->unit_org_id->editAttributes() ?>>
        <?= $Page->unit_org_id->selectOptionListHtml("x_unit_org_id") ?>
    </select>
    <?= $Page->unit_org_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->unit_org_id->getErrorMessage() ?></div>
<?= $Page->unit_org_id->Lookup->getParamTag($Page, "p_x_unit_org_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='satker_x_unit_org_id']"),
        options = { name: "x_unit_org_id", selectId: "satker_x_unit_org_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.satker.fields.unit_org_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { // nama_satker ?>
    <div id="r_nama_satker" class="form-group row">
        <label id="elh_satker_nama_satker" for="x_nama_satker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_satker->caption() ?><?= $Page->nama_satker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_satker->cellAttributes() ?>>
<span id="el_satker_nama_satker">
<input type="<?= $Page->nama_satker->getInputTextType() ?>" data-table="satker" data-field="x_nama_satker" name="x_nama_satker" id="x_nama_satker" size="30" maxlength="70" placeholder="<?= HtmlEncode($Page->nama_satker->getPlaceHolder()) ?>" value="<?= $Page->nama_satker->EditValue ?>"<?= $Page->nama_satker->editAttributes() ?> aria-describedby="x_nama_satker_help">
<?= $Page->nama_satker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_satker->getErrorMessage() ?></div>
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
    ew.addEventHandlers("satker");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
