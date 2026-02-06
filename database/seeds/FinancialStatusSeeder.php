<?php

use Illuminate\Database\Seeder;
use App\FinancialStatus;

class FinancialStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $financial_status = [
            [
                "name" => "Rich",
            ],
            [
                "name" => "Upper middle class",
            ],
            [
                "name" => "Middle class",
            ],
            [
                "name" => "Poor",
            ],
            [
                "name" => "Very poor",
            ],

        ];
        FinancialStatus::insert($financial_status);
    }
}
