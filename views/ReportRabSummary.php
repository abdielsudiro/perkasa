<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ReportRabSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentForm, currentPageID;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?= $Page->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_Report_RAB" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->nama_satker->Visible) { ?>
    <th data-name="nama_satker" class="<?= $Page->nama_satker->headerCellClass() ?>"><div class="Report_RAB_nama_satker"><?= $Page->renderSort($Page->nama_satker) ?></div></th>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { ?>
    <th data-name="kode_kegiatan" class="<?= $Page->kode_kegiatan->headerCellClass() ?>"><div class="Report_RAB_kode_kegiatan"><?= $Page->renderSort($Page->kode_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { ?>
    <th data-name="uraian" class="<?= $Page->uraian->headerCellClass() ?>"><div class="Report_RAB_uraian"><?= $Page->renderSort($Page->uraian) ?></div></th>
<?php } ?>
<?php if ($Page->volum->Visible) { ?>
    <th data-name="volum" class="<?= $Page->volum->headerCellClass() ?>"><div class="Report_RAB_volum"><?= $Page->renderSort($Page->volum) ?></div></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { ?>
    <th data-name="satuan" class="<?= $Page->satuan->headerCellClass() ?>" style="min-width: 15px;"><div class="Report_RAB_satuan"><?= $Page->renderSort($Page->satuan) ?></div></th>
<?php } ?>
<?php if ($Page->sbm->Visible) { ?>
    <th data-name="sbm" class="<?= $Page->sbm->headerCellClass() ?>" style="min-width: 15px;"><div class="Report_RAB_sbm"><?= $Page->renderSort($Page->sbm) ?></div></th>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { ?>
    <th data-name="kode_akun" class="<?= $Page->kode_akun->headerCellClass() ?>"><div class="Report_RAB_kode_akun"><?= $Page->renderSort($Page->kode_akun) ?></div></th>
<?php } ?>
<?php if ($Page->subtotal->Visible) { ?>
    <th data-name="subtotal" class="<?= $Page->subtotal->headerCellClass() ?>" style="min-width: 15px;"><div class="Report_RAB_subtotal"><?= $Page->renderSort($Page->subtotal) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->nama_satker->Visible) { ?>
        <td data-field="nama_satker"<?= $Page->nama_satker->cellAttributes() ?>>
<span<?= $Page->nama_satker->viewAttributes() ?>>
<?= $Page->nama_satker->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kode_kegiatan->Visible) { ?>
        <td data-field="kode_kegiatan"<?= $Page->kode_kegiatan->cellAttributes() ?>>
<span<?= $Page->kode_kegiatan->viewAttributes() ?>>
<?= $Page->kode_kegiatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->uraian->Visible) { ?>
        <td data-field="uraian"<?= $Page->uraian->cellAttributes() ?>>
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->volum->Visible) { ?>
        <td data-field="volum"<?= $Page->volum->cellAttributes() ?>>
<span<?= $Page->volum->viewAttributes() ?>>
<?= $Page->volum->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->satuan->Visible) { ?>
        <td data-field="satuan"<?= $Page->satuan->cellAttributes() ?>>
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->sbm->Visible) { ?>
        <td data-field="sbm"<?= $Page->sbm->cellAttributes() ?>>
<span<?= $Page->sbm->viewAttributes() ?>>
<?= $Page->sbm->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kode_akun->Visible) { ?>
        <td data-field="kode_akun"<?= $Page->kode_akun->cellAttributes() ?>>
<span<?= $Page->kode_akun->viewAttributes() ?>>
<?= $Page->kode_akun->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->subtotal->Visible) { ?>
        <td data-field="subtotal"<?= $Page->subtotal->cellAttributes() ?>>
<span<?= $Page->subtotal->viewAttributes() ?>>
<?= $Page->subtotal->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, 0); ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
    <div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->RABbyUnitKerja->PageBreakType = "before"; // Page break type
        $Page->RABbyUnitKerja->PageBreak = $Page->ExportChartPageBreak;
        $Page->RABbyUnitKerja->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->RABbyUnitKerja->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->RABbyUnitKerja->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->RABbyUnitKerja->hasData()) { ?>
<?php if (!$Page->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
