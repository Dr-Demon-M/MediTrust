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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_phone');
            $table->string('patient_email')->nullable();
            $table->enum('patient_gender', ['male', 'female']);
            $table->unsignedTinyInteger('patient_age');
            $table->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->decimal('service_price', 10, 2);
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled'
            ])->default('pending');
            $table->text('patient_note')->nullable();
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
