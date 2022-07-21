<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rh extends Model
{
    use HasFactory;

    public function modelos(){
        return $this->hasOne(modelo::class,'rh_id');
    }
}
