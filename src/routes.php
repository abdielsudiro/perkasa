<?php

namespace PHPMaker2021\perkasa2;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // action2
    $app->any('/Action2List[/{action_id}]', Action2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Action2List-action2-list'); // list
    $app->any('/Action2Add[/{action_id}]', Action2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Action2Add-action2-add'); // add
    $app->any('/Action2View[/{action_id}]', Action2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Action2View-action2-view'); // view
    $app->any('/Action2Edit[/{action_id}]', Action2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Action2Edit-action2-edit'); // edit
    $app->any('/Action2Delete[/{action_id}]', Action2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Action2Delete-action2-delete'); // delete
    $app->group(
        '/action2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{action_id}]', Action2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('action2/list-action2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{action_id}]', Action2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('action2/add-action2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{action_id}]', Action2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('action2/view-action2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{action_id}]', Action2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('action2/edit-action2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{action_id}]', Action2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('action2/delete-action2-delete-2'); // delete
        }
    );

    // action_target
    $app->any('/ActionTargetList[/{action_target_id}]', ActionTargetController::class . ':list')->add(PermissionMiddleware::class)->setName('ActionTargetList-action_target-list'); // list
    $app->any('/ActionTargetAdd[/{action_target_id}]', ActionTargetController::class . ':add')->add(PermissionMiddleware::class)->setName('ActionTargetAdd-action_target-add'); // add
    $app->any('/ActionTargetView[/{action_target_id}]', ActionTargetController::class . ':view')->add(PermissionMiddleware::class)->setName('ActionTargetView-action_target-view'); // view
    $app->any('/ActionTargetEdit[/{action_target_id}]', ActionTargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('ActionTargetEdit-action_target-edit'); // edit
    $app->any('/ActionTargetDelete[/{action_target_id}]', ActionTargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('ActionTargetDelete-action_target-delete'); // delete
    $app->group(
        '/action_target',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{action_target_id}]', ActionTargetController::class . ':list')->add(PermissionMiddleware::class)->setName('action_target/list-action_target-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{action_target_id}]', ActionTargetController::class . ':add')->add(PermissionMiddleware::class)->setName('action_target/add-action_target-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{action_target_id}]', ActionTargetController::class . ':view')->add(PermissionMiddleware::class)->setName('action_target/view-action_target-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{action_target_id}]', ActionTargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('action_target/edit-action_target-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{action_target_id}]', ActionTargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('action_target/delete-action_target-delete-2'); // delete
        }
    );

    // action_type
    $app->any('/ActionTypeList[/{action_type_id}]', ActionTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('ActionTypeList-action_type-list'); // list
    $app->any('/ActionTypeAdd[/{action_type_id}]', ActionTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('ActionTypeAdd-action_type-add'); // add
    $app->any('/ActionTypeView[/{action_type_id}]', ActionTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('ActionTypeView-action_type-view'); // view
    $app->any('/ActionTypeEdit[/{action_type_id}]', ActionTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('ActionTypeEdit-action_type-edit'); // edit
    $app->any('/ActionTypeDelete[/{action_type_id}]', ActionTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('ActionTypeDelete-action_type-delete'); // delete
    $app->group(
        '/action_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{action_type_id}]', ActionTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('action_type/list-action_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{action_type_id}]', ActionTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('action_type/add-action_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{action_type_id}]', ActionTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('action_type/view-action_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{action_type_id}]', ActionTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('action_type/edit-action_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{action_type_id}]', ActionTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('action_type/delete-action_type-delete-2'); // delete
        }
    );

    // activity
    $app->any('/ActivityList[/{activity_id}]', ActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('ActivityList-activity-list'); // list
    $app->any('/ActivityAdd[/{activity_id}]', ActivityController::class . ':add')->add(PermissionMiddleware::class)->setName('ActivityAdd-activity-add'); // add
    $app->any('/ActivityView[/{activity_id}]', ActivityController::class . ':view')->add(PermissionMiddleware::class)->setName('ActivityView-activity-view'); // view
    $app->any('/ActivityEdit[/{activity_id}]', ActivityController::class . ':edit')->add(PermissionMiddleware::class)->setName('ActivityEdit-activity-edit'); // edit
    $app->any('/ActivityDelete[/{activity_id}]', ActivityController::class . ':delete')->add(PermissionMiddleware::class)->setName('ActivityDelete-activity-delete'); // delete
    $app->group(
        '/activity',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{activity_id}]', ActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('activity/list-activity-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{activity_id}]', ActivityController::class . ':add')->add(PermissionMiddleware::class)->setName('activity/add-activity-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{activity_id}]', ActivityController::class . ':view')->add(PermissionMiddleware::class)->setName('activity/view-activity-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{activity_id}]', ActivityController::class . ':edit')->add(PermissionMiddleware::class)->setName('activity/edit-activity-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{activity_id}]', ActivityController::class . ':delete')->add(PermissionMiddleware::class)->setName('activity/delete-activity-delete-2'); // delete
        }
    );

    // activity_target
    $app->any('/ActivityTargetList[/{activity_target_id}]', ActivityTargetController::class . ':list')->add(PermissionMiddleware::class)->setName('ActivityTargetList-activity_target-list'); // list
    $app->any('/ActivityTargetAdd[/{activity_target_id}]', ActivityTargetController::class . ':add')->add(PermissionMiddleware::class)->setName('ActivityTargetAdd-activity_target-add'); // add
    $app->any('/ActivityTargetView[/{activity_target_id}]', ActivityTargetController::class . ':view')->add(PermissionMiddleware::class)->setName('ActivityTargetView-activity_target-view'); // view
    $app->any('/ActivityTargetEdit[/{activity_target_id}]', ActivityTargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('ActivityTargetEdit-activity_target-edit'); // edit
    $app->any('/ActivityTargetDelete[/{activity_target_id}]', ActivityTargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('ActivityTargetDelete-activity_target-delete'); // delete
    $app->group(
        '/activity_target',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{activity_target_id}]', ActivityTargetController::class . ':list')->add(PermissionMiddleware::class)->setName('activity_target/list-activity_target-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{activity_target_id}]', ActivityTargetController::class . ':add')->add(PermissionMiddleware::class)->setName('activity_target/add-activity_target-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{activity_target_id}]', ActivityTargetController::class . ':view')->add(PermissionMiddleware::class)->setName('activity_target/view-activity_target-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{activity_target_id}]', ActivityTargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('activity_target/edit-activity_target-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{activity_target_id}]', ActivityTargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('activity_target/delete-activity_target-delete-2'); // delete
        }
    );

    // activity_type
    $app->any('/ActivityTypeList[/{activity_type_id}]', ActivityTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('ActivityTypeList-activity_type-list'); // list
    $app->any('/ActivityTypeAdd[/{activity_type_id}]', ActivityTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('ActivityTypeAdd-activity_type-add'); // add
    $app->any('/ActivityTypeView[/{activity_type_id}]', ActivityTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('ActivityTypeView-activity_type-view'); // view
    $app->any('/ActivityTypeEdit[/{activity_type_id}]', ActivityTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('ActivityTypeEdit-activity_type-edit'); // edit
    $app->any('/ActivityTypeDelete[/{activity_type_id}]', ActivityTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('ActivityTypeDelete-activity_type-delete'); // delete
    $app->group(
        '/activity_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{activity_type_id}]', ActivityTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('activity_type/list-activity_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{activity_type_id}]', ActivityTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('activity_type/add-activity_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{activity_type_id}]', ActivityTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('activity_type/view-activity_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{activity_type_id}]', ActivityTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('activity_type/edit-activity_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{activity_type_id}]', ActivityTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('activity_type/delete-activity_type-delete-2'); // delete
        }
    );

    // akun
    $app->any('/AkunList[/{id}]', AkunController::class . ':list')->add(PermissionMiddleware::class)->setName('AkunList-akun-list'); // list
    $app->any('/AkunAdd[/{id}]', AkunController::class . ':add')->add(PermissionMiddleware::class)->setName('AkunAdd-akun-add'); // add
    $app->any('/AkunView[/{id}]', AkunController::class . ':view')->add(PermissionMiddleware::class)->setName('AkunView-akun-view'); // view
    $app->any('/AkunEdit[/{id}]', AkunController::class . ':edit')->add(PermissionMiddleware::class)->setName('AkunEdit-akun-edit'); // edit
    $app->any('/AkunDelete[/{id}]', AkunController::class . ':delete')->add(PermissionMiddleware::class)->setName('AkunDelete-akun-delete'); // delete
    $app->group(
        '/akun',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AkunController::class . ':list')->add(PermissionMiddleware::class)->setName('akun/list-akun-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AkunController::class . ':add')->add(PermissionMiddleware::class)->setName('akun/add-akun-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AkunController::class . ':view')->add(PermissionMiddleware::class)->setName('akun/view-akun-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AkunController::class . ':edit')->add(PermissionMiddleware::class)->setName('akun/edit-akun-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AkunController::class . ':delete')->add(PermissionMiddleware::class)->setName('akun/delete-akun-delete-2'); // delete
        }
    );

    // detail
    $app->any('/DetailList[/{detail_id}]', DetailController::class . ':list')->add(PermissionMiddleware::class)->setName('DetailList-detail-list'); // list
    $app->any('/DetailAdd[/{detail_id}]', DetailController::class . ':add')->add(PermissionMiddleware::class)->setName('DetailAdd-detail-add'); // add
    $app->any('/DetailView[/{detail_id}]', DetailController::class . ':view')->add(PermissionMiddleware::class)->setName('DetailView-detail-view'); // view
    $app->any('/DetailEdit[/{detail_id}]', DetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('DetailEdit-detail-edit'); // edit
    $app->any('/DetailDelete[/{detail_id}]', DetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('DetailDelete-detail-delete'); // delete
    $app->group(
        '/detail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{detail_id}]', DetailController::class . ':list')->add(PermissionMiddleware::class)->setName('detail/list-detail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{detail_id}]', DetailController::class . ':add')->add(PermissionMiddleware::class)->setName('detail/add-detail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{detail_id}]', DetailController::class . ':view')->add(PermissionMiddleware::class)->setName('detail/view-detail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{detail_id}]', DetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('detail/edit-detail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{detail_id}]', DetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('detail/delete-detail-delete-2'); // delete
        }
    );

    // group
    $app->any('/GroupList[/{group_id}]', GroupController::class . ':list')->add(PermissionMiddleware::class)->setName('GroupList-group-list'); // list
    $app->any('/GroupAdd[/{group_id}]', GroupController::class . ':add')->add(PermissionMiddleware::class)->setName('GroupAdd-group-add'); // add
    $app->any('/GroupView[/{group_id}]', GroupController::class . ':view')->add(PermissionMiddleware::class)->setName('GroupView-group-view'); // view
    $app->any('/GroupEdit[/{group_id}]', GroupController::class . ':edit')->add(PermissionMiddleware::class)->setName('GroupEdit-group-edit'); // edit
    $app->any('/GroupDelete[/{group_id}]', GroupController::class . ':delete')->add(PermissionMiddleware::class)->setName('GroupDelete-group-delete'); // delete
    $app->group(
        '/group',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{group_id}]', GroupController::class . ':list')->add(PermissionMiddleware::class)->setName('group/list-group-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{group_id}]', GroupController::class . ':add')->add(PermissionMiddleware::class)->setName('group/add-group-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{group_id}]', GroupController::class . ':view')->add(PermissionMiddleware::class)->setName('group/view-group-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{group_id}]', GroupController::class . ':edit')->add(PermissionMiddleware::class)->setName('group/edit-group-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{group_id}]', GroupController::class . ':delete')->add(PermissionMiddleware::class)->setName('group/delete-group-delete-2'); // delete
        }
    );

    // group_member
    $app->any('/GroupMemberList', GroupMemberController::class . ':list')->add(PermissionMiddleware::class)->setName('GroupMemberList-group_member-list'); // list
    $app->group(
        '/group_member',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', GroupMemberController::class . ':list')->add(PermissionMiddleware::class)->setName('group_member/list-group_member-list-2'); // list
        }
    );

    // kegiatan
    $app->any('/KegiatanList[/{id}]', KegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('KegiatanList-kegiatan-list'); // list
    $app->any('/KegiatanAdd[/{id}]', KegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('KegiatanAdd-kegiatan-add'); // add
    $app->any('/KegiatanView[/{id}]', KegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('KegiatanView-kegiatan-view'); // view
    $app->any('/KegiatanEdit[/{id}]', KegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('KegiatanEdit-kegiatan-edit'); // edit
    $app->any('/KegiatanDelete[/{id}]', KegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('KegiatanDelete-kegiatan-delete'); // delete
    $app->group(
        '/kegiatan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('kegiatan/list-kegiatan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('kegiatan/add-kegiatan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('kegiatan/view-kegiatan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('kegiatan/edit-kegiatan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('kegiatan/delete-kegiatan-delete-2'); // delete
        }
    );

    // komponen
    $app->any('/KomponenList[/{id}]', KomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('KomponenList-komponen-list'); // list
    $app->any('/KomponenAdd[/{id}]', KomponenController::class . ':add')->add(PermissionMiddleware::class)->setName('KomponenAdd-komponen-add'); // add
    $app->any('/KomponenView[/{id}]', KomponenController::class . ':view')->add(PermissionMiddleware::class)->setName('KomponenView-komponen-view'); // view
    $app->any('/KomponenEdit[/{id}]', KomponenController::class . ':edit')->add(PermissionMiddleware::class)->setName('KomponenEdit-komponen-edit'); // edit
    $app->any('/KomponenDelete[/{id}]', KomponenController::class . ':delete')->add(PermissionMiddleware::class)->setName('KomponenDelete-komponen-delete'); // delete
    $app->group(
        '/komponen',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('komponen/list-komponen-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KomponenController::class . ':add')->add(PermissionMiddleware::class)->setName('komponen/add-komponen-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KomponenController::class . ':view')->add(PermissionMiddleware::class)->setName('komponen/view-komponen-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KomponenController::class . ':edit')->add(PermissionMiddleware::class)->setName('komponen/edit-komponen-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KomponenController::class . ':delete')->add(PermissionMiddleware::class)->setName('komponen/delete-komponen-delete-2'); // delete
        }
    );

    // kro
    $app->any('/KroList[/{id}]', KroController::class . ':list')->add(PermissionMiddleware::class)->setName('KroList-kro-list'); // list
    $app->any('/KroAdd[/{id}]', KroController::class . ':add')->add(PermissionMiddleware::class)->setName('KroAdd-kro-add'); // add
    $app->any('/KroView[/{id}]', KroController::class . ':view')->add(PermissionMiddleware::class)->setName('KroView-kro-view'); // view
    $app->any('/KroEdit[/{id}]', KroController::class . ':edit')->add(PermissionMiddleware::class)->setName('KroEdit-kro-edit'); // edit
    $app->any('/KroDelete[/{id}]', KroController::class . ':delete')->add(PermissionMiddleware::class)->setName('KroDelete-kro-delete'); // delete
    $app->group(
        '/kro',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KroController::class . ':list')->add(PermissionMiddleware::class)->setName('kro/list-kro-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KroController::class . ':add')->add(PermissionMiddleware::class)->setName('kro/add-kro-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KroController::class . ':view')->add(PermissionMiddleware::class)->setName('kro/view-kro-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KroController::class . ':edit')->add(PermissionMiddleware::class)->setName('kro/edit-kro-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KroController::class . ':delete')->add(PermissionMiddleware::class)->setName('kro/delete-kro-delete-2'); // delete
        }
    );

    // process
    $app->any('/ProcessList[/{process_id}]', ProcessController::class . ':list')->add(PermissionMiddleware::class)->setName('ProcessList-process-list'); // list
    $app->any('/ProcessAdd[/{process_id}]', ProcessController::class . ':add')->add(PermissionMiddleware::class)->setName('ProcessAdd-process-add'); // add
    $app->any('/ProcessView[/{process_id}]', ProcessController::class . ':view')->add(PermissionMiddleware::class)->setName('ProcessView-process-view'); // view
    $app->any('/ProcessEdit[/{process_id}]', ProcessController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProcessEdit-process-edit'); // edit
    $app->any('/ProcessDelete[/{process_id}]', ProcessController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProcessDelete-process-delete'); // delete
    $app->any('/ProcessPreview', ProcessController::class . ':preview')->add(PermissionMiddleware::class)->setName('ProcessPreview-process-preview'); // preview
    $app->group(
        '/process',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{process_id}]', ProcessController::class . ':list')->add(PermissionMiddleware::class)->setName('process/list-process-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{process_id}]', ProcessController::class . ':add')->add(PermissionMiddleware::class)->setName('process/add-process-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{process_id}]', ProcessController::class . ':view')->add(PermissionMiddleware::class)->setName('process/view-process-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{process_id}]', ProcessController::class . ':edit')->add(PermissionMiddleware::class)->setName('process/edit-process-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{process_id}]', ProcessController::class . ':delete')->add(PermissionMiddleware::class)->setName('process/delete-process-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', ProcessController::class . ':preview')->add(PermissionMiddleware::class)->setName('process/preview-process-preview-2'); // preview
        }
    );

    // process_admin
    $app->any('/ProcessAdminList', ProcessAdminController::class . ':list')->add(PermissionMiddleware::class)->setName('ProcessAdminList-process_admin-list'); // list
    $app->group(
        '/process_admin',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', ProcessAdminController::class . ':list')->add(PermissionMiddleware::class)->setName('process_admin/list-process_admin-list-2'); // list
        }
    );

    // program
    $app->any('/ProgramList[/{id}]', ProgramController::class . ':list')->add(PermissionMiddleware::class)->setName('ProgramList-program-list'); // list
    $app->any('/ProgramAdd[/{id}]', ProgramController::class . ':add')->add(PermissionMiddleware::class)->setName('ProgramAdd-program-add'); // add
    $app->any('/ProgramView[/{id}]', ProgramController::class . ':view')->add(PermissionMiddleware::class)->setName('ProgramView-program-view'); // view
    $app->any('/ProgramEdit[/{id}]', ProgramController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProgramEdit-program-edit'); // edit
    $app->any('/ProgramDelete[/{id}]', ProgramController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProgramDelete-program-delete'); // delete
    $app->group(
        '/program',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ProgramController::class . ':list')->add(PermissionMiddleware::class)->setName('program/list-program-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ProgramController::class . ':add')->add(PermissionMiddleware::class)->setName('program/add-program-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ProgramController::class . ':view')->add(PermissionMiddleware::class)->setName('program/view-program-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ProgramController::class . ':edit')->add(PermissionMiddleware::class)->setName('program/edit-program-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ProgramController::class . ':delete')->add(PermissionMiddleware::class)->setName('program/delete-program-delete-2'); // delete
        }
    );

    // rab_kegiatan2
    $app->any('/RabKegiatan2List[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('RabKegiatan2List-rab_kegiatan2-list'); // list
    $app->any('/RabKegiatan2Add[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('RabKegiatan2Add-rab_kegiatan2-add'); // add
    $app->any('/RabKegiatan2View[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('RabKegiatan2View-rab_kegiatan2-view'); // view
    $app->any('/RabKegiatan2Edit[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('RabKegiatan2Edit-rab_kegiatan2-edit'); // edit
    $app->any('/RabKegiatan2Delete[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('RabKegiatan2Delete-rab_kegiatan2-delete'); // delete
    $app->group(
        '/rab_kegiatan2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('rab_kegiatan2/list-rab_kegiatan2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('rab_kegiatan2/add-rab_kegiatan2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('rab_kegiatan2/view-rab_kegiatan2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_kegiatan2/edit-rab_kegiatan2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{rab_kegiatan_id}]', RabKegiatan2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_kegiatan2/delete-rab_kegiatan2-delete-2'); // delete
        }
    );

    // request2
    $app->any('/Request2List[/{request_id}]', Request2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Request2List-request2-list'); // list
    $app->any('/Request2Add[/{request_id}]', Request2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Request2Add-request2-add'); // add
    $app->any('/Request2View[/{request_id}]', Request2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Request2View-request2-view'); // view
    $app->any('/Request2Edit[/{request_id}]', Request2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Request2Edit-request2-edit'); // edit
    $app->any('/Request2Delete[/{request_id}]', Request2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Request2Delete-request2-delete'); // delete
    $app->group(
        '/request2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_id}]', Request2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('request2/list-request2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_id}]', Request2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('request2/add-request2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_id}]', Request2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('request2/view-request2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_id}]', Request2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('request2/edit-request2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_id}]', Request2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('request2/delete-request2-delete-2'); // delete
        }
    );

    // request_action
    $app->any('/RequestActionList[/{request_action_id}]', RequestActionController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestActionList-request_action-list'); // list
    $app->any('/RequestActionAdd[/{request_action_id}]', RequestActionController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestActionAdd-request_action-add'); // add
    $app->any('/RequestActionView[/{request_action_id}]', RequestActionController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestActionView-request_action-view'); // view
    $app->any('/RequestActionEdit[/{request_action_id}]', RequestActionController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestActionEdit-request_action-edit'); // edit
    $app->any('/RequestActionDelete[/{request_action_id}]', RequestActionController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestActionDelete-request_action-delete'); // delete
    $app->any('/RequestActionPreview', RequestActionController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestActionPreview-request_action-preview'); // preview
    $app->group(
        '/request_action',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_action_id}]', RequestActionController::class . ':list')->add(PermissionMiddleware::class)->setName('request_action/list-request_action-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_action_id}]', RequestActionController::class . ':add')->add(PermissionMiddleware::class)->setName('request_action/add-request_action-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_action_id}]', RequestActionController::class . ':view')->add(PermissionMiddleware::class)->setName('request_action/view-request_action-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_action_id}]', RequestActionController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_action/edit-request_action-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_action_id}]', RequestActionController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_action/delete-request_action-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestActionController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_action/preview-request_action-preview-2'); // preview
        }
    );

    // request_data
    $app->any('/RequestDataList[/{request_data_id}]', RequestDataController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestDataList-request_data-list'); // list
    $app->any('/RequestDataAdd[/{request_data_id}]', RequestDataController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestDataAdd-request_data-add'); // add
    $app->any('/RequestDataView[/{request_data_id}]', RequestDataController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestDataView-request_data-view'); // view
    $app->any('/RequestDataEdit[/{request_data_id}]', RequestDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestDataEdit-request_data-edit'); // edit
    $app->any('/RequestDataDelete[/{request_data_id}]', RequestDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestDataDelete-request_data-delete'); // delete
    $app->any('/RequestDataPreview', RequestDataController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestDataPreview-request_data-preview'); // preview
    $app->group(
        '/request_data',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_data_id}]', RequestDataController::class . ':list')->add(PermissionMiddleware::class)->setName('request_data/list-request_data-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_data_id}]', RequestDataController::class . ':add')->add(PermissionMiddleware::class)->setName('request_data/add-request_data-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_data_id}]', RequestDataController::class . ':view')->add(PermissionMiddleware::class)->setName('request_data/view-request_data-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_data_id}]', RequestDataController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_data/edit-request_data-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_data_id}]', RequestDataController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_data/delete-request_data-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestDataController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_data/preview-request_data-preview-2'); // preview
        }
    );

    // request_file
    $app->any('/RequestFileList[/{request_file_id}]', RequestFileController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestFileList-request_file-list'); // list
    $app->any('/RequestFileAdd[/{request_file_id}]', RequestFileController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestFileAdd-request_file-add'); // add
    $app->any('/RequestFileView[/{request_file_id}]', RequestFileController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestFileView-request_file-view'); // view
    $app->any('/RequestFileEdit[/{request_file_id}]', RequestFileController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestFileEdit-request_file-edit'); // edit
    $app->any('/RequestFileDelete[/{request_file_id}]', RequestFileController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestFileDelete-request_file-delete'); // delete
    $app->any('/RequestFilePreview', RequestFileController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestFilePreview-request_file-preview'); // preview
    $app->group(
        '/request_file',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_file_id}]', RequestFileController::class . ':list')->add(PermissionMiddleware::class)->setName('request_file/list-request_file-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_file_id}]', RequestFileController::class . ':add')->add(PermissionMiddleware::class)->setName('request_file/add-request_file-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_file_id}]', RequestFileController::class . ':view')->add(PermissionMiddleware::class)->setName('request_file/view-request_file-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_file_id}]', RequestFileController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_file/edit-request_file-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_file_id}]', RequestFileController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_file/delete-request_file-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestFileController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_file/preview-request_file-preview-2'); // preview
        }
    );

    // request_note
    $app->any('/RequestNoteList[/{request_note_id}]', RequestNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestNoteList-request_note-list'); // list
    $app->any('/RequestNoteAdd[/{request_note_id}]', RequestNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestNoteAdd-request_note-add'); // add
    $app->any('/RequestNoteView[/{request_note_id}]', RequestNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestNoteView-request_note-view'); // view
    $app->any('/RequestNoteEdit[/{request_note_id}]', RequestNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestNoteEdit-request_note-edit'); // edit
    $app->any('/RequestNoteDelete[/{request_note_id}]', RequestNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestNoteDelete-request_note-delete'); // delete
    $app->any('/RequestNotePreview', RequestNoteController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestNotePreview-request_note-preview'); // preview
    $app->group(
        '/request_note',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_note_id}]', RequestNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('request_note/list-request_note-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_note_id}]', RequestNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('request_note/add-request_note-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_note_id}]', RequestNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('request_note/view-request_note-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_note_id}]', RequestNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_note/edit-request_note-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_note_id}]', RequestNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_note/delete-request_note-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestNoteController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_note/preview-request_note-preview-2'); // preview
        }
    );

    // request_rab
    $app->any('/RequestRabList[/{request_rab_id}]', RequestRabController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestRabList-request_rab-list'); // list
    $app->any('/RequestRabAdd[/{request_rab_id}]', RequestRabController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestRabAdd-request_rab-add'); // add
    $app->any('/RequestRabView[/{request_rab_id}]', RequestRabController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestRabView-request_rab-view'); // view
    $app->any('/RequestRabEdit[/{request_rab_id}]', RequestRabController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestRabEdit-request_rab-edit'); // edit
    $app->any('/RequestRabDelete[/{request_rab_id}]', RequestRabController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestRabDelete-request_rab-delete'); // delete
    $app->any('/RequestRabPreview', RequestRabController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestRabPreview-request_rab-preview'); // preview
    $app->group(
        '/request_rab',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_rab_id}]', RequestRabController::class . ':list')->add(PermissionMiddleware::class)->setName('request_rab/list-request_rab-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_rab_id}]', RequestRabController::class . ':add')->add(PermissionMiddleware::class)->setName('request_rab/add-request_rab-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_rab_id}]', RequestRabController::class . ':view')->add(PermissionMiddleware::class)->setName('request_rab/view-request_rab-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_rab_id}]', RequestRabController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_rab/edit-request_rab-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_rab_id}]', RequestRabController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_rab/delete-request_rab-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestRabController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_rab/preview-request_rab-preview-2'); // preview
        }
    );

    // request_stakeholder
    $app->any('/RequestStakeholderList[/{request_id}]', RequestStakeholderController::class . ':list')->add(PermissionMiddleware::class)->setName('RequestStakeholderList-request_stakeholder-list'); // list
    $app->any('/RequestStakeholderAdd[/{request_id}]', RequestStakeholderController::class . ':add')->add(PermissionMiddleware::class)->setName('RequestStakeholderAdd-request_stakeholder-add'); // add
    $app->any('/RequestStakeholderView[/{request_id}]', RequestStakeholderController::class . ':view')->add(PermissionMiddleware::class)->setName('RequestStakeholderView-request_stakeholder-view'); // view
    $app->any('/RequestStakeholderEdit[/{request_id}]', RequestStakeholderController::class . ':edit')->add(PermissionMiddleware::class)->setName('RequestStakeholderEdit-request_stakeholder-edit'); // edit
    $app->any('/RequestStakeholderDelete[/{request_id}]', RequestStakeholderController::class . ':delete')->add(PermissionMiddleware::class)->setName('RequestStakeholderDelete-request_stakeholder-delete'); // delete
    $app->any('/RequestStakeholderPreview', RequestStakeholderController::class . ':preview')->add(PermissionMiddleware::class)->setName('RequestStakeholderPreview-request_stakeholder-preview'); // preview
    $app->group(
        '/request_stakeholder',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{request_id}]', RequestStakeholderController::class . ':list')->add(PermissionMiddleware::class)->setName('request_stakeholder/list-request_stakeholder-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{request_id}]', RequestStakeholderController::class . ':add')->add(PermissionMiddleware::class)->setName('request_stakeholder/add-request_stakeholder-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{request_id}]', RequestStakeholderController::class . ':view')->add(PermissionMiddleware::class)->setName('request_stakeholder/view-request_stakeholder-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{request_id}]', RequestStakeholderController::class . ':edit')->add(PermissionMiddleware::class)->setName('request_stakeholder/edit-request_stakeholder-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{request_id}]', RequestStakeholderController::class . ':delete')->add(PermissionMiddleware::class)->setName('request_stakeholder/delete-request_stakeholder-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RequestStakeholderController::class . ':preview')->add(PermissionMiddleware::class)->setName('request_stakeholder/preview-request_stakeholder-preview-2'); // preview
        }
    );

    // ro
    $app->any('/RoList[/{id}]', RoController::class . ':list')->add(PermissionMiddleware::class)->setName('RoList-ro-list'); // list
    $app->any('/RoAdd[/{id}]', RoController::class . ':add')->add(PermissionMiddleware::class)->setName('RoAdd-ro-add'); // add
    $app->any('/RoView[/{id}]', RoController::class . ':view')->add(PermissionMiddleware::class)->setName('RoView-ro-view'); // view
    $app->any('/RoEdit[/{id}]', RoController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoEdit-ro-edit'); // edit
    $app->any('/RoDelete[/{id}]', RoController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoDelete-ro-delete'); // delete
    $app->group(
        '/ro',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoController::class . ':list')->add(PermissionMiddleware::class)->setName('ro/list-ro-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoController::class . ':add')->add(PermissionMiddleware::class)->setName('ro/add-ro-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoController::class . ':view')->add(PermissionMiddleware::class)->setName('ro/view-ro-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoController::class . ':edit')->add(PermissionMiddleware::class)->setName('ro/edit-ro-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoController::class . ':delete')->add(PermissionMiddleware::class)->setName('ro/delete-ro-delete-2'); // delete
        }
    );

    // satker
    $app->any('/SatkerList[/{satker_id}]', SatkerController::class . ':list')->add(PermissionMiddleware::class)->setName('SatkerList-satker-list'); // list
    $app->any('/SatkerAdd[/{satker_id}]', SatkerController::class . ':add')->add(PermissionMiddleware::class)->setName('SatkerAdd-satker-add'); // add
    $app->any('/SatkerView[/{satker_id}]', SatkerController::class . ':view')->add(PermissionMiddleware::class)->setName('SatkerView-satker-view'); // view
    $app->any('/SatkerEdit[/{satker_id}]', SatkerController::class . ':edit')->add(PermissionMiddleware::class)->setName('SatkerEdit-satker-edit'); // edit
    $app->any('/SatkerDelete[/{satker_id}]', SatkerController::class . ':delete')->add(PermissionMiddleware::class)->setName('SatkerDelete-satker-delete'); // delete
    $app->group(
        '/satker',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{satker_id}]', SatkerController::class . ':list')->add(PermissionMiddleware::class)->setName('satker/list-satker-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{satker_id}]', SatkerController::class . ':add')->add(PermissionMiddleware::class)->setName('satker/add-satker-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{satker_id}]', SatkerController::class . ':view')->add(PermissionMiddleware::class)->setName('satker/view-satker-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{satker_id}]', SatkerController::class . ':edit')->add(PermissionMiddleware::class)->setName('satker/edit-satker-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{satker_id}]', SatkerController::class . ':delete')->add(PermissionMiddleware::class)->setName('satker/delete-satker-delete-2'); // delete
        }
    );

    // state
    $app->any('/StateList[/{state_id}]', StateController::class . ':list')->add(PermissionMiddleware::class)->setName('StateList-state-list'); // list
    $app->any('/StateAdd[/{state_id}]', StateController::class . ':add')->add(PermissionMiddleware::class)->setName('StateAdd-state-add'); // add
    $app->any('/StateView[/{state_id}]', StateController::class . ':view')->add(PermissionMiddleware::class)->setName('StateView-state-view'); // view
    $app->any('/StateEdit[/{state_id}]', StateController::class . ':edit')->add(PermissionMiddleware::class)->setName('StateEdit-state-edit'); // edit
    $app->any('/StateDelete[/{state_id}]', StateController::class . ':delete')->add(PermissionMiddleware::class)->setName('StateDelete-state-delete'); // delete
    $app->group(
        '/state',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{state_id}]', StateController::class . ':list')->add(PermissionMiddleware::class)->setName('state/list-state-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{state_id}]', StateController::class . ':add')->add(PermissionMiddleware::class)->setName('state/add-state-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{state_id}]', StateController::class . ':view')->add(PermissionMiddleware::class)->setName('state/view-state-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{state_id}]', StateController::class . ':edit')->add(PermissionMiddleware::class)->setName('state/edit-state-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{state_id}]', StateController::class . ':delete')->add(PermissionMiddleware::class)->setName('state/delete-state-delete-2'); // delete
        }
    );

    // state_activity
    $app->any('/StateActivityList', StateActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('StateActivityList-state_activity-list'); // list
    $app->group(
        '/state_activity',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', StateActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('state_activity/list-state_activity-list-2'); // list
        }
    );

    // state_type
    $app->any('/StateTypeList[/{state_type_id}]', StateTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('StateTypeList-state_type-list'); // list
    $app->any('/StateTypeAdd[/{state_type_id}]', StateTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('StateTypeAdd-state_type-add'); // add
    $app->any('/StateTypeView[/{state_type_id}]', StateTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('StateTypeView-state_type-view'); // view
    $app->any('/StateTypeEdit[/{state_type_id}]', StateTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('StateTypeEdit-state_type-edit'); // edit
    $app->any('/StateTypeDelete[/{state_type_id}]', StateTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('StateTypeDelete-state_type-delete'); // delete
    $app->group(
        '/state_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{state_type_id}]', StateTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('state_type/list-state_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{state_type_id}]', StateTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('state_type/add-state_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{state_type_id}]', StateTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('state_type/view-state_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{state_type_id}]', StateTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('state_type/edit-state_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{state_type_id}]', StateTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('state_type/delete-state_type-delete-2'); // delete
        }
    );

    // subdetail
    $app->any('/SubdetailList[/{subdetail_id}]', SubdetailController::class . ':list')->add(PermissionMiddleware::class)->setName('SubdetailList-subdetail-list'); // list
    $app->any('/SubdetailAdd[/{subdetail_id}]', SubdetailController::class . ':add')->add(PermissionMiddleware::class)->setName('SubdetailAdd-subdetail-add'); // add
    $app->any('/SubdetailView[/{subdetail_id}]', SubdetailController::class . ':view')->add(PermissionMiddleware::class)->setName('SubdetailView-subdetail-view'); // view
    $app->any('/SubdetailEdit[/{subdetail_id}]', SubdetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('SubdetailEdit-subdetail-edit'); // edit
    $app->any('/SubdetailDelete[/{subdetail_id}]', SubdetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('SubdetailDelete-subdetail-delete'); // delete
    $app->group(
        '/subdetail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{subdetail_id}]', SubdetailController::class . ':list')->add(PermissionMiddleware::class)->setName('subdetail/list-subdetail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{subdetail_id}]', SubdetailController::class . ':add')->add(PermissionMiddleware::class)->setName('subdetail/add-subdetail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{subdetail_id}]', SubdetailController::class . ':view')->add(PermissionMiddleware::class)->setName('subdetail/view-subdetail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{subdetail_id}]', SubdetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('subdetail/edit-subdetail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{subdetail_id}]', SubdetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('subdetail/delete-subdetail-delete-2'); // delete
        }
    );

    // subkomponen
    $app->any('/SubkomponenList[/{kode_subkomponen}]', SubkomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('SubkomponenList-subkomponen-list'); // list
    $app->any('/SubkomponenAdd[/{kode_subkomponen}]', SubkomponenController::class . ':add')->add(PermissionMiddleware::class)->setName('SubkomponenAdd-subkomponen-add'); // add
    $app->any('/SubkomponenView[/{kode_subkomponen}]', SubkomponenController::class . ':view')->add(PermissionMiddleware::class)->setName('SubkomponenView-subkomponen-view'); // view
    $app->any('/SubkomponenEdit[/{kode_subkomponen}]', SubkomponenController::class . ':edit')->add(PermissionMiddleware::class)->setName('SubkomponenEdit-subkomponen-edit'); // edit
    $app->any('/SubkomponenDelete[/{kode_subkomponen}]', SubkomponenController::class . ':delete')->add(PermissionMiddleware::class)->setName('SubkomponenDelete-subkomponen-delete'); // delete
    $app->group(
        '/subkomponen',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{kode_subkomponen}]', SubkomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('subkomponen/list-subkomponen-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{kode_subkomponen}]', SubkomponenController::class . ':add')->add(PermissionMiddleware::class)->setName('subkomponen/add-subkomponen-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{kode_subkomponen}]', SubkomponenController::class . ':view')->add(PermissionMiddleware::class)->setName('subkomponen/view-subkomponen-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{kode_subkomponen}]', SubkomponenController::class . ':edit')->add(PermissionMiddleware::class)->setName('subkomponen/edit-subkomponen-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{kode_subkomponen}]', SubkomponenController::class . ':delete')->add(PermissionMiddleware::class)->setName('subkomponen/delete-subkomponen-delete-2'); // delete
        }
    );

    // target
    $app->any('/TargetList[/{target_id}]', TargetController::class . ':list')->add(PermissionMiddleware::class)->setName('TargetList-target-list'); // list
    $app->any('/TargetAdd[/{target_id}]', TargetController::class . ':add')->add(PermissionMiddleware::class)->setName('TargetAdd-target-add'); // add
    $app->any('/TargetView[/{target_id}]', TargetController::class . ':view')->add(PermissionMiddleware::class)->setName('TargetView-target-view'); // view
    $app->any('/TargetEdit[/{target_id}]', TargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('TargetEdit-target-edit'); // edit
    $app->any('/TargetDelete[/{target_id}]', TargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('TargetDelete-target-delete'); // delete
    $app->group(
        '/target',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{target_id}]', TargetController::class . ':list')->add(PermissionMiddleware::class)->setName('target/list-target-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{target_id}]', TargetController::class . ':add')->add(PermissionMiddleware::class)->setName('target/add-target-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{target_id}]', TargetController::class . ':view')->add(PermissionMiddleware::class)->setName('target/view-target-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{target_id}]', TargetController::class . ':edit')->add(PermissionMiddleware::class)->setName('target/edit-target-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{target_id}]', TargetController::class . ':delete')->add(PermissionMiddleware::class)->setName('target/delete-target-delete-2'); // delete
        }
    );

    // transition
    $app->any('/TransitionList[/{transition_id}]', TransitionController::class . ':list')->add(PermissionMiddleware::class)->setName('TransitionList-transition-list'); // list
    $app->any('/TransitionAdd[/{transition_id}]', TransitionController::class . ':add')->add(PermissionMiddleware::class)->setName('TransitionAdd-transition-add'); // add
    $app->any('/TransitionView[/{transition_id}]', TransitionController::class . ':view')->add(PermissionMiddleware::class)->setName('TransitionView-transition-view'); // view
    $app->any('/TransitionEdit[/{transition_id}]', TransitionController::class . ':edit')->add(PermissionMiddleware::class)->setName('TransitionEdit-transition-edit'); // edit
    $app->any('/TransitionDelete[/{transition_id}]', TransitionController::class . ':delete')->add(PermissionMiddleware::class)->setName('TransitionDelete-transition-delete'); // delete
    $app->group(
        '/transition',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{transition_id}]', TransitionController::class . ':list')->add(PermissionMiddleware::class)->setName('transition/list-transition-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{transition_id}]', TransitionController::class . ':add')->add(PermissionMiddleware::class)->setName('transition/add-transition-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{transition_id}]', TransitionController::class . ':view')->add(PermissionMiddleware::class)->setName('transition/view-transition-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{transition_id}]', TransitionController::class . ':edit')->add(PermissionMiddleware::class)->setName('transition/edit-transition-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{transition_id}]', TransitionController::class . ':delete')->add(PermissionMiddleware::class)->setName('transition/delete-transition-delete-2'); // delete
        }
    );

    // transition_action
    $app->any('/TransitionActionList', TransitionActionController::class . ':list')->add(PermissionMiddleware::class)->setName('TransitionActionList-transition_action-list'); // list
    $app->group(
        '/transition_action',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', TransitionActionController::class . ':list')->add(PermissionMiddleware::class)->setName('transition_action/list-transition_action-list-2'); // list
        }
    );

    // transition_activity
    $app->any('/TransitionActivityList', TransitionActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('TransitionActivityList-transition_activity-list'); // list
    $app->group(
        '/transition_activity',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', TransitionActivityController::class . ':list')->add(PermissionMiddleware::class)->setName('transition_activity/list-transition_activity-list-2'); // list
        }
    );

    // unit_org
    $app->any('/UnitOrgList[/{unit_org_id}]', UnitOrgController::class . ':list')->add(PermissionMiddleware::class)->setName('UnitOrgList-unit_org-list'); // list
    $app->any('/UnitOrgAdd[/{unit_org_id}]', UnitOrgController::class . ':add')->add(PermissionMiddleware::class)->setName('UnitOrgAdd-unit_org-add'); // add
    $app->any('/UnitOrgView[/{unit_org_id}]', UnitOrgController::class . ':view')->add(PermissionMiddleware::class)->setName('UnitOrgView-unit_org-view'); // view
    $app->any('/UnitOrgEdit[/{unit_org_id}]', UnitOrgController::class . ':edit')->add(PermissionMiddleware::class)->setName('UnitOrgEdit-unit_org-edit'); // edit
    $app->any('/UnitOrgDelete[/{unit_org_id}]', UnitOrgController::class . ':delete')->add(PermissionMiddleware::class)->setName('UnitOrgDelete-unit_org-delete'); // delete
    $app->group(
        '/unit_org',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{unit_org_id}]', UnitOrgController::class . ':list')->add(PermissionMiddleware::class)->setName('unit_org/list-unit_org-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{unit_org_id}]', UnitOrgController::class . ':add')->add(PermissionMiddleware::class)->setName('unit_org/add-unit_org-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{unit_org_id}]', UnitOrgController::class . ':view')->add(PermissionMiddleware::class)->setName('unit_org/view-unit_org-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{unit_org_id}]', UnitOrgController::class . ':edit')->add(PermissionMiddleware::class)->setName('unit_org/edit-unit_org-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{unit_org_id}]', UnitOrgController::class . ':delete')->add(PermissionMiddleware::class)->setName('unit_org/delete-unit_org-delete-2'); // delete
        }
    );

    // user_level2
    $app->any('/UserLevel2List[/{user_level_id}]', UserLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('UserLevel2List-user_level2-list'); // list
    $app->any('/UserLevel2Add[/{user_level_id}]', UserLevel2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('UserLevel2Add-user_level2-add'); // add
    $app->any('/UserLevel2View[/{user_level_id}]', UserLevel2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('UserLevel2View-user_level2-view'); // view
    $app->any('/UserLevel2Edit[/{user_level_id}]', UserLevel2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('UserLevel2Edit-user_level2-edit'); // edit
    $app->any('/UserLevel2Delete[/{user_level_id}]', UserLevel2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('UserLevel2Delete-user_level2-delete'); // delete
    $app->group(
        '/user_level2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{user_level_id}]', UserLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('user_level2/list-user_level2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{user_level_id}]', UserLevel2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('user_level2/add-user_level2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{user_level_id}]', UserLevel2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('user_level2/view-user_level2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{user_level_id}]', UserLevel2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('user_level2/edit-user_level2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{user_level_id}]', UserLevel2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('user_level2/delete-user_level2-delete-2'); // delete
        }
    );

    // user_level_permission
    $app->any('/UserLevelPermissionList[/{user_level_permission_id}]', UserLevelPermissionController::class . ':list')->add(PermissionMiddleware::class)->setName('UserLevelPermissionList-user_level_permission-list'); // list
    $app->any('/UserLevelPermissionAdd[/{user_level_permission_id}]', UserLevelPermissionController::class . ':add')->add(PermissionMiddleware::class)->setName('UserLevelPermissionAdd-user_level_permission-add'); // add
    $app->any('/UserLevelPermissionView[/{user_level_permission_id}]', UserLevelPermissionController::class . ':view')->add(PermissionMiddleware::class)->setName('UserLevelPermissionView-user_level_permission-view'); // view
    $app->any('/UserLevelPermissionEdit[/{user_level_permission_id}]', UserLevelPermissionController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserLevelPermissionEdit-user_level_permission-edit'); // edit
    $app->any('/UserLevelPermissionDelete[/{user_level_permission_id}]', UserLevelPermissionController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserLevelPermissionDelete-user_level_permission-delete'); // delete
    $app->group(
        '/user_level_permission',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{user_level_permission_id}]', UserLevelPermissionController::class . ':list')->add(PermissionMiddleware::class)->setName('user_level_permission/list-user_level_permission-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{user_level_permission_id}]', UserLevelPermissionController::class . ':add')->add(PermissionMiddleware::class)->setName('user_level_permission/add-user_level_permission-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{user_level_permission_id}]', UserLevelPermissionController::class . ':view')->add(PermissionMiddleware::class)->setName('user_level_permission/view-user_level_permission-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{user_level_permission_id}]', UserLevelPermissionController::class . ':edit')->add(PermissionMiddleware::class)->setName('user_level_permission/edit-user_level_permission-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{user_level_permission_id}]', UserLevelPermissionController::class . ':delete')->add(PermissionMiddleware::class)->setName('user_level_permission/delete-user_level_permission-delete-2'); // delete
        }
    );

    // users
    $app->any('/UsersList[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->any('/UsersAdd[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->any('/UsersView[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->any('/UsersEdit[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->any('/UsersDelete[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->any('/UserlevelpermissionsList[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->any('/UserlevelpermissionsAdd[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsAdd-userlevelpermissions-add'); // add
    $app->any('/UserlevelpermissionsView[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->any('/UserlevelpermissionsEdit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->any('/UserlevelpermissionsDelete[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsDelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->any('/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->any('/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->any('/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->any('/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->any('/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // v_uraian_level
    $app->any('/VUraianLevelList', VUraianLevelController::class . ':list')->add(PermissionMiddleware::class)->setName('VUraianLevelList-v_uraian_level-list'); // list
    $app->group(
        '/v_uraian_level',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VUraianLevelController::class . ':list')->add(PermissionMiddleware::class)->setName('v_uraian_level/list-v_uraian_level-list-2'); // list
        }
    );

    // v_level_7
    $app->any('/VLevel7List', VLevel7Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel7List-v_level_7-list'); // list
    $app->group(
        '/v_level_7',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel7Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_7/list-v_level_7-list-2'); // list
        }
    );

    // v_level_1
    $app->any('/VLevel1List', VLevel1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel1List-v_level_1-list'); // list
    $app->group(
        '/v_level_1',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_1/list-v_level_1-list-2'); // list
        }
    );

    // v_level_2
    $app->any('/VLevel2List', VLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel2List-v_level_2-list'); // list
    $app->group(
        '/v_level_2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_2/list-v_level_2-list-2'); // list
        }
    );

    // v_level_3
    $app->any('/VLevel3List', VLevel3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel3List-v_level_3-list'); // list
    $app->group(
        '/v_level_3',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_3/list-v_level_3-list-2'); // list
        }
    );

    // v_level_4
    $app->any('/VLevel4List', VLevel4Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel4List-v_level_4-list'); // list
    $app->group(
        '/v_level_4',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel4Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_4/list-v_level_4-list-2'); // list
        }
    );

    // v_level_5
    $app->any('/VLevel5List', VLevel5Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel5List-v_level_5-list'); // list
    $app->group(
        '/v_level_5',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel5Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_5/list-v_level_5-list-2'); // list
        }
    );

    // v_level_6
    $app->any('/VLevel6List', VLevel6Controller::class . ':list')->add(PermissionMiddleware::class)->setName('VLevel6List-v_level_6-list'); // list
    $app->group(
        '/v_level_6',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VLevel6Controller::class . ':list')->add(PermissionMiddleware::class)->setName('v_level_6/list-v_level_6-list-2'); // list
        }
    );

    // v_akun
    $app->any('/VAkunList', VAkunController::class . ':list')->add(PermissionMiddleware::class)->setName('VAkunList-v_akun-list'); // list
    $app->group(
        '/v_akun',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VAkunController::class . ':list')->add(PermissionMiddleware::class)->setName('v_akun/list-v_akun-list-2'); // list
        }
    );

    // v_kegiatan
    $app->any('/VKegiatanList', VKegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('VKegiatanList-v_kegiatan-list'); // list
    $app->group(
        '/v_kegiatan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VKegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('v_kegiatan/list-v_kegiatan-list-2'); // list
        }
    );

    // v_komponen
    $app->any('/VKomponenList', VKomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('VKomponenList-v_komponen-list'); // list
    $app->group(
        '/v_komponen',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VKomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('v_komponen/list-v_komponen-list-2'); // list
        }
    );

    // v_kro
    $app->any('/VKroList', VKroController::class . ':list')->add(PermissionMiddleware::class)->setName('VKroList-v_kro-list'); // list
    $app->group(
        '/v_kro',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VKroController::class . ':list')->add(PermissionMiddleware::class)->setName('v_kro/list-v_kro-list-2'); // list
        }
    );

    // v_program
    $app->any('/VProgramList', VProgramController::class . ':list')->add(PermissionMiddleware::class)->setName('VProgramList-v_program-list'); // list
    $app->group(
        '/v_program',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VProgramController::class . ':list')->add(PermissionMiddleware::class)->setName('v_program/list-v_program-list-2'); // list
        }
    );

    // v_ro
    $app->any('/VRoList', VRoController::class . ':list')->add(PermissionMiddleware::class)->setName('VRoList-v_ro-list'); // list
    $app->group(
        '/v_ro',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VRoController::class . ':list')->add(PermissionMiddleware::class)->setName('v_ro/list-v_ro-list-2'); // list
        }
    );

    // v_subkomponen
    $app->any('/VSubkomponenList', VSubkomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('VSubkomponenList-v_subkomponen-list'); // list
    $app->group(
        '/v_subkomponen',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VSubkomponenController::class . ':list')->add(PermissionMiddleware::class)->setName('v_subkomponen/list-v_subkomponen-list-2'); // list
        }
    );

    // rab
    $app->any('/RabList[/{id_rab}]', RabController::class . ':list')->add(PermissionMiddleware::class)->setName('RabList-rab-list'); // list
    $app->any('/RabAdd[/{id_rab}]', RabController::class . ':add')->add(PermissionMiddleware::class)->setName('RabAdd-rab-add'); // add
    $app->any('/RabView[/{id_rab}]', RabController::class . ':view')->add(PermissionMiddleware::class)->setName('RabView-rab-view'); // view
    $app->any('/RabEdit[/{id_rab}]', RabController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabEdit-rab-edit'); // edit
    $app->any('/RabDelete[/{id_rab}]', RabController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabDelete-rab-delete'); // delete
    $app->group(
        '/rab',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_rab}]', RabController::class . ':list')->add(PermissionMiddleware::class)->setName('rab/list-rab-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_rab}]', RabController::class . ':add')->add(PermissionMiddleware::class)->setName('rab/add-rab-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_rab}]', RabController::class . ':view')->add(PermissionMiddleware::class)->setName('rab/view-rab-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_rab}]', RabController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab/edit-rab-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_rab}]', RabController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab/delete-rab-delete-2'); // delete
        }
    );

    // sub_akun
    $app->any('/SubAkunList[/{detail_id}]', SubAkunController::class . ':list')->add(PermissionMiddleware::class)->setName('SubAkunList-sub_akun-list'); // list
    $app->any('/SubAkunAdd[/{detail_id}]', SubAkunController::class . ':add')->add(PermissionMiddleware::class)->setName('SubAkunAdd-sub_akun-add'); // add
    $app->any('/SubAkunView[/{detail_id}]', SubAkunController::class . ':view')->add(PermissionMiddleware::class)->setName('SubAkunView-sub_akun-view'); // view
    $app->any('/SubAkunEdit[/{detail_id}]', SubAkunController::class . ':edit')->add(PermissionMiddleware::class)->setName('SubAkunEdit-sub_akun-edit'); // edit
    $app->any('/SubAkunDelete[/{detail_id}]', SubAkunController::class . ':delete')->add(PermissionMiddleware::class)->setName('SubAkunDelete-sub_akun-delete'); // delete
    $app->group(
        '/sub_akun',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{detail_id}]', SubAkunController::class . ':list')->add(PermissionMiddleware::class)->setName('sub_akun/list-sub_akun-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{detail_id}]', SubAkunController::class . ':add')->add(PermissionMiddleware::class)->setName('sub_akun/add-sub_akun-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{detail_id}]', SubAkunController::class . ':view')->add(PermissionMiddleware::class)->setName('sub_akun/view-sub_akun-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{detail_id}]', SubAkunController::class . ':edit')->add(PermissionMiddleware::class)->setName('sub_akun/edit-sub_akun-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{detail_id}]', SubAkunController::class . ':delete')->add(PermissionMiddleware::class)->setName('sub_akun/delete-sub_akun-delete-2'); // delete
        }
    );

    // rab_rincian
    $app->any('/RabRincianList[/{rab_rincian_id}]', RabRincianController::class . ':list')->add(PermissionMiddleware::class)->setName('RabRincianList-rab_rincian-list'); // list
    $app->any('/RabRincianAdd[/{rab_rincian_id}]', RabRincianController::class . ':add')->add(PermissionMiddleware::class)->setName('RabRincianAdd-rab_rincian-add'); // add
    $app->any('/RabRincianView[/{rab_rincian_id}]', RabRincianController::class . ':view')->add(PermissionMiddleware::class)->setName('RabRincianView-rab_rincian-view'); // view
    $app->any('/RabRincianEdit[/{rab_rincian_id}]', RabRincianController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabRincianEdit-rab_rincian-edit'); // edit
    $app->any('/RabRincianDelete[/{rab_rincian_id}]', RabRincianController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabRincianDelete-rab_rincian-delete'); // delete
    $app->any('/RabRincianPreview', RabRincianController::class . ':preview')->add(PermissionMiddleware::class)->setName('RabRincianPreview-rab_rincian-preview'); // preview
    $app->group(
        '/rab_rincian',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{rab_rincian_id}]', RabRincianController::class . ':list')->add(PermissionMiddleware::class)->setName('rab_rincian/list-rab_rincian-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{rab_rincian_id}]', RabRincianController::class . ':add')->add(PermissionMiddleware::class)->setName('rab_rincian/add-rab_rincian-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{rab_rincian_id}]', RabRincianController::class . ':view')->add(PermissionMiddleware::class)->setName('rab_rincian/view-rab_rincian-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{rab_rincian_id}]', RabRincianController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_rincian/edit-rab_rincian-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{rab_rincian_id}]', RabRincianController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_rincian/delete-rab_rincian-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RabRincianController::class . ':preview')->add(PermissionMiddleware::class)->setName('rab_rincian/preview-rab_rincian-preview-2'); // preview
        }
    );

    // penelaah_note
    $app->any('/PenelaahNoteList[/{approval_note_id}]', PenelaahNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('PenelaahNoteList-penelaah_note-list'); // list
    $app->any('/PenelaahNoteAdd[/{approval_note_id}]', PenelaahNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('PenelaahNoteAdd-penelaah_note-add'); // add
    $app->any('/PenelaahNoteView[/{approval_note_id}]', PenelaahNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('PenelaahNoteView-penelaah_note-view'); // view
    $app->any('/PenelaahNoteEdit[/{approval_note_id}]', PenelaahNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenelaahNoteEdit-penelaah_note-edit'); // edit
    $app->any('/PenelaahNoteDelete[/{approval_note_id}]', PenelaahNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('PenelaahNoteDelete-penelaah_note-delete'); // delete
    $app->group(
        '/penelaah_note',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{approval_note_id}]', PenelaahNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('penelaah_note/list-penelaah_note-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{approval_note_id}]', PenelaahNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('penelaah_note/add-penelaah_note-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{approval_note_id}]', PenelaahNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('penelaah_note/view-penelaah_note-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{approval_note_id}]', PenelaahNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('penelaah_note/edit-penelaah_note-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{approval_note_id}]', PenelaahNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('penelaah_note/delete-penelaah_note-delete-2'); // delete
        }
    );

    // reviewer_note
    $app->any('/ReviewerNoteList[/{reviewer_note_id}]', ReviewerNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('ReviewerNoteList-reviewer_note-list'); // list
    $app->any('/ReviewerNoteAdd[/{reviewer_note_id}]', ReviewerNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('ReviewerNoteAdd-reviewer_note-add'); // add
    $app->any('/ReviewerNoteView[/{reviewer_note_id}]', ReviewerNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('ReviewerNoteView-reviewer_note-view'); // view
    $app->any('/ReviewerNoteEdit[/{reviewer_note_id}]', ReviewerNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('ReviewerNoteEdit-reviewer_note-edit'); // edit
    $app->any('/ReviewerNoteDelete[/{reviewer_note_id}]', ReviewerNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('ReviewerNoteDelete-reviewer_note-delete'); // delete
    $app->group(
        '/reviewer_note',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{reviewer_note_id}]', ReviewerNoteController::class . ':list')->add(PermissionMiddleware::class)->setName('reviewer_note/list-reviewer_note-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{reviewer_note_id}]', ReviewerNoteController::class . ':add')->add(PermissionMiddleware::class)->setName('reviewer_note/add-reviewer_note-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{reviewer_note_id}]', ReviewerNoteController::class . ':view')->add(PermissionMiddleware::class)->setName('reviewer_note/view-reviewer_note-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{reviewer_note_id}]', ReviewerNoteController::class . ':edit')->add(PermissionMiddleware::class)->setName('reviewer_note/edit-reviewer_note-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{reviewer_note_id}]', ReviewerNoteController::class . ':delete')->add(PermissionMiddleware::class)->setName('reviewer_note/delete-reviewer_note-delete-2'); // delete
        }
    );

    // rab_detail
    $app->any('/RabDetailList[/{id}]', RabDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('RabDetailList-rab_detail-list'); // list
    $app->any('/RabDetailAdd[/{id}]', RabDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('RabDetailAdd-rab_detail-add'); // add
    $app->any('/RabDetailView[/{id}]', RabDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('RabDetailView-rab_detail-view'); // view
    $app->any('/RabDetailEdit[/{id}]', RabDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabDetailEdit-rab_detail-edit'); // edit
    $app->any('/RabDetailDelete[/{id}]', RabDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabDetailDelete-rab_detail-delete'); // delete
    $app->group(
        '/rab_detail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RabDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('rab_detail/list-rab_detail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RabDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('rab_detail/add-rab_detail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RabDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('rab_detail/view-rab_detail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RabDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_detail/edit-rab_detail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RabDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_detail/delete-rab_detail-delete-2'); // delete
        }
    );

    // rab_file
    $app->any('/RabFileList[/{id_rab_file}]', RabFileController::class . ':list')->add(PermissionMiddleware::class)->setName('RabFileList-rab_file-list'); // list
    $app->any('/RabFileAdd[/{id_rab_file}]', RabFileController::class . ':add')->add(PermissionMiddleware::class)->setName('RabFileAdd-rab_file-add'); // add
    $app->any('/RabFileView[/{id_rab_file}]', RabFileController::class . ':view')->add(PermissionMiddleware::class)->setName('RabFileView-rab_file-view'); // view
    $app->any('/RabFileEdit[/{id_rab_file}]', RabFileController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabFileEdit-rab_file-edit'); // edit
    $app->any('/RabFileDelete[/{id_rab_file}]', RabFileController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabFileDelete-rab_file-delete'); // delete
    $app->any('/RabFilePreview', RabFileController::class . ':preview')->add(PermissionMiddleware::class)->setName('RabFilePreview-rab_file-preview'); // preview
    $app->group(
        '/rab_file',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_rab_file}]', RabFileController::class . ':list')->add(PermissionMiddleware::class)->setName('rab_file/list-rab_file-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_rab_file}]', RabFileController::class . ':add')->add(PermissionMiddleware::class)->setName('rab_file/add-rab_file-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_rab_file}]', RabFileController::class . ':view')->add(PermissionMiddleware::class)->setName('rab_file/view-rab_file-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_rab_file}]', RabFileController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_file/edit-rab_file-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_rab_file}]', RabFileController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_file/delete-rab_file-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RabFileController::class . ':preview')->add(PermissionMiddleware::class)->setName('rab_file/preview-rab_file-preview-2'); // preview
        }
    );

    // rab_note_penelaah
    $app->any('/RabNotePenelaahList[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':list')->add(PermissionMiddleware::class)->setName('RabNotePenelaahList-rab_note_penelaah-list'); // list
    $app->any('/RabNotePenelaahAdd[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':add')->add(PermissionMiddleware::class)->setName('RabNotePenelaahAdd-rab_note_penelaah-add'); // add
    $app->any('/RabNotePenelaahView[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':view')->add(PermissionMiddleware::class)->setName('RabNotePenelaahView-rab_note_penelaah-view'); // view
    $app->any('/RabNotePenelaahEdit[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabNotePenelaahEdit-rab_note_penelaah-edit'); // edit
    $app->any('/RabNotePenelaahDelete[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabNotePenelaahDelete-rab_note_penelaah-delete'); // delete
    $app->any('/RabNotePenelaahPreview', RabNotePenelaahController::class . ':preview')->add(PermissionMiddleware::class)->setName('RabNotePenelaahPreview-rab_note_penelaah-preview'); // preview
    $app->group(
        '/rab_note_penelaah',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':list')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/list-rab_note_penelaah-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':add')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/add-rab_note_penelaah-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':view')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/view-rab_note_penelaah-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/edit-rab_note_penelaah-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_rab_note_penelaah}]', RabNotePenelaahController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/delete-rab_note_penelaah-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RabNotePenelaahController::class . ':preview')->add(PermissionMiddleware::class)->setName('rab_note_penelaah/preview-rab_note_penelaah-preview-2'); // preview
        }
    );

    // rab_note_penyetuju
    $app->any('/RabNotePenyetujuList[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':list')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuList-rab_note_penyetuju-list'); // list
    $app->any('/RabNotePenyetujuAdd[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':add')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuAdd-rab_note_penyetuju-add'); // add
    $app->any('/RabNotePenyetujuView[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':view')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuView-rab_note_penyetuju-view'); // view
    $app->any('/RabNotePenyetujuEdit[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':edit')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuEdit-rab_note_penyetuju-edit'); // edit
    $app->any('/RabNotePenyetujuDelete[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':delete')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuDelete-rab_note_penyetuju-delete'); // delete
    $app->any('/RabNotePenyetujuPreview', RabNotePenyetujuController::class . ':preview')->add(PermissionMiddleware::class)->setName('RabNotePenyetujuPreview-rab_note_penyetuju-preview'); // preview
    $app->group(
        '/rab_note_penyetuju',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':list')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/list-rab_note_penyetuju-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':add')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/add-rab_note_penyetuju-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':view')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/view-rab_note_penyetuju-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':edit')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/edit-rab_note_penyetuju-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_rab_note_penyetuju}]', RabNotePenyetujuController::class . ':delete')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/delete-rab_note_penyetuju-delete-2'); // delete
            $group->any('/' . Config("PREVIEW_ACTION") . '', RabNotePenyetujuController::class . ':preview')->add(PermissionMiddleware::class)->setName('rab_note_penyetuju/preview-rab_note_penyetuju-preview-2'); // preview
        }
    );

    // Report_RAB
    $app->any('/ReportRab', ReportRabController::class)->add(PermissionMiddleware::class)->setName('ReportRab-Report_RAB-summary'); // summary

    // Dashboard2
    $app->any('/Dashboard2', Dashboard2Controller::class)->add(PermissionMiddleware::class)->setName('Dashboard2-Dashboard2-dashboard'); // dashboard

    // ReportRABStatus
    $app->any('/ReportRabStatus', ReportRabStatusController::class)->add(PermissionMiddleware::class)->setName('ReportRabStatus-ReportRABStatus-summary'); // summary

    // statuses
    $app->any('/StatusesList[/{id_statuses}]', StatusesController::class . ':list')->add(PermissionMiddleware::class)->setName('StatusesList-statuses-list'); // list
    $app->any('/StatusesAdd[/{id_statuses}]', StatusesController::class . ':add')->add(PermissionMiddleware::class)->setName('StatusesAdd-statuses-add'); // add
    $app->any('/StatusesView[/{id_statuses}]', StatusesController::class . ':view')->add(PermissionMiddleware::class)->setName('StatusesView-statuses-view'); // view
    $app->any('/StatusesEdit[/{id_statuses}]', StatusesController::class . ':edit')->add(PermissionMiddleware::class)->setName('StatusesEdit-statuses-edit'); // edit
    $app->any('/StatusesDelete[/{id_statuses}]', StatusesController::class . ':delete')->add(PermissionMiddleware::class)->setName('StatusesDelete-statuses-delete'); // delete
    $app->group(
        '/statuses',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_statuses}]', StatusesController::class . ':list')->add(PermissionMiddleware::class)->setName('statuses/list-statuses-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_statuses}]', StatusesController::class . ':add')->add(PermissionMiddleware::class)->setName('statuses/add-statuses-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_statuses}]', StatusesController::class . ':view')->add(PermissionMiddleware::class)->setName('statuses/view-statuses-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_statuses}]', StatusesController::class . ':edit')->add(PermissionMiddleware::class)->setName('statuses/edit-statuses-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_statuses}]', StatusesController::class . ':delete')->add(PermissionMiddleware::class)->setName('statuses/delete-statuses-delete-2'); // delete
        }
    );

    // v_rab_menunggu
    $app->any('/VRabMenungguList[/{id_rab}]', VRabMenungguController::class . ':list')->add(PermissionMiddleware::class)->setName('VRabMenungguList-v_rab_menunggu-list'); // list
    $app->group(
        '/v_rab_menunggu',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_rab}]', VRabMenungguController::class . ':list')->add(PermissionMiddleware::class)->setName('v_rab_menunggu/list-v_rab_menunggu-list-2'); // list
        }
    );

    // v_rab_report
    $app->any('/VRabReportList', VRabReportController::class . ':list')->add(PermissionMiddleware::class)->setName('VRabReportList-v_rab_report-list'); // list
    $app->group(
        '/v_rab_report',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VRabReportController::class . ':list')->add(PermissionMiddleware::class)->setName('v_rab_report/list-v_rab_report-list-2'); // list
        }
    );

    // v_rab_status
    $app->any('/VRabStatusList', VRabStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('VRabStatusList-v_rab_status-list'); // list
    $app->group(
        '/v_rab_status',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', VRabStatusController::class . ':list')->add(PermissionMiddleware::class)->setName('v_rab_status/list-v_rab_status-list-2'); // list
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->any('/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // captcha
    $app->any('/captcha[/{page}]', OthersController::class . ':captcha')->add(PermissionMiddleware::class)->setName('captcha');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
