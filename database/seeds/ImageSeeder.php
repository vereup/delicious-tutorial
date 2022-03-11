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
                'path' => '/images/store_Img_1-1.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_Img_1-2.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_Img_1-3.png',
            ],
            [
                'store_id' => '1',
                'path' => '/images/store_Img_1-4.png',
            ],
            [
                'store_id' => '2',
                'path' => '/images/store_Img_2-1.png',
            ],
            [
                'store_id' => '3',
                'path' => '/images/store_Img_3-1.png',
            ],
            [
                'store_id' => '4',
                'path' => '/images/store_Img_4-1.png',
            ],
            [
                'store_id' => '5',
                'path' => '/images/store_Img_5-1.png',
            ],
            [
                'store_id' => '6',
                'path' => '/images/store_Img_6-1.png',
            ]
        ];

        DB::table('images')->insert($images);
    }
}
