<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    use WithPagination;

    // Properti Search
    public string $search = '';

    // Properti Form Modal Project
    public bool $isModalOpen = false;
    public ?int $projectId = null;
    public string $title = '';
    public string $description = '';

    // =========================================================
    // ACTIONS: MANAJEMEN PROJECT (CREATE, UPDATE, ARCHIVE)
    // =========================================================

    public function createProject(): void
    {
        $this->reset(['projectId', 'title', 'description']);
        $this->isModalOpen = true;
    }

    public function saveProject(): void
    {
        // Validasi: Judul wajib diisi
        $this->validate([
            'title'       => 'required|min:3|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            if ($this->projectId) {
                // Proses Update
                $project = Project::findOrFail($this->projectId);
                Gate::authorize('update', $project);

                $project->update([
                    'title'       => $this->title,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'Project berhasil diperbarui!');
            } else {
                // Proses Create (Hanya Admin berdasarkan ProjectPolicy)
                Gate::authorize('create', Project::class);

                Auth::user()->projects()->create([
                    'title'       => $this->title,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'Project baru berhasil ditambahkan!');
            }

            $this->isModalOpen = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan sistem saat menyimpan project.');
        }
    }

    public function archiveProject($id): void
    {
        $project = Project::findOrFail($id);
        Gate::authorize('update', $project);

        $project->update(['is_archived' => true]);
        session()->flash('success', 'Project berhasil diarsipkan!');
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
    }

    // =========================================================
    // LIFECYCLE & DATA FETCHING
    // =========================================================

    public function with(): array
    {
        $user = Auth::user();

        $query = Project::where('is_archived', false)
            ->withCount('tasks')
            ->latest();

        if ($user->role !== 'admin') {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('tasks', function ($t) use ($user) {
                      $t->where('assignee_id', $user->id);
                  });
            });
        } else {
            $query->with('user');
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return [
            'projects' => $query->paginate(10),
        ];
    }
}; ?>

<div class="space-y-6 relative">

    @if (session()->has('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-900/20">
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('success') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-900/20">
            <p class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">Projects</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Kelola semua project aktif dan pantau perkembangannya.</p>
        </div>

        @if(auth()->user()->role === 'admin')
            <button wire:click="createProject" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 transition-all shrink-0">
                + Add Project
            </button>
        @endif
    </div>

    <div class="relative max-w-md">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
        </div>
        <input type="text" wire:model.live.debounce.300ms="search" class="block w-full rounded-xl border-0 py-2.5 pl-10 pr-3 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 dark:bg-zinc-900 dark:text-white dark:ring-zinc-700 dark:focus:ring-white transition-all" placeholder="Cari nama atau deskripsi project...">
    </div>

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

        <div class="hidden sm:grid grid-cols-12 items-center gap-4 border-b border-zinc-200 bg-zinc-50 px-6 py-3 text-sm font-semibold text-zinc-900 dark:border-zinc-800 dark:bg-zinc-800/50 dark:text-white">
            <div class="col-span-8">Nama Project</div>
            <div class="col-span-2 text-center">Tasks</div>
            <div class="col-span-2 text-right">Aksi</div>
        </div>

        <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
            @forelse ($projects as $project)
                <div class="grid grid-cols-1 sm:grid-cols-12 items-center gap-4 px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">

                    <div class="col-span-1 sm:col-span-8 flex flex-col gap-1">
                        <a wire:navigate href="{{ route('projects.show', $project->id) }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                            {{ $project->title }}
                        </a>
                        <span class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1">{{ $project->description }}</span>
                    </div>

                    <div class="col-span-1 sm:col-span-2 flex justify-start sm:justify-center">
                        <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10 dark:bg-zinc-800 dark:text-zinc-400 dark:ring-zinc-700/50">
                            {{ $project->tasks_count }} tasks
                        </span>
                    </div>

                    <div class="col-span-1 sm:col-span-2 flex items-center justify-start sm:justify-end gap-3 mt-2 sm:mt-0">
                        @can('update', $project)
                            <button wire:click="archiveProject({{ $project->id }})" wire:confirm="Yakin ingin mengarsipkan project ini?" class="text-sm font-medium text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400 transition-colors">
                                Archive
                            </button>
                        @endcan

                        <a wire:navigate href="{{ route('projects.show', $project->id) }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">Tidak ada project</h3>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Belum ada project aktif atau yang sesuai dengan pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        @if ($projects->hasPages())
            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

    @if($isModalOpen)
        <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md dark:bg-zinc-900 dark:border dark:border-zinc-800">

                        <form wire:submit="saveProject">
                            <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <h3 class="text-lg font-semibold leading-6 text-zinc-900 dark:text-white" id="modal-title">
                                    {{ $projectId ? 'Edit Project' : 'Add New Project' }}
                                </h3>

                                @if ($errors->any())
                                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-900/20">
                                        <div class="flex items-start gap-3">
                                            <svg class="h-5 w-5 text-red-600 dark:text-red-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                            <div>
                                                <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Gagal menyimpan project</h4>
                                                <p class="mt-1 text-xs text-red-700 dark:text-red-400">Mohon periksa kembali kolom yang bertanda bintang merah (*).</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Project Title <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model="title" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm" placeholder="Masukkan nama project...">
                                        @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Description</label>
                                        <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm" placeholder="Tuliskan tujuan atau deskripsi singkat..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-zinc-800/50">
                                <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 sm:ml-3 sm:w-auto dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100">Save Project</button>
                                <button type="button" wire:click="closeModal" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-medium text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700 dark:hover:bg-zinc-700">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
