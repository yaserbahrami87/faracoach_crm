<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('comment')->nullable();
            $table->integer('problemfollowup_id')->nullable();
            $table->integer('categoryfollowup_id')->nullable();
            $table->tinyInteger('status_followups')->default(1);
            $table->string('date_fa',20)->nullable();
            $table->string('time_fa',20)->nullable();
            $table->string('datetime_fa',30)->nullable();
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
        Schema::dropIfExists('followups');
    }
}
