<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<25;$i++){
            $product = new Product();
            $product->title = 'Samsung' . $i;
            $product->price = 6990 + $i;
            $product->description = 'description' . $i;
            $product->category_id = 1;
            $product->save();
        }
    }
}
