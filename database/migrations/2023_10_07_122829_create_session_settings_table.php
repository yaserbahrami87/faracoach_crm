<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coach_id');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_services');
            $table->foreign('fk_services')->references('id')->on('clinic_basic_infos')->onDelete('cascade');
            $table->boolean('student_coach')->default('0');
            $table->boolean('introduction')->default('1');
            $table->tinyInteger('presentation');
            $table->unsignedBigInteger('student_price')->nullable();
            $table->tinyInteger('student_count')->nullable();
            $table->float('introduction_price',10)->nullable();
            $table->float('appointment_price');
            $table->tinyInteger('collaboration_type');
            $table->float('online_price');
            $table->float('discount')->nullable();
            $table->string('date_request');
            $table->text('description')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            //$table->foreign('student_price')->references('id')->on('price_setting')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_settings');
    }
}
