<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '新書',
                'sort_order' => 1,
            ],
            [
                'name' => '文庫本',
                'sort_order' => 2,
            ],
            [
                'name' => '雑誌',
                'sort_order' => 3,
            ],
        ]);
        
        DB::table('secondary_categories')->insert([
            [
                'name' => 'ビジネス',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => '科学',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => '歴史',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => '趣味',
                'sort_order' => 4,
                'primary_category_id' => 2
            ],
            [
                'name' => '文学',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => '人文',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],
        ]);
    }

}
