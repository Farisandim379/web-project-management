<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    // Member bisa melihat daftar task miliknya (filter spesifik nanti di query database)
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Bisa melihat detail task jika dia pembuat project-nya ATAU dia assignee-nya
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id || $user->id === $task->assignee_id;
    }

    // Izinkan membuat task (nanti di komponen Livewire kita pastikan dia hanya bisa bikin task di project miliknya)
    public function create(User $user): bool
    {
        return true;
    }

    // Bisa update (misal: ubah status jadi 'done') jika dia pembuat project ATAU assignee-nya
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id || $user->id === $task->assignee_id;
    }

    // Hanya pembuat project yang boleh menghapus task
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id;
    }
}
