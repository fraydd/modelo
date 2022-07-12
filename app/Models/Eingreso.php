<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eingreso extends Model
{
    use HasFactory;

    protected $fillable=[
        'empleado_id',
        'salida'];

    public function admins(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
}
