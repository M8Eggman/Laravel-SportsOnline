<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'duelist'],
            ['name' => 'controller'],
            ['name' => 'initiator'],
            ['name' => 'sentinel'],
        ];

        foreach ($positions as $p) {
            Position::create($p);
        }
    }
}
