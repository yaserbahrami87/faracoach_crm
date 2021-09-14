<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_pages', function (Blueprint $table) {
            $table->id();
            $table->string('fname','100')->nullable();
            $table->string('lname','100')->nullable();
            $table->string('email','150')->nullable();
            $table->string('tel','21')->nullable();
            $table->string('resource','100')->nullable();
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
        Schema::dropIfExists('land_pages');
    }
}
