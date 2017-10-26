<?php class PageHeader {
  static $defaultProps = array(
    'title' => '',
    'subtitle' => '',
    'image' => '',
    'imageUrl' => ''
  );

  public static function render(array $args) {
    $props = array_merge(self::$defaultProps, $args);
    ob_start(); ?>
      <div class="PageHeader section thick relative dark">
        <?php $img = $props['image']; ?>
        <?php $imgUrl = $img ? $img['sizes']['1800w'] : $props['imageUrl']; ?>
        <div class="background-image" style="background-image: url(<?= $imgUrl; ?>);"></div>
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
