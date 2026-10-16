<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');                      // Nama Keahlian (contoh: Editing Video, Public Speaking)
            $table->string('category')->default('Lainnya'); // Kategori (Soft Skill, Teknologi & Digital, Bahasa, dll)
            $table->string('level')->default('Pemula');     // Tingkat Kemahiran (Pemula, Menengah, Mahir)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};