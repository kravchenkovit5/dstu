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

        return $res;
    }

}
