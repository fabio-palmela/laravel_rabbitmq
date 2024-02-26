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
        Schema::create('simulacao_consignado', function (Blueprint $table) {
            $table->id();
            $table->string('cpf_cooperado')->unique()->nullable();
            $table->string('cnpj_ente_consignante')->nullable();
            $table->float('valor_credito', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulacao_consignado');
    }
};
