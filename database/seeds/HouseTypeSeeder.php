<?php

use Illuminate\Database\Seeder;
use App\HouseType;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$house_types = [
            [
                "name" => "ഓട്",
            ],
            [
                "name" => "ഓല",
            ],
            [
                "name" => "കോൺഗ്രീറ് ഒരു നില",
            ],
            [
                "name" => "ഇരുനില ",
            ],
            [
                "name" => "Others",
            ],

        ];
        HouseType::insert($house_types);
    }
}
