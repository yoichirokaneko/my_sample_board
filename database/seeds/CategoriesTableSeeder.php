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
        	['category_name' => 'アジア'],
            ['category_name' => 'ヨーロッパ'],
            ['category_name' => 'アフリカ'],
            ['category_name' => 'アメリカ'],
        ]);
    }
}
