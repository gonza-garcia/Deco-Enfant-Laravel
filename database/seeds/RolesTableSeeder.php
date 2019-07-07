<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Administrador'],
            ['id' => 2, 'name' => 'Usuario'],
            ['id' => 3, 'name' => 'Invitado'],
        ];

        foreach ($roles as $role)
        {
            \App\Role::updateOrCreate(['id'=>$role['id']], $role);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
