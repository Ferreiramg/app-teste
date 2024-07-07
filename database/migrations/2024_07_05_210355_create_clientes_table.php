<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('cidades', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->string('uf', 2);

            $table->integer('codigo_ibge');

            $table->decimal('latitude', 11, 8)->nullable();

            $table->decimal('longitude', 11, 8)->nullable();
        });

        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('razao_social');

            $table->string('cpf_cnpj', 14);

            $table->string('email')->nullable();

            $table->string('telefone')->nullable();

            $table->timestamps();
        });

        Schema::create('cliente_enderecos', function (Blueprint $table) {

            $table->increments('id');

            $table->string('logradouro');

            $table->string('numero', 10);

            $table->string('complemento')->nullable();

            $table->string('bairro');

            $table->integer('cidade_id')->unsigned();

            $table->integer('cliente_id')->unsigned();

            $table->foreign('cidade_id')->references('id')->on('cidades');

            $table->foreign('cliente_id')->references('id')->on('clientes')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_enderecos');
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('cidades');
    }
};
