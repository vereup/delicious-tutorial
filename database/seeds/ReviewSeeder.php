<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'store_id' => 1,
                'user_id' => 4,
                'title' => '굿굿굿',
                'contents' => '너무 맛있더라구요',
                'rating' => 4,
                'been_date' => 20220212
            ],
            [
                'store_id' => 2,
                'user_id' => 3,
                'title' => '우왕 굿굿굿',
                'contents' => '너무 왕맛있더라구요',
                'rating' => 3,
                'been_date' => 20220120
            ],
            [
                'store_id' => 3,
                'user_id' => 4,
                'title' => '매우 맛',
                'contents' => '너무 킹맛있더라구요',
                'rating' => 5,
                'been_date' => 20220120
            ],
            [
                'store_id' => 4,
                'user_id' => 1,
                'title' => '굿굿굿',
                'contents' => '너무 맛있더라구요',
                'rating' => 4,
                'been_date' => 20220120
            ],
            [
                'store_id' => 6,
                'user_id' => 1,
                'title' => '굿굿굿1',
                'contents' => '너무 맛있더라구요1',
                'rating' => 4,
                'been_date' => 20220120
            ],
            [
                'store_id' => 6,
                'user_id' => 2,
                'title' => '굿굿굿4',
                'contents' => '너무 맛있더라구요4',
                'rating' => 4,
                'been_date' => 20220120
            ],
            [
                'store_id' => 6,
                'user_id' => 3,
                'title' => '굿굿굿5',
                'contents' => '너무 맛있더라구요5',
                'rating' => 4,
                'been_date' => 20220120
            ],
            [
                'store_id' => 3,
                'user_id' => 3,
                'title' => '우왕 굿굿굿3',
                'contents' => '너무 왕맛있더라구요3',
                'rating' => 3,
                'been_date' => 20220120
            ],


        ];

        DB::table('reviews')->insert($reviews);
    }
}
