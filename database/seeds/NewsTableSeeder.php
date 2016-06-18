<?php

use Illuminate\Database\Seeder;
use App\Models\News;
class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$news = factory(News::class, 30)->create();

    }
}
