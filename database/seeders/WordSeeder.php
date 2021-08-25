<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Word::factory()
            ->count(5)
            ->create();
    }
}
