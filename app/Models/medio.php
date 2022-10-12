<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medio extends Model
{
    use HasFactory;
    public function cajas(){
        return $this->hasOne(Caja::class,'medio_id');
    }
}
