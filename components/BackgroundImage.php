<?php
class BackgroundImage {
  static $defaultProps = array(
    'image' => '',
    'imageUrl' => 'https://source.unsplash.com/800x800',
    'imageBlurUrl' => ''
  );

  public static function render(array $args = []) {
    $props = array_merge(self::$defaultProps, $args);
    ob_start(); ?>
      <?php $img = $props['image']; ?>
      <?php $imgUrl = $img ? $img['sizes']['1800w'] : $props['imageUrl']; ?>
      <div class="BackgroundImage--parent lazy-parent">
        <div
          class="BackgroundImage lazy-child"
          style="background-image: url(<?= $props['imageBlurUrl']; ?>)"
          data-bg-src="<?= $imgUrl; ?>"
        ></div>
      </div>
    <?php echo ob_get_clean();
  }
}
