<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::insert([[
            'country_id' => Country::firstWhere('tag', 'FR')->id,
            'name' => 'colissimo',
            'price' => 495,
        ],[
            'country_id' => Country::firstWhere('tag', 'BE')->id,
            'name' => 'colissimo',
            'price' => 1290,
        ],[
            'country_id' => Country::firstWhere('tag', 'CH')->id,
            'name' => 'colissimo',
            'price' => 1290,
        ]]);
    }
}
