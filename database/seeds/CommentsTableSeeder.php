<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Comments')->insert([
        	[
        		'user_id' => '2',
        		'post_id' => '1',
        		'comment' => '仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
        	[
        		'user_id' => '3',
        		'post_id' => '1',
        		'comment' => '仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント仕事の投稿へのコメント',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
        	[
        		'user_id' => '3',
        		'post_id' => '2',
        		'comment' => '旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント旅行の投稿へのコメント',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
        	[
        		'user_id' => '1',
        		'post_id' => '3',
        		'comment' => '読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント読書の投稿へのコメント',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
