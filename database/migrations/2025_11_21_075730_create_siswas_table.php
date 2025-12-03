<?php

use App\Models\User;
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
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('nis', 10)->primary();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->year('tahun_masuk');
            $table->unsignedTinyInteger('tingkat')->default(10);
            $table->string("pas_photo")->default('siswa.png')->nullable();
            $table->enum('status', ['aktif', 'lulus', 'keluar', 'tinggal_kelas'])->default('aktif');
            $table->foreignIdFor(User::class)->nullable()->unique()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
