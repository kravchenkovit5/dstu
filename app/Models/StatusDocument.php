<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusDocument extends Model
{
    protected $primaryKey = "statusdoc";

    private static $data;
    

    public static function find_in_selected($value)
    {
        if (empty(self::$data)) {
            $result = StatusDocument::all()->toArray();
            foreach ( $result as $key => $elem){
                self::$data[$elem['statusdoc']] = $elem['name'];
            }

        }
        if (!empty($value)) {            
            return self::$data[$value];
        }else{
            return 'not found!';
        }
    }
}
