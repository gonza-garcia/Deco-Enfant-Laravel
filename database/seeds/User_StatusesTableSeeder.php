<?php

use Illuminate\Database\Seeder;

class User_StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Activo'],
            ['id' => 2, 'name' => 'Inactivo'],
            ['id' => 3, 'name' => 'Suspendido'],
            ['id' => 4, 'name' => 'Baneado'],
        ];

        foreach ($items as $item)
        {
            \App\User_status::updateOrCreate(['id'=>$item['id']], $item);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
