<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    // Member bisa melihat daftar project miliknya (filter ini nanti dilakukan di query database level)
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Hanya bisa melihat detail jika project tersebut miliknya
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    // Semua user yang login boleh membuat project
    public function create(User $user): bool
    {
        return true;
    }

    // Hanya bisa edit jika project tersebut miliknya
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    // Hanya bisa hapus jika project tersebut miliknya
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
