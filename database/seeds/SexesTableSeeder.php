<?php

use Illuminate\Database\Seeder;

class SexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexes = [
            ['id' => 1, 'name' => 'Femenino'],
            ['id' => 2, 'name' => 'Masculino'],
        ];

        foreach ($sexes as $sex)
        {
            \App\Sex::updateOrCreate(['id'=>$sex['id']], $sex);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
