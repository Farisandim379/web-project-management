<?php
if (!function_exists('_e589c380c124ceb1933f84bc7471c10c')):
function _e589c380c124ceb1933f84bc7471c10c($__blaze, $__data = [], $__slots = [], $__bound = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::sanitized($__data, $__bound);
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP); unset($__data, $__bound);
ob_start();
?>


<?php
$__defaults = [
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/8d8560881b07bdb88df45df81da83d34.php'); ?>
<?php require_once $__blaze->compiledPath.'/8d8560881b07bdb88df45df81da83d34.php'; ?>
<?php $__attrs8d8560881b07bdb88df45df81da83d34 = ['kbd' => $kbd]; ?>
<?php $__blaze->pushData($__attrs8d8560881b07bdb88df45df81da83d34); ?>
<?php $slots8d8560881b07bdb88df45df81da83d34 = []; ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $slots8d8560881b07bdb88df45df81da83d34['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slots8d8560881b07bdb88df45df81da83d34); ?>
<?php _8d8560881b07bdb88df45df81da83d34($__blaze, $__attrs8d8560881b07bdb88df45df81da83d34, $slots8d8560881b07bdb88df45df81da83d34, ['kbd'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/8d8560881b07bdb88df45df81da83d34.php'); ?>
<?php require_once $__blaze->compiledPath.'/8d8560881b07bdb88df45df81da83d34.php'; ?>
<?php $__attrs8d8560881b07bdb88df45df81da83d34 = ['kbd' => $kbd]; ?>
<?php $__blaze->pushData($__attrs8d8560881b07bdb88df45df81da83d34); ?>
<?php $slots8d8560881b07bdb88df45df81da83d34 = []; ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $slots8d8560881b07bdb88df45df81da83d34['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slots8d8560881b07bdb88df45df81da83d34); ?>
<?php _8d8560881b07bdb88df45df81da83d34($__blaze, $__attrs8d8560881b07bdb88df45df81da83d34, $slots8d8560881b07bdb88df45df81da83d34, ['kbd'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>