<?php

use Illuminate\Database\Seeder;
use App\IslamicEducation;

class IslamicEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $islamic_education = [
            [
                "name" => "Not Available",
            ],

        ];
        IslamicEducation::insert($islamic_education);
    }
}
