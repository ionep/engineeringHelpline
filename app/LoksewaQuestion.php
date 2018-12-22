<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoksewaQuestion extends Model
{
    public $table = 'loksewa';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps= true; 
    
    public function loksewa(){
        return $this->belongsTo('App\Loksewa');
    }
}
