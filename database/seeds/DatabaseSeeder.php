<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this -> call([
            UserSeeder::class,
            AddressSeeder::class,
            CountySeeder::class,
            CategorySeeder::class,
            LocalCodeSeeder::class,
            StoreSeeder::class,
            ImageSeeder::class,
            ReviewSeeder::class,
            // WishSeeder::class,
        ]);
    }
}
