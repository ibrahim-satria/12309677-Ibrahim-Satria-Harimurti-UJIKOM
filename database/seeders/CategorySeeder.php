<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Peralatan IT', 'division_pj' => 'Teknologi Informasi'],
            ['name' => 'Perlengkapan Kantor', 'division_pj' => 'Administrasi'],
            ['name' => 'Furniture', 'division_pj' => 'Operasional'],
            ['name' => 'Peralatan Maintenance', 'division_pj' => 'Pemeliharaan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
