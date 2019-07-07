<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //Definir las categorias principales
        //si no existe la categoría con el name buscado, firstOrCreate la va a crear e insertar en la base de datos
        $varios      = \App\Category::firstOrCreate(['name'=>'Varios']);
        $alfombras   = \App\Category::firstOrCreate(['name'=>'Alfombras']);
        $almohadones = \App\Category::firstOrCreate(['name'=>'Almohadones']);
        $bolsas      = \App\Category::firstOrCreate(['name'=>'Bolsas De Dormir']);
        $muebles     = \App\Category::firstOrCreate(['name'=>'Muebles']);
        $puffs       = \App\Category::firstOrCreate(['name'=>'Puffs']);

        //Definir las subcategorias de cada categoria principal
        $categories_subcategories = [
            $varios->id       => ['Varios'],
            $alfombras->id    => ['Lino','Playmats'],
            $almohadones->id  => ['Tusor Liso','Estampados','Tusor Pintados A Mano'],
            $bolsas->id       => ['Grandes','Pequeñas'],
            $muebles->id      => ['Bancos','Sillones'],
            $puffs->id        => ['Grandes','Pequeños'],
        ];

        foreach ($categories_subcategories as $category_id => $subcategories)
        {
            foreach($subcategories as $subcat_name)
            {
                $subcat = ['name'        => $subcat_name,
                           'category_id' => $category_id];

                \App\Subcategory::create($subcat);
            }
        }
    }
}
