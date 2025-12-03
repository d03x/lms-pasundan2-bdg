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
        Schema::create('matpels', function (Blueprint $table) {
            $table->string('kode', 25)->primary();
            $table->string('nama', 100);
            $table->enum('kategori', ['Adaptif', 'Normatif', 'Produktif'])->default('Adaptif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matpels');
    }
};
