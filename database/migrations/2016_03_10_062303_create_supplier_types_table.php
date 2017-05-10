<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_en', 11)->comment('供应商类型-英');
            $table->string('type_ch', 11)->comment('供应商类型-中');
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
        Schema::drop('supplier_types');
    }
}
