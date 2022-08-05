<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestRabEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest_rabedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frequest_rabedit = currentForm = new ew.Form("frequest_rabedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request_rab")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request_rab)
        ew.vars.tables.request_rab = currentTable;
    frequest_rabedit.addFields([
        ["request_rab_id", [fields.request_rab_id.visible && fields.request_rab_id.required ? ew.Validators.required(fields.request_rab_id.caption) : null], fields.request_rab_id.isInvalid],
        ["id_rab", [fields.id_rab.visible && fields.id_rab.required ? ew.Validators.required(fields.id_rab.caption) : null], fields.id_rab.isInvalid],
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest_rabedit,
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
    frequest_rabedit.validate = function () {
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
    frequest_rabedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest_rabedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frequest_rabedit.lists.id_rab = <?= $Page->id_rab->toClientList($Page) ?>;
    loadjs.done("frequest_rabedit");
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
<form name="frequest_rabedit" id="frequest_rabedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request_rab">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "request2") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="request2">
<input type="hidden" name="fk_request_id" value="<?= HtmlEncode($Page->request_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->request_rab_id->Visible) { // request_rab_id ?>
    <div id="r_request_rab_id" class="form-group row">
        <label id="elh_request_rab_request_rab_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_rab_id->caption() ?><?= $Page->request_rab_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_rab_id->cellAttributes() ?>>
<span id="el_request_rab_request_rab_id">
<span<?= $Page->request_rab_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_rab_id->getDisplayValue($Page->request_rab_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="request_rab" data-field="x_request_rab_id" data-hidden="1" name="x_request_rab_id" id="x_request_rab_id" value="<?= HtmlEncode($Page->request_rab_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_rab->Visible) { // id_rab ?>
    <div id="r_id_rab" class="form-group row">
        <label id="elh_request_rab_id_rab" for="x_id_rab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_rab->caption() ?><?= $Page->id_rab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_rab->cellAttributes() ?>>
<span id="el_request_rab_id_rab">
    <select
        id="x_id_rab"
        name="x_id_rab"
        class="form-control ew-select<?= $Page->id_rab->isInvalidClass() ?>"
        data-select2-id="request_rab_x_id_rab"
        data-table="request_rab"
        data-field="x_id_rab"
        data-value-separator="<?= $Page->id_rab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_rab->getPlaceHolder()) ?>"
        <?= $Page->id_rab->editAttributes() ?>>
        <?= $Page->id_rab->selectOptionListHtml("x_id_rab") ?>
    </select>
    <?= $Page->id_rab->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->id_rab->getErrorMessage() ?></div>
<?= $Page->id_rab->Lookup->getParamTag($Page, "p_x_id_rab") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='request_rab_x_id_rab']"),
        options = { name: "x_id_rab", selectId: "request_rab_x_id_rab", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.request_rab.fields.id_rab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id" class="form-group row">
        <label id="elh_request_rab_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_id->cellAttributes() ?>>
<?php if ($Page->request_id->getSessionValue() != "") { ?>
<span id="el_request_rab_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->request_id->getDisplayValue($Page->request_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_request_id" name="x_request_id" value="<?= HtmlEncode($Page->request_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_request_rab_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" data-table="request_rab" data-field="x_request_id" name="x_request_id" id="x_request_id" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" value="<?= $Page->request_id->EditValue ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
<?php } ?>
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
    ew.addEventHandlers("request_rab");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
