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
        Schema::create('corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('institution1_id')->nullable()->constrained('institutions')->onDelete('set null');
                $table->foreignId('course1_id')->nullable()->constrained('courses')->onDelete('set null');
                $table->foreignId('institution2_id')->nullable()->constrained('institutions')->onDelete('set null')->nullable();
                $table->foreignId('course2_id')->nullable()->constrained('courses')->onDelete('set null')->nullable();
                $table->foreignId('institution3_id')->nullable()->constrained('institutions')->onDelete('set null')->nullable();
                $table->foreignId('course3_id')->nullable()->constrained('courses')->onDelete('set null')->nullable();
                $table->foreignId('institution4_id')->nullable()->constrained('institutions')->onDelete('set null')->nullable();
                $table->foreignId('course4_id')->nullable()->constrained('courses')->onDelete('set null')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corrections');
    }
};
