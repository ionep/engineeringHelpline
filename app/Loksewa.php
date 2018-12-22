<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loksewa extends Model
{
    public $table = 'loksewa_sets';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps= true; 

    public function loksewaQuestion(){
        return $this->hasMany('App\LoksewaQuestion');
    }
}
