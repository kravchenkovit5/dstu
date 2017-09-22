<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Doc extends Model
{
    protected $primaryKey = 'marking';

    protected $casts = [
        'marking' => 'string',
    ];

    public function getRef()
    {
         if ( !empty($this->reference)){
             return 'viewer/'.$this->marking;
         }else{
             return '';
         }
    }

    public function setIdRequestAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['id_request'] = 0;
        }
    }

    public function getTypedocAttribute($value)
    {
        return TypeDocuments::find_in_selected($value); //возвращаем название в читабельном виде
    }

    public function getStatusdocAttribute($value)
    {
        return StatusDocument::find_in_selected($value); //возвращаем название в читабельном виде        
    }

    public function getIdRequestAttribute($value){
        if ( $value === 0 ) return '';
        else return $value;
    }

}