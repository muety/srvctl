<?php

namespace Actions\Fail2Ban;

class UnbanIpAction implements \Actions\Action {
    public static $name = "fail2ban_unban_ip";
    
    private $ip = "";

    function __construct($ip) {
        if (count($args) != 1 || !filter_var($args[0], FILTER_VALIDATE_IP)) {
            throw new Exception("invalid arguments");
        }
        $this->ip = $args[0];
    }

    public function run() {
        $cmd = "sudo " . FAIL2BAN_PROG . " unban " . $this->ip;
        $output = [];
        $code = -1;

        exec($cmd, $output, $code);
        return [ $code, $output ];
    }
}
