<?php

require_once("globals.php");
require_once("actions/action.php");
require_once("actions/fail2ban/ignore_ip.php");
require_once("actions/fail2ban/unignore_ip.php");
require_once("actions/fail2ban/unban_ip.php");
require_once("actions/fail2ban/unban_all.php");

$phpVersion = phpversion();
$clientIp = $_SERVER['REMOTE_ADDR'];

// View variables
$successAlert = "";
$dangerAlert = "";

// Handle actions
$actionName = $_POST["action"];
$actionArgs = $_POST["args"];
$action = null;

switch ($actionName) {
    case \Actions\Fail2Ban\UnbanIpAction::$name:
        $action = new \Actions\Fail2Ban\UnbanIpAction($actionArgs);
        break;
    case \Actions\Fail2Ban\UnbanAllAction::$name:
        $action = new \Actions\Fail2Ban\UnbanAllAction($actionArgs);
        break;
    case \Actions\Fail2Ban\IgnoreMeAction::$name:
        $action = new \Actions\Fail2Ban\IgnoreIpAction($actionArgs);
        break;
    case \Actions\Fail2Ban\UnignoreMeAction::$name:
        $action = new \Actions\Fail2Ban\UnignoreIpAction($actionArgs);
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