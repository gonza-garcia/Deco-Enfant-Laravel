<?php

use Illuminate\Database\Seeder;

class Order_StatusesTableSeeder extends Seeder
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
            ['id' => 2, 'name' => 'Pedido'],
            ['id' => 3, 'name' => 'Enviado'],
            ['id' => 4, 'name' => 'Entregado'],
            ['id' => 5, 'name' => 'Devolución'],
            ['id' => 6, 'name' => 'Finalizado'],
        ];

        foreach ($items as $item)
        {
            \App\Order_status::updateOrCreate(['id'=>$item['id']], $item);
        }

        //si la fila con el id ya existe en la db, actualiza el nombre, si no existe, lo crea e inserta en la db
    }
}
