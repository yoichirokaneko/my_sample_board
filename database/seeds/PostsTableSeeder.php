<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        	[
        		'user_id' => '1',
        		'category_id' => '1',
        		'title' => '仕事の投稿',
        		'body' => '本文本文本文',
        	],
        	[
        		'user_id' => '2',
        		'category_id' => '2',
        		'title' => '旅行の投稿',
        		'body' => '本文本文本文',
        	],
        ]);
    }
}
