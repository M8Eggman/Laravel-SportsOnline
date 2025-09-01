<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $continents = [
            ['name' => 'Europe'],
            ['name' => 'CIS'],
            ['name' => 'Americas'],
            ['name' => 'Oceania'],
            ['name' => 'Asia'],
            ['name' => 'Africa & Middle East'],
        ];

        foreach ($continents as $c) {
            Continent::create($c);
        }
    }
}
