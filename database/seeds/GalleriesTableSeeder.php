<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('galleries')->insert([
			'title' => 'New Arrivals',
			'tag' => 'home_collection_banner',
			'subtitle' => 'New Season 2016',
			'description' => 'OC Sport presenta una nueva gama de mochilas, 
			bolsos, equipaje y accesorios pensados para cargar dentro más de lo que tu estilo
			 de vida necesita, con nuevos estilos, diseños funcionales, colores y estampados exclusivos.'
		]);
		DB::table('galleries')->insert([
			'title' => 'Landpage banner',
			'tag' => 'home_banner',
			'description' => 'Banner gigante para el home.',
			'images' => '[
				{"src": "uploads/banner_01.jpg", "url": "/productos"},
				{"src": "uploads/banner_02.jpg", "url": "/productos"},
				{"src": "uploads/banner_03.jpg", "url": "/productos"},
				{"src": "uploads/banner_04.jpg", "url": "/productos"},
				{"src": "uploads/banner_05.jpg", "url": "/productos"}
			]'
		]);
		DB::table('galleries')->insert([
			'title' => 'Rider Luchy',
			'images' => '[
				{"src": "uploads/rider_01.jpg", "url": ""},
				{"src": "uploads/rider_02.jpg", "url": ""},
				{"src": "uploads/rider_03.jpg", "url": ""}
			]'
		]);
		DB::table('galleries')->insert([
			'title' => 'COLEGIALES',
			'subtitle' => 'OC STORE',
			'tag' => 'store_item',
			'description' => '<p>Av. Federico Lacroze 3387, Buenos Aires<br />Tel.: 011 4554 8658<br />Horario: lun / s&aacute;b 10:00 a 19:30 hs.</p><p><a href="https://www.facebook.com/OCStoreColegiales" target="_blank"><img src="http://localhost:8080/images/ico-facebook02.png" /></a> <a href="https://www.google.com.ar/maps/place/Av.+Federico+Lacroze+3387,+C1426CQG+CABA/@-34.5796628,-58.4504437,17z/data=!3m1!4b1!4m2!3m1!1s0x95bcb5e86710fb73:0xe31926a6a13bd852" target="_blank"><img src="http://localhost:8080/images/ico-googlemaps02.png" /></a></p>',
			'images' => '[{"src":"uploads\/127dd31f73b14fd1e7d02ebd9acfbff5.jpg","url":""},{"src":"uploads\/72805d5dff07de846f37a2fcc7f1d30f.jpg","url":""},{"src":"uploads\/ea23320073cbf12fe07796e840055905.jpg","url":""}]'
		]);
		DB::table('galleries')->insert([
			'title' => 'V. URQUIZA',
			'subtitle' => 'OC STORE',
			'tag' => 'store_item',
			'description' => '<p>Olaz&aacute;bal 5235, Buenos Aires<br />Tel.: 011 4521 9669<br />Horario: lun / s&aacute;b 10:30 a 14 y de 16:30 a 20</p><p><a href="https://www.google.com.ar/maps/place/Olaz%C3%A1bal+5235,+C1430BPA+CABA/@-34.5659848,-58.4681648,17z/data=!3m1!4b1!4m2!3m1!1s0x95bcb67e99f84aaf:0x816cfdc415245459" target="_blank"><img src="/images/ico-googlemaps02.png" /></a></p>',
			'images' => '[{"src":"uploads\/eb677f58ca1f18b8abd20f9e1bb68546.jpg","url":""},{"src":"uploads\/c9b96362238e3fd0a882a06f6cd63591.jpg","url":""},{"src":"uploads\/9a0765b574c5cdfec8ea6d9a6b3b814c.jpg","url":""}]'
		]);
	}
}
