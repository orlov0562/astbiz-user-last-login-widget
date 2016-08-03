<?php

    function AstBiz_User_Last_Login_Last_Login_Text($lastLoginTime) {

        // Minutes after last login
        $m = round((time() - $lastLoginTime) / 60);

        if ($m<=5) { $ret = '<span class="online">Сейчас на сайте</span>'; }
        elseif($m>5 AND $m<=15) { $ret = '<span>Заходил пару минут назад</span>'; }
        elseif($m>15 AND $m<=30) { $ret = '<span>Заходил 15 минут назад</span>'; }
        elseif($m>30 AND $m<=60) { $ret = '<span>Заходил пол часа назад</span>'; }
        elseif($m>60 AND $m<=120) { $ret = '<span>Заходил час назад</span>'; }
        elseif($m>120 AND $m<=240) { $ret = '<span>Заходил пару часов назад</span>'; }
        elseif($m>240 AND $m<=480) { $ret = '<span>Заходил несколько часов назад</span>'; }
        elseif(date('d.m.Y')==date('d.m.Y',$lastLoginTime)) { $ret = '<span>Заходил сегодня</span>'; }
        elseif(date('d.m.Y', strtotime('-1 day'))==date('d.m.Y',$lastLoginTime)) { $ret = '<span>Заходил вчера</span>'; }
        elseif(!$lastLoginTime) { $ret = '<span>Никогда</span>'; }
        else { $ret = '<span>Заходил '.date('d.m.Y', $lastLoginTime).'</span>'; }

        return $ret;

    }
