<?php # [BlazeFolded]:{flux::sidebar.collapse}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/collapse.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::sidebar.header}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/header.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::sidebar.nav}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/nav.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::spacer}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/spacer.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::sidebar}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/index.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::sidebar.toggle}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/toggle.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::spacer}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/spacer.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::heading}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/heading.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::text}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/text.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.radio.group}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/radio/group.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.separator}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/separator.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/item.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.radio.group}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/radio/group.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.separator}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/separator.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/item.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::menu}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/index.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/dropdown.blade.php}:{1772508755} ?>
<?php # [BlazeFolded]:{flux::header}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/header.blade.php}:{1772508755} ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
    <head>
        <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <?php $__blaze->pushData(['sticky' => '1', 'collapsible' => 'mobile', 'class' => 'border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900']); $__env->pushConsumableComponentData(['sticky' => '1', 'collapsible' => 'mobile', 'class' => 'border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900']); ?><ui-sidebar-toggle class="z-20 fixed inset-0 bg-black/10 hidden data-flux-sidebar-on-mobile:not-data-flux-sidebar-collapsed-mobile:block" data-flux-sidebar-backdrop></ui-sidebar-toggle>

<ui-sidebar
    class="[grid-area:sidebar] z-1 flex flex-col gap-4 [:where(&amp;)]:w-64 p-4 data-flux-sidebar-collapsed-desktop:w-14 data-flux-sidebar-collapsed-desktop:px-2 data-flux-sidebar-collapsed-desktop:cursor-e-resize rtl:data-flux-sidebar-collapsed-desktop:cursor-w-resize max-lg:data-flux-sidebar-cloak:hidden data-flux-sidebar-on-mobile:data-flux-sidebar-collapsed-mobile:-translate-x-full data-flux-sidebar-on-mobile:data-flux-sidebar-collapsed-mobile:rtl:translate-x-full z-20! data-flux-sidebar-on-mobile:start-0! data-flux-sidebar-on-mobile:fixed! data-flux-sidebar-on-mobile:top-0! data-flux-sidebar-on-mobile:min-h-dvh! data-flux-sidebar-on-mobile:max-h-dvh! max-h-dvh overflow-y-auto overscroll-contain border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900" x-init="$el.classList.add(&#039;transition-transform&#039;)"
     collapsible="mobile"          sticky     x-data
    data-flux-sidebar-cloak
    data-flux-sidebar
>
    <div class="flex items-center justify-between gap-2 min-h-10" data-flux-sidebar-header>
    <?php if (isset($component)) { $__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo','data' => ['sidebar' => true,'href' => ''.e(route('dashboard')).'','wire:navigate' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sidebar' => true,'href' => ''.e(route('dashboard')).'','wire:navigate' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3)): ?>
<?php $attributes = $__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3; ?>
<?php unset($__attributesOriginal7b17d80ff7900603fe9e5f0b453cc7c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3)): ?>
<?php $component = $__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3; ?>
<?php unset($__componentOriginal7b17d80ff7900603fe9e5f0b453cc7c3); ?>
<?php endif; ?>
                <ui-sidebar-toggle class="w-10 h-8 flex items-center justify-center in-data-flux-sidebar-collapsed-desktop:opacity-0 in-data-flux-sidebar-collapsed-desktop:absolute in-data-flux-sidebar-collapsed-desktop:in-data-flux-sidebar-active:opacity-100  lg:hidden" data-flux-sidebar-collapse>
    <ui-tooltip position="right center"  data-flux-tooltip >
        <button type="button" class="size-10 relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none text-sm rounded-lg inline-flex  bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white in-data-flux-sidebar-collapsed-desktop:cursor-e-resize rtl:in-data-flux-sidebar-collapsed-desktop:cursor-w-resize [&amp;[collapsible=&quot;mobile&quot;]]:in-data-flux-sidebar-on-desktop:hidden rtl:rotate-180">
            <svg class="text-zinc-500 dark:text-zinc-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.5 3.75V16.25M3.4375 16.25H16.5625C17.08 16.25 17.5 15.83 17.5 15.3125V4.6875C17.5 4.17 17.08 3.75 16.5625 3.75H3.4375C2.92 3.75 2.5 4.17 2.5 4.6875V15.3125C2.5 15.83 2.92 16.25 3.4375 16.25Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

                    <div popover="manual" class="relative py-2 px-2.5 rounded-md text-xs text-white font-medium bg-zinc-800 dark:bg-zinc-700 dark:border dark:border-white/10 p-0 overflow-visible" data-flux-tooltip-content>
    Toggle sidebar

    </div>
            </ui-tooltip>
</ui-sidebar-toggle>
</div>

            <nav class="flex flex-col overflow-visible min-h-auto" data-flux-sidebar-nav>
    <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/group.blade.php', $__blaze->compiledPath.'/c790dacd952ba228aa15895bdac759be.php'); ?>
<?php require_once $__blaze->compiledPath.'/c790dacd952ba228aa15895bdac759be.php'; ?>
<?php $__attrsc790dacd952ba228aa15895bdac759be = ['heading' => __('Platform'),'class' => 'grid']; ?>
<?php $__blaze->pushData($__attrsc790dacd952ba228aa15895bdac759be); ?>
<?php $slotsc790dacd952ba228aa15895bdac759be = []; ?>
<?php ob_start(); ?>
                    <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/item.blade.php', $__blaze->compiledPath.'/dc4d671f0674b89c6b6303f175940a9b.php'); ?>
<?php require_once $__blaze->compiledPath.'/dc4d671f0674b89c6b6303f175940a9b.php'; ?>
<?php $__attrsdc4d671f0674b89c6b6303f175940a9b = ['icon' => 'home','href' => route('dashboard'),'current' => request()->routeIs('dashboard'),'wire:navigate' => true]; ?>
<?php $__blaze->pushData($__attrsdc4d671f0674b89c6b6303f175940a9b); ?>
<?php $slotsdc4d671f0674b89c6b6303f175940a9b = []; ?>
<?php ob_start(); ?>
                        <?php echo e(__('Dashboard')); ?>

                    <?php $slotsdc4d671f0674b89c6b6303f175940a9b['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slotsdc4d671f0674b89c6b6303f175940a9b); ?>
<?php _dc4d671f0674b89c6b6303f175940a9b($__blaze, $__attrsdc4d671f0674b89c6b6303f175940a9b, $slotsdc4d671f0674b89c6b6303f175940a9b, ['href', 'current', 'wire:navigate'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
                    <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/item.blade.php', $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'); ?>
<?php require_once $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'; ?>
<?php $__attrs0bfcca569c37e83b847947b33e4c729e = ['icon' => 'folder','href' => route('projects.index'),'current' => request()->routeIs('projects.*')]; ?>
<?php $__blaze->pushData($__attrs0bfcca569c37e83b847947b33e4c729e); ?>
<?php $slots0bfcca569c37e83b847947b33e4c729e = []; ?>
<?php ob_start(); ?>
                        Projects
                    <?php $slots0bfcca569c37e83b847947b33e4c729e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slots0bfcca569c37e83b847947b33e4c729e); ?>
<?php _0bfcca569c37e83b847947b33e4c729e($__blaze, $__attrs0bfcca569c37e83b847947b33e4c729e, $slots0bfcca569c37e83b847947b33e4c729e, ['href', 'current'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'admin'): ?>
                        <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/item.blade.php', $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'); ?>
<?php require_once $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'; ?>
<?php $__attrs0bfcca569c37e83b847947b33e4c729e = ['icon' => 'archive-box','href' => route('projects.archive'),'current' => request()->routeIs('projects.archive')]; ?>
<?php $__blaze->pushData($__attrs0bfcca569c37e83b847947b33e4c729e); ?>
<?php $slots0bfcca569c37e83b847947b33e4c729e = []; ?>
<?php ob_start(); ?>
                            Archive
                        <?php $slots0bfcca569c37e83b847947b33e4c729e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slots0bfcca569c37e83b847947b33e4c729e); ?>
<?php _0bfcca569c37e83b847947b33e4c729e($__blaze, $__attrs0bfcca569c37e83b847947b33e4c729e, $slots0bfcca569c37e83b847947b33e4c729e, ['href', 'current'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>

                        <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/item.blade.php', $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'); ?>
<?php require_once $__blaze->compiledPath.'/0bfcca569c37e83b847947b33e4c729e.php'; ?>
<?php $__attrs0bfcca569c37e83b847947b33e4c729e = ['icon' => 'users','href' => route('members.index'),'current' => request()->routeIs('members.*')]; ?>
<?php $__blaze->pushData($__attrs0bfcca569c37e83b847947b33e4c729e); ?>
<?php $slots0bfcca569c37e83b847947b33e4c729e = []; ?>
<?php ob_start(); ?>
                            Members
                        <?php $slots0bfcca569c37e83b847947b33e4c729e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slots0bfcca569c37e83b847947b33e4c729e); ?>
<?php _0bfcca569c37e83b847947b33e4c729e($__blaze, $__attrs0bfcca569c37e83b847947b33e4c729e, $slots0bfcca569c37e83b847947b33e4c729e, ['href', 'current'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php $slotsc790dacd952ba228aa15895bdac759be['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slotsc790dacd952ba228aa15895bdac759be); ?>
<?php _c790dacd952ba228aa15895bdac759be($__blaze, $__attrsc790dacd952ba228aa15895bdac759be, $slotsc790dacd952ba228aa15895bdac759be, ['heading'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
</nav>


            <div class="flex-1" data-flux-spacer></div>


            <?php if (isset($component)) { $__componentOriginalca54afb14f8d43d7f1acc5dbe6164a0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca54afb14f8d43d7f1acc5dbe6164a0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.desktop-user-menu','data' => ['class' => 'hidden lg:block','name' => auth()->user()->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('desktop-user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden lg:block','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(auth()->user()->name)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca54afb14f8d43d7f1acc5dbe6164a0a)): ?>
<?php $attributes = $__attributesOriginalca54afb14f8d43d7f1acc5dbe6164a0a; ?>
<?php unset($__attributesOriginalca54afb14f8d43d7f1acc5dbe6164a0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca54afb14f8d43d7f1acc5dbe6164a0a)): ?>
<?php $component = $__componentOriginalca54afb14f8d43d7f1acc5dbe6164a0a; ?>
<?php unset($__componentOriginalca54afb14f8d43d7f1acc5dbe6164a0a); ?>
<?php endif; ?>
</ui-sidebar>
<?php $__blaze->popData(); $__env->popConsumableComponentData(); ?>

        <!-- Mobile User Menu -->
        <header class="[grid-area:header] z-10 min-h-14 flex items-center px-6 lg:px-8 lg:hidden" data-flux-header>
            <button type="button" class="relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none justify-center h-10 text-sm rounded-lg w-10 inline-flex -ms-2.5 bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white      shrink-0 lg:hidden" data-flux-button="data-flux-button" x-data="" x-on:click="$dispatch('flux-sidebar-toggle')" aria-label="Toggle sidebar" data-flux-sidebar-toggle="data-flux-sidebar-toggle">
        <svg class="shrink-0 [:where(&amp;)]:size-5" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M2 6.75A.75.75 0 0 1 2.75 6h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 6.75Zm0 6.5a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"/>
</svg>
    </button>


            <div class="flex-1" data-flux-spacer></div>


            <ui-dropdown position="top end"  data-flux-dropdown>
    <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/profile.blade.php', $__blaze->compiledPath.'/f3a8e4bffbfee679dd6ae3a127182cb0.php'); ?>
<?php require_once $__blaze->compiledPath.'/f3a8e4bffbfee679dd6ae3a127182cb0.php'; ?>
<?php $__blaze->pushData(['initials' => auth()->user()->initials(),'icon-trailing' => 'chevron-down']); ?>
<?php _f3a8e4bffbfee679dd6ae3a127182cb0($__blaze, ['initials' => auth()->user()->initials(),'icon-trailing' => 'chevron-down'], [], ['initials'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>

                <ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden"
    popover="manual"
    data-flux-menu
>
    <ui-menu-radio-group  data-flux-menu-radio-group>
    <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::avatar", ['name' => auth()->user()->name, 'initials' => auth()->user()->initials()]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/avatar/index.blade.php', $__blaze->compiledPath.'/d030992609b91b909a2c4be44b1ce839.php'); ?>
<?php require_once $__blaze->compiledPath.'/d030992609b91b909a2c4be44b1ce839.php'; ?>
<?php $__blaze->pushData(['name' => auth()->user()->name,'initials' => auth()->user()->initials()]); ?>
<?php _d030992609b91b909a2c4be44b1ce839($__blaze, ['name' => auth()->user()->name,'initials' => auth()->user()->initials()], [], ['name', 'initials'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <div class="font-medium [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white text-sm [&amp;:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&amp;]:mt-2 truncate" data-flux-heading><?php echo e(auth()->user()->name); ?></div>

                                    <p class="[:where(&amp;)]:font-normal [:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-500 [:where(&amp;)]:dark:text-white/70 truncate" data-flux-text ><?php echo e(auth()->user()->email); ?></p>
                                </div>
                            </div>
                        </div>
</ui-menu-radio-group>


                    <div class="-mx-[.3125rem] my-[.3125rem] h-px"  data-flux-menu-separator>
    <div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full dark:bg-zinc-600!" data-flux-separator></div>
</div>


                    <ui-menu-radio-group  data-flux-menu-radio-group>
    <a href="<?php echo e(route('profile.edit')); ?>" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current" wire:navigate="">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="M13.024 9.25c.47 0 .827-.433.637-.863a4 4 0 0 0-4.094-2.364c-.468.05-.665.576-.43.984l1.08 1.868a.75.75 0 0 0 .649.375h2.158ZM7.84 7.758c-.236-.408-.79-.5-1.068-.12A3.982 3.982 0 0 0 6 10c0 .884.287 1.7.772 2.363.278.38.832.287 1.068-.12l1.078-1.868a.75.75 0 0 0 0-.75L7.839 7.758ZM9.138 12.993c-.235.408-.039.934.43.984a4 4 0 0 0 4.094-2.364c.19-.43-.168-.863-.638-.863h-2.158a.75.75 0 0 0-.65.375l-1.078 1.868Z"/>
  <path fill-rule="evenodd" d="m14.13 4.347.644-1.117a.75.75 0 0 0-1.299-.75l-.644 1.116a6.954 6.954 0 0 0-2.081-.556V1.75a.75.75 0 0 0-1.5 0v1.29a6.954 6.954 0 0 0-2.081.556L6.525 2.48a.75.75 0 1 0-1.3.75l.645 1.117A7.04 7.04 0 0 0 4.347 5.87L3.23 5.225a.75.75 0 1 0-.75 1.3l1.116.644A6.954 6.954 0 0 0 3.04 9.25H1.75a.75.75 0 0 0 0 1.5h1.29c.078.733.27 1.433.556 2.081l-1.116.645a.75.75 0 1 0 .75 1.298l1.117-.644a7.04 7.04 0 0 0 1.523 1.523l-.645 1.117a.75.75 0 1 0 1.3.75l.644-1.116a6.954 6.954 0 0 0 2.081.556v1.29a.75.75 0 0 0 1.5 0v-1.29a6.954 6.954 0 0 0 2.081-.556l.645 1.116a.75.75 0 0 0 1.299-.75l-.645-1.117a7.042 7.042 0 0 0 1.523-1.523l1.117.644a.75.75 0 0 0 .75-1.298l-1.116-.645a6.954 6.954 0 0 0 .556-2.081h1.29a.75.75 0 0 0 0-1.5h-1.29a6.954 6.954 0 0 0-.556-2.081l1.116-.644a.75.75 0 0 0-.75-1.3l-1.117.645a7.04 7.04 0 0 0-1.524-1.523ZM10 4.5a5.475 5.475 0 0 0-2.781.754A5.527 5.527 0 0 0 5.22 7.277 5.475 5.475 0 0 0 4.5 10a5.475 5.475 0 0 0 .752 2.777 5.527 5.527 0 0 0 2.028 2.004c.802.458 1.73.719 2.72.719a5.474 5.474 0 0 0 2.78-.753 5.527 5.527 0 0 0 2.001-2.027c.458-.802.719-1.73.719-2.72a5.475 5.475 0 0 0-.753-2.78 5.528 5.528 0 0 0-2.028-2.002A5.475 5.475 0 0 0 10 4.5Z" clip-rule="evenodd"/>
</svg>

        
    
    <?php echo e(__('Settings')); ?>

    </a>
</ui-menu-radio-group>


                    <div class="-mx-[.3125rem] my-[.3125rem] h-px"  data-flux-menu-separator>
    <div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full dark:bg-zinc-600!" data-flux-separator></div>
</div>


                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current w-full cursor-pointer" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" data-test="logout-button">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
</svg>

        
    
    <?php echo e(__('Log out')); ?>

    </button>

                    </form>
</ui-menu>
</ui-dropdown>
    </header>


        <?php echo e($slot); ?>


        <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

    </body>
</html>
<?php /**PATH Z:\project\project-javas\javas-coding-challenge\resources\views/layouts/app/sidebar.blade.php ENDPATH**/ ?>