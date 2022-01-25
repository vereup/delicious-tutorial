<?php

use Illuminate\Database\Seeder;

class WishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wishes = [
            [
                'store_id' => 1,
                'user_id' => 4
            ],
            [
                'store_id' => 1,
                'user_id' => 3
            ],
            [
                'store_id' => 1,
                'user_id' => 4
            ],
            [
                'store_id' => 2,
                'user_id' => 3
            ],
            [
                'store_id' => 3,
                'user_id' => 3
            ],
            [
                'store_id' => 5,
                'user_id' => 3
            ],
            [
                'store_id' => 4,
                'user_id' => 3
            ]

        ];

        DB::table('wishes')->insert($wishes);
    }
}
