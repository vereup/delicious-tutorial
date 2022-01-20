<?php

use Illuminate\Database\Seeder;

class LocalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localCodes = [
            '02',
            '031',
            '032',
            '033',
            '041',
            '042',
            '043',
            '044',
            '051',
            '052',
            '053',
            '054',
            '055',
            '061',
            '062',
            '063',
            '064'
        ];
        foreach($localCodes as $localCode)
        DB::table('local_codes')->insert([
            'number' => $localCode
        ]);
    }
}
