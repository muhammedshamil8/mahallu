<?php

use Illuminate\Database\Seeder;
use App\RationCard;

class RationCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ration_cards = [
            [
                "name" => "BPL (Pink)",
            ],
            [
                "name" => "APL (Blue)",
            ],
            [
                "name" => "APL (White)",
            ],
            [
                "name" => "Annapoorna (Yellow)",
            ],
            [
                "name" => "No ration card",
            ]

        ];
        RationCard::insert($ration_cards);
    }
}
