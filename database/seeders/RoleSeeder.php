<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            'Admin', 'Owner', 'Guest'
        ];

        foreach($jabatan as $jabatan) {
            Role::create([
                'nama' => $jabatan
            ]);
        }
    }
}
