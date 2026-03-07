<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    use WithPagination;

    public $search = '';

    // Properti untuk Form
    public $isModalOpen = false;
    public $projectId, $title, $description;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Membuka form untuk Create
    public function create()
    {
        $this->reset(['projectId', 'title', 'description']);
        $this->isModalOpen = true;
    }

    // Membuka form untuk Edit
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        // Pastikan hanya pemilik yang bisa edit
        Gate::authorize('update', $project);

        $this->projectId = $project->id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->isModalOpen = true;
    }

    // Menyimpan data (Create / Update)
    public function save()
    {
        // Validasi input
        $this->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
        ]);

        if ($this->projectId) {
            // Logika Update
            $project = Project::findOrFail($this->projectId);
            Gate::authorize('update', $project);
            $project->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Project berhasil diperbarui!');
        } else {
            // Logika Create
            Gate::authorize('create', Project::class);
            Project::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Project baru berhasil ditambahkan!');
        }

        $this->isModalOpen = false;
        $this->reset(['projectId', 'title', 'description']);
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('delete', $project);
        $project->delete();
        session()->flash('success', 'Project berhasil dihapus!');
    }

   public function with(): array
    {
        $user = Auth::user();
        $query = Project::query()->withCount('tasks')->latest();

        if ($user->role !== 'admin') {
            // Filter project milik member ATAU yang ada tugas untuknya
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
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Projects</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Kelola semua project dan pantau perkembangannya.</p>
        </div>

        @can('create', App\Models\Project::class)
        <div>
            <button wire:click="create" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 transition-all">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Create Project
            </button>
        </div>
        @endcan
    </div>

    <div class="flex items-center justify-between">
        <div class="relative w-full max-w-md">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau deskripsi project..." class="block w-full rounded-xl border-0 py-2.5 pl-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 dark:bg-zinc-900 dark:text-white dark:ring-zinc-700 dark:focus:ring-white transition-all">
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white">Nama Project</th>
                        @if(auth()->user()->role === 'admin')
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Owner</th>
                        @endif
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Tasks</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/20 transition-colors">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3">
                                <div class="font-medium text-zinc-900 dark:text-white">{{ $project->title }}</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400 truncate max-w-xs">{{ $project->description }}</div>
                            </td>
                            @if(auth()->user()->role === 'admin')
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $project->user->name }}
                                </td>
                            @endif
                            <td class="whitespace-nowrap px-3 py-4">
                                <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10 dark:bg-zinc-800 dark:text-zinc-400 dark:ring-zinc-700/50">
                                    {{ $project->tasks_count }} tasks
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <a wire:navigate href="{{ route('projects.show', $project->id) }}" class="text-zinc-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Detail</a>

                                    @can('update', $project)
                                        <button wire:click="edit({{ $project->id }})" class="text-zinc-500 hover:text-amber-600 dark:hover:text-amber-400 transition-colors">Edit</button>
                                        <button wire:click="deleteProject({{ $project->id }})" wire:confirm="Yakin ingin menghapus project ini beserta seluruh task di dalamnya?" class="text-zinc-500 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                            Delete
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                Tidak ada project yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-900 dark:border dark:border-zinc-800">
                        <form wire:submit="save">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 dark:bg-zinc-900">
                                <h3 class="text-lg font-semibold leading-6 text-zinc-900 dark:text-white" id="modal-title">
                                    {{ $projectId ? 'Edit Project' : 'Create New Project' }}
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="title" class="block text-sm font-medium leading-6 text-zinc-900 dark:text-zinc-300">Project Title</label>
                                        <input type="text" wire:model="title" id="title" class="block w-full rounded-xl border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700 dark:focus:ring-white">
                                        @error('title') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="description" class="block text-sm font-medium leading-6 text-zinc-900 dark:text-zinc-300">Description (Optional)</label>
                                        <textarea wire:model="description" id="description" rows="3" class="block w-full rounded-xl border-0 py-2 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-900 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700 dark:focus:ring-white"></textarea>
                                        @error('description') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
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
