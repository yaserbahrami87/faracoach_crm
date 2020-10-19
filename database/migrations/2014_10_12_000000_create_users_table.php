<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_email')->unique();
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('user_password');
            $table->string('user_fname',20)->nullable();
            $table->string('user_lname',30)->nullable();
            $table->string('user_father',30)->nullable();
            $table->string('user_codemelli',15)->unique();
            $table->boolean('user_sex')->nullable();
            $table->string('user_tel',20)->nullable();
            $table->string('user_shenasname',20)->nullable();
            $table->string('user_born',30)->nullable();
            $table->string('user_education',20)->nullable();
            $table->string('user_reshteh',20)->nullable();
            $table->string('user_state',20)->nullable();
            $table->string('user_city',20)->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_personal_image')->nullable();
            $table->string('user_shenasnameh_image')->nullable();
            $table->string('user_cartmelli_image')->nullable();
            $table->string('user_education_image')->nullable();
            $table->boolean('user_married')->nullable();
            $table->tinyInteger('user_status')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
