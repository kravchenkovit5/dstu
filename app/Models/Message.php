<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function getStatusAttribute($value)
    {
        if ($value == 'read') return 'прочитано';
        else                  return 'не прочитано';
    }
}
