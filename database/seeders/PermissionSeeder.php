<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['name' => 'Coord']);
        $role = Role::create(['name' => 'Aluno']);

        $coordPermissions = [
            'coord_alunos',
            'coord_orientadores',
            'declaracoes',
            'avisos_create',
            'avisos_view',
        ];

        foreach ($coordPermissions as $permission) {
            Permission::create(['name' => $permission]);

        }
    }
}
