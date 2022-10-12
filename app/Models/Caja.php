<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
class Caja extends Model
{
    use HasFactory;
    protected $fillable=[
        /* Datos personales */

        'paga',
        'recibe',
        'concepto',
        'valor',
        'estado',
        'medio_id'];

        public function medios(){
            return $this->belongsTo(medio::class);
            }
        
        protected function serializeDate(DateTimeInterface $date)
        {
            return $date->format('Y-m-d H:i:s');
        }
}
