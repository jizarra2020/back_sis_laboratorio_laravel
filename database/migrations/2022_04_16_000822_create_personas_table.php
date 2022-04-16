<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;
use League\CommonMark\Reference\ReferenceParser;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string("nombres",50);
            $table->string("apellidos",50);
            $table->string("ci_dni",15)->uniqie();
            $table->string("telefono",15)->Nullable();
            $table->date("fecha_nacimienot")->Nullable();
            $table->string("direccion")->Nullable();
            $table->string("ciudad")->Nullable();
            $table->string("pais")->Nullable();

            //Relacion 1:1 entre tabala: personas y user
            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->foreign("user_id")->references("id")->on("users");

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
        Schema::dropIfExists('personas');
    }
}

