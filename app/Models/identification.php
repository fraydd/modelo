<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identification extends Model
{
    use HasFactory;
    
    public function modelos(){
    
        return $this->hasOne(modelo::class,'identification_id');
        
    }
}
