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
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->uuid('jawabanID')->primary();
            $table->foreignUuid('tugas_id')->index('jawaban_tugas_id')->constrained('tugas','tugasID');
            $table->foreignIdFor(User::class, 'answered_by_id')->constrained('users');
            $table->text('jawaban')->nullable();
            $table->string('file')->nullable();
            $table->string('file_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_tugas');
    }
};
