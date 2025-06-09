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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user who uploaded it
            $table->string('exam_number');
            $table->year('exam_year'); // Use 'year' type for exam year
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // Link to the subject table
            $table->enum('exam_series', ['Internal', 'Private']); // New: Exam Series dropdown
            $table->enum('exam_type', ['WAEC', 'NECO', 'Nabteb', 'London GCE', 'Others']); // New: Exam Type dropdown
            $table->enum('grade', ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9', 'NA']); // Grade dropdown values
            $table->string('image_path')->nullable(); // Optional image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
