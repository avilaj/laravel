<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Size;
use App\Model\Reference;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $calzado = \App\Model\Type::create(['label'=>'calzado']);
        $vestimenta = \App\Model\Type::create(['label'=>'vestimenta']);
        foreach (range(35, 46) as $talle) {
            $size = ['label' => $talle];
            $calzado->sizes()->create($size);
        }
        $clothesSizes = ['XS', 'S', 'M', 'L','XL', 'XXL'];
        foreach ($clothesSizes as $talle) {
          $size = ['label' => $talle];
          $vestimenta->sizes()->create($size);
        }
    }
}
