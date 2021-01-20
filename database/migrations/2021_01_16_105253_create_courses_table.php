<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course',250);
            $table->integer('teacher')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('duration')->default(0);
            $table->string('duration_date',20)->nullable();
            $table->tinyInteger('count_students')->default(0);
            $table->tinyInteger('coaches')->default(0);
            $table->tinyInteger('coachingbycoach')->default(0);
            $table->tinyInteger('coachingbyreference')->default(0);
            $table->tinyInteger('intership')->default(0);
            $table->string('start',20)->nullable();
            $table->string('end',20)->nullable();
            $table->string('infocourse',250)->nullable();
            $table->string('exam',100)->nullable();
            $table->string('certificate',100)->nullable();
            $table->string('fi',10)->nullable();
            $table->tinyInteger('type_peymant_id')->nullable();
            $table->string('images',250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
