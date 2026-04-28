<?php
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
?>

<div class="space-y-6">
    <!-- Notifikasi Sukses -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-900/20">
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Archived Projects</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Project yang sudah selesai atau ditutup. Anda bisa mengembalikannya kapan saja.</p>
        </div>
    </div>

    <!-- Daftar Project Terarsip -->
    <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $archivedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400 line-through"><?php echo e($project->title); ?></span>
                        <span class="text-xs text-zinc-400 dark:text-zinc-500 line-clamp-1"><?php echo e($project->description); ?></span>
                    </div>
                    <div class="flex items-center gap-4 shrink-0">
                        <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                            <?php echo e($project->tasks_count); ?> tasks
                        </span>

                        <button wire:click="restoreProject(<?php echo e($project->id); ?>)" wire:confirm="Kembalikan project ini ke daftar aktif?" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 dark:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            Restore
                        </button>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada project yang diarsipkan.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($archivedProjects->hasPages()): ?>
            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                <?php echo e($archivedProjects->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div><?php /**PATH Z:\project\project-javas\javas-coding-challenge\storage\framework/views/livewire/views/639aa862.blade.php ENDPATH**/ ?>