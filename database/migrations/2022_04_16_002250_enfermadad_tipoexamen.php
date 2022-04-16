<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnfermadadTipoexamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('enfermedad_tipoexamen', function (Blueprint $table) {

            $table->primary(["enfermedad_id", "tipoexamen_id"]);     // declarando llave primaria de tabal PIVOT

            $table->bigInteger("enfermedad_id")->unsigned();
            $table->bigInteger("tipoexamen_id")->unsigned();
            $table->foreign("enfermedad_id")->references("id")->on("enfermedads");
            $table->foreign("tipoexamen_id")->references("id")->on("tipoexamens");

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
        //
        Schema::dropIfExists('enfermedad_tipoexamen');
    }
}
