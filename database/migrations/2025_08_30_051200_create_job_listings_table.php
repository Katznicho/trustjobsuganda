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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->json('required_skill_ids')->nullable();
            $table->string('min_experience_tier')->nullable();
            $table->string('district')->nullable();
            $table->string('division')->nullable();
            $table->string('parish')->nullable();
            $table->string('village')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('pay_type')->nullable();
            $table->boolean('urgent')->default(false);
            $table->enum('status', ['active', 'taken', 'unavailable', 'completed'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
