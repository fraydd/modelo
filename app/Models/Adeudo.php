<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adeudo extends Model
{
    use HasFactory;

    public function modelos(){
        return $this->belongsTo(modelo::class);
        }
}
