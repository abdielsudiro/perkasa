<?php

namespace PHPMaker2021\perkasa2;

// Page object
$ReportRabStatusSummary = &$Page;
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
while ($Page->GroupCount <= count($Page->GroupRecords) && $Page->GroupCount <= $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<?php if ($Page->GroupCount > 1) { ?>
</tbody>
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
<?= $Page->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_ReportRABStatus" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->id_statuses->Visible) { ?>
    <?php if ($Page->id_statuses->ShowGroupHeaderAsRow) { ?>
    <th data-name="id_statuses">&nbsp;</th>
    <?php } else { ?>
    <th data-name="id_statuses" class="<?= $Page->id_statuses->headerCellClass() ?>"><div class="ReportRABStatus_id_statuses"><?= $Page->renderSort($Page->id_statuses) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->subtotal->Visible) { ?>
    <?php if ($Page->subtotal->ShowGroupHeaderAsRow) { ?>
    <th data-name="subtotal">&nbsp;</th>
    <?php } else { ?>
    <th data-name="subtotal" class="<?= $Page->subtotal->headerCellClass() ?>" style="min-width: 15px;"><div class="ReportRABStatus_subtotal"><?= $Page->renderSort($Page->subtotal) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { ?>
    <th data-name="nama_satker" class="<?= $Page->nama_satker->headerCellClass() ?>"><div class="ReportRABStatus_nama_satker"><?= $Page->renderSort($Page->nama_satker) ?></div></th>
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

    // Build detail SQL
    $where = DetailFilterSql($Page->id_statuses, $Page->getSqlFirstGroupField(), $Page->id_statuses->groupValue(), $Page->Dbid);
    if ($Page->PageFirstGroupFilter != "") {
        $Page->PageFirstGroupFilter .= " OR ";
    }
    $Page->PageFirstGroupFilter .= $where;
    if ($Page->Filter != "") {
        $where = "($Page->Filter) AND ($where)";
    }
    $sql = $Page->buildReportSql($Page->getSqlSelect(), $Page->getSqlFrom(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
    $rs = $sql->execute();
    $Page->DetailRecords = $rs ? $rs->fetchAll() : [];
    $Page->DetailRecordCount = count($Page->DetailRecords);

    // Load detail records
    $Page->id_statuses->Records = &$Page->DetailRecords;
    $Page->id_statuses->LevelBreak = true; // Set field level break
    $Page->GroupCounter[1] = $Page->GroupCount;
    $Page->id_statuses->getCnt($Page->id_statuses->Records); // Get record count
    ?>
<?php if ($Page->id_statuses->Visible && $Page->id_statuses->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_TOTAL;
        $Page->RowTotalType = ROWTOTAL_GROUP;
        $Page->RowTotalSubType = ROWTOTAL_HEADER;
        $Page->RowGroupLevel = 1;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id_statuses->Visible) { ?>
        <td data-field="id_statuses"<?= $Page->id_statuses->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
        <td data-field="id_statuses" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?= $Page->id_statuses->cellAttributes() ?>>
        <span class="ew-summary-caption d-inline-block ReportRABStatus_id_statuses"><?= $Page->renderSort($Page->id_statuses) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->id_statuses->viewAttributes() ?>><?= $Page->id_statuses->GroupViewValue ?></span>
        <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->id_statuses->Count, 0); ?></span>)</span>
        </td>
    </tr>
<?php } ?>
    <?php
    $Page->subtotal->getDistinctValues($Page->id_statuses->Records);
    $Page->setGroupCount(count($Page->subtotal->DistinctValues), $Page->GroupCounter[1]);
    $Page->GroupCounter[2] = 0; // Init group count index
    foreach ($Page->subtotal->DistinctValues as $subtotal) { // Load records for this distinct value
    $Page->subtotal->setGroupValue($subtotal); // Set group value
    $Page->subtotal->getDistinctRecords($Page->id_statuses->Records, $Page->subtotal->groupValue());
    $Page->subtotal->LevelBreak = true; // Set field level break
    $Page->GroupCounter[2]++;
    $Page->subtotal->getCnt($Page->subtotal->Records); // Get record count
    $Page->setGroupCount($Page->subtotal->Count, $Page->GroupCounter[1], $Page->GroupCounter[2]);
    ?>
<?php if ($Page->subtotal->Visible && $Page->subtotal->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->subtotal->setDbValue($subtotal); // Set current value for subtotal
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_TOTAL;
        $Page->RowTotalType = ROWTOTAL_GROUP;
        $Page->RowTotalSubType = ROWTOTAL_HEADER;
        $Page->RowGroupLevel = 2;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id_statuses->Visible) { ?>
        <td data-field="id_statuses"<?= $Page->id_statuses->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->subtotal->Visible) { ?>
        <td data-field="subtotal"<?= $Page->subtotal->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
        <td data-field="subtotal" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?= $Page->subtotal->cellAttributes() ?>>
        <span class="ew-summary-caption d-inline-block ReportRABStatus_subtotal"><?= $Page->renderSort($Page->subtotal) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->subtotal->viewAttributes() ?>><?= $Page->subtotal->GroupViewValue ?></span>
        <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->subtotal->Count, 0); ?></span>)</span>
        </td>
    </tr>
<?php } ?>
    <?php
    $Page->RecordCount = 0; // Reset record count
    foreach ($Page->subtotal->Records as $record) {
        $Page->RecordCount++;
        $Page->RecordIndex++;
        $Page->loadRowValues($record);
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->id_statuses->Visible) { ?>
    <?php if ($Page->id_statuses->ShowGroupHeaderAsRow) { ?>
        <td data-field="id_statuses"<?= $Page->id_statuses->cellAttributes(); ?>>&nbsp;</td>
    <?php } else { ?>
        <td data-field="id_statuses"<?= $Page->id_statuses->cellAttributes(); ?>><span<?= $Page->id_statuses->viewAttributes() ?>><?= $Page->id_statuses->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->subtotal->Visible) { ?>
    <?php if ($Page->subtotal->ShowGroupHeaderAsRow) { ?>
        <td data-field="subtotal"<?= $Page->subtotal->cellAttributes(); ?>>&nbsp;</td>
    <?php } else { ?>
        <td data-field="subtotal"<?= $Page->subtotal->cellAttributes(); ?>><span<?= $Page->subtotal->viewAttributes() ?>><?= $Page->subtotal->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->nama_satker->Visible) { ?>
        <td data-field="nama_satker"<?= $Page->nama_satker->cellAttributes() ?>>
<span<?= $Page->nama_satker->viewAttributes() ?>>
<?= $Page->nama_satker->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
    }
    } // End group level 1
?>
<?php

    // Next group
    $Page->loadGroupRowValues();

    // Show header if page break
    if ($Page->isExport()) {
        $Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? false : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);
    }

    // Page_Breaking server event
    if ($Page->ShowHeader) {
        $Page->pageBreaking($Page->ShowHeader, $Page->PageBreakContent);
    }
    $Page->GroupCount++;
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
<?php if ($Page->id_statuses->ShowCompactSummaryFooter) { ?>
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
        $Page->ChartRABStatus->PageBreakType = "before"; // Page break type
        $Page->ChartRABStatus->PageBreak = $Page->ExportChartPageBreak;
        $Page->ChartRABStatus->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->ChartRABStatus->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->ChartRABStatus->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->ChartRABStatus->hasData()) { ?>
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
