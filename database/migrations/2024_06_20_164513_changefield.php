<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Changefield extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('total_score')->change();
            $table->integer('score_introduced')->change();
            $table->integer('score_purchase')->change();
            $table->integer('score_re_entry')->change();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->tinyInteger('total_score')->change();
            $table->tinyInteger('score_introduced')->change();
            $table->tinyInteger('score_purchase')->change();
            $table->tinyInteger('score_re_entry')->change();
        });
    }
}
