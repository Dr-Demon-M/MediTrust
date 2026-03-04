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
        Schema::table('specialties', function (Blueprint $table) {
            $table->string('subtitle')->after('slug')->nullable();
            $table->string('image')->after('icon')->nullable();
            $table->unsignedInteger('procedures_count')->after('image')->default(0);
            $table->string('procedures_label')->after('procedures_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specialties', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'image', 'procedures_count', 'procedures_label']);
        });
    }
};
