<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_en', 11)->comment('用户类型-英');
            $table->string('type_ch', 11)->comment('用户类型-中');
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
        Schema::drop('product_categories');
    }
}
