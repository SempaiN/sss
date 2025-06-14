<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskFactory extends Factory
{
    use HasFactory;
    protected $model = \App\Models\Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'completed' => $this->faker->boolean(30),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
