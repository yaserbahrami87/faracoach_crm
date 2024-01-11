<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFiledsCertificates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('name',200)->unique();
            $table->dropColumn('course_id');
            $table->unsignedBigInteger('product_id');
            $table->string('type',200)->nullable();
            $table->dropColumn('suggest');
            $table->dropColumn('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('type');
            $table->renameColumn('product_id','course_id');

        });
    }
}
