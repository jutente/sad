<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->date('dtnascimento');
            $table->string('cns', 15);
            $table->string('cpf', 11);
            $table->string('rua', 100);
            $table->string('numero', 10);
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('cep', 11)->nullable();
            $table->string('tel', 15);
            $table->string('cel', 15);

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
        Schema::dropIfExists('pacientes');
    }
}
