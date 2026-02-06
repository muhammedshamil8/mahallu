<?php

use Illuminate\Database\Seeder;
use App\Relation;
class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relations = [
            [
                "name" => "Head of Family",
            ],

        ];
        Relation::insert($relations);
    }
}
