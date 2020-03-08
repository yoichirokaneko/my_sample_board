<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
        	],
            [

                'name' => 'yoyo', 
                'password' => bcrypt('yoyoyoyo'),
                'email' => 'yoyo@yoyo.com',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ],
            [

                'name' => 'xian',
                'password' => bcrypt('xianxian'),
                'email' => 'xian@xian.com',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
