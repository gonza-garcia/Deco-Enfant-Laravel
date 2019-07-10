<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['id' => 1, 'name' => 'Indefinido'],
            ['id' => 2, 'name' => 'Blanco'],
            ['id' => 3, 'name' => 'Negro'],
            ['id' => 4, 'name' => 'Azul'],
            ['id' => 5, 'name' => 'Rojo'],
            ['id' => 6, 'name' => 'Amarillo'],
            ['id' => 7, 'name' => 'Verde'],
            ['id' => 8, 'name' => 'Naranja'],
            ['id' => 9, 'name' => 'Marrón'],
            ['id' => 10, 'name' => 'Violeta'],
            ['id' => 11, 'name' => 'Rosa'],
        ];

        foreach ($colors as $color)
        {
            \App\Color::updateOrCreate(['id'=>$color['id']], $color);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
