<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Models\SharedTask;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 usuarios con 3 tareas cada uno
        User::factory()->count(10)->create()->each(function ($user) {
            Task::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });

        // Compartir la primera tarea de cada usuario con otros 2 usuarios
        $users = User::all();

        foreach ($users as $user) {
            $firstTask = $user->tasks()->first();
            if (!$firstTask) continue;

            $otherUsers = $users->where('id', '!=', $user->id)->take(2);
            foreach ($otherUsers as $otherUser) {
                SharedTask::create([
                    'task_id' => $firstTask->id,
                    'user_id' => $otherUser->id,
                ]);
            }
        }
    }
}
