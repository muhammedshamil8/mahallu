<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UserSeeder::class);
         $this->call(PermissionTableSeeder::class);
         $this->call(CreateAdminUserSeeder::class);
         $this->call(HouseTypeSeeder::class);
         $this->call(FinancialStatusSeeder::class);
         $this->call(HouseOwnershipSeeder::class);
         $this->call(RationCardSeeder::class);
         $this->call(VehicleSeeder::class);
         $this->call(BloodGroupSeeder::class);
         $this->call(EducationSeeder::class);
         $this->call(IslamicEducationSeeder::class);
         $this->call(JobSeeder::class);
         $this->call(MaritalStatusSeeder::class);
         $this->call(PhysicalStatusSeeder::class);
         $this->call(RelationSeeder::class);
         $this->call(MasjidSeeder::class);
    }
}
