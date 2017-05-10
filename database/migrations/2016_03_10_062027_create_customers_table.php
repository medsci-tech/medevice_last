<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->comment('用户类型ID');
            $table->foreign('type_id')->references('id')->on('customer_types');

            $table->string('phone', 31)->nullable()->comment('personal telephone');
            $table->string('password', 31)->nullable()->comment('personal password');

            $table->string('openid')->comment('wechat open id');
            $table->string('nickname')->nullable()->comment('wechat nick name');
            $table->string('head_image_url')->nullable()->comment('wechat head img url');
            $table->string('company')->nullable()->comment('公司名称');

            $table->unique('phone');
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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('customers_type_id_foreign');
        });
        Schema::drop('customers');
    }
}
