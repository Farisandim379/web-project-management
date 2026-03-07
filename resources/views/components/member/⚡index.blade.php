<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    use WithPagination;

    public function mount()
    {
        // Tolak akses jika bukan admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function with(): array
    {
        $members = User::where('role', 'member')
            ->withCount([
                'tasks as todo_count' => function ($q) { $q->where('status', 'todo'); },
                'tasks as doing_count' => function ($q) { $q->where('status', 'in_progress'); },
                'tasks as done_count' => function ($q) { $q->where('status', 'done'); }
            ])
            ->latest()
            ->paginate(10);

        return ['members' => $members];
    }
}; ?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Team Members</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Pantau produktivitas dan status tugas dari setiap anggota tim.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white">Nama Member</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">To Do</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">In Progress</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Done</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse ($members as $member)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/20 transition-colors">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-100 text-xs font-bold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                                        {{ $member->initials() }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-zinc-900 dark:text-white">{{ $member->name }}</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $member->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4">
                                <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                    {{ $member->todo_count }} tasks
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4">
                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ $member->doing_count }} tasks
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4">
                                <span class="inline-flex items-center rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    {{ $member->done_count }} tasks
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                Belum ada member yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($members->hasPages())
            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</div>
