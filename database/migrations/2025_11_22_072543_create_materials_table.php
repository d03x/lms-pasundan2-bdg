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
        Schema::create('materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->dateTime('publish_date');
            $table->text('description')->nullable();
            $table->json('file_materi')->nullable();
            $table->string('youtube_id')->nullable();
            $table->json('kelas_ids');
            $table->string('matpel_kode');
            $table->foreign('matpel_kode')->on('matpels')->references('kode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
