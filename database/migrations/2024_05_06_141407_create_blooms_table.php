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
        Schema::create('b_l_o_o_m_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('questionchapter_id')->constrained('question_chapters')->onDelete('cascade');
            $table->string('question_description')->nullable();
            $table->string('question_text');
            $table->string('bloom_taxonomy');
            $table->string('question_mark');
            // Add other fields as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_l_o_o_m_s');
    }
};
