<?php
use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
?>

<div class="space-y-6 relative">

    <!-- Success Notification -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-900/20">
            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-white">Overview</h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'admin'): ?>
            <button wire:click="createTask" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 transition-all">
                + Quick Add Task
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 <?php echo e(auth()->user()->role === 'admin' ? 'lg:grid-cols-5' : 'lg:grid-cols-4'); ?> gap-4 md:gap-6">

        <!-- Projects Stats Card -->
        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-orange-600 dark:text-orange-400">Projects</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"><?php echo e($projectCount); ?></p>
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
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"><?php echo e($todoCount); ?></p>
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
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"><?php echo e($inProgressCount); ?></p>
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
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"><?php echo e($doneCount); ?></p>
                </div>
            </div>
        </div>

        <!-- Members Stats Card (Admin Only) -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'admin'): ?>
        <div class="relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-purple-600 dark:text-purple-400">Total Members</p>
                    <p class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"><?php echo e($memberCount); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Recent Projects List -->
    <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
        <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-5 dark:border-zinc-800">
            <h3 class="text-base font-semibold tracking-tight text-zinc-900 dark:text-white">Recent Projects</h3>
            <a wire:navigate href="<?php echo e(route('projects.index')); ?>" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white transition-colors">View all</a>
        </div>
        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="flex items-center justify-between px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex flex-col gap-1">
                        <a wire:navigate href="<?php echo e(route('projects.show', $project->id)); ?>" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                            <?php echo e($project->title); ?>

                        </a>
                        <span class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1 max-w-lg"><?php echo e($project->description); ?></span>
                    </div>
                    <div class="ml-4 shrink-0">
                        <span class="inline-flex items-center rounded-md bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10 dark:bg-zinc-800 dark:text-zinc-400 dark:ring-zinc-700/50">
                            <?php echo e($project->tasks_count); ?> tasks
                        </span>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="px-6 py-8 text-center">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada project yang ditambahkan.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Quick Add Task Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isTaskModalOpen): ?>
        <?php if (isset($component)) { $__componentOriginala0d1ad7580bea9f6f8978e38d4a5ced1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0d1ad7580bea9f6f8978e38d4a5ced1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.quick-task-modal','data' => ['projects' => $allProjects,'members' => $members]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('quick-task-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['projects' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allProjects),'members' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($members)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0d1ad7580bea9f6f8978e38d4a5ced1)): ?>
<?php $attributes = $__attributesOriginala0d1ad7580bea9f6f8978e38d4a5ced1; ?>
<?php unset($__attributesOriginala0d1ad7580bea9f6f8978e38d4a5ced1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0d1ad7580bea9f6f8978e38d4a5ced1)): ?>
<?php $component = $__componentOriginala0d1ad7580bea9f6f8978e38d4a5ced1; ?>
<?php unset($__componentOriginala0d1ad7580bea9f6f8978e38d4a5ced1); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH Z:\project\project-javas\javas-coding-challenge\storage\framework/views/livewire/views/2cc2a0bf.blade.php ENDPATH**/ ?>