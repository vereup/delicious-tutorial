<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            '한식',
            '양식',
            '일식',
            '중식',
            '아시안요리',
            '카페&디저트',
            '기타'
        ];
        foreach($categories as $category)
        DB::table('categories')->insert([
            'name' => $category
        ]);
    }
}
