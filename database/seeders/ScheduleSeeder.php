<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'plane_name' => 'Boeing 737',
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'departure' => '2026-04-10 08:00:00',
                'price' => 500000,
                'stock' => 150
            ],
            [
                'plane_name' => 'Airbus A320',
                'origin' => 'Bandung',
                'destination' => 'Yogyakarta',
                'departure' => '2026-04-11 10:00:00',
                'price' => 400000,
                'stock' => 120
            ],
            [
                'plane_name' => 'Boeing 777',
                'origin' => 'Medan',
                'destination' => 'Denpasar',
                'departure' => '2026-04-12 12:00:00',
                'price' => 600000,
                'stock' => 200
            ]
        ];

        foreach ($schedules as $schedule) {
            \App\Models\Schedule::create($schedule);
        }
    }
}
