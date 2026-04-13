<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['category_id' => 1, 'name' => 'Laptop Dell XPS 13', 'total' => 5, 'repair' => 0],
            ['category_id' => 1, 'name' => 'Monitor LG 24 Inch', 'total' => 8, 'repair' => 1],
            ['category_id' => 1, 'name' => 'Keyboard Mechanical', 'total' => 12, 'repair' => 0],
            ['category_id' => 2, 'name' => 'Kertas A4 1 Rim', 'total' => 50, 'repair' => 0],
            ['category_id' => 2, 'name' => 'Tinta Printer Epson', 'total' => 20, 'repair' => 0],
            ['category_id' => 3, 'name' => 'Meja Kantor', 'total' => 10, 'repair' => 2],
            ['category_id' => 3, 'name' => 'Kursi Putar', 'total' => 15, 'repair' => 0],
            ['category_id' => 4, 'name' => 'Screwdriver Set', 'total' => 6, 'repair' => 0],
            ['category_id' => 4, 'name' => 'Impact Drill', 'total' => 3, 'repair' => 1],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
