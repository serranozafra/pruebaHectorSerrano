<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class,5)->create();
        factory(App\Color::class,10)->create();
        factory(App\Product::class,50)->create();
        factory(App\Language::class,3)->create();
        factory(App\ProductColor::class,100)->create();
    }
}
