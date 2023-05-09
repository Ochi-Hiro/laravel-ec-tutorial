<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'ここに店名入る',
                'information' => 'ここにお店の情報ここにお店の情報ここにお店の情報',
                'filename' => 'sample1.jpg',
                'is_selling' => true
            ],
            [
                'owner_id' => 2,
                'name' => 'ここに店名入る',
                'information' => 'ここにお店の情報ここにお店の情報ここにお店の情報',
                'filename' => 'sample2.jpg',
                'is_selling' => true
            ],
            ]);
    }
}
