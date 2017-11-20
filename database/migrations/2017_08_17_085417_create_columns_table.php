<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',300);
            $table->unsignedInteger('parent_id')->default(0)->comment('父栏目索引');
            $table->integer('sort')->default(0)->comment('栏目排序'); //排序
            $table->string('path',200)->default("")->comment('栏目路径'); //路径
            $table->string('pic')->default("")->comment('栏目小图片'); //
            $table->string('bigPic')->default("")->comment('栏目大图片');
            $table->string('template',100)->default("")->comment('模板');
            $table->string('intro',3000)->default("")->comment('栏目介绍');
            $table->text('contents')->comment('栏目内容'); //路径
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
        Schema::dropIfExists('columns');
    }
}
