<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sex extends Model
{
    use HasFactory;
    public function modelos(){
        return $this->hasOne(modelo::class,'sex_id');
    }
}
