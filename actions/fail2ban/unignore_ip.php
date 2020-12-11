<?php

namespace Actions\Fail2Ban;

class UnignoreIpAction implements \Actions\Action {
    public static $name = "fail2ban_unignore_ip";

    private $ip = "";

    function __construct($args) {
        if (count($args) != 1 || !filter_var($args[0], FILTER_VALIDATE_IP)) {
            throw new Exception("invalid arguments");
        }
        $this->ip = $args[0];
    }

    private function listJails() {
        $cmd = "sudo " . FAIL2BAN_PROG . " status";
        $output = [];
        $code = -1;

        exec($cmd, $output, $code);
        return [ $code, $output ];
    }

    private function parseJails($output) {
        $matches = [];
        $n = preg_match_all("/Jail list:\t(.+)$/", $output, $matches, PREG_PATTERN_ORDER);

        if ($n != 1) {
            return false;
        }

        return explode(", ", $matches[1][0]);
    }
    
    public function run() {
        $result = $this->listJails();
        if ($result[0] > 0) {
            return $result;
        }

        $jails = $this->parseJails(join("\n", $result[1]));
        if (!$jails) {
            return [ 1, "failed to extract jails" ];
        }

        foreach ($jails as $jail) {
            $cmd = "sudo " . FAIL2BAN_PROG . " set " . $jail . " delignoreip " . $this->ip;
            $output = [];
            $code = -1;

            exec($cmd, $output, $code);
            if ($code != 0) {
                return [ $code, $output ];
            }
        }

        return [ 0, "" ];
    }
}
