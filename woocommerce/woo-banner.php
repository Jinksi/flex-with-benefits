<?php

$queried_cat = get_queried_object();
$image = get_field('banner', $queried_cat);
$color = get_field('background_color', $queried_cat);
if (is_shop() || is_page(48)) {
  $image = get_field('banner', 7);
  $color = get_field('background_color', 7);
}
?>
<?php if ($image): ?>
<section class="woo-banner section thick" style="background: <?php echo $color; ?> url(<?php echo $image['sizes']['1800w'] ?>) center no-repeat;">
  <div class="overlay"></div>
<?php elseif($color): ?>
<section class="woo-banner section thick" style="background: <?php echo $color; ?> url(<?php echo $image['sizes']['1800w'] ?>) center no-repeat;">
<?php else: ?>
<section class="woo-banner section thick" style="background: <?php echo $color; ?> url(<?php echo $image['sizes']['1800w'] ?>) center no-repeat;">
  <div class="overlay"></div>
<?php endif; ?>
  <div class="container skinny">
    <h1 class="page-title tacenter"><?php woocommerce_page_title(); ?></h1>
  </div>
</section>
