<?php get_header(); ?>
<?php get_template_part('inc-edit');?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php $featimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '1800w' ); ?>

  <section class="single-post--header-image relative black">
    <div class="background-image" style="background-image: url(<?= $featimg[0]; ?>);"></div>
  </section>

  <div class="single-post--back-btn container skinny">
    <a class="single-post--back-btn--btn" href="<?php echo get_post_type_archive_link('post'); ?>"><i class="fa fa-angle-left"></i> BACK</a>
  </div>

  <section class="single-post--container container skinny white">
    <div class="single-post--heading">
      <h1 class="single-post--title"><?php the_title(); ?></h1>
      <div class="single-post--meta">
        <div class="single-post--meta--category"><?php the_category( ', ' ); ?></div>
        <div class="single-post--meta--date"><?php the_date(); ?></div>
      </div>
    </div>

    <?php the_content();?>

    <div class="single-post--footer">
      <?php get_template_part( 'components/share' ); ?>
    </div>
  </section>

  <section class="section light relative">
    <div class="container skinny">
      <div class="pagination">
        <span class="pagination--button pagination--button--previous"><?php previous_post_link( '%link', '<i class="fa fa-2x fa-angle-left"></i> Prev Post'); ?></span>
        <span class="pagination--button pagination--button--next"><?php next_post_link( '%link', 'Next Post <i class="fa fa-2x fa-angle-right"></i>'); ?></span>
      </div>
    </div>
  </section>

<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>
