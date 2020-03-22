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
        	['category_name' => '自然・風景'],
            ['category_name' => '遺跡・建築物'],
            ['category_name' => '街並み・夜景'],
            ['category_name' => '料理・飲み物'],
        ]);
    }
}
