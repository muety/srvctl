<?php

namespace Actions\Fail2Ban;

class UnbanAllAction implements \Actions\Action {
    public static $name = "fail2ban_unban_all";
    
    public function run() {
        $cmd = "sudo " . FAIL2BAN_PROG . " unban --all";
        $output = [];
        $code = -1;

        exec($cmd, $output, $code);
        return [ $code, $output ];
    }
}
