<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            ['name'           => 'Almohadón Nórdico',
             'short_desc'     => 'Almohadón de pelo de zorro sintético importado',
             'long_desc'      => 'Almohadón de pelo de zorro sintético importado. Lavable apto para lavarropas. 40x40x20',
             'price'          => 610,
             'thumbnail'      => './img/products/almo_001.jpg',
             'stock'          => 10,
             'discount'       => 20,
             'size_id'        => \App\Size::firstOrCreate(['name'=>'40x40'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name'=>'Negro'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Tusor Liso', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Almohadones'])->id])->id,
            ],
            ['name'           => 'Almohadón Estampado',
             'short_desc'     => 'Almohadón estampado blanco y negro',
             'long_desc'      => 'Almohadón estampado blanco y negro. Relleno vellón siliconado. 50x50x20',
             'price'          => 450,
             'thumbnail'      => './img/products/almo_002.jpg',
             'stock'          => 10,
             'discount'       => 0,
             'size_id'        => \App\Size::firstOrCreate(['name' => '50x50'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Rojo'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Estampados', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Almohadones'])->id])->id,
            ],
            ['name'           => 'Almohadón Libertad',
             'short_desc'     => 'Almohadón libertad tusor crudo',
             'long_desc'      => 'Almohadón libertad tusor crudo pintado a mano. 40x40x20. Rosa y Dorado',
             'price'          => 540,
             'thumbnail'      => './img/products/almo_003.jpg',
             'stock'          => 6,
             'discount'       => 0,
             'size_id'        => \App\Size::firstOrCreate(['name' => '40x40'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Marrón'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Tusor Pintados A Mano', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Almohadones'])->id])->id,
            ],
            ['name'           => 'Banquito Nórdico',
             'short_desc'     => 'Banquito nórdico con funda de pelo',
             'long_desc'      => 'Banquito nórdico mini con funda de pelo desmontable. 60x30x30',
             'price'          => 590,
             'thumbnail'      => './img/products/banq_001.jpg',
             'stock'          => 8,
             'discount'       => 5,
             'size_id'        => \App\Size::firstOrCreate(['name' => '60x60'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Amarillo'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Bancos', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Muebles'])->id])->id,
            ],
            ['name'           => 'Sillón De Mimbre 2 Cuerpos',
             'short_desc'     => 'Sillón De Mimbre 2 Cuerpos',
             'long_desc'      => 'Sillón de mimbre 2 cuerpos. 120x150x80. Blanco',
             'price'          => 1600,
             'thumbnail'      => './img/products/banq_002.jpg',
             'stock'          => 4,
             'discount'       => 13,
             'size_id'        => \App\Size::firstOrCreate(['name' => '120x150'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Rosa'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Sillones', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Muebles'])->id])->id,
            ],
            ['name'           => 'Alfombra De Lino',
             'short_desc'     => 'Alfombra de lino acolchada',
             'long_desc'      => 'Alfombra de lino acolchada. 1 metro de diámetro. 100x100',
             'price'          => 1300,
             'thumbnail'      => './img/products/alfo_001.jpg',
             'stock'          => 6,
             'discount'       => 0,
             'size_id'        => \App\Size::firstOrCreate(['name' => '100x100'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Azul'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Lino', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Alfombras'])->id])->id,
            ],
            ['name'           => 'Playmat 1.3 metros',
             'short_desc'     => 'Playmat 1.3 metros de diámetro',
             'long_desc'      => 'Playmat 1.3 metros de diámetro. 130x130x110',
             'price'          => 1200,
             'thumbnail'      => './img/products/alfo_002.jpg',
             'stock'          => 6,
             'discount'       => 10,
             'size_id'        => \App\Size::firstOrCreate(['name' => '130x130'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Verde'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Playmats', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Alfombras'])->id])->id,
            ],
            ['name'           => 'Puff grande',
             'short_desc'     => 'Puff grande de pelo sintético',
             'long_desc'      => 'Puff grande de pelo sintético largo. 120x80x80',
             'price'          => 1900,
             'thumbnail'      => './img/products/puff_001.jpg',
             'stock'          => 8,
             'discount'       => 30,
             'size_id'        => \App\Size::firstOrCreate(['name' => '120x80'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Violeta'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Grandes', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Puffs'])->id])->id,
            ],
            ['name'           => 'Puff pequeño',
             'short_desc'     => 'Puff pequeño de pelo sintético',
             'long_desc'      => 'Puff pequeño de pelo sintético largo. 90x50x50',
             'price'          => 1500,
             'thumbnail'      => './img/products/puff_002.jpg',
             'stock'          => 7,
             'discount'       => 25,
             'size_id'        => \App\Size::firstOrCreate(['name' => '90x50'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Naranja'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Pequeños', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Puffs'])->id])->id,
            ],
            ['name'           => 'Bolsa De Dormir Grande',
             'short_desc'     => 'Bolsa de dormir grande',
             'long_desc'      => 'Bolsa de dormir grande super abrigadita de castorino. 120x60x20',
             'price'          => 2500,
             'thumbnail'      => './img/products/bols_001.jpg',
             'stock'          => 6,
             'discount'       => 14,
             'size_id'        => \App\Size::firstOrCreate(['name' => '120x70'])->id,
             'color_id'       => \App\Color::firstOrCreate(['name' => 'Blanco'])->id,
             'subcategory_id' => \App\Subcategory::firstOrCreate(['name'=>'Grandes', 'category_id'=>\App\Category::firstOrCreate(['name'=>'Bolsas De Dormir'])->id])->id,
            ],
        ];

        foreach ($products as $product)
        {
            \App\Product::create($product);
        }

    }
}
