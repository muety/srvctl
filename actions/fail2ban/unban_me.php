<?php

namespace Actions\Fail2Ban;

class UnbanMeAction implements \Actions\Action {
    public static $name = "fail2ban_unban_me";
    
    private $ip = "";

    function __construct($ip) {
        $this->ip = $ip;
    }

    public function run() {
        $cmd = "sudo " . FAIL2BAN_PROG . " unban " . $this->ip;
        $output = [];
        $code = -1;

        exec($cmd, $output, $code);
        return [ $code, $output ];
    }
}
