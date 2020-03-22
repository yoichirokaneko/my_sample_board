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
        		'title' => 'サントリーニ島',
        		'body' => '本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
        	[
        		'user_id' => '2',
        		'category_id' => '2',
        		'title' => '',
        		'body' => '本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
            [
                'user_id' => '3',
                'category_id' => '4',
                'title' => '読書の投稿',
                'body' => '本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
