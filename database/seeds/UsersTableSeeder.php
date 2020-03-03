<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
                'name' => 'ichiro',
            	'password' =>  bcrypt('ichiroichiro'),
            	'email' => 'ichiro@ichiro.com',
        	],
            [
                'name' => 'yoyo', 
                'password' => bcrypt('yoyoyoyo'),
                'email' => 'yoyo@yoyo.com',
            ],
        ]);
    }
}
