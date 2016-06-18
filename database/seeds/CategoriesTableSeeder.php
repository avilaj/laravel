<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categorias = [
            'Remeras / Musculosas',
            'Camisas',
            'Pantalones / Bermudas',
            'Buzos',
            'Camperas',
            'Underwear',
            'Boardshort',
            'Marroquinería',
            'Accesorios'
        ];
        foreach ($categorias as $categoria) {
            # code...
            $data = [
                'name' => $categoria,
                'description' => $faker->text()
            ];
            Category::create($data);
        }
    }
}
