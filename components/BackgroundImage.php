<?php
class BackgroundImage {
  static $defaultProps = array(
    'image' => '',
    'imageUrl' => 'https://source.unsplash.com/800x800',
    'imageBlurUrl' => '',
    'lazy' => false
  );

  public static function render(array $args = []) {
    $props = array_merge(self::$defaultProps, $args);
    ob_start(); ?>
      <?php $img = $props['image']; ?>
      <?php $imgUrl = $img ? $img['sizes']['1800w'] : $props['imageUrl']; ?>
      <div class="BackgroundImage--parent <?= $props['lazy'] ? 'lazy-parent' : ''; ?>">
        <div
          class="BackgroundImage <?= $props['lazy'] ? 'lazy-child' : ''; ?>"
          <?php if ($props['lazy']): ?>
            data-bg-src="<?= $imgUrl; ?>"
            style="background-image: url(<?= $props['imageBlurUrl']; ?>)"
          <?php else: ?>
            style="background-image: url(<?= $props['imageUrl']; ?>)"
          <?php endif; ?>
        ></div>
      </div>
    <?php echo ob_get_clean();
  }
}
