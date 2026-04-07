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
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();
        
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();
        
            $table->foreignId('therapist_id')
            ->constrained()
            ->cascadeOnDelete();
        
            $table->date('date');
        
            $table->string('time');

            $table->string('status')->default('pending');

            $table->string('meeting_link')->nullable();

            $table->timestamps();
        
            $table->unique(['therapist_id','date','time']);
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
