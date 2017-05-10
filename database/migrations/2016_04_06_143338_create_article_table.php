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
            $table->integer('type_id')->unsigned()->comment('类型');
            $table->foreign('type_id')->references('id')->on('article_types');
            $table->string('title')->comment('文章标题');
            $table->string('thumbnail')->comment('文章缩略图');
            $table->string('description')->comment('文章简述');
            $table->string('url')->comment('文章uri');
            $table->boolean('top')->default(false)->comment('head');
            $table->integer('weight')->unsigned()->default(0)->comment('权重');
            $table->integer('count')->unsigned()->default(0)->comment('阅读量');
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
