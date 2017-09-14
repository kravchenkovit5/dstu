<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeDocuments extends Model
{
//    protected $table = "type_doc";
    protected $primaryKey = "typedoc";

    private static $data;

    public static function find_in_selected($value)
    {
        if (empty(self::$data)) {
            $result = TypeDocuments::all()->toArray();
            foreach ( $result as $key => $elem){
                self::$data[$elem['typedoc']] = $elem['name'];
            }

        }
        if (!empty($value)) {
            return self::$data[$value];
        }else{
            return 'not found!';
        }

    }

}
