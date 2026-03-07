<?php

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    // -------------------------------------------------------------
    // CONSTANTS
    // -------------------------------------------------------------
    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

    // -------------------------------------------------------------
    // GROUP PROPERTIES (State Management & Form)
    // -------------------------------------------------------------
    public bool $isTaskModalOpen = false;

    // Form Data
    public ?int $project_id = null;
    public string $title = '';
    public ?string $description = null;
    public string $status = self::STATUS_TODO;
    public ?int $assignee_id = null;
    public ?string $deadline = null;

    // -------------------------------------------------------------
    // ACTIONS / METHODS
    // -------------------------------------------------------------
    public function createTask(): void
    {
        $this->reset(['project_id', 'title', 'description', 'assignee_id', 'deadline']);
        $this->status = self::STATUS_TODO;
        $this->isTaskModalOpen = true;
    }

    public function saveTask(): void
    {
        $this->validate([
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:' . self::STATUS_TODO . ',' . self::STATUS_IN_PROGRESS . ',' . self::STATUS_DONE,
            'assignee_id' => 'nullable|exists:users,id',
            'deadline'    => 'nullable|date',
        ]);

        $project = Project::findOrFail($this->project_id);
        Gate::authorize('update', $project);

        $project->tasks()->create([
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
            'assignee_id' => $this->assignee_id,
            'deadline'    => $this->deadline,
        ]);

        session()->flash('success', 'Task baru berhasil ditambahkan dari Dashboard!');
        $this->isTaskModalOpen = false;
    }

    public function closeTaskModal(): void
    {
        $this->isTaskModalOpen = false;
    }

    // -------------------------------------------------------------
    // LOGIC (Data Fetching Helpers)
    // -------------------------------------------------------------
    private function fetchAdminData(): array
    {
        $taskStats = Task::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')->toArray();

        return [
            'projectCount'    => Project::count(),
            'projects'        => Project::withCount('tasks')->latest()->take(5)->get(),
            'todoCount'       => $taskStats[self::STATUS_TODO] ?? 0,
            'inProgressCount' => $taskStats[self::STATUS_IN_PROGRESS] ?? 0,
            'doneCount'       => $taskStats[self::STATUS_DONE] ?? 0,
            'memberCount'     => User::where('role', 'member')->count(),
            'allProjects'     => Project::orderBy('title')->get(),
            'members'         => User::where('role', 'member')->get(),
        ];
    }

    private function fetchMemberData(User $user): array
    {
        $baseProjectQuery = Project::where('user_id', $user->id)
            ->orWhereHas('tasks', function ($q) use ($user) {
                $q->where('assignee_id', $user->id);
            });

        $taskStats = Task::where('assignee_id', $user->id)
            ->orWhereHas('project', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')->toArray();

        return [
            'projectCount'    => (clone $baseProjectQuery)->count(),
            'projects'        => $baseProjectQuery->withCount('tasks')->latest()->take(5)->get(),
            'todoCount'       => $taskStats[self::STATUS_TODO] ?? 0,
            'inProgressCount' => $taskStats[self::STATUS_IN_PROGRESS] ?? 0,
            'doneCount'       => $taskStats[self::STATUS_DONE] ?? 0,
            'memberCount'     => 0,
            'allProjects'     => collect(),
            'members'         => collect(),
        ];
    }

    // Main Lifecycle Hook
    public function with(): array
    {
        $user = Auth::user();
        return $user->role === 'admin'
            ? $this->fetchAdminData()
            : $this->fetchMemberData($user);
    }
}; ?>

<div class="space-y-6 relative">

    <!-- Success Notification -->
    @if (session()->has('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-900/20">
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Overview</h2>

        @if(auth()->user()->role === 'admin')
            <button wire:click="createTask" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 transition-all">
                + Quick Add Task
            </button>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 {{ auth()->user()->role === 'admin' ? 'lg:grid-cols-5' : 'lg:grid-cols-4' }} gap-4 md:gap-6">

        <!-- Projects Stats Card -->
        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-orange-600 dark:text-orange-400">Projects</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $projectCount }}</p>
                </div>
            </div>
        </div>

        <!-- To Do Stats Card -->
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

        <!-- In Progress Stats Card -->
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

        <!-- Done Stats Card -->
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

        <!-- Members Stats Card (Admin Only) -->
        @if(auth()->user()->role === 'admin')
        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-purple-600 dark:text-purple-400">Total Members</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">{{ $memberCount }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Recent Projects List -->
    <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-5 dark:border-zinc-800">
            <h3 class="text-base font-semibold tracking-tight text-zinc-900 dark:text-white">Recent Projects</h3>
            <a wire:navigate href="{{ route('projects.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-colors">View all</a>
        </div>
        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @forelse ($projects as $project)
                <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex flex-col gap-1">
                        <a wire:navigate href="{{ route('projects.show', $project->id) }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                            {{ $project->title }}
                        </a>
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

    <!-- Quick Add Task Modal -->
    @if($isTaskModalOpen)
        <x-quick-task-modal :projects="$allProjects" :members="$members" />
    @endif

</div>
