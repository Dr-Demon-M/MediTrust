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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); 
            $table->string('photo')->nullable();
            $table->foreignId('specialty')->constrained('specialties')->onDelete('null')->nullable();
            $table->integer('years_experience')->default(0);
            $table->decimal('consultation_fee', 8, 2)->default(0);
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
