<?php

use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('configuration')->insert([
        	'key' => 'home_slider',
        	'value' => '2',
            'type' => 'home'
        ]);
        DB::table('configuration')->insert([
        	'key' => 'home_octeam',
        	'value' => 'uploads/team.jpg',
            'type' => 'home'
        ]);
        DB::table('configuration')->insert([
        	'key' => 'home_ocwarranty',
        	'value' => 'uploads/garantia.jpg',
            'type' => 'home'

        ]);
        DB::table('configuration')->insert([
        	'key' => 'home_ocstores',
        	'value' => 'uploads/stores.jpg',
            'type' => 'home'

        ]);
        DB::table('configuration')->insert([
            'key' => 'home_middle_banner',
            'value' => 'uploads/pic-big.jpg',
            'type' => 'home'

        ]);
        DB::table('configuration')->insert([
        	'key' => 'ventas_mayoristas',
        	'value' => 'uploads/ventasmayoristas.jpg',
            'type' => 'layout'
        ]);
        DB::table('configuration')->insert([
            'key' => 'team_banner',
            'value' => 'uploads/banner_team.jpg'
        ]);
        DB::table('configuration')->insert([
            'key' => 'news_banner',
            'value' => 'uploads/banner_team.jpg'
        ]);
        DB::table('configuration')->insert([
            'key' => 'stores_banner',
            'value' => 2
        ]);
        DB::table('configuration')->insert([
            'key' => 'about_banner',
            'value' => 'uploads/banner_team.jpg'
        ]);
        DB::table('configuration')->insert([
            'key' => 'warranty_banner',
            'value' => 'uploads/banner_team.jpg'
        ]);
        DB::table('configuration')->insert([
            'key' => 'contact_banner',
            'value' => 'uploads/banner_team.jpg'
        ]);
        DB::table('configuration')->insert([
            'key' => 'best_seller',
            'value' => 1
        ]);

        DB::table('configuration')->insert([
            'key' => 'home_products',
            'value' => '["1","2","3"]'
        ]);
        DB::table('configuration')->insert([
            'key' => 'collection_title',
            'value' => 'NEW ARRIVALS'
        ]);
        DB::table('configuration')->insert([
            'key' => 'collection_subtitle',
            'value' => 'NEW SEASON 2016'
        ]);
        DB::table('configuration')->insert([
            'key' => 'collection_description',
            'value' => 'OC Sport presenta una nueva gama de mochilas, bolsos, equipaje y accesorios pensados para cargar dentro más de lo que tu estilo de vida necesita, con nuevos estilos, diseños funcionales, colores y estampados exclusivos.'
        ]);
    }
}
