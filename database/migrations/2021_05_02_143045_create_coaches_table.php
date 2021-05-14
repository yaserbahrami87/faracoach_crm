<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->text('education_background')->nullable();
            $table->text('researches')->nullable();
            $table->text('certificates')->nullable();
            $table->text('experience')->nullable();
            $table->text('skills')->nullable();
            $table->text('documents')->nullable();
            $table->integer('count_meeting')->nullable();
            $table->integer('customer_satisfaction')->default(0);
            $table->integer('change_customer')->default(0);
            $table->integer('count_recommendation')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('coaches');
    }
}
