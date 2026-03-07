<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    use WithPagination;

    public $search = '';

    public function mount()
    {
        // Fitur ini khusus untuk Admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya Administrator yang dapat mengakses arsip.');
        }
    }

    public function restoreProject($id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('update', $project);

        $project->update(['is_archived' => false]);
        session()->flash('success', 'Project berhasil dikembalikan dari arsip!');
    }

    public function with(): array
    {
        $query = Project::where('is_archived', true)->withCount('tasks')->latest();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        return [
            'archivedProjects' => $query->paginate(10),
        ];
    }
}; ?>

<div class="space-y-6">
    @if (session()->has('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-900/20">
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Archived Projects</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Project yang sudah selesai atau ditutup. Anda bisa mengembalikannya kapan saja.</p>
        </div>
    </div>

    <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            @forelse ($archivedProjects as $project)
                <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400 line-through">{{ $project->title }}</span>
                        <span class="text-xs text-zinc-400 dark:text-zinc-500 line-clamp-1">{{ $project->description }}</span>
                    </div>
                    <div class="flex items-center gap-4 shrink-0">
                        <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                            {{ $project->tasks_count }} tasks
                        </span>

                        <button wire:click="restoreProject({{ $project->id }})" wire:confirm="Kembalikan project ini ke daftar aktif?" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 dark:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            Restore
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada project yang diarsipkan.</p>
                </div>
            @endforelse
        </div>

        @if ($archivedProjects->hasPages())
            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                {{ $archivedProjects->links() }}
            </div>
        @endif
    </div>
</div>
