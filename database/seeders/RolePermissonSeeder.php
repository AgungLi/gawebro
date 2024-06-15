<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage categories',
            'manage tools',
            'manage projects',
            'manage project tools',
            'manage wallets',
            'manage applicants',

            //other singular action
            'apply job',
            'topup wallet',
            'withdraw wallet'
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $clientRole = Role::firstOrCreate([
             'name' => 'project_client'   
        ]);

        $clientPemissions = [
            'manage projects',
            'manage project tools',
            'manage applicants',
            'topup wallet',
            'withdraw wallet'
        ];

        $clientRole->syncPermissions($clientPemissions);

        $freelancerRole = Role::firstOrCreate([
            'name' => 'project_freelancer'
        ]);

        $freelancerPermissions = [
            'apply job',
            'withdraw wallet'
        ];

        $freelancerRole->syncPermissions($freelancerPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'occupation' => 'owner',
            'connect' => 99999,
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($superAdminRole);

        $wallet = new Wallet([
            'balance' => 0
        ]);

        $user->wallet()->save($wallet);

    }
}
