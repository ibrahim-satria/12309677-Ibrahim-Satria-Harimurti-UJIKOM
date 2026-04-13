<?php

namespace Database\Seeders;

use App\Models\Lending;
use Illuminate\Database\Seeder;

class LendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $lendings = [
            ['item_id' => 1, 'user_id' => 2, 'total_lent' => 1, 'returned' => 1, 'return_date' => $now->copy()->addDays(7)],
            ['item_id' => 2, 'user_id' => 3, 'total_lent' => 2, 'returned' => 0, 'return_date' => $now->copy()->addDays(10)],
            ['item_id' => 4, 'user_id' => 2, 'total_lent' => 5, 'returned' => 1, 'return_date' => $now->copy()->addDays(1)],
            ['item_id' => 6, 'user_id' => 4, 'total_lent' => 2, 'returned' => 0, 'return_date' => $now->copy()->addDays(14)],
            ['item_id' => 7, 'user_id' => 3, 'total_lent' => 1, 'returned' => 1, 'return_date' => $now->copy()->addDays(5)],
            ['item_id' => 8, 'user_id' => 2, 'total_lent' => 1, 'returned' => 0, 'return_date' => $now->copy()->addDays(3)],
        ];

        foreach ($lendings as $lending) {
            Lending::factory()->create($lending);
        }
    }
}
