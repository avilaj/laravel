<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Order;
use App\Model\Reference;

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
		$references = Reference::with('product')->get();
		$orderStatus = ['PROCESANDO', 'EMPACANDO', 'ENVIADO', 'RECIBIDO'];
		foreach (range(1, 20) as $index) {
			$order = [
				'customer_id' => 1,
				'details' => $faker->realText($faker->numberBetween(70,120)),
				'status' => $faker->randomElement($orderStatus),
				'price' => 0
			];
			$order = Order::create($order);
			foreach (range(1, $faker->numberBetween(1, 7)) as $index) {
				$ref = $references->random();
				$item = [
					'order_id' => $order->id,
					'reference_id' => $ref->id,
					'price' => $ref->product->price,
					'qty' => $faker->numberBetween(1, 3)
				];
				$order->items()->create($item);
			}
			$order->updatePrice();
		}

	}
}
