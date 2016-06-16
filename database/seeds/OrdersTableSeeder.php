<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 20) as $index) {
			$order = [
				'customer_id' => 1,
				'details' => $faker->realText($faker->numberBetween(70,120)),
				'status' => $faker->randomElement(['PROCESANDO', 'EMPACANDO', 'ENVIADO', 'RECIBIDO']),
				'price' => $faker->numberBetween(300.0, 3000.0)
			];
			Order::create($order);
			// DB::table('orders')->insert($order);
		}

		foreach (range(1, 200) as $index) {
			$item = [
				'order_id' => $faker->numberBetween(1, 20),
				'reference_id' => $faker->numberBetween(1, 4),
				'price' => $faker->numberBetween(10.0, 1000.0),
				'qty' => $faker->numberBetween(1, 3)
			];
			DB::table('order_reference')->insert($item);
		}
	}
}
