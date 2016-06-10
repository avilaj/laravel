<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('news')->insert([
			'title' => 'Luchy Cosoleto pasó por OC Sport y se llevó mochilas de la nueva colección!',
			'slug' => 'luchy-cosoleto',
			'short_text' => 'Nuestra Surf Rider, Luchy Cosoleto, pasó por la sucursal OC Sport de Av. Federico Lacroze 3383 y se llevó mochilas de la nueva colección. Vení a conocerla, te esperamos!',
			'text' => 'Nuestra Surf Rider, Luchy Cosoleto, pasó por la sucursal OC Sport de Av. Federico Lacroze 3383 y se llevó mochilas de la nueva colección. Vení a conocerla, te esperamos!',
			'thumbnail' => 'uploads/rider_01.jpg'
		]);
		DB::table('news')->insert([
			'title' => 'Otra noticia también super importantisima como la anterior!',
			'slug' => 'otra-noticia',
			'short_text' => 'Mirá la entrevista live streaming con Bárbara Perez, instructora de snowboard y modelo del team Roxy Argentina, junto a Rama Quesada en los estudios de Surf & Rock Radio.',
			'text' => 'Mirá la entrevista live streaming con Bárbara Perez, instructora de snowboard y modelo del team Roxy Argentina, junto a Rama Quesada en los estudios de Surf & Rock Radio. Ver Entrevista',
			'thumbnail' => 'uploads/rider_01.jpg'
		]);
		$news = factory(App\News::class, 30)->create();

    }
}
