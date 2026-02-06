<?php

use Illuminate\Database\Seeder;
use App\HouseOwnership;

class HouseOwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $house_ownership = [
            [
                "name" => "Own",
            ],
            [
                "name" => "Rent",
            ],
            [
                "name" => "Lease",
            ],

        ];
        HouseOwnership::insert($house_ownership);
    }
}
