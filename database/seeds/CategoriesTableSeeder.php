<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	['category_name' => '仕事'],
            ['category_name' => '旅行'],
            ['category_name' => 'グルメ'],
            ['category_name' => '読書'],
        ]);
    }
}
