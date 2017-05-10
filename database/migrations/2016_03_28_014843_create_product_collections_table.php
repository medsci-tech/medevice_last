<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->increments('id')->comment('主键.');

            $table->integer('customer_id')->unsigned()->comment('用户ID');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('product_id')->unsigned()->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('product_collect');
    }
}
