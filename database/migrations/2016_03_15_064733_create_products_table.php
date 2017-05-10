<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('category_id')->unsigned()->comment('所属类别ID');
            $table->foreign('category_id')->references('id')->on('product_categories');

            $table->integer('supplier_id')->unsigned()->comment('所属供应商ID');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->string('name')->comment('名称');
            $table->string('remark')->comment('备注');
            $table->text('introduction')->comment('介绍');
            $table->text('registration_no')->comment('注册号');
            $table->text('department')->comment('科室');
            $table->text('body_parts')->comment('使用部位');
            $table->decimal('price')->comment('价格');
            $table->integer('fans')->unsigned()->comment('关注数');
            $table->string('logo_image_url')->nullable()->comment('Logo图片地址');
            $table->string('tag')->comment('标签');
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
        Schema::drop('products');
    }
}
