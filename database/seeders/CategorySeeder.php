<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->title = 'Điện thoại';
        $category->save();

        $category = new Category();
        $category->title = 'Máy tính bảng';
        $category->save();
    }
}
