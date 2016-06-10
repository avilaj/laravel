<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' => 'Productos',
            'banner' => 'uploads/01.jpg',
            'slug' => 'productos',
            'description' => 'Todos los productos',
            'order' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Bolsos',
            'banner' => 'uploads/03.jpg',
            'slug' => 'bolsos',
        	'order' => 2
        ]);
        DB::table('categories')->insert([
            'name' => 'Equipajes',
            'banner' => 'uploads/04.jpg',
            'slug' => 'equipajes',
        	'order' => 3
        ]);
        DB::table('categories')->insert([
        	'name' => 'Mochilas c/carro',
            'banner' => 'uploads/01.jpg',
            'slug' => 'mochlas-c-carro',
        	'order' => 4
        ]);
        DB::table('categories')->insert([
        	'name' => 'Mochilas',
            'banner' => 'uploads/05.jpg',
            'slug' => 'mochilas',
        	'order' => 5
        ]);
        DB::table('categories')->insert([
        	'name' => 'Morrales p/notebook',
            'banner' => 'uploads/02.jpg',
            'slug' => 'morrales-p-notebook',
        	'order' => 6
        ]);
        DB::table('categories')->insert([
        	'name' => 'Riñoneras',
            'banner' => 'uploads/03.jpg',
            'slug' => 'rinoneras',
        	'order' => 7
        ]);
        DB::table('categories')->insert([
        	'name' => 'Accesorios',
            'banner' => 'uploads/01.jpg',
            'slug' => 'accesorios',
        	'order' => 6
        ]);
    }
}
