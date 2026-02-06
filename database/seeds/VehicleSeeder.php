<?php

use Illuminate\Database\Seeder;
use App\Vehicles;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                "name" => "Not Available",
            ],
            [
                "name" => "Cycle",
            ],
            [
                "name" => "Two Wheeler",
            ],
            [
                "name" => "Three Wheeler",
            ],
            [
                "name" => "Car / 4 Wheeler ",
            ],
            [
                "name" => "Tempo/Lorry/Bus",
            ],

        ];
        Vehicles::insert($vehicles);
    }
}
