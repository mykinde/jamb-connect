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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user who owns this account
            $table->unique(['user_id', 'profile_code']);// Unique identifier for the account
            $table->enum('application_type', ['UTME', 'DL', 'NOUN', 'PT', 'DE', 'SDW']); // Dropdown selection
            $table->string('phone')->nullable(); // Phone field
            $table->string('email_address')->unique(); // Email field (can be globally unique or unique per user, depending on needs)
            $table->year('last_jamb_year')->nullable(); // Last JAMB year
            $table->string('last_institution_attended')->nullable(); // Nullable text field
            $table->string('proposed_new_institution'); // Text field
            $table->string('proposed_course'); // Text field
            $table->year('application_year'); // Application year

            $table->string('nationality');
            $table->string('state');
            $table->string('lga');

            // Boolean fields for disabilities
            $table->boolean('blind')->default(false);
            $table->boolean('deaf')->default(false);
            $table->boolean('dumb')->default(false);
            $table->boolean('lame')->default(false);

            $table->enum('marital_status', ['Single', 'Married'])->nullable(); // Marital status dropdown
            $table->string('resident_address');
            $table->string('resident_town')->nullable();
            $table->string('resident_state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
