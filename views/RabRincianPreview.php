<?php

namespace PHPMaker2021\perkasa2;

// Page object
$RabRincianPreview = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid rab_rincian"><!-- .card -->
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
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
    <?php if ($Page->SortUrl($Page->rab_rincian_id) == "") { ?>
        <th class="<?= $Page->rab_rincian_id->headerCellClass() ?>"><?= $Page->rab_rincian_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->rab_rincian_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->rab_rincian_id->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->rab_rincian_id->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->rab_rincian_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->rab_rincian_id->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <?php if ($Page->SortUrl($Page->uraian) == "") { ?>
        <th class="<?= $Page->uraian->headerCellClass() ?>"><?= $Page->uraian->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->uraian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->uraian->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->uraian->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->uraian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->uraian->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
    <?php if ($Page->SortUrl($Page->volum) == "") { ?>
        <th class="<?= $Page->volum->headerCellClass() ?>"><?= $Page->volum->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->volum->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->volum->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->volum->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->volum->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->volum->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
    <?php if ($Page->SortUrl($Page->satuan) == "") { ?>
        <th class="<?= $Page->satuan->headerCellClass() ?>"><?= $Page->satuan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->satuan->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->satuan->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->satuan->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
    <?php if ($Page->SortUrl($Page->sbm) == "") { ?>
        <th class="<?= $Page->sbm->headerCellClass() ?>"><?= $Page->sbm->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->sbm->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->sbm->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->sbm->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->sbm->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->sbm->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
    <?php if ($Page->SortUrl($Page->kode_akun) == "") { ?>
        <th class="<?= $Page->kode_akun->headerCellClass() ?>"><?= $Page->kode_akun->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kode_akun->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->kode_akun->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->kode_akun->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->kode_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->kode_akun->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
    <?php if ($Page->SortUrl($Page->subtotal) == "") { ?>
        <th class="<?= $Page->subtotal->headerCellClass() ?>"><?= $Page->subtotal->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->subtotal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->subtotal->Name) ?>" data-sort-order="<?= $Page->SortField == $Page->subtotal->Name && $Page->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->SortField == $Page->subtotal->Name) { ?><?php if ($Page->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
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
    $Page->aggregateListRowValues(); // Aggregate row values

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
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <!-- rab_rincian_id -->
        <td<?= $Page->rab_rincian_id->cellAttributes() ?>>
<span<?= $Page->rab_rincian_id->viewAttributes() ?>>
<?= $Page->rab_rincian_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <!-- uraian -->
        <td<?= $Page->uraian->cellAttributes() ?>>
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <!-- volum -->
        <td<?= $Page->volum->cellAttributes() ?>>
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <!-- satuan -->
        <td<?= $Page->satuan->cellAttributes() ?>>
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <!-- sbm -->
        <td<?= $Page->sbm->cellAttributes() ?>>
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <!-- kode_akun -->
        <td<?= $Page->kode_akun->cellAttributes() ?>>
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <!-- subtotal -->
        <td<?= $Page->subtotal->cellAttributes() ?>>
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
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
<?php
    // Render aggregate row
    $Page->RowType = ROWTYPE_AGGREGATE; // Aggregate
    $Page->aggregateListRow(); // Prepare aggregate row

    // Render list options
    $Page->renderListOptions();
?>
    <tfoot><!-- Table footer -->
    <tr class="ew-table-footer">
<?php
// Render list options (footer, left)
$Page->ListOptions->render("footer", "left");
?>
<?php if ($Page->rab_rincian_id->Visible) { // rab_rincian_id ?>
        <!-- rab_rincian_id -->
        <td class="<?= $Page->rab_rincian_id->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <!-- uraian -->
        <td class="<?= $Page->uraian->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->volum->Visible) { // volum ?>
        <!-- volum -->
        <td class="<?= $Page->volum->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <!-- satuan -->
        <td class="<?= $Page->satuan->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->sbm->Visible) { // sbm ?>
        <!-- sbm -->
        <td class="<?= $Page->sbm->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { // kode_akun ?>
        <!-- kode_akun -->
        <td class="<?= $Page->kode_akun->footerCellClass() ?>">
        &nbsp;
        </td>
<?php } ?>
<?php if ($Page->subtotal->Visible) { // subtotal ?>
        <!-- subtotal -->
        <td class="<?= $Page->subtotal->footerCellClass() ?>">
        <span class="ew-aggregate"><?= $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
        <?= $Page->subtotal->ViewValue ?></span>
        </td>
<?php } ?>
<?php
// Render list options (footer, right)
$Page->ListOptions->render("footer", "right");
?>
    </tr>
    </tfoot>
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
