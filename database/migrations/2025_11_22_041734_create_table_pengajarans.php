<?php

use App\Models\Kelas;
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
        Schema::create('pengajarans', function (Blueprint $table) {
            $table->id();
            $table->string('matpel_kode');
            $table->string('guru_nip');
            //foreign
            $table->foreignIdFor(Kelas::class)->constrained('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('matpel_kode')->on('matpels')->references('kode');
            $table->foreign('guru_nip')->on('gurus')->references('nip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajarans');
    }
};
