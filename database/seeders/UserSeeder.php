<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::all();

        $users = [
            [
                'id_role' => $role[0]->id_role,
                'nama' => 'Administrator',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya No. 1',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'id_role' => $role[1]->id_role,
                'nama' => 'Owner',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'id_role' => $role[2]->id_role,
                'nama' => 'Guest',
                'tempat_lahir' => 'Badung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'no_hp' => '0812341234',
                'alamat' => 'Jl. Sidakarya',
                'foto' => 'assets/uploads/users/default.png',
                'email' => 'guest@gmail.com',
                'password' => bcrypt('12345678')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
