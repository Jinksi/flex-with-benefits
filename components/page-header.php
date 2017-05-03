<?php if(get_field('page_header_title')): ?>

  <div class="section thick page-header relative dark">
    <?php $img = get_field('page_header_image'); ?>
    <?php $img_url = $img ? $img['sizes']['1800w'] : 'https://source.unsplash.com/1200x600'; ?>
    <div class="background-image" style="background-image: url(<?= $img_url; ?>);"></div>
    <div class="container skinny">
      <h1 class="page-header__title"><?php the_field('page_header_title') ?></h1>
      <h4 class="page-header__subtitle"><?php the_field( 'page_header_subtitle' ); ?></h4>
    </div>
  </div>

<?php endif; ?>
