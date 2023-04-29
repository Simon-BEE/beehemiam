<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Country;
use App\Models\User;
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
        User::create([
            'firstname' => 'Simon',
            'lastname' => 'BÉE',
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => bcrypt(env('ADMIN_PWD', '123123')),
            'email_verified_at' => now(),
            'last_activity_at' => now(),
            'newsletter' => true,
            'role' => User::ADMIN_ROLE,
        ]);

        User::factory(10)->create();

        Country::insert([
            ['name' => 'France', 'tag' => 'FR'],
            ['name' => 'Belgique', 'tag' => 'BE'],
            ['name' => 'Suisse', 'tag' => 'CH'],
        ]);

        $this->call(ShippingSeeder::class);

        $this->call(OrderStatusesSeeder::class);

        $this->call(SizesSeeder::class);

        if (app()->env !== 'testing') {
            $this->call(ShopSeeder::class);

            ContactMessage::factory(20)->create();
        }
    }
}
