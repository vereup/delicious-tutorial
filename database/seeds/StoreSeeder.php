<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            [
                'category_id' => 6,
                'county_id' => 20,
                'local_code_id' => 1,
                'name' => '수박화채 1호점',
                'introduction' => '맛잇어요 진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요 ',
                'telephone_number' => '1231234',
                'rating_average' => 4.0,
                'review_count' => 1,
                'address_detail' => '여의도동 11'
            ],
            [
                'category_id' => 3,
                'county_id' => 23,
                'local_code_id' => 1,
                'name' => '라멘집',
                'introduction' => '맛잇어요 굿 진짜 맛있을껄요 확실해요 진짜 맛있을껄요 확실해요 진짜 맛있을껄요 확실해요 ',
                'telephone_number' => '5119129',
                'rating_average' => 5.0,
                'review_count' => 1,
                'address_detail' => '평창동 11'
            ],
            [
                'category_id' => 6,
                'county_id' => 2,
                'local_code_id' => 1,
                'name' => '베이커리&샌드위치',
                'introduction' => '샌드위치 맛잇어요 진짜 맛있을껄요 확실해요 진짜 맛있을껄요 확실해요 진짜 맛있을껄요 확실해요',
                'telephone_number' => '1239229',
                'rating_average' => 4.0,
                'review_count' => 2,
                'address_detail' => '천호동 11'
            ],
            [
                'category_id' => 4,
                'county_id' => 8,
                'local_code_id' => 1,
                'name' => '샤브샤브&훠궈',
                'introduction' => '샤브샤브 맛잇어요 진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요 ',
                'telephone_number' => '4454559',
                'rating_average' => 4.0,
                'review_count' => 1,
                'address_detail' => '가산동 11'
            ],
            [
                'category_id' => 6,
                'county_id' => 15,
                'local_code_id' => 1,
                'name' => '도너츠',
                'introduction' => '도너츠 맛잇어요 진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요 ',
                'telephone_number' => '1139753',
                'rating_average' => 4.0,
                'review_count' => 1,
                'address_detail' => '서초동 11'
            ],
            [
                'category_id' => 2,
                'county_id' => 15,
                'local_code_id' => 1,
                'name' => '스테이크',
                'introduction' => '스테이크 맛잇어요 진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요  진짜 맛있을껄요 확실해요 ',
                'telephone_number' => '3232312',
                'rating_average' => 4.0,
                'review_count' => 2,
                'address_detail' => '방배동 11'
            ]
        ];

        DB::table('stores')->insert($stores);
    }
}
