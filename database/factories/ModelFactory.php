<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//         'password' => bcrypt(str_random(10)),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(10),
        'pin' => $faker->boolean($chanceOfGettingTrue = 30),
        'short_text' => $faker->realText($faker->numberBetween(70,120)),
        'text' => $faker->realText($faker->numberBetween(120, 240)),
        'thumbnail' => 'uploads/rider_01.jpg',
        'created_at' =>  $faker->dateTimeThisYear($max = 'now'),
        'gallery_id' => 3
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
	$number = $faker->numberBetween(1, 7);
	$serie = "serie_{$number}";
    return [
			'title' => $faker->sentence(1),
			'created_at' => $faker->dateTime($max = 'now'),
			'category_id'=>$faker->numberBetween(2, 7),
			'tags' => $serie,
			'subtitle' => $faker->sentence($faker->numberBetween(3, 5)),
			'thumbnail' => 'uploads/bolso-a.jpg',
			'images' => ['uploads/bolso-a.jpg','uploads/bolso-b.jpg'],
			'link' => 'http://shop.ocsport.com.ar/bolsos/oc-2023-k-bolso-deportivo-24/',
			'specs' => [
				["key"=> "Material","val"=> "Polyester 1680D Impermeable"],
				["key"=> "Peso","val"=> "920 grs."],
				["key"=> "Dimensiones","val"=> "28 cm. alto, 57 cm. ancho, 26 cm. profundo"],
				["key"=> "Capacidad","val"=> "42 lts."],
				["key"=> "Ancho de correas","val"=> "8 cm."],
				["key"=> "Cierres","val"=> "Nº 10 y Nº 8"]
			],
			'details' => $faker->text(120),
			'description' => $faker->text(120),
    ];
});