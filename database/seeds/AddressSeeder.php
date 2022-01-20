<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cites = [
            '서울시',
            '경기도',
            '인천시',
            '강원도',
            '충청남도',
            '대전시',
            '충청북도',
            '세종시',
            '부산시',
            '울산시',
            '대구시',
            '경상북도',
            '경상남도',
            '전라남도',
            '광주시',
            '전라북도',
            '제주도'
        ];
        foreach($cites as $city)
        DB::table('addresses')->insert([
            'city' => $city
        ]);
    }
}
