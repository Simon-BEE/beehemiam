<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert([
            [
                'name' => 'Annulée',
                'color' => 'gray',
            ],
            [
                'name' => 'Terminée',
                'color' => 'green',
            ],
            [
                'name' => 'Échouée',
                'color' => 'red',
            ],
            [
                'name' => 'En cours de livraison',
                'color' => 'blue',
            ],
            [
                'name' => 'En cours de fabrication',
                'color' => 'orange',
            ],
            [
                'name' => 'Remboursée',
                'color' => 'pink',
            ],
            [
                'name' => 'En préparation',
                'color' => 'teal',
            ],
            [
                'name' => 'En traitement',
                'color' => 'yellow',
            ],
        ]);
    }
}
