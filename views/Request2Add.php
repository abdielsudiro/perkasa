<?php

namespace PHPMaker2021\perkasa2;

// Page object
$Request2Add = &$Page;
?>
<script>
var currentForm, currentPageID;
var frequest2add;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    frequest2add = currentForm = new ew.Form("frequest2add", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "request2")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.request2)
        ew.vars.tables.request2 = currentTable;
    frequest2add.addFields([
        ["request_id", [fields.request_id.visible && fields.request_id.required ? ew.Validators.required(fields.request_id.caption) : null, ew.Validators.integer], fields.request_id.isInvalid],
        ["process_id", [fields.process_id.visible && fields.process_id.required ? ew.Validators.required(fields.process_id.caption) : null, ew.Validators.integer], fields.process_id.isInvalid],
        ["title", [fields.title.visible && fields.title.required ? ew.Validators.required(fields.title.caption) : null], fields.title.isInvalid],
        ["date_requested", [fields.date_requested.visible && fields.date_requested.required ? ew.Validators.required(fields.date_requested.caption) : null], fields.date_requested.isInvalid],
        ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["current_state_id", [fields.current_state_id.visible && fields.current_state_id.required ? ew.Validators.required(fields.current_state_id.caption) : null, ew.Validators.integer], fields.current_state_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frequest2add,
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
    frequest2add.validate = function () {
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
    frequest2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frequest2add.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    frequest2add.lists._username = <?= $Page->_username->toClientList($Page) ?>;
    loadjs.done("frequest2add");
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
<form name="frequest2add" id="frequest2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="request2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->request_id->Visible) { // request_id ?>
    <div id="r_request_id" class="form-group row">
        <label id="elh_request2_request_id" for="x_request_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_id->caption() ?><?= $Page->request_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_id->cellAttributes() ?>>
<span id="el_request2_request_id">
<input type="<?= $Page->request_id->getInputTextType() ?>" data-table="request2" data-field="x_request_id" name="x_request_id" id="x_request_id" size="30" placeholder="<?= HtmlEncode($Page->request_id->getPlaceHolder()) ?>" value="<?= $Page->request_id->EditValue ?>"<?= $Page->request_id->editAttributes() ?> aria-describedby="x_request_id_help">
<?= $Page->request_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->process_id->Visible) { // process_id ?>
    <div id="r_process_id" class="form-group row">
        <label id="elh_request2_process_id" for="x_process_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->process_id->caption() ?><?= $Page->process_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->process_id->cellAttributes() ?>>
<span id="el_request2_process_id">
<input type="<?= $Page->process_id->getInputTextType() ?>" data-table="request2" data-field="x_process_id" name="x_process_id" id="x_process_id" size="30" placeholder="<?= HtmlEncode($Page->process_id->getPlaceHolder()) ?>" value="<?= $Page->process_id->EditValue ?>"<?= $Page->process_id->editAttributes() ?> aria-describedby="x_process_id_help">
<?= $Page->process_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->process_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->title->Visible) { // title ?>
    <div id="r_title" class="form-group row">
        <label id="elh_request2_title" for="x_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->title->caption() ?><?= $Page->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->title->cellAttributes() ?>>
<span id="el_request2_title">
<input type="<?= $Page->title->getInputTextType() ?>" data-table="request2" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->title->getPlaceHolder()) ?>" value="<?= $Page->title->EditValue ?>"<?= $Page->title->editAttributes() ?> aria-describedby="x_title_help">
<?= $Page->title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id" class="form-group row">
        <label id="elh_request2_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->user_id->cellAttributes() ?>>
<span id="el_request2_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" data-table="request2" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" value="<?= $Page->user_id->EditValue ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_request2__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_request2__username">
<div class="input-group ew-lookup-list" aria-describedby="x__username_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x__username"><?= EmptyValue(strval($Page->_username->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->_username->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->_username->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->_username->ReadOnly || $Page->_username->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x__username',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
<?= $Page->_username->getCustomMessage() ?>
<?= $Page->_username->Lookup->getParamTag($Page, "p_x__username") ?>
<input type="hidden" is="selection-list" data-table="request2" data-field="x__username" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->_username->displayValueSeparatorAttribute() ?>" name="x__username" id="x__username" value="<?= $Page->_username->CurrentValue ?>"<?= $Page->_username->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->current_state_id->Visible) { // current_state_id ?>
    <div id="r_current_state_id" class="form-group row">
        <label id="elh_request2_current_state_id" for="x_current_state_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->current_state_id->caption() ?><?= $Page->current_state_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->current_state_id->cellAttributes() ?>>
<span id="el_request2_current_state_id">
<input type="<?= $Page->current_state_id->getInputTextType() ?>" data-table="request2" data-field="x_current_state_id" name="x_current_state_id" id="x_current_state_id" size="30" placeholder="<?= HtmlEncode($Page->current_state_id->getPlaceHolder()) ?>" value="<?= $Page->current_state_id->EditValue ?>"<?= $Page->current_state_id->editAttributes() ?> aria-describedby="x_current_state_id_help">
<?= $Page->current_state_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->current_state_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("request_rab", explode(",", $Page->getCurrentDetailTable())) && $request_rab->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_rab", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestRabGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_note", explode(",", $Page->getCurrentDetailTable())) && $request_note->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_note", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestNoteGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_stakeholder", explode(",", $Page->getCurrentDetailTable())) && $request_stakeholder->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_stakeholder", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestStakeholderGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_action", explode(",", $Page->getCurrentDetailTable())) && $request_action->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestActionGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_data", explode(",", $Page->getCurrentDetailTable())) && $request_data->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_data", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestDataGrid.php" ?>
<?php } ?>
<?php
    if (in_array("process", explode(",", $Page->getCurrentDetailTable())) && $process->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("process", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ProcessGrid.php" ?>
<?php } ?>
<?php
    if (in_array("request_file", explode(",", $Page->getCurrentDetailTable())) && $request_file->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("request_file", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "RequestFileGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("request2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
