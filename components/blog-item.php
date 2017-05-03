<a href="<?php the_permalink(); ?>" class="blog-item">
  <div class="blog-item--image relative">
    <?php $featimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '800w' ); ?>
    <div class="background-image" style="background-image: url(<?= $featimg[0]; ?>);"></div>
  </div>
  <div class="blog-item--inner">
    <h4 class="blog-item--title"><?php the_title(); ?></h4>
    <h6 class="blog-item--subtitle"><?php echo join(', ', array_map(function($cat){ return $cat->name; }, get_the_category())); ?></h6>
    <div class="blog-item--excerpt">
      <?php the_excerpt(); ?>
    </div>
  </div>
</a>
