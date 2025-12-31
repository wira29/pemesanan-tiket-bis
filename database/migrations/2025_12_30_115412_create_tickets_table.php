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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('travel_id')->constrained('travel')->onDelete('restrict');
            $table->string('name');
            $table->enum('gender', ['m', 'f']);
            $table->enum('age', ['dewasa', 'anak-anak']);
            $table->string('passport')->nullable();
            $table->string('whatsapp');
            $table->integer('seat_no');
            $table->boolean('is_half')->default(false);
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
