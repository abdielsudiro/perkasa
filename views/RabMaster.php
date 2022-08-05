<?php

namespace PHPMaker2021\perkasa2;

// Table
$rab = Container("rab");
?>
<?php if ($rab->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_rabmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($rab->id_rab->Visible) { // id_rab ?>
        <tr id="r_id_rab">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->id_rab->caption() ?></td>
            <td <?= $rab->id_rab->cellAttributes() ?>>
<span id="el_rab_id_rab">
<span<?= $rab->id_rab->viewAttributes() ?>>
<?= $rab->id_rab->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rab->satker_id->Visible) { // satker_id ?>
        <tr id="r_satker_id">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->satker_id->caption() ?></td>
            <td <?= $rab->satker_id->cellAttributes() ?>>
<span id="el_rab_satker_id">
<span<?= $rab->satker_id->viewAttributes() ?>>
<?= $rab->satker_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rab->kode_kegiatan->Visible) { // kode_kegiatan ?>
        <tr id="r_kode_kegiatan">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->kode_kegiatan->caption() ?></td>
            <td <?= $rab->kode_kegiatan->cellAttributes() ?>>
<span id="el_rab_kode_kegiatan">
<span<?= $rab->kode_kegiatan->viewAttributes() ?>>
<?= $rab->kode_kegiatan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rab->id_statuses->Visible) { // id_statuses ?>
        <tr id="r_id_statuses">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->id_statuses->caption() ?></td>
            <td <?= $rab->id_statuses->cellAttributes() ?>>
<span id="el_rab_id_statuses">
<span<?= $rab->id_statuses->viewAttributes() ?>>
<?= $rab->id_statuses->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rab->isApprovalAgree->Visible) { // isApprovalAgree ?>
        <tr id="r_isApprovalAgree">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->isApprovalAgree->caption() ?></td>
            <td <?= $rab->isApprovalAgree->cellAttributes() ?>>
<span id="el_rab_isApprovalAgree">
<span<?= $rab->isApprovalAgree->viewAttributes() ?>>
<?= $rab->isApprovalAgree->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rab->isPenelaahAgree->Visible) { // isPenelaahAgree ?>
        <tr id="r_isPenelaahAgree">
            <td class="<?= $rab->TableLeftColumnClass ?>"><?= $rab->isPenelaahAgree->caption() ?></td>
            <td <?= $rab->isPenelaahAgree->cellAttributes() ?>>
<span id="el_rab_isPenelaahAgree">
<span<?= $rab->isPenelaahAgree->viewAttributes() ?>>
<?= $rab->isPenelaahAgree->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
