<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                "name" => "Not Available",
            ],

        ];
        Job::insert($jobs);
    }
}
