<?php

use Illuminate\Database\Seeder;

class Shipping_StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Indefinido'],
            ['id' => 2, 'name' => 'Enviado'],
            ['id' => 3, 'name' => 'En Tránsito'],
            ['id' => 4, 'name' => 'Entregado'],
        ];

        foreach ($items as $item)
        {
            \App\Shipping_status::updateOrCreate(['id'=>$item['id']], $item);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
