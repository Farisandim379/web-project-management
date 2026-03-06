<?php

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function with(): array
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $projects = Project::withCount('tasks')->latest()->take(5)->get();
            $taskStats = Task::selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')->toArray();
        } else {
            $projects = Project::where('user_id', $user->id)
                ->withCount('tasks')
                ->latest()
                ->take(5)
                ->get();

            $taskStats = Task::where('assignee_id', $user->id)
                ->orWhereHas('project', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')->toArray();
        }

        return [
            'projects' => $projects,
            'todoCount' => $taskStats['todo'] ?? 0,
            'inProgressCount' => $taskStats['in_progress'] ?? 0,
            'doneCount' => $taskStats['done'] ?? 0,
        ];
    }
}; ?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Overview</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">To Do</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $todoCount }}</p>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">In Progress</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $inProgressCount }}</p>
                </div>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">Done</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $doneCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-5 dark:border-zinc-800">
            <h3 class="text-base font-semibold tracking-tight text-zinc-900 dark:text-white">Recent Projects</h3>
            <a href="#" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-colors">View all</a>
        </div>
        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @forelse ($projects as $project)
                <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-medium text-zinc-900 dark:text-white">{{ $project->title }}</span>
                        <span class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1 max-w-lg">{{ $project->description }}</span>
                    </div>
                    <div class="ml-4 shrink-0">
                        <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10 dark:bg-zinc-800 dark:text-zinc-400 dark:ring-zinc-700/50">
                            {{ $project->tasks_count }} tasks
                        </span>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada project yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
