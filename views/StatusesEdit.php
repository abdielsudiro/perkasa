<?php

namespace PHPMaker2021\perkasa2;

// Page object
$StatusesEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstatusesedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fstatusesedit = currentForm = new ew.Form("fstatusesedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "statuses")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.statuses)
        ew.vars.tables.statuses = currentTable;
    fstatusesedit.addFields([
        ["id_statuses", [fields.id_statuses.visible && fields.id_statuses.required ? ew.Validators.required(fields.id_statuses.caption) : null], fields.id_statuses.isInvalid],
        ["nama_status", [fields.nama_status.visible && fields.nama_status.required ? ew.Validators.required(fields.nama_status.caption) : null], fields.nama_status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fstatusesedit,
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
    fstatusesedit.validate = function () {
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
    fstatusesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstatusesedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fstatusesedit");
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
<form name="fstatusesedit" id="fstatusesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="statuses">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
    <div id="r_id_statuses" class="form-group row">
        <label id="elh_statuses_id_statuses" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_statuses->caption() ?><?= $Page->id_statuses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el_statuses_id_statuses">
<span<?= $Page->id_statuses->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_statuses->getDisplayValue($Page->id_statuses->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="statuses" data-field="x_id_statuses" data-hidden="1" name="x_id_statuses" id="x_id_statuses" value="<?= HtmlEncode($Page->id_statuses->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_status->Visible) { // nama_status ?>
    <div id="r_nama_status" class="form-group row">
        <label id="elh_statuses_nama_status" for="x_nama_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_status->caption() ?><?= $Page->nama_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_status->cellAttributes() ?>>
<span id="el_statuses_nama_status">
<input type="<?= $Page->nama_status->getInputTextType() ?>" data-table="statuses" data-field="x_nama_status" name="x_nama_status" id="x_nama_status" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->nama_status->getPlaceHolder()) ?>" value="<?= $Page->nama_status->EditValue ?>"<?= $Page->nama_status->editAttributes() ?> aria-describedby="x_nama_status_help">
<?= $Page->nama_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_status->getErrorMessage() ?></div>
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
    ew.addEventHandlers("statuses");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
