<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['id' => 1, 'name' => 'Indefinido'],
            ['id' => 2, 'name' => '10x15'],
            ['id' => 3, 'name' => '24x60'],
            ['id' => 4, 'name' => '40x40'],
            ['id' => 5, 'name' => '50x50'],
            ['id' => 6, 'name' => '60x60'],
            ['id' => 7, 'name' => '120x70'],
            ['id' => 8, 'name' => '120x80'],
            ['id' => 9, 'name' => '90x50'],
            ['id' => 10, 'name' => '100x100'],
            ['id' => 11, 'name' => '75x50'],
            ['id' => 12, 'name' => '120x150'],
            ['id' => 13, 'name' => '130x130'],
        ];

        foreach ($sizes as $size)
        {
            \App\Size::updateOrCreate(['id'=>$size['id']], $size);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
