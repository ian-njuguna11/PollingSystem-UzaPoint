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
       Schema::create('polls', function (Blueprint $table) {
        $table->id();
        $table->string('poll_tittle');
        $table->integer('votes');
        $table->integer('questions');
        $table->foreignId('userId');
        $table->date('end_date');
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
