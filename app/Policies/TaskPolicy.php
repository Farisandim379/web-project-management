<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool { return true; }

    public function view(User $user, Task $task): bool {
        if ($user->role === 'admin') return true;
        return $user->id === $task->project->user_id || $user->id === $task->assignee_id;
    }

    public function create(User $user): bool { return $user->role === 'admin'; }

    // Admin diizinkan mengedit Task
    public function update(User $user, Task $task): bool { return $user->role === 'admin'; }
    public function delete(User $user, Task $task): bool { return $user->role === 'admin'; }

    public function changeStatus(User $user, Task $task): bool {
        if ($user->role === 'admin') return true;
        return $user->id === $task->project->user_id || $user->id === $task->assignee_id;
    }
}
