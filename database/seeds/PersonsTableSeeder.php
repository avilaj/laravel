<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('persons')->insert([
			'name' => 'Luchy cossoleto',
			'activity' => 'Surf',
			'facebook' => 'https://facebook.com',
			'instagram' => 'https://instagram.com',
			'youtube' => 'https://youtube.com',
			'bio' => 'Amante de los deportes, Luchy está llamada a ser una de las promesas del sur en latinoamérica. Con tan solo 16 años ya tuvo experiencia en varios mundiales ISA, y en los torneos juniors de la ASP. “Soy muy feliz surfeando, me gusta competir y es un orgullo representar a mi país, cuidemos las playas, cuidemos el mar, disfrutemos del surf”, expresa cada vez que puede.',
			'gallery_id' => 3,
		]);
    }
}
