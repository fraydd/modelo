<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdeudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adeudos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monto');
            $table->string('tipo');

            $table->unsignedBigInteger('modelo_id');
            $table->foreign('modelo_id')
                ->references('id')
                ->on('modelos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adeudos');
    }
}
