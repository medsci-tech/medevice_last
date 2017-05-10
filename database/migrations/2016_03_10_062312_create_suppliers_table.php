<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->comment('供应商类型ID');
            $table->foreign('type_id')->references('id')->on('supplier_types');

            $table->string('openid')->comment('微信openid');
            $table->unique('openid');
            $table->string('phone', 31)->nullable()->comment('联系方式');
            $table->unique('phone');
            $table->string('email', 31)->nullable()->comment('邮箱');
            $table->unique('email');

            $table->boolean('is_approved')->default(0)->comment('是否通过审核.');
            $table->string('supplier_name')->nullable()->comment('供应商名称');
            $table->text('supplier_desc')->nullable()->comment('供应商描述');
            $table->string('logo_image_url')->nullable()->comment('Logo图片地址');
            $table->integer('fans')->unsigned()->comment('关注数');
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
        //
        Schema::drop('suppliers');
    }
}
