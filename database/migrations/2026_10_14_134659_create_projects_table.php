<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('tools')->nullable();       // Alat/Media (Canva, CapCut, Word, dll)
            $table->string('file_url')->nullable();    // Link Berkas (Google Drive, YouTube, dll)
            $table->longText('image_url')->nullable();  // Foto/Preview Karya (Base64)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};