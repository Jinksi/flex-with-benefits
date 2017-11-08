<?php
import('/components/BackgroundImage.php');

class PageHeader {
  static $defaultProps = array(
    'title' => '',
    'subtitle' => '',
    'image' => '',
    'imageUrl' => 'https://source.unsplash.com/1280x720'
  );

  public static function render(array $args = []) {
    $props = array_merge(self::$defaultProps, $args);
    ob_start(); ?>
      <div class="PageHeader section thick relative dark">
        <?php $img = $props['image']; ?>
        <?php $imgUrl = $img ? $img['sizes']['1800w'] : $props['imageUrl']; ?>
        <?php BackgroundImage::render([
          'imageUrl' => $imgUrl
        ]); ?>
        <div class="container skinny">
          <h1 class="PageHeader--title"><?= $props['title']; ?></h1>
          <?php if ($props['subtitle']): ?>
            <h4 class="PageHeader--subtitle">
              <?= $props['subtitle']; ?>
            </h4>
          <?php endif; ?>
        </div>
      </div>
    <?php echo ob_get_clean();
  }
}
