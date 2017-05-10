<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierAttentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supplier_attentions', function (Blueprint $table) {
            $table->increments('id')->comment('主键.');

            $table->integer('customer_id')->unsigned()->comment('用户ID');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('supplier_id')->unsigned()->comment('供应商ID');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

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
        Schema::drop('supplier_follow');
    }
}
