<?php

use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counties = [
            [
                'address_id' => '1',
                'county' => '강남구',
            ],
            [
                'address_id' => '1',
                'county' => '강동구',
            ],
            [
                'address_id' => '1',
                'county' => '강북구',
            ],
            [
                'address_id' => '1',
                'county' => '강서구',
            ],
            [
                'address_id' => '1',
                'county' => '영등포구',
            ],
            [
                'address_id' => '1',
                'county' => '종로구',
            ],
            [
                'address_id' => '1',
                'county' => '금천구',
            ],
            [
                'address_id' => '1',
                'county' => '서초구',
            ],
            [
                'address_id' => '2',
                'county' => '가평군',
            ],
            [
                'address_id' => '2',
                'county' => '고양시 덕양구',
            ],
            [
                'address_id' => '2',
                'county' => '고양시 일산동구',
            ],
            [
                'address_id' => '3',
                'county' => '강화군',
            ],
        ];

        DB::table('counties')->insert($counties);
    }
}
