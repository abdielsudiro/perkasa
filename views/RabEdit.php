<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var frabedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frabedit = currentForm = new ew.Form("frabedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "rab")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.rab)
        ew.vars.tables.rab = currentTable;
    frabedit.addFields([
        ["satker_id", [fields.satker_id.visible && fields.satker_id.required ? ew.Validators.required(fields.satker_id.caption) : null], fields.satker_id.isInvalid],
        ["kode_program", [fields.kode_program.visible && fields.kode_program.required ? ew.Validators.required(fields.kode_program.caption) : null], fields.kode_program.isInvalid],
        ["kode_kegiatan", [fields.kode_kegiatan.visible && fields.kode_kegiatan.required ? ew.Validators.required(fields.kode_kegiatan.caption) : null], fields.kode_kegiatan.isInvalid],
        ["kode_kro", [fields.kode_kro.visible && fields.kode_kro.required ? ew.Validators.required(fields.kode_kro.caption) : null], fields.kode_kro.isInvalid],
        ["kode_komponen", [fields.kode_komponen.visible && fields.kode_komponen.required ? ew.Validators.required(fields.kode_komponen.caption) : null], fields.kode_komponen.isInvalid],
        ["kode_subkomponen", [fields.kode_subkomponen.visible && fields.kode_subkomponen.required ? ew.Validators.required(fields.kode_subkomponen.caption) : null], fields.kode_subkomponen.isInvalid],
        ["kode_ro", [fields.kode_ro.visible && fields.kode_ro.required ? ew.Validators.required(fields.kode_ro.caption) : null], fields.kode_ro.isInvalid],
        ["filename", [fields.filename.visible && fields.filename.required ? ew.Validators.fileRequired(fields.filename.caption) : null], fields.filename.isInvalid],
        ["id_statuses", [fields.id_statuses.visible && fields.id_statuses.required ? ew.Validators.required(fields.id_statuses.caption) : null, ew.Validators.integer], fields.id_statuses.isInvalid],
        ["isApprovalAgree", [fields.isApprovalAgree.visible && fields.isApprovalAgree.required ? ew.Validators.required(fields.isApprovalAgree.caption) : null], fields.isApprovalAgree.isInvalid],
        ["isPenelaahAgree", [fields.isPenelaahAgree.visible && fields.isPenelaahAgree.required ? ew.Validators.required(fields.isPenelaahAgree.caption) : null], fields.isPenelaahAgree.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frabedit,
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
    frabedit.validate = function () {
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
    frabedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frabedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frabedit.lists.satker_id = <?= $Page->satker_id->toClientList($Page) ?>;
    frabedit.lists.kode_program = <?= $Page->kode_program->toClientList($Page) ?>;
    frabedit.lists.kode_kegiatan = <?= $Page->kode_kegiatan->toClientList($Page) ?>;
    frabedit.lists.kode_kro = <?= $Page->kode_kro->toClientList($Page) ?>;
    frabedit.lists.kode_komponen = <?= $Page->kode_komponen->toClientList($Page) ?>;
    frabedit.lists.kode_subkomponen = <?= $Page->kode_subkomponen->toClientList($Page) ?>;
    frabedit.lists.kode_ro = <?= $Page->kode_ro->toClientList($Page) ?>;
    loadjs.done("frabedit");
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
<form name="frabedit" id="frabedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rab">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->satker_id->Visible) { // satker_id ?>
    <div id="r_satker_id" class="form-group row">
        <label id="elh_rab_satker_id" for="x_satker_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satker_id->caption() ?><?= $Page->satker_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satker_id->cellAttributes() ?>>
<span id="el_rab_satker_id">
    <select
        id="x_satker_id"
        name="x_satker_id"
        class="form-control ew-select<?= $Page->satker_id->isInvalidClass() ?>"
        data-select2-id="rab_x_satker_id"
        data-table="rab"
        data-field="x_satker_id"
        data-value-separator="<?= $Page->satker_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->satker_id->getPlaceHolder()) ?>"
        <?= $Page->satker_id->editAttributes() ?>>
        <?= $Page->satker_id->selectOptionListHtml("x_satker_id") ?>
    </select>
    <?= $Page->satker_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->satker_id->getErrorMessage() ?></div>
<?= $Page->satker_id->Lookup->getParamTag($Page, "p_x_satker_id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_x_satker_id']"),
        options = { name: "x_satker_id", selectId: "rab_x_satker_id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.satker_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_program->Visible) { // kode_program ?>
    <div id="r_kode_program" class="form-group row">
        <label id="elh_rab_kode_program" for="x_kode_program" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_program->caption() ?><?= $Page->kode_program->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_program->cellAttributes() ?>>
<span id="el_rab_kode_program">
<?php $Page->kode_program->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_program"
        name="x_kode_program"
        class="form-control ew-select<?= $Page->kode_program->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_program"
        data-table="rab"
        data-field="x_kode_program"
        data-value-separator="<?= $Page->kode_program->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_program->getPlaceHolder()) ?>"
        <?= $Page->kode_program->editAttributes() ?>>
        <?= $Page->kode_program->selectOptionListHtml("x_kode_program") ?>
    </select>
    <?= $Page->kode_program->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_program->getErrorMessage() ?></div>
<?= $Page->kode_program->Lookup->getParamTag($Page, "p_x_kode_program") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='rab_x_kode_program']"),
        options = { name: "x_kode_program", selectId: "rab_x_kode_program", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_program.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { // kode_kegiatan ?>
    <div id="r_kode_kegiatan" class="form-group row">
        <label id="elh_rab_kode_kegiatan" for="x_kode_kegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kegiatan->caption() ?><?= $Page->kode_kegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kegiatan->cellAttributes() ?>>
<span id="el_rab_kode_kegiatan">
<?php $Page->kode_kegiatan->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_kegiatan"
        name="x_kode_kegiatan"
        class="form-control ew-select<?= $Page->kode_kegiatan->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_kegiatan"
        data-table="rab"
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
    var el = document.querySelector("select[data-select2-id='rab_x_kode_kegiatan']"),
        options = { name: "x_kode_kegiatan", selectId: "rab_x_kode_kegiatan", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_kegiatan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kro->Visible) { // kode_kro ?>
    <div id="r_kode_kro" class="form-group row">
        <label id="elh_rab_kode_kro" for="x_kode_kro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kro->caption() ?><?= $Page->kode_kro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kro->cellAttributes() ?>>
<span id="el_rab_kode_kro">
<?php $Page->kode_kro->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_kro"
        name="x_kode_kro"
        class="form-control ew-select<?= $Page->kode_kro->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_kro"
        data-table="rab"
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
    var el = document.querySelector("select[data-select2-id='rab_x_kode_kro']"),
        options = { name: "x_kode_kro", selectId: "rab_x_kode_kro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_kro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_komponen->Visible) { // kode_komponen ?>
    <div id="r_kode_komponen" class="form-group row">
        <label id="elh_rab_kode_komponen" for="x_kode_komponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_komponen->caption() ?><?= $Page->kode_komponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_komponen->cellAttributes() ?>>
<span id="el_rab_kode_komponen">
<?php $Page->kode_komponen->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_komponen"
        name="x_kode_komponen"
        class="form-control ew-select<?= $Page->kode_komponen->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_komponen"
        data-table="rab"
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
    var el = document.querySelector("select[data-select2-id='rab_x_kode_komponen']"),
        options = { name: "x_kode_komponen", selectId: "rab_x_kode_komponen", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_komponen.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_subkomponen->Visible) { // kode_subkomponen ?>
    <div id="r_kode_subkomponen" class="form-group row">
        <label id="elh_rab_kode_subkomponen" for="x_kode_subkomponen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_subkomponen->caption() ?><?= $Page->kode_subkomponen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_subkomponen->cellAttributes() ?>>
<span id="el_rab_kode_subkomponen">
    <select
        id="x_kode_subkomponen"
        name="x_kode_subkomponen"
        class="form-control ew-select<?= $Page->kode_subkomponen->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_subkomponen"
        data-table="rab"
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
    var el = document.querySelector("select[data-select2-id='rab_x_kode_subkomponen']"),
        options = { name: "x_kode_subkomponen", selectId: "rab_x_kode_subkomponen", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_subkomponen.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_ro->Visible) { // kode_ro ?>
    <div id="r_kode_ro" class="form-group row">
        <label id="elh_rab_kode_ro" for="x_kode_ro" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_ro->caption() ?><?= $Page->kode_ro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_ro->cellAttributes() ?>>
<span id="el_rab_kode_ro">
<?php $Page->kode_ro->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_kode_ro"
        name="x_kode_ro"
        class="form-control ew-select<?= $Page->kode_ro->isInvalidClass() ?>"
        data-select2-id="rab_x_kode_ro"
        data-table="rab"
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
    var el = document.querySelector("select[data-select2-id='rab_x_kode_ro']"),
        options = { name: "x_kode_ro", selectId: "rab_x_kode_ro", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.rab.fields.kode_ro.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <div id="r_filename" class="form-group row">
        <label id="elh_rab_filename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->filename->caption() ?><?= $Page->filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->filename->cellAttributes() ?>>
<span id="el_rab_filename">
<div id="fd_x_filename">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->filename->title() ?>" data-table="rab" data-field="x_filename" name="x_filename" id="x_filename" lang="<?= CurrentLanguageID() ?>" multiple<?= $Page->filename->editAttributes() ?><?= ($Page->filename->ReadOnly || $Page->filename->Disabled) ? " disabled" : "" ?> aria-describedby="x_filename_help">
        <label class="custom-file-label ew-file-label" for="x_filename"><?= $Language->phrase("ChooseFiles") ?></label>
    </div>
</div>
<?= $Page->filename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->filename->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_filename" id= "fn_x_filename" value="<?= $Page->filename->Upload->FileName ?>">
<input type="hidden" name="fa_x_filename" id= "fa_x_filename" value="<?= (Post("fa_x_filename") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_filename" id= "fs_x_filename" value="100">
<input type="hidden" name="fx_x_filename" id= "fx_x_filename" value="<?= $Page->filename->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_filename" id= "fm_x_filename" value="<?= $Page->filename->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_filename" id= "fc_x_filename" value="<?= $Page->filename->UploadMaxFileCount ?>">
</div>
<table id="ft_x_filename" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_statuses->Visible) { // id_statuses ?>
    <div id="r_id_statuses" class="form-group row">
        <label id="elh_rab_id_statuses" for="x_id_statuses" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_statuses->caption() ?><?= $Page->id_statuses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_statuses->cellAttributes() ?>>
<span id="el_rab_id_statuses">
<input type="<?= $Page->id_statuses->getInputTextType() ?>" data-table="rab" data-field="x_id_statuses" name="x_id_statuses" id="x_id_statuses" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id_statuses->getPlaceHolder()) ?>" value="<?= $Page->id_statuses->EditValue ?>"<?= $Page->id_statuses->editAttributes() ?> aria-describedby="x_id_statuses_help">
<?= $Page->id_statuses->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_statuses->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isApprovalAgree->Visible) { // isApprovalAgree ?>
    <div id="r_isApprovalAgree" class="form-group row">
        <label id="elh_rab_isApprovalAgree" for="x_isApprovalAgree" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isApprovalAgree->caption() ?><?= $Page->isApprovalAgree->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->isApprovalAgree->cellAttributes() ?>>
<span id="el_rab_isApprovalAgree">
<input type="<?= $Page->isApprovalAgree->getInputTextType() ?>" data-table="rab" data-field="x_isApprovalAgree" name="x_isApprovalAgree" id="x_isApprovalAgree" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->isApprovalAgree->getPlaceHolder()) ?>" value="<?= $Page->isApprovalAgree->EditValue ?>"<?= $Page->isApprovalAgree->editAttributes() ?> aria-describedby="x_isApprovalAgree_help">
<?= $Page->isApprovalAgree->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isApprovalAgree->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isPenelaahAgree->Visible) { // isPenelaahAgree ?>
    <div id="r_isPenelaahAgree" class="form-group row">
        <label id="elh_rab_isPenelaahAgree" for="x_isPenelaahAgree" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isPenelaahAgree->caption() ?><?= $Page->isPenelaahAgree->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->isPenelaahAgree->cellAttributes() ?>>
<span id="el_rab_isPenelaahAgree">
<input type="<?= $Page->isPenelaahAgree->getInputTextType() ?>" data-table="rab" data-field="x_isPenelaahAgree" name="x_isPenelaahAgree" id="x_isPenelaahAgree" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->isPenelaahAgree->getPlaceHolder()) ?>" value="<?= $Page->isPenelaahAgree->EditValue ?>"<?= $Page->isPenelaahAgree->editAttributes() ?> aria-describedby="x_isPenelaahAgree_help">
<?= $Page->isPenelaahAgree->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isPenelaahAgree->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="rab" data-field="x_id_rab" data-hidden="1" name="x_id_rab" id="x_id_rab" value="<?= HtmlEncode($Page->id_rab->CurrentValue) ?>">
<?php
    if (in_array("rab_file", explode(",", $Page->getCurrentDetailTable())) && $rab_file->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_file", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabFileGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_note_penelaah", explode(",", $Page->getCurrentDetailTable())) && $rab_note_penelaah->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_note_penelaah", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabNotePenelaahGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_note_penyetuju", explode(",", $Page->getCurrentDetailTable())) && $rab_note_penyetuju->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_note_penyetuju", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabNotePenyetujuGrid.php" ?>
<?php } ?>
<?php
    if (in_array("rab_rincian", explode(",", $Page->getCurrentDetailTable())) && $rab_rincian->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("rab_rincian", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RabRincianGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("rab");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
