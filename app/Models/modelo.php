<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo extends Model
{
    use HasFactory;
    protected $fillable=[
         /* Datos personales */

         'nombre',
         'nid',
         'foto',
         'expedido',
         'fechan',
         'direccion',
         'telefono',
         'correo',
         'sex_id',
         'identification_id',
         'rh_id',

         /* Datos comerciales */
         'estatura',
         'busto',
         'cintura',
         'cadera',
         'cabello',
         'ojos',
         'piel',
         'pantalon',
         'camisa',
         'calzado',

         /* Redes sociales */
         'facebook',    
         'instagram',  
         'twitter',
         'tiktok',
         'otro',

         /* Datos acudiente */
         'nombre_acudiente',
         'nid_acudiente',
         'expedido_acudiente',
         'parentezco',
         'direccion_acudiente',
         'telefono_acudiente',

         /* control */
         'estado',
         'meses_pagados',
         'fecha_pago',
         'fecha_vence',
         'deuda',

         'observaciones',


    ];

    public function ingresos(){
        return $this->hasMany(Ingreso::class);
    }
    public function sexes(){
        return $this->belongsTo(sex::class);
        }
    
        public function identifications(){
            return $this->belongsTo(identification::class);
            }

            public function rhs(){
                return $this->belongsTo(rh::class);
                }

                public function adeudos(){
                    return $this->hasOne(Adeudo::class,'adeudo_id');
                }
}
