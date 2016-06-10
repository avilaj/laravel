<?php
use Faker\Factory as Faker;
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
		$faker = Faker::create();
		DB::table('products')->insert([
			'title' => 'Oc 2023 B',
			'slug' => 'oc-2023-b',
			'category_id'=>2,
			'tags' => 'oc_2023',
			'subtitle' => 'Bolso deportivo 24"',
			'thumbnail' => 'uploads/bolso-a.jpg',
			'images' => 'uploads/bolso-a.jpg,uploads/bolso-b.jpg',
			'link' => 'http://shop.ocsport.com.ar/bolsos/oc-2023-k-bolso-deportivo-24/',
			'specs' => '[
				{"key": "Material","val": "Polyester 1680D Impermeable"},
				{"key": "Peso","val": "920 grs."},
				{"key": "Dimensiones","val": "28 cm. alto, 57 cm. ancho, 26 cm. profundo"},
				{"key": "Capacidad","val": "42 lts."},
				{"key": "Ancho de correas","val": "8 cm."},
				{"key": "Cierres","val": "Nº 10 y Nº 8"}
			]',
			'details' => '1 Bolsillo Frontal. 2 Bolsillos Laterales. 1 Compartimiento grande. 2 agarraderas. Correa removible acolchada para colgar colgar del hombro.'
		]);
		DB::table('products')->insert([
			'title' => 'Oc 2023 K',
			'slug' => 'oc-2023-k',
			'category_id'=>2,
			'tags' => 'oc_2023',
			'thumbnail' => 'uploads/bolso-a.jpg',
			'images' => 'uploads/bolso-a.jpg,uploads/bolso-b.jpg',
			'subtitle' => 'Bolso deportivo 24"',
			'link' => 'http://shop.ocsport.com.ar/bolsos/oc-2023-k-bolso-deportivo-24/',
			'specs' => '[
				{"key": "Material","val": "Polyester 1680D Impermeable"},
				{"key": "Peso","val": "920 grs."},
				{"key": "Dimensiones","val": "28 cm. alto, 57 cm. ancho, 26 cm. profundo"},
				{"key": "Capacidad","val": "42 lts."},
				{"key": "Ancho de correas","val": "8 cm."},
				{"key": "Cierres","val": "Nº 10 y Nº 8"}
			]',
			'details' => '1 Bolsillo Frontal. 2 Bolsillos Laterales. 1 Compartimiento grande. 2 agarraderas. Correa removible acolchada para colgar colgar del hombro.'
		]);
		DB::table('products')->insert([
			'title' => 'Oc 2023 Z',
			'slug' => 'oc-2023-z',
			'category_id'=>2,
			'tags' => 'oc_2023',
			'subtitle' => 'Bolso deportivo 24"',
			'thumbnail' => 'uploads/bolso-a.jpg',
			'images' => 'uploads/bolso-a.jpg,uploads/bolso-b.jpg',
			'link' => 'http://shop.ocsport.com.ar/bolsos/oc-2023-k-bolso-deportivo-24/',
			'specs' => '[
				{"key": "Material","val": "Polyester 1680D Impermeable"},
				{"key": "Peso","val": "920 grs."},
				{"key": "Dimensiones","val": "28 cm. alto, 57 cm. ancho, 26 cm. profundo"},
				{"key": "Capacidad","val": "42 lts."},
				{"key": "Ancho de correas","val": "8 cm."},
				{"key": "Cierres","val": "Nº 10 y Nº 8"}
			]',
			'details' => '1 Bolsillo Frontal. 2 Bolsillos Laterales. 1 Compartimiento grande. 2 agarraderas. Correa removible acolchada para colgar colgar del hombro.'
		]);

		$news = factory(App\Product::class, 30)->create();

		foreach(range(1, 40) as $index) {
			DB::table('product_colors')->insert([
				'product_id' => $faker->numberBetween(1, 30),
				'color_id' => $faker->numberBetween(1, 5)
			]);
		}
	}
}
