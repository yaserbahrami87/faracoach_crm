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
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fname',20)->nullable();
            $table->string('lname',30)->nullable();
            $table->string('father',30)->nullable();
            $table->string('codemelli',15)->nullable()->unique();
            $table->boolean('sex')->nullable();
            $table->string('tel',20)->nullable();
            $table->string('shenasname',20)->nullable();
            $table->string('born',30)->nullable();
            $table->string('education',20)->nullable();
            $table->string('reshteh',20)->nullable();
            $table->string('state',20)->nullable();
            $table->string('city',20)->nullable();
            $table->string('address')->nullable();
            $table->string('personal_image')->nullable();
            $table->string('shenasnameh_image')->nullable();
            $table->string('cartmelli_image')->nullable();
            $table->string('education_image')->nullable();
            $table->boolean('married')->nullable();
            $table->tinyInteger('type')->default('0');
            $table->string('resource',30)->nullable();
            $table->string('detailsresource',50)->nullable();
            $table->string('gettingknow',40)->nullable();
            $table->string('introduced',40)->nullable();
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
