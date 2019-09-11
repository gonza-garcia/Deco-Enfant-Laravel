<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //Definir los países
        //si no existe el país con el name buscado, firstOrCreate lo va a crear e insertar en la base de datos
        $argentina  = \App\Country::firstOrCreate(['name'=>'Argentina']);
        $bolivia    = \App\Country::firstOrCreate(['name'=>'Bolivia']);
        $brasil     = \App\Country::firstOrCreate(['name'=>'Brasil']);
        $chile      = \App\Country::firstOrCreate(['name'=>'Chile']);
        $colombia   = \App\Country::firstOrCreate(['name'=>'Colombia']);
        $ecuador    = \App\Country::firstOrCreate(['name'=>'Ecuador']);
        $paraguay   = \App\Country::firstOrCreate(['name'=>'Paraguay']);
        $peru       = \App\Country::firstOrCreate(['name'=>'Perú']);
        $uruguay    = \App\Country::firstOrCreate(['name'=>'Uruguay']);

        //Definir las provincias por cada país
        $country_provinces = [
            $argentina->id => ['Buenos Aires','Catamarca','Chaco','Chubut','Córdoba','Corrientes','Entre Ríos','Formosa','Jujuy',
                               'La Pampa','La Rioja','Mendoza','Misiones','Río Negro','Salta','San Juan','San Luis','Santa Cruz',
                               'Santa Fe','Santiago Del Estero','Tierra Del Fuego','Tucumán'],
            $bolivia->id   => ['Abel Iturralde','Abuná','Alonso De Ibañez'],
            $brasil->id    => ['Acre','Bahia','Sao Paulo'],
            $chile->id     => ['Atacama','Coquimbo','Valparaíso'],
            $colombia->id  => ['Caldas','Magdalena','Santander'],
            $ecuador->id   => ['Bolívar','Chimborazo','Esmeraldas'],
            $paraguay->id  => ['Alto Paraná','Boquerón','Central'],
            $peru->id      => ['Amazonas','Arequipa','Callao'],
            $uruguay->id   => ['Canelones','Colonia','Montevideo'],
        ];

        foreach ($country_provinces as $country_id => $provinces)
        {
            foreach($provinces as $prov_name)
            {
                $prov = ['name'       => $prov_name,
                         'country_id' => $country_id];

                \App\Province::create($prov);
            }
        }

    }
}
