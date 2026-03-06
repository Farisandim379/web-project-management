<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@javas.com',
            'password' => bcrypt('password'), // Password untuk login: password
            'role' => 'admin',
        ]);

        // 2. Buat Akun Member 1
        $member1 = User::factory()->create([
            'name' => 'Member Satu',
            'email' => 'member1@javas.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);

        // 3. Buat Akun Member 2
        $member2 = User::factory()->create([
            'name' => 'Member Dua',
            'email' => 'member2@javas.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);

        // 4. Generate 3 Project untuk Member 1, masing-masing punya 5 Task
        Project::factory(3)->create(['user_id' => $member1->id])->each(function ($project) use ($member1) {
            Task::factory(5)->create([
                'project_id' => $project->id,
                'assignee_id' => $member1->id,
            ]);
        });

        // 5. Generate 2 Project untuk Member 2, masing-masing punya 3 Task
        Project::factory(2)->create(['user_id' => $member2->id])->each(function ($project) use ($member2) {
            Task::factory(3)->create([
                'project_id' => $project->id,
                'assignee_id' => $member2->id,
            ]);
        });
    }
}
