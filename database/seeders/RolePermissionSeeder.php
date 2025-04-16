<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Add this import
use Spatie\Permission\Models\Permission; // Add this import
use App\Models\User; // Corrected import

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage companies',
            'manage jobs',
            'manage users',
            'manage applicants',
            'manage applicant soft skill',
            'manage applicant hard skill',
            'manage skills',
            'manage job skill',
            'manage applicant skill',
            'manage educations',
            'manage experiences',
            'manage certifications',
        ];

        foreach($permissions as $permission) {
            Permission::firstorCreate([
                'name' => $permission,
            ]
            );
        }

        // // Applicant Role
        // $applicantRole = Role::firstOrCreate([
        //     'name' => 'applicant_role',
        // ]); 

        // $applicantRolePermissions = [
        //     'manage applicant soft skill',
        //     'manage applicant hard skill',
        //     'manage skills',
        //     'manage job skill',
        //     'manage applicant skill',
        //     'manage educations',
        //     'manage experiences',
        //     'manage certifications',
        // ];

        // $applicantRole->syncPermissions($applicantRolePermissions);

        // // Company Role
        // $companyRole = Role::firstOrCreate([
        //     'name' => 'company_role',
        // ]); 

        // $companyRolePermissions = [
        //     'manage applicants',
        //     'manage applicant soft skill',
        //     'manage applicant hard skill',
        //     'manage job skill',
        //     'manage applicant skill',
        // ];

        // $companyRole->syncPermissions($companyRolePermissions);
        

        // Admin Role
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]); 

        $user = User::create([
            'name' => 'JobMatch',
            'email' => 'job@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($superAdminRole);

    }
}
