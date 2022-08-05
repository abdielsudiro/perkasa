<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabKegiatan2Edit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frab_kegiatan2edit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frab_kegiatan2edit = currentForm = new ew.Form("frab_kegiatan2edit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab_kegiatan2")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab_kegiatan2)
        ew.vars.tables.rab_kegiatan2 = currentTable;
    frab_kegiatan2edit.addFields([
        ["rab_kegiatan_id", [fields.rab_kegiatan_id.visible && fields.rab_kegiatan_id.required ? ew.Validators.required(fields.rab_kegiatan_id.caption) : null], fields.rab_kegiatan_id.isInvalid],
        ["satker_id", [fields.satker_id.visible && fields.satker_id.required ? ew.Validators.required(fields.satker_id.caption) : null], fields.satker_id.isInvalid],
        ["kode_kegiatan", [fields.kode_kegiatan.visible && fields.kode_kegiatan.required ? ew.Validators.required(fields.kode_kegiatan.caption) : null], fields.kode_kegiatan.isInvalid],
        ["kode_kro", [fields.kode_kro.visible && fields.kode_kro.required ? ew.Validators.required(fields.kode_kro.caption) : null], fields.kode_kro.isInvalid],
        ["kode_ro", [fields.kode_ro.visible && fields.kode_ro.required ? ew.Validators.required(fields.kode_ro.caption) : null], fields.kode_ro.isInvalid],
        ["kode_komponen", [fields.kode_komponen.visible && fields.kode_komponen.required ? ew.Validators.required(fields.kode_komponen.caption) : null], fields.kode_komponen.isInvalid],
        ["kode_subkomponen", [fields.kode_subkomponen.visible && fields.kode_subkomponen.required ? ew.Validators.required(fields.kode_subkomponen.caption) : null], fields.kode_subkomponen.isInvalid],
        ["total_biaya", [fields.total_biaya.visible && fields.total_biaya.required ? ew.Validators.required(fields.total_biaya.caption) : null, ew.Validators.float], fields.total_biaya.isInvalid],
        ["reviewer_note_id", [fields.reviewer_note_id.visible && fields.reviewer_note_id.required ? ew.Validators.required(fields.reviewer_note_id.caption) : null], fields.reviewer_note_id.isInvalid],
        ["approval_note_id", [fields.approval_note_id.visible && fields.approval_note_id.required ? ew.Validators.required(fields.approval_note_id.caption) : null], fields.approval_note_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frab_kegiatan2edit,
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
    frab_kegiatan2edit.validate = function () {
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
    frab_kegiatan2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frab_kegiatan2edit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frab_kegiatan2edit.lists.satker_id = <?= $Page->satker_id->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.kode_kegiatan = <?= $Page->kode_kegiatan->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.kode_kro = <?= $Page->kode_kro->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.kode_ro = <?= $Page->kode_ro->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.kode_komponen = <?= $Page->kode_komponen->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.kode_subkomponen = <?= $Page->kode_subkomponen->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.reviewer_note_id = <?= $Page->reviewer_note_id->toClientList($Page) ?>;
    frab_kegiatan2edit.lists.approval_note_id = <?= $Page->approval_note_id->toClientList($Page) ?>;
    loadjs.done("frab_kegiatan2edit");
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
<form name="frab_kegiatan2edit" id="frab_kegiatan2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab_kegiatan2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->rab_kegiatan_id->Visible) { // rab_kegiatan_id ?>
    <div id="r_rab_kegiatan_id" class="form-group row">
        <label id="elh_rab_kegiatan2_rab_kegiatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rab_kegiatan_id->caption() ?><?= $Page->rab_kegiatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rab_kegiatan_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_rab_kegiatan_id">
<span<?= $Page->rab_kegiatan_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->rab_kegiatan_id->getDisplayValue($Page->rab_kegiatan_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="rab_kegiatan2" data-field="x_rab_kegiatan_id" data-hidden="1" name="x_rab_kegiatan_id" id="x_rab_kegiatan_id" value="<?= HtmlEncode($Page->rab_kegiatan_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <div id="r_satker_id" class="form-group row">
        <label id="elh_rab_kegiatan2_satker_id" for="x_satker_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satker_id->caption() ?><?= $Page->satker_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satker_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_satker_id">
<div class="input-group ew-lookup-list" aria-describedby="x_satker_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_satker_id"><?= EmptyValue(strval($Page->satker_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->satker_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->satker_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->satker_id->ReadOnly || $Page->satker_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_satker_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->satker_id->getErrorMessage() ?></div>
<?= $Page->satker_id->getCustomMessage() ?>
<?= $Page->satker_id->Lookup->getParamTag($Page, "p_x_satker_id") ?>
<input type="hidden" is="selection-list" data-table="rab_kegiatan2" data-field="x_satker_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->satker_id->displayValueSeparatorAttribute() ?>" name="x_satker_id" id="x_satker_id" value="<?= $Page->satker_id->CurrentValue ?>"<?= $Page->satker_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <div id="r_kode_kegiatan" class="form-group row">
        <label id="elh_rab_kegiatan2_kode_kegiatan" for="x_kode_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kegiatan->caption() ?><?= $Page->kode_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_kegiatan">
<?php $Page->kode_kegiatan->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_kegiatan"
        name="x_kode_kegiatan"
        class="form-control ew-select<?= $Page->kode_kegiatan->isInvalidClass() ?>"
        data-select2-id="rab_kegiatan2_x_kode_kegiatan"
        data-table="rab_kegiatan2"
        data-field="x_kode_kegiatan"
        data-value-separator="<?= $Page->kode_kegiatan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_kegiatan->getPlaceHolder()) ?>"
        <?= $Page->kode_kegiatan->editAttributes() ?>>
        <?= $Page->kode_kegiatan->selectOptionListHtml("x_kode_kegiatan") ?>
    </select>
    <?= $Page->kode_kegiatan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_kegiatan->getErrorMessage() ?></div>
<?= $Page->kode_kegiatan->Lookup->getParamTag($Page, "p_x_kode_kegiatan") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_kegiatan2_x_kode_kegiatan']"),
        options = { name: "x_kode_kegiatan", selectId: "rab_kegiatan2_x_kode_kegiatan", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_kegiatan2.fields.kode_kegiatan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <div id="r_kode_kro" class="form-group row">
        <label id="elh_rab_kegiatan2_kode_kro" for="x_kode_kro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kro->caption() ?><?= $Page->kode_kro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_kro">
<?php $Page->kode_kro->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_kro"
        name="x_kode_kro"
        class="form-control ew-select<?= $Page->kode_kro->isInvalidClass() ?>"
        data-select2-id="rab_kegiatan2_x_kode_kro"
        data-table="rab_kegiatan2"
        data-field="x_kode_kro"
        data-value-separator="<?= $Page->kode_kro->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_kro->getPlaceHolder()) ?>"
        <?= $Page->kode_kro->editAttributes() ?>>
        <?= $Page->kode_kro->selectOptionListHtml("x_kode_kro") ?>
    </select>
    <?= $Page->kode_kro->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_kro->getErrorMessage() ?></div>
<?= $Page->kode_kro->Lookup->getParamTag($Page, "p_x_kode_kro") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_kegiatan2_x_kode_kro']"),
        options = { name: "x_kode_kro", selectId: "rab_kegiatan2_x_kode_kro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_kegiatan2.fields.kode_kro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <div id="r_kode_ro" class="form-group row">
        <label id="elh_rab_kegiatan2_kode_ro" for="x_kode_ro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_ro->caption() ?><?= $Page->kode_ro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_ro">
<?php $Page->kode_ro->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_ro"
        name="x_kode_ro"
        class="form-control ew-select<?= $Page->kode_ro->isInvalidClass() ?>"
        data-select2-id="rab_kegiatan2_x_kode_ro"
        data-table="rab_kegiatan2"
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
    var el = document.querySelector("select[data-select2-id='rab_kegiatan2_x_kode_ro']"),
        options = { name: "x_kode_ro", selectId: "rab_kegiatan2_x_kode_ro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_kegiatan2.fields.kode_ro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <div id="r_kode_komponen" class="form-group row">
        <label id="elh_rab_kegiatan2_kode_komponen" for="x_kode_komponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_komponen->caption() ?><?= $Page->kode_komponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_komponen">
<?php $Page->kode_komponen->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_komponen"
        name="x_kode_komponen"
        class="form-control ew-select<?= $Page->kode_komponen->isInvalidClass() ?>"
        data-select2-id="rab_kegiatan2_x_kode_komponen"
        data-table="rab_kegiatan2"
        data-field="x_kode_komponen"
        data-value-separator="<?= $Page->kode_komponen->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_komponen->getPlaceHolder()) ?>"
        <?= $Page->kode_komponen->editAttributes() ?>>
        <?= $Page->kode_komponen->selectOptionListHtml("x_kode_komponen") ?>
    </select>
    <?= $Page->kode_komponen->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_komponen->getErrorMessage() ?></div>
<?= $Page->kode_komponen->Lookup->getParamTag($Page, "p_x_kode_komponen") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_kegiatan2_x_kode_komponen']"),
        options = { name: "x_kode_komponen", selectId: "rab_kegiatan2_x_kode_komponen", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_kegiatan2.fields.kode_komponen.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <div id="r_kode_subkomponen" class="form-group row">
        <label id="elh_rab_kegiatan2_kode_subkomponen" for="x_kode_subkomponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_subkomponen->caption() ?><?= $Page->kode_subkomponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el_rab_kegiatan2_kode_subkomponen">
    <select
        id="x_kode_subkomponen"
        name="x_kode_subkomponen"
        class="form-control ew-select<?= $Page->kode_subkomponen->isInvalidClass() ?>"
        data-select2-id="rab_kegiatan2_x_kode_subkomponen"
        data-table="rab_kegiatan2"
        data-field="x_kode_subkomponen"
        data-value-separator="<?= $Page->kode_subkomponen->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_subkomponen->getPlaceHolder()) ?>"
        <?= $Page->kode_subkomponen->editAttributes() ?>>
        <?= $Page->kode_subkomponen->selectOptionListHtml("x_kode_subkomponen") ?>
    </select>
    <?= $Page->kode_subkomponen->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_subkomponen->getErrorMessage() ?></div>
<?= $Page->kode_subkomponen->Lookup->getParamTag($Page, "p_x_kode_subkomponen") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_kegiatan2_x_kode_subkomponen']"),
        options = { name: "x_kode_subkomponen", selectId: "rab_kegiatan2_x_kode_subkomponen", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab_kegiatan2.fields.kode_subkomponen.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_biaya->Visible) { // total_biaya ?>
    <div id="r_total_biaya" class="form-group row">
        <label id="elh_rab_kegiatan2_total_biaya" for="x_total_biaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_biaya->caption() ?><?= $Page->total_biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->total_biaya->cellAttributes() ?>>
<span id="el_rab_kegiatan2_total_biaya">
<input type="<?= $Page->total_biaya->getInputTextType() ?>" data-table="rab_kegiatan2" data-field="x_total_biaya" name="x_total_biaya" id="x_total_biaya" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->total_biaya->getPlaceHolder()) ?>" value="<?= $Page->total_biaya->EditValue ?>"<?= $Page->total_biaya->editAttributes() ?> aria-describedby="x_total_biaya_help">
<?= $Page->total_biaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_biaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reviewer_note_id->Visible) { // reviewer_note_id ?>
    <div id="r_reviewer_note_id" class="form-group row">
        <label id="elh_rab_kegiatan2_reviewer_note_id" for="x_reviewer_note_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reviewer_note_id->caption() ?><?= $Page->reviewer_note_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->reviewer_note_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_reviewer_note_id">
<div class="input-group ew-lookup-list" aria-describedby="x_reviewer_note_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_reviewer_note_id"><?= EmptyValue(strval($Page->reviewer_note_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->reviewer_note_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->reviewer_note_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->reviewer_note_id->ReadOnly || $Page->reviewer_note_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_reviewer_note_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->reviewer_note_id->getErrorMessage() ?></div>
<?= $Page->reviewer_note_id->getCustomMessage() ?>
<?= $Page->reviewer_note_id->Lookup->getParamTag($Page, "p_x_reviewer_note_id") ?>
<input type="hidden" is="selection-list" data-table="rab_kegiatan2" data-field="x_reviewer_note_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->reviewer_note_id->displayValueSeparatorAttribute() ?>" name="x_reviewer_note_id" id="x_reviewer_note_id" value="<?= $Page->reviewer_note_id->CurrentValue ?>"<?= $Page->reviewer_note_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->approval_note_id->Visible) { // approval_note_id ?>
    <div id="r_approval_note_id" class="form-group row">
        <label id="elh_rab_kegiatan2_approval_note_id" for="x_approval_note_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->approval_note_id->caption() ?><?= $Page->approval_note_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->approval_note_id->cellAttributes() ?>>
<span id="el_rab_kegiatan2_approval_note_id">
<div class="input-group ew-lookup-list" aria-describedby="x_approval_note_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_approval_note_id"><?= EmptyValue(strval($Page->approval_note_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->approval_note_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->approval_note_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->approval_note_id->ReadOnly || $Page->approval_note_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_approval_note_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->approval_note_id->getErrorMessage() ?></div>
<?= $Page->approval_note_id->getCustomMessage() ?>
<?= $Page->approval_note_id->Lookup->getParamTag($Page, "p_x_approval_note_id") ?>
<input type="hidden" is="selection-list" data-table="rab_kegiatan2" data-field="x_approval_note_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->approval_note_id->displayValueSeparatorAttribute() ?>" name="x_approval_note_id" id="x_approval_note_id" value="<?= $Page->approval_note_id->CurrentValue ?>"<?= $Page->approval_note_id->editAttributes() ?>>
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
    ew.addEventHandlers("rab_kegiatan2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
