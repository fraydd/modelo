<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'cedula',
        'direccion',
        'telefono',
        'ingreso'
    ];

    public function eingresos(){
        return $this->hasMany(Eingreso::class);
    }
}
