<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Task::create([
                'user_id' => 1,
                'title' => Str::random(10),
                'description' => Str::random(30),
                'registration_date' => date('Y-m-d'),
                'expiration_date' => '2024-04-30',
            ]);
        }
    }
}
