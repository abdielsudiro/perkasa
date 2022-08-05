<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RequestStakeholderPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid request_stakeholder"><!-- .card -->
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
<?php if ($Page->request_id->Visible) { // request_id ?>
    <?php if ($Page->SortUrl($Page->request_id) == "") { ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><?= $Page->request_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->request_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->request_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->request_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->request_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <?php if ($Page->SortUrl($Page->user_id) == "") { ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><?= $Page->user_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->user_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->user_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->user_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <!-- request_id -->
        <td<?= $Page->request_id->cellAttributes() ?>>
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <!-- user_id -->
        <td<?= $Page->user_id->cellAttributes() ?>>
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
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
