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
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->enum('experience_tier', ['<6 months', '6-12 months', '1-2 years', '2-5 years', '>5 years']);
            $table->decimal('years_estimate', 3, 1);
            $table->boolean('has_certificate')->default(false);
            $table->string('institution_name', 80)->nullable();
            $table->string('certificate_name', 80)->nullable();
            $table->date('issue_date')->nullable();
            $table->string('certificate_file_url')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skills');
    }
};
