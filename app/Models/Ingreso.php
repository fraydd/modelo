<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{

    use HasFactory;

    protected $fillable=[
                        'ingreso',];
    //public $timestamps=false;

    public function modelos(){
        return $this->belongsTo(modelo::class,'modelo_id');
    }
}
