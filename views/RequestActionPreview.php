<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestActionPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid request_action"><!-- .card -->
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
    <thead><!-- Table header -->
        <tr class="ew-table-header">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
    <?php if ($Page->SortUrl($Page->request_action_id) == "") { ?>
        <th class="<?= $Page->request_action_id->headerCellClass() ?>"><?= $Page->request_action_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->request_action_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->request_action_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->request_action_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->request_action_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->request_action_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
    <?php if ($Page->SortUrl($Page->request_id) == "") { ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><?= $Page->request_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->request_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->request_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->request_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->request_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
    <?php if ($Page->SortUrl($Page->action_id) == "") { ?>
        <th class="<?= $Page->action_id->headerCellClass() ?>"><?= $Page->action_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->action_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->action_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->action_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->action_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->action_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
    <?php if ($Page->SortUrl($Page->transition_id) == "") { ?>
        <th class="<?= $Page->transition_id->headerCellClass() ?>"><?= $Page->transition_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->transition_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->transition_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->transition_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->transition_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->transition_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <?php if ($Page->SortUrl($Page->is_active) == "") { ?>
        <th class="<?= $Page->is_active->headerCellClass() ?>"><?= $Page->is_active->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->is_active->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->is_active->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->is_active->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->is_active->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->is_active->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
    <?php if ($Page->SortUrl($Page->is_complete) == "") { ?>
        <th class="<?= $Page->is_complete->headerCellClass() ?>"><?= $Page->is_complete->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->is_complete->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->is_complete->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->is_complete->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->is_complete->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->is_complete->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
        </tr>
    </thead>
    <tbody><!-- Table body -->
<?php
$Page->RecCount = 0;
$Page->RowCount = 0;
while ($Page->Recordset && !$Page->Recordset->EOF) {
    // Init row class and style
    $Page->RecCount++;
    $Page->RowCount++;
    $Page->CssStyle = "";
    $Page->loadListRowValues($Page->Recordset);

    // Render row
    $Page->RowType = ROWTYPE_PREVIEW; // Preview record
    $Page->resetAttributes();
    $Page->renderListRow();

    // Render list options
    $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
<?php if ($Page->request_action_id->Visible) { // request_action_id ?>
        <!-- request_action_id -->
        <td<?= $Page->request_action_id->cellAttributes() ?>>
<span<?= $Page->request_action_id->viewAttributes() ?>>
<?= $Page->request_action_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->request_id->Visible) { // request_id ?>
        <!-- request_id -->
        <td<?= $Page->request_id->cellAttributes() ?>>
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->action_id->Visible) { // action_id ?>
        <!-- action_id -->
        <td<?= $Page->action_id->cellAttributes() ?>>
<span<?= $Page->action_id->viewAttributes() ?>>
<?= $Page->action_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->transition_id->Visible) { // transition_id ?>
        <!-- transition_id -->
        <td<?= $Page->transition_id->cellAttributes() ?>>
<span<?= $Page->transition_id->viewAttributes() ?>>
<?= $Page->transition_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <!-- is_active -->
        <td<?= $Page->is_active->cellAttributes() ?>>
<span<?= $Page->is_active->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_active_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_active->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_active->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_active_<?= $Page->RowCount ?>"></label>
</div></span>
</td>
<?php } ?>
<?php if ($Page->is_complete->Visible) { // is_complete ?>
        <!-- is_complete -->
        <td<?= $Page->is_complete->cellAttributes() ?>>
<span<?= $Page->is_complete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_is_complete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->is_complete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->is_complete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_is_complete_<?= $Page->RowCount ?>"></label>
</div></span>
</td>
<?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    $Page->Recordset->moveNext();
} // while
?>
    </tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?= $Page->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?= $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
    foreach ($Page->OtherOptions as $option)
        $option->render("body");
?>
</div>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
