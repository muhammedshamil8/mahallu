<?php

use Illuminate\Database\Seeder;
use App\MaritalStatus;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marital_statoos = [
            [
                "name" => "Unmarried",
            ],
            [
                "name" => "Married",
            ],
            [
                "name" => "Widow/Widower",
            ],
            [
                "name" => "Divorcee",
            ],
            [
                "name" => "Divorcee(nikah only) ",
            ],
            [
                "name" => "Separated",
            ],

        ];
        MaritalStatus::insert($marital_statoos);
    }
}
