<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierDetailImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supplier_detail_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_id');
            $table->string('image_url');
            $table->string('image_name');
            $table->integer('priority')->default(0);
            $table->foreign('supplier_id')->references('id')->on('suppliers');

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
        Schema::table('supplier_detail_images', function (Blueprint $table) {
            $table->dropForeign('supplier_detail_images_supplier_id_foreign');
        });
        Schema::drop('supplier_detail_images');
    }
}
