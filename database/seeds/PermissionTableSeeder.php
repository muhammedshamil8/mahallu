<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrativePermissionList = [
            [
                "name" => "user-list",
                "group" => "Administration"
            ],
            [
                "name" => "user-create",
                "group" => "Administration"
            ],
            [
                "name" => "user-edit",
                "group" => "Administration"
            ],
            [
                "name" => "user-delete",
                "group" => "Administration"
            ],

            [
                "name" => "role-list",
                "group" => "Administration"
            ],
            [
                "name" => "role-create",
                "group" => "Administration"
            ],
            [
                "name" => "role-edit",
                "group" => "Administration"
            ],
            [
                "name" => "role-delete",
                "group" => "Administration"
            ],
        ];
        $mahalluPermissionList = [
            
            [
                "name" => "family-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "family-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "family-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "family-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "educations-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "educations-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "educations-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "educations-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "islamic_educations-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "islamic_educations-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "islamic_educations-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "islamic_educations-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "jobs-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "jobs-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "jobs-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "jobs-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "relations-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "relations-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "relations-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "relations-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "facilities-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "facilities-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "facilities-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "facilities-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "relegion-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "relegion-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "relegion-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "relegion-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "masjid-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "masjid-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "masjid-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "masjid-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "designation-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "designation-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "designation-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "designation-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "districts-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "districts-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "districts-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "districts-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "executive-members-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "executive-members-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "executive-members-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "executive-members-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "committe-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "committe-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "committe-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "committe-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "account_list-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "account_list-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "account_list-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "account_list-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "receiver_list-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "receiver_list-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "receiver_list-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "receiver_list-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "bank_account-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "bank_account-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "bank_account-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "bank_account-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "income-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "income-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "income-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "income-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "expense-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "expense-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "expense-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "expense-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "donors-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "donors-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "donors-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "donors-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "helps-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "helps-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "helps-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "helps-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "beneficiaries-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "beneficiaries-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "beneficiaries-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "beneficiaries-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "staffs-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "staffs-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "staffs-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "staffs-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "shops-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "shops-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "shops-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "shops-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "students-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "students-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "students-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "students-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "classes-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "classes-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "classes-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "classes-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "family_reports-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "family_reports-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "family_reports-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "family_reports-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "member_reports-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "member_reports-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "member_reports-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "member_reports-delete",
                "group" => "Mahallu"
            ],
            
            [
                "name" => "tran_reports-list",
                "group" => "Mahallu"
            ],
            [
                "name" => "tran_reports-create",
                "group" => "Mahallu"
            ],
            [
                "name" => "tran_reports-edit",
                "group" => "Mahallu"
            ],
            [
                "name" => "tran_reports-delete",
                "group" => "Mahallu"
            ],
        ];
        $permissions = array_merge($administrativePermissionList, $mahalluPermissionList);
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'group' => $permission['group'],
            ]);
        }
    }
}
