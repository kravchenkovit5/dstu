<?php

namespace App\Http\Controllers;

class UrlUtility{

    public static function getActiveLinkArray($activeLabel)
    {
        $res = array();
        $res['main'] = '';
        $res['requests'] = '';
        $res['messages'] = '';
        $res[$activeLabel] = 'active';

        $res['notread_mess'] = (new MessageController())->selectNotReadMess();
        if ($res['notread_mess'] > 0){
            $res['notread_mess'] = '(' . $res['notread_mess'] .')';
        } else $res['notread_mess'] = '';

        return $res;
    }

}
