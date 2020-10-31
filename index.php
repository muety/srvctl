<?php

require_once("globals.php");
require_once("actions/action.php");
require_once("actions/fail2ban/whitelist_me.php");
require_once("actions/fail2ban/unban_me.php");
require_once("actions/fail2ban/unban_all.php");

$phpVersion = phpversion();
$clientIp = $_SERVER['REMOTE_ADDR'];

// View variables
$successAlert = "";
$dangerAlert = "";

// Handle actions
$actionName = $_POST["action"];
$action = null;

switch ($actionName) {
    case \Actions\Fail2Ban\UnbanMeAction::$name:
        $action = new \Actions\Fail2Ban\UnbanMeAction($clientIp);
        break;
    case \Actions\Fail2Ban\UnbanAllAction::$name:
        $action = new \Actions\Fail2Ban\UnbanAllAction();
        break;
    case \Actions\Fail2Ban\WhitelistMeAction::$name:
        $action = new \Actions\Fail2Ban\WhitelistMeAction($clientIp);
        break;
}

if ($action != null) {
    $result = $action->run();
    if ($result[0] == 0) {
        $successAlert = "Command was executed.";
    } else {
        $dangerAlert = "Command exited with status " . $result[0] . ".\n\n" . join("\n", $result[1]);
    }
}

// Some formatting
$successAlert = str_replace("\n", "<br>", $successAlert);
$dangerAlert = str_replace("\n", "<br>", $dangerAlert);

require_once("views/layout.php");