<?php

use Illuminate\Database\Seeder;

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('columns')->insert([
            'title' => '关于我们',
            'contents' => '',
            'path' => 'about',
            'template' => 'about'
        ]);
        DB::table('columns')->insert([
            'title' => '水管理产品',
            'contents' => '',
            'path' => 'water-products',
            'template' => 'products'
        ]);
        DB::table('columns')->insert([
            'title' => '产品系列',
            'contents' => '',
            'path' => 'products',
            'template' => 'products'
        ]);
        DB::table('columns')->insert([
            'title' => '案例应用',
            'contents' => '',
            'path' => 'cases',
            'template' => 'cases'
        ]);
        DB::table('columns')->insert([
            'title' => '技术支持',
            'contents' => '',
            'path' => 'technical',
            'template' => 'technical'
        ]);
        DB::table('columns')->insert([
            'title' => '联系我们',
            'contents' => '',
            'path' => 'contact',
            'template' => 'contact'
        ]);
        DB::table('columns')->insert([
            'title' => '展会信息',
            'contents' => '',
            'path' => 'exhibitions',
            'template' => 'exhibition'
        ]);
        DB::table('columns')->insert([
            'title' => '最新时讯',
            'contents' => '',
            'path' => 'newests',
            'template' => 'newest'
        ]);
        DB::table('columns')->insert([
            'title' => '往期新闻',
            'contents' => '',
            'path' => 'oldnews',
            'template' => 'oldnew'
        ]);
    }
}
