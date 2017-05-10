<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->comment('����');
            $table->foreign('type_id')->references('id')->on('article_types');
            $table->string('title')->comment('���±���');
            $table->string('thumbnail')->comment('��������ͼ');
            $table->string('description')->comment('���¼���');
            $table->string('url')->comment('����uri');
            $table->boolean('top')->default(false)->comment('head');
            $table->integer('weight')->unsigned()->default(0)->comment('Ȩ��');
            $table->integer('count')->unsigned()->default(0)->comment('�Ķ���');
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_type_id_foreign');
        });
        Schema::drop('articles');
    }
}
