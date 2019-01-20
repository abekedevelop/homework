<?php

use Illuminate\Database\Seeder;

class CityCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\CityCountryLink::class, 4)->create();
    }
}
