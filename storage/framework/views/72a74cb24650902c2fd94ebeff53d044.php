<?php # [BlazeFolded]:{flux::separator}:{Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/separator.blade.php}:{1772508755} ?>
<?php
if (!function_exists('_72a74cb24650902c2fd94ebeff53d044')):
function _72a74cb24650902c2fd94ebeff53d044($__blaze, $__data = [], $__slots = [], $__bound = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::sanitized($__data, $__bound);
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP); unset($__data, $__bound);
ob_start();
?>


<div class="-mx-[.3125rem] my-[.3125rem] h-px" <?php echo e($attributes); ?> data-flux-menu-separator>
    <div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full dark:bg-zinc-600!" data-flux-separator></div>

</div>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/separator.blade.php ENDPATH**/ ?>