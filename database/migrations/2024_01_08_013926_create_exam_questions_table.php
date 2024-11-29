<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title',200)->nullable();
            $table->boolean('is_question')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->tinyInteger('score')->default(0);
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->foreign('exam_id')->on('exams')->references('id')->onDelete('cascade');
            $table->string('date_fa',11)->nullable();
            $table->string('time_fa',11)->nullable();
            $table->timestamps();
        });

        Schema::table('exam_questions', function (Blueprint $table) {
            $table->foreign('question_id')->on('exam_questions')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_questions');
    }
}
