<?php
if (!function_exists('_04ef5cdd4dccc3dc5635fac579f0eb5d')):
function _04ef5cdd4dccc3dc5635fac579f0eb5d($__blaze, $__data = [], $__slots = [], $__bound = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::sanitized($__data, $__bound);
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP); unset($__data, $__bound);
ob_start();
?>


<?php
extract(Flux::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php $__blaze->ensureCompiled('Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/e589c380c124ceb1933f84bc7471c10c.php'); ?>
<?php require_once $__blaze->compiledPath.'/e589c380c124ceb1933f84bc7471c10c.php'; ?>
<?php $__attrse589c380c124ceb1933f84bc7471c10c = ['content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__blaze->pushData($__attrse589c380c124ceb1933f84bc7471c10c); ?>
<?php $slotse589c380c124ceb1933f84bc7471c10c = []; ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $slotse589c380c124ceb1933f84bc7471c10c['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($slotse589c380c124ceb1933f84bc7471c10c); ?>
<?php _e589c380c124ceb1933f84bc7471c10c($__blaze, $__attrse589c380c124ceb1933f84bc7471c10c, $slotse589c380c124ceb1933f84bc7471c10c, ['content', 'position', 'kbd'], isset($this) ? $this : null); ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH Z:\project\project-javas\javas-coding-challenge\vendor\livewire\flux\src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>