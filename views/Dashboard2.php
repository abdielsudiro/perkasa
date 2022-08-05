<?php

namespace PHPMaker2021\perkasa2;

// Dashboard Page object
$Dashboard2 = $Page;
?>
<script>
var currentForm, currentPageID;
var fdashboard;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "dashboard";
    fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
    loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-vertical">
<div class="row">
<div class="<?= $Page->ItemClassNames[0] ?>">
<div id="Item1" class="card">
<div class="card-header">
    <h3 class="card-title"><?= $Language->chartPhrase("Report_RAB", "RABbyUnitKerja", "ChartCaption") ?></h3>
    <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Report_RAB = Container("Report_RAB");
$Report_RAB->RABbyUnitKerja->Width = 0;
$Report_RAB->RABbyUnitKerja->Height = 0;
$Report_RAB->RABbyUnitKerja->setParameter("clickurl", "ReportRab"); // Add click URL
$Report_RAB->RABbyUnitKerja->DrillDownUrl = ""; // No drill down for dashboard
$Report_RAB->RABbyUnitKerja->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?= $Page->ItemClassNames[1] ?>">
<div id="Item2" class="card">
<div class="card-header">
    <h3 class="card-title"><?= $Language->chartPhrase("ReportRABStatus", "ChartRABStatus", "ChartCaption") ?></h3>
    <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$ReportRABStatus = Container("ReportRABStatus");
$ReportRABStatus->ChartRABStatus->Width = 0;
$ReportRABStatus->ChartRABStatus->Height = 0;
$ReportRABStatus->ChartRABStatus->setParameter("clickurl", "ReportRabStatus"); // Add click URL
$ReportRABStatus->ChartRABStatus->DrillDownUrl = ""; // No drill down for dashboard
$ReportRABStatus->ChartRABStatus->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
