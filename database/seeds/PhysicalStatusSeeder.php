<?php

use Illuminate\Database\Seeder;
use App\PhysicalStatus;

class PhysicalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $physical_statoos = [
            [
                "name" => "Normal",
            ],
            [
                "name" => "Blind",
            ],
            [
                "name" => "Deaf",
            ],
            [
                "name" => "Dumb",
            ],
            [
                "name" => "Other",
            ],

        ];
        PhysicalStatus::insert($physical_statoos);
    }
}
