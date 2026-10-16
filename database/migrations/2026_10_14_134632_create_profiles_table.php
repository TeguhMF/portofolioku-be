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
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name')->nullable();
        $table->string('username')->unique()->nullable();
        $table->string('school_name')->nullable();
        $table->string('grade_level')->nullable();
        $table->string('career_goal')->nullable();
        $table->text('bio')->nullable();
        $table->string('phone_whatsapp')->nullable();
        $table->longText('avatar_url')->nullable(); // Support Base64 image
        $table->string('social_linkedin')->nullable();
        $table->string('social_github')->nullable();
        $table->string('social_instagram')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
