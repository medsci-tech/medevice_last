<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->comment('主键.');

            $table->integer('customer_id')->unsigned()->comment('用户ID');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('product_id')->unsigned()->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products');

            $table->string('phone', 31)->comment('手机号码.');
            $table->string('name', 31)->comment('姓名.');
            $table->text('remark')->comment('备注.');
            $table->integer('count')->comment('数量.');
            $table->integer('order_sn')->comment('订单号.');

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
        Schema::drop('orders');
    }
}
