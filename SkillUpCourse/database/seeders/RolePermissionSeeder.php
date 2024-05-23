<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $studentRole = Role::create([
            'name' => 'student',
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);

        // Super admin account
        $userOwner = User::create([
            'name' => 'Daniel Siahaan',
            'occupation' => 'Educator',
            'avatar' => 'images/default-avatar.png',
            'email' => 'dsiahaan581@gmail.com',
            'password' => bcrypt('Tuhanberkati@11'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
