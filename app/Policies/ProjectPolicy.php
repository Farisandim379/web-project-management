<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool { return true; }

    public function view(User $user, Project $project): bool {
        if ($user->role === 'admin') return true;

        // Member bisa melihat jika dia pembuat project ATAU dia punya task di project tersebut
        return $user->id === $project->user_id || $project->tasks()->where('assignee_id', $user->id)->exists();
    }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Project $project): bool { return $user->role === 'admin'; }
    public function delete(User $user, Project $project): bool { return $user->role === 'admin'; }
}
