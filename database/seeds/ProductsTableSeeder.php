<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Model\Product;
use App\Model\Reference;

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
        $categories = DB::table('categories')->pluck('id');
        $types = DB::table('types')->pluck('id');
        $colores = DB::table('colors')->pluck('id');
        $brands = DB::table('brands')->pluck('id');

        foreach (range(1, 40) as $index) {
            $data = [
                'category_id' => $faker->randomElement($categories),
                'brand_id' => $faker->randomElement($brands),
                'type_id' => $faker->randomElement($types),
                'title' => $faker->sentence($faker->numberBetween(3,7)),
                'subtitle' => $faker->sentence($faker->numberBetween(5,9)),
                'description' => $faker->text,
                'price' => $faker->numberBetween(300.0, 2000.0),
                'gender' => $faker->randomElement(['MUJER','HOMBRE','NIÑO', 'NIÑA'])
            ];
            $product = new Product($data);
            $product->save();
            $product->generateReference($faker->randomElement($colores));
            $product->generateReference($faker->randomElement($colores));
        }
        $references = Reference::all();
        foreach ($references as $reference) {
          foreach($reference->product->type->sizes() as $size) {
            $reference->addStock($size->id, $faker->numberBetween(1, 10) , 'Precarga desde generador');
          }
        }

    }
}
