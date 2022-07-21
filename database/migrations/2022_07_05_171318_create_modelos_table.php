<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            /* Datos personales */
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('nid');
            $table->string('foto');
            $table->string('expedido');
            $table->date('fechan');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo');
            /*  identification
                sexe
                gsrh
                */

            /* Datos comerciales */
            $table->double('estatura',3,2);
            $table->integer('busto');
            $table->integer('cintura');
            $table->integer('cadera');
            $table->string('cabello');
            $table->string('ojos');
            $table->string('piel');
            $table->string('pantalon');
            $table->string('camisa');
            $table->string('calzado');

            /* Redes sociales */
            $table->string('facebook')->nullable(); //https://www.facebook.com/nombreDeUsuario   
            $table->string('instagram')->nullable(); //https://www.instagram.com/nombreDeUsuario  
            $table->string('twitter')->nullable(); //https://www.twitter.com/nombreDeUsuario
            $table->string('tiktok')->nullable(); //https://www.tiktok.com/@nombreDeUsuario
            $table->string('otro')->nullable();

            /* Datos acudiente */
            $table->string('nombre_acudiente')->nullable();
            $table->integer('nid_acudiente')->nullable();
            $table->string('expedido_acudiente')->nullable();
            $table->string('parentezco')->nullable();
            $table->string('direccion_acudiente')->nullable();
            $table->string('telefono_acudiente')->nullable();
            

            /* Control */

            $table->boolean('estado');
            $table->integer('meses_pagados');
            $table->date('fecha_pago');
            $table->date('fecha_vence');


            $table->timestamps();

            $table->unsignedBigInteger('sex_id');
            $table->foreign('sex_id')
                ->references('id')
                ->on('sexes');

            $table->unsignedBigInteger('identification_id');
            $table->foreign('identification_id')
                ->references('id')
                ->on('identifications');

            $table->unsignedBigInteger('rh_id');
            $table->foreign('rh_id')
                ->references('id')
                ->on('rhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelos');
    }
}
