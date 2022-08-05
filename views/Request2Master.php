<?php

namespace PHPMaker2021\perkasa2;

// Table
$request2 = Container("request2");
?>
<?php if ($request2->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_request2master" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($request2->request_id->Visible) { // request_id ?>
        <tr id="r_request_id">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->request_id->caption() ?></td>
            <td <?= $request2->request_id->cellAttributes() ?>>
<span id="el_request2_request_id">
<span<?= $request2->request_id->viewAttributes() ?>>
<?= $request2->request_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->process_id->Visible) { // process_id ?>
        <tr id="r_process_id">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->process_id->caption() ?></td>
            <td <?= $request2->process_id->cellAttributes() ?>>
<span id="el_request2_process_id">
<span<?= $request2->process_id->viewAttributes() ?>>
<?= $request2->process_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->title->Visible) { // title ?>
        <tr id="r_title">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->title->caption() ?></td>
            <td <?= $request2->title->cellAttributes() ?>>
<span id="el_request2_title">
<span<?= $request2->title->viewAttributes() ?>>
<?= $request2->title->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->date_requested->Visible) { // date_requested ?>
        <tr id="r_date_requested">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->date_requested->caption() ?></td>
            <td <?= $request2->date_requested->cellAttributes() ?>>
<span id="el_request2_date_requested">
<span<?= $request2->date_requested->viewAttributes() ?>>
<?= $request2->date_requested->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->user_id->Visible) { // user_id ?>
        <tr id="r_user_id">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->user_id->caption() ?></td>
            <td <?= $request2->user_id->cellAttributes() ?>>
<span id="el_request2_user_id">
<span<?= $request2->user_id->viewAttributes() ?>>
<?= $request2->user_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->_username->Visible) { // username ?>
        <tr id="r__username">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->_username->caption() ?></td>
            <td <?= $request2->_username->cellAttributes() ?>>
<span id="el_request2__username">
<span<?= $request2->_username->viewAttributes() ?>>
<?= $request2->_username->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($request2->current_state_id->Visible) { // current_state_id ?>
        <tr id="r_current_state_id">
            <td class="<?= $request2->TableLeftColumnClass ?>"><?= $request2->current_state_id->caption() ?></td>
            <td <?= $request2->current_state_id->cellAttributes() ?>>
<span id="el_request2_current_state_id">
<span<?= $request2->current_state_id->viewAttributes() ?>>
<?= $request2->current_state_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
