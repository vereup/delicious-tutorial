<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'store_id' => '1',
                'path' => '/images/store_thum_1-1.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_thum_1-2.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_thum_1-3.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_thum_1-4.png',
            ],
            [
                'store_id' => '2',
                'path' => '/images/store_thum_2.png',
            ],
            [
                'store_id' => '3',
                'path' => '/images/store_thum_3.png',
            ],
            [
                'store_id' => '4',
                'path' => '/images/store_thum_4.png',
            ],
            [
                'store_id' => '5',
                'path' => '/images/store_thum_5.png',
            ],
            [
                'store_id' => '6',
                'path' => '/images/store_thum_6.png',
            ]
        ];

        DB::table('images')->insert($images);
    }
}
