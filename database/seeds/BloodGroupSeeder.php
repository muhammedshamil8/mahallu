<?php

use Illuminate\Database\Seeder;
use App\BloodGroup;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blood_groups = [
            [
                "name" => "A+",
            ],
            [
                "name" => "A-",
            ],
            [
                "name" => "B+",
            ],
            [
                "name" => "B-",
            ],
            [
                "name" => "AB+",
            ],
            [
                "name" => "AB-",
            ],
            [
                "name" => "O+",
            ],
            [
                "name" => "O-",
            ],

        ];
        BloodGroup::insert($blood_groups);
    }
}
