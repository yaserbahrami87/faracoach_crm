<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product',200)->nullable();
            $table->string('shortlink',200)->nullable();
            $table->string('image',200)->nullable();
            $table->text('info')->nullable();
            $table->integer('fi')->nullable();
            $table->integer('fi_off')->nullable();
            $table->boolean('status')->default(1);
            $table->string('date_fa',200)->nullable();
            $table->string('time_fa',200)->nullable();
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
                $table->unsignedBigInteger('product_id')->nullable();
                $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
                $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
                $table->unique(['product_id','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
