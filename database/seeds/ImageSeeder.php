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
                'path' => '/storage/images/store_Img_1-1.png',
            ],
            [
                'store_id' => '1',
                'path' => '/storage/images/store_Img_1-2.png',
            ],
            [
                'store_id' => '1',
                'path' => '/storage/images/store_Img_1-3.png',
            ],
            [
                'store_id' => '1',
                'path' => '/storage/images/store_Img_1-4.png',
            ],
            [
                'store_id' => '2',
                'path' => '/storage/images/store_Img_2.png',
            ],
            [
                'store_id' => '3',
                'path' => '/storage/images/store_Img_3.png',
            ],
            [
                'store_id' => '4',
                'path' => '/storage/images/store_Img_4.png',
            ],
            [
                'store_id' => '5',
                'path' => '/storage/images/store_Img_5.png',
            ],
            [
                'store_id' => '6',
                'path' => '/storage/images/store_Img_6.png',
            ]
        ];

        DB::table('images')->insert($images);
    }
}
