<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('categories')->insert([
            ['id' => 1, 'content' => '1.商品の お届けについて'],
            ['id' => 2, 'content' => '2.商品の交換について'],
            ['id' => 3, 'content' => '3.商品トラブル'],
            ['id' => 4, 'content' => '4.ショップへのお問合せ'],
            ['id' => 5, 'content' => '5.その他'],
        ]);

    }
}