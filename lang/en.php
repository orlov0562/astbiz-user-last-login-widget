<?php

    function AstBiz_User_Last_Login_Last_Login_Text($lastLoginTime) {

        // Minutes after last login
        $m = round((time() - $lastLoginTime) / 60);

        if ($m<=5) { $ret = '<span class="online">Online</span>'; }
        elseif($m>5 AND $m<=15) { $ret = '<span>Couple minutes ago</span>'; }
        elseif($m>15 AND $m<=30) { $ret = '<span>Fifteen minutes ago</span>'; }
        elseif($m>30 AND $m<=60) { $ret = '<span>Half an hour ago</span>'; }
        elseif($m>60 AND $m<=120) { $ret = '<span>Hour ago</span>'; }
        elseif($m>120 AND $m<=240) { $ret = '<span>Couple hours ago</span>'; }
        elseif($m>240 AND $m<=480) { $ret = '<span>Few hours ago</span>'; }
        elseif(date('d.m.Y')==date('d.m.Y',$lastLoginTime)) { $ret = '<span>Today</span>'; }
        elseif(date('d.m.Y', strtotime('-1 day'))==date('d.m.Y',$lastLoginTime)) { $ret = '<span>Yesterday</span>'; }
        elseif(!$lastLoginTime) { $ret = '<span>Never</span>'; }
        else { $ret = '<span>Last visit '.date('d.m.Y', $lastLoginTime).'</span>'; }

        return $ret;

    }
