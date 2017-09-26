<?php

namespace App\Modules;

class UrlUtility{

    public static function getActiveLinkArray($activeLabel)
    {
        $res = array();
        $res['main'] = '';
        $res['requests'] = '';
        $res['messages'] = '';
        $res[$activeLabel] = 'active';

//        $res['notread_mess'] = (new MessageController())->selectNotReadMess();
//        if ($res['notread_mess'] > 0){
//            $res['notread_mess'] = '(' . $res['notread_mess'] .')';
//        } else $res['notread_mess'] = '';

        return $res;
    }

//для чтения куков
//function readCookie(name) {
//    var nameEQ = name + "=";
//    var ca = document.cookie.split(';');
//    for (var i = 0; i < ca.length; i++) {
//        var c = ca[i];
//        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
//        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
//        }
//    return null;
//    }


}
