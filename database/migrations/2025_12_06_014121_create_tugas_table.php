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
        Schema::create('tugas', function (Blueprint $table) {
            $table->uuid('tugasID')->primary();
            $table->string('matpel_kode');
            $table->foreign('matpel_kode')->on('matpels')->references('kode');
            $table->string('title');
            $table->text('content');
            $table->foreignIdFor(User::class, 'created_by_user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('mode_pengumpulan', ['file', 'text', 'foto'])->default('file');
            $table->dateTime('deadline');
            $table->dateTime('publish_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
