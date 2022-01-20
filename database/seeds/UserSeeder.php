<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name' => '고의영',
                'email' => 'ko@gmail.com',
                'password' => bcrypt('laravel1^^')
            ],
            [
                'name' => '홍길동',
                'email' => 'sk@sk.com',
                'password' => bcrypt('laravel1^^')
            ],
            [
                'name' => '김길동',
                'email' => 'kt@kt.com',
                'password' => bcrypt('laravel1^^')
            ],
            [
                'name' => '최길동',
                'email' => 'lg@lg.com',
                'password' => bcrypt('laravel1^^')
            ]
        ];

        DB::table('users')->insert($datas);
    }
}
