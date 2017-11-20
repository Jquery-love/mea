<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',300)->default('');
            $table->string('path',300)->default('')->comment('文章路径');
            $table->integer('sort')->default(0);
            $table->string('pic',150)->default('')->comment('主题图片');
            $table->boolean('recommend')->default(false)->comment('是否推荐');
            $table->string('template',100)->default("")->comment('模板');
            $table->string('intro',3000)->default('')->comment('简介');
            $table->text('desc')->comment('描述详情');
            $table->integer('column_id')->comment('所属类别');
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
        Schema::dropIfExists('contents');
    }
}
