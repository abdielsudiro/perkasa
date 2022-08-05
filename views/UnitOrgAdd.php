<?php

namespace PHPMaker2021\perkasa2;

// Page object
$UnitOrgAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var funit_orgadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    funit_orgadd = currentForm = new ew.Form("funit_orgadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "unit_org")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.unit_org)
        ew.vars.tables.unit_org = currentTable;
    funit_orgadd.addFields([
        ["unit_org_id", [fields.unit_org_id.visible && fields.unit_org_id.required ? ew.Validators.required(fields.unit_org_id.caption) : null, ew.Validators.integer], fields.unit_org_id.isInvalid],
        ["nama_unit_org", [fields.nama_unit_org.visible && fields.nama_unit_org.required ? ew.Validators.required(fields.nama_unit_org.caption) : null], fields.nama_unit_org.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = funit_orgadd,
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
    funit_orgadd.validate = function () {
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
    funit_orgadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    funit_orgadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("funit_orgadd");
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
<form name="funit_orgadd" id="funit_orgadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="unit_org">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->unit_org_id->Visible) { // unit_org_id ?>
    <div id="r_unit_org_id" class="form-group row">
        <label id="elh_unit_org_unit_org_id" for="x_unit_org_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_org_id->caption() ?><?= $Page->unit_org_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->unit_org_id->cellAttributes() ?>>
<span id="el_unit_org_unit_org_id">
<input type="<?= $Page->unit_org_id->getInputTextType() ?>" data-table="unit_org" data-field="x_unit_org_id" name="x_unit_org_id" id="x_unit_org_id" size="30" placeholder="<?= HtmlEncode($Page->unit_org_id->getPlaceHolder()) ?>" value="<?= $Page->unit_org_id->EditValue ?>"<?= $Page->unit_org_id->editAttributes() ?> aria-describedby="x_unit_org_id_help">
<?= $Page->unit_org_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_org_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_unit_org->Visible) { // nama_unit_org ?>
    <div id="r_nama_unit_org" class="form-group row">
        <label id="elh_unit_org_nama_unit_org" for="x_nama_unit_org" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_unit_org->caption() ?><?= $Page->nama_unit_org->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_unit_org->cellAttributes() ?>>
<span id="el_unit_org_nama_unit_org">
<input type="<?= $Page->nama_unit_org->getInputTextType() ?>" data-table="unit_org" data-field="x_nama_unit_org" name="x_nama_unit_org" id="x_nama_unit_org" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_unit_org->getPlaceHolder()) ?>" value="<?= $Page->nama_unit_org->EditValue ?>"<?= $Page->nama_unit_org->editAttributes() ?> aria-describedby="x_nama_unit_org_help">
<?= $Page->nama_unit_org->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_unit_org->getErrorMessage() ?></div>
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
    ew.addEventHandlers("unit_org");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
