<?php

// create_question_sets_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChaptersTable extends Migration
{
    public function up()
    {
        Schema::create('question_chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('questioncategory_id')->constrained('question_categories')->onDelete('cascade'); // Update the table name to 'question_categories'
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_chapters');
    }
}