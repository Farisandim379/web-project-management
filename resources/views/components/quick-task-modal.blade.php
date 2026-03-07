@props(['projects', 'members'])

<div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md dark:bg-zinc-900 dark:border dark:border-zinc-800">

                <form wire:submit="saveTask">
                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-semibold leading-6 text-zinc-900 dark:text-white" id="modal-title">Quick Add Task</h3>
                        <!-- alert error -->
                        @if ($errors->any())
                            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-900/50 dark:bg-red-900/20">
                                <div class="flex items-start gap-3">
                                    <svg class="h-5 w-5 text-red-600 dark:text-red-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Gagal menyimpan task</h4>
                                        <p class="mt-1 text-xs text-red-700 dark:text-red-400">Mohon periksa kembali kolom yang bertanda bintang merah (*).</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Select Project <span class="text-red-500">*</span></label>
                                <select wire:model="project_id" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm">
                                    <option value="">-- Choose a Project --</option>
                                    @foreach($projects as $proj)
                                        <option value="{{ $proj->id }}">{{ $proj->title }}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Task Title <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="title" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm">
                                @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Description</label>
                                <textarea wire:model="description" rows="2" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Status</label>
                                    <select wire:model="status" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm">
                                        <option value="todo">To Do</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Deadline</label>
                                    <input type="date" wire:model="deadline" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-900 dark:text-zinc-300">Assign To <span class="text-red-500">*</span></label>
                                <select wire:model="assignee_id" class="mt-1 block w-full rounded-xl border-zinc-300 shadow-sm focus:ring-zinc-900 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white sm:text-sm">
                                    <option value="">-- Unassigned --</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-zinc-800/50">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 sm:ml-3 sm:w-auto dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100">Save Task</button>
                        <button type="button" wire:click="closeTaskModal" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-medium text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700 dark:hover:bg-zinc-700">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
