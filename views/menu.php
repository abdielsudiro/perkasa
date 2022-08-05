<?php

namespace PHPMaker2021\perkasa2;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(613, "mi_Dashboard2", $MenuLanguage->MenuPhrase("613", "MenuText"), $MenuRelativePath . "Dashboard2", -1, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}Dashboard'), false, false, "", "", false);
$sideMenu->addMenuItem(525, "mci_RAB", $MenuLanguage->MenuPhrase("525", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(201, "mi_rab", $MenuLanguage->MenuPhrase("201", "MenuText"), $MenuRelativePath . "RabList", 525, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}rab'), false, false, "", "", false);
$sideMenu->addMenuItem(313, "mi_rab_rincian", $MenuLanguage->MenuPhrase("313", "MenuText"), $MenuRelativePath . "RabRincianList?cmd=resetall", 525, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}rab_rincian'), false, false, "", "", false);
$sideMenu->addMenuItem(460, "mi_rab_detail", $MenuLanguage->MenuPhrase("460", "MenuText"), $MenuRelativePath . "RabDetailList", 525, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}rab_detail'), false, false, "", "", false);
$sideMenu->addMenuItem(459, "mci_RAB_Request", $MenuLanguage->MenuPhrase("459", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(19, "mi_request2", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "Request2List", 459, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request'), false, false, "", "", false);
$sideMenu->addMenuItem(612, "mci_Reports", $MenuLanguage->MenuPhrase("612", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(44, "mci_Setting", $MenuLanguage->MenuPhrase("44", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(45, "mci_Master_Data", $MenuLanguage->MenuPhrase("45", "MenuText"), "", 44, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(27, "mi_satker", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "SatkerList", 45, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}satker'), false, false, "", "", false);
$sideMenu->addMenuItem(37, "mi_unit_org", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "UnitOrgList", 45, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}unit_org'), false, false, "", "", false);
$sideMenu->addMenuItem(46, "mci_Setup_MAG", $MenuLanguage->MenuPhrase("46", "MenuText"), "", 44, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(17, "mi_program", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "ProgramList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}program'), false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_kegiatan", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "KegiatanList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}kegiatan'), false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_kro", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "KroList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}kro'), false, false, "", "", false);
$sideMenu->addMenuItem(26, "mi_ro", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "RoList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}ro'), false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_komponen", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "KomponenList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}komponen'), false, false, "", "", false);
$sideMenu->addMenuItem(32, "mi_subkomponen", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "SubkomponenList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}subkomponen'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_akun", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "AkunList", 46, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}akun'), false, false, "", "", false);
$sideMenu->addMenuItem(95, "mci_Manage_Users", $MenuLanguage->MenuPhrase("95", "MenuText"), "", 44, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(40, "mi_users", $MenuLanguage->MenuPhrase("40", "MenuText"), $MenuRelativePath . "UsersList", 95, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}users'), false, false, "", "", false);
$sideMenu->addMenuItem(47, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("47", "MenuText"), $MenuRelativePath . "UserlevelpermissionsList", 95, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}userlevelpermissions'), false, false, "", "", false);
$sideMenu->addMenuItem(48, "mi_userlevels", $MenuLanguage->MenuPhrase("48", "MenuText"), $MenuRelativePath . "UserlevelsList", 95, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}userlevels'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_group", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "GroupList", 95, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}group'), false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_group_member", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "GroupMemberList", 95, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}group_member'), false, false, "", "", false);
$sideMenu->addMenuItem(308, "mci_Workflow", $MenuLanguage->MenuPhrase("308", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(311, "mci_Process_and_Activity", $MenuLanguage->MenuPhrase("311", "MenuText"), "", 308, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(1, "mi_action2", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "Action2List", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}action'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_action_target", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "ActionTargetList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}action_target'), false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_action_type", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "ActionTypeList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}action_type'), false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_activity", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "ActivityList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}activity'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_activity_target", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "ActivityTargetList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}activity_target'), false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_activity_type", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "ActivityTypeList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}activity_type'), false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_process", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "ProcessList?cmd=resetall", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}process'), false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_process_admin", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "ProcessAdminList", 311, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}process_admin'), false, false, "", "", false);
$sideMenu->addMenuItem(309, "mci_Request_Monitor", $MenuLanguage->MenuPhrase("309", "MenuText"), "", 308, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(20, "mi_request_action", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "RequestActionList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_action'), false, false, "", "", false);
$sideMenu->addMenuItem(21, "mi_request_data", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "RequestDataList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_data'), false, false, "", "", false);
$sideMenu->addMenuItem(22, "mi_request_file", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "RequestFileList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_file'), false, false, "", "", false);
$sideMenu->addMenuItem(23, "mi_request_note", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "RequestNoteList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_note'), false, false, "", "", false);
$sideMenu->addMenuItem(24, "mi_request_rab", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "RequestRabList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_rab'), false, false, "", "", false);
$sideMenu->addMenuItem(25, "mi_request_stakeholder", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "RequestStakeholderList?cmd=resetall", 309, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}request_stakeholder'), false, false, "", "", false);
$sideMenu->addMenuItem(310, "mci_State_Monitoring", $MenuLanguage->MenuPhrase("310", "MenuText"), "", 308, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(28, "mi_state", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "StateList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}state'), false, false, "", "", false);
$sideMenu->addMenuItem(29, "mi_state_activity", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "StateActivityList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}state_activity'), false, false, "", "", false);
$sideMenu->addMenuItem(30, "mi_state_type", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "StateTypeList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}state_type'), false, false, "", "", false);
$sideMenu->addMenuItem(33, "mi_target", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "TargetList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}target'), false, false, "", "", false);
$sideMenu->addMenuItem(34, "mi_transition", $MenuLanguage->MenuPhrase("34", "MenuText"), $MenuRelativePath . "TransitionList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}transition'), false, false, "", "", false);
$sideMenu->addMenuItem(35, "mi_transition_action", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "TransitionActionList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}transition_action'), false, false, "", "", false);
$sideMenu->addMenuItem(36, "mi_transition_activity", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "TransitionActivityList", 310, "", AllowListMenu('{B20675D9-527F-46BA-86B0-8B4F29ABE0ED}transition_activity'), false, false, "", "", false);
echo $sideMenu->toScript();
