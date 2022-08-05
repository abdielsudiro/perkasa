<?php

namespace PHPMaker2021\perkasa2;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "action2" => \DI\create(Action2::class),
    "action_target" => \DI\create(ActionTarget::class),
    "action_type" => \DI\create(ActionType::class),
    "activity" => \DI\create(Activity::class),
    "activity_target" => \DI\create(ActivityTarget::class),
    "activity_type" => \DI\create(ActivityType::class),
    "akun" => \DI\create(Akun::class),
    "detail" => \DI\create(Detail::class),
    "group" => \DI\create(Group::class),
    "group_member" => \DI\create(GroupMember::class),
    "kegiatan" => \DI\create(Kegiatan::class),
    "komponen" => \DI\create(Komponen::class),
    "kro" => \DI\create(Kro::class),
    "process" => \DI\create(Process::class),
    "process_admin" => \DI\create(ProcessAdmin::class),
    "program" => \DI\create(Program::class),
    "rab_kegiatan2" => \DI\create(RabKegiatan2::class),
    "request2" => \DI\create(Request2::class),
    "request_action" => \DI\create(RequestAction::class),
    "request_data" => \DI\create(RequestData::class),
    "request_file" => \DI\create(RequestFile::class),
    "request_note" => \DI\create(RequestNote::class),
    "request_rab" => \DI\create(RequestRab::class),
    "request_stakeholder" => \DI\create(RequestStakeholder::class),
    "ro" => \DI\create(Ro::class),
    "satker" => \DI\create(Satker::class),
    "state" => \DI\create(State::class),
    "state_activity" => \DI\create(StateActivity::class),
    "state_type" => \DI\create(StateType::class),
    "subdetail" => \DI\create(Subdetail::class),
    "subkomponen" => \DI\create(Subkomponen::class),
    "target" => \DI\create(Target::class),
    "transition" => \DI\create(Transition::class),
    "transition_action" => \DI\create(TransitionAction::class),
    "transition_activity" => \DI\create(TransitionActivity::class),
    "unit_org" => \DI\create(UnitOrg::class),
    "user_level2" => \DI\create(UserLevel2::class),
    "user_level_permission" => \DI\create(UserLevelPermission::class),
    "users" => \DI\create(Users::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "v_uraian_level" => \DI\create(VUraianLevel::class),
    "v_level_7" => \DI\create(VLevel7::class),
    "v_level_1" => \DI\create(VLevel1::class),
    "v_level_2" => \DI\create(VLevel2::class),
    "v_level_3" => \DI\create(VLevel3::class),
    "v_level_4" => \DI\create(VLevel4::class),
    "v_level_5" => \DI\create(VLevel5::class),
    "v_level_6" => \DI\create(VLevel6::class),
    "v_akun" => \DI\create(VAkun::class),
    "v_kegiatan" => \DI\create(VKegiatan::class),
    "v_komponen" => \DI\create(VKomponen::class),
    "v_kro" => \DI\create(VKro::class),
    "v_program" => \DI\create(VProgram::class),
    "v_ro" => \DI\create(VRo::class),
    "v_subkomponen" => \DI\create(VSubkomponen::class),
    "rab" => \DI\create(Rab::class),
    "sub_akun" => \DI\create(SubAkun::class),
    "rab_rincian" => \DI\create(RabRincian::class),
    "penelaah_note" => \DI\create(PenelaahNote::class),
    "reviewer_note" => \DI\create(ReviewerNote::class),
    "rab_detail" => \DI\create(RabDetail::class),
    "rab_file" => \DI\create(RabFile::class),
    "rab_note_penelaah" => \DI\create(RabNotePenelaah::class),
    "rab_note_penyetuju" => \DI\create(RabNotePenyetuju::class),
    "Report_RAB" => \DI\create(ReportRab::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "ReportRABStatus" => \DI\create(ReportRabStatus::class),
    "statuses" => \DI\create(Statuses::class),
    "v_rab_menunggu" => \DI\create(VRabMenunggu::class),
    "v_rab_report" => \DI\create(VRabReport::class),
    "v_rab_status" => \DI\create(VRabStatus::class),

    // User table
    "usertable" => \DI\get("users"),
];
