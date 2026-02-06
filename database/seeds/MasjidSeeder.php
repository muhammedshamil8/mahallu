<?php

use Illuminate\Database\Seeder;
use App\Masjid;

class MasjidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masjids = [
            [
                "name" => "Not Available",
            ],

        ];
        Masjid::insert($masjids);
    }
}
