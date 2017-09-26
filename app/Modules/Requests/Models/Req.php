<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed description
 * @property mixed name
 * @property int status
 * @property string author
 */
class Req extends Model
{
    protected $primaryKey = "id";
    protected $table = "Requests";

    public function getStatusAttribute($value){
        if (!empty($value)){
            $statusModel = StatusRequest::find($value);
            if  ($statusModel != null){
                return $statusModel->name;
            }
        }
    }
}
