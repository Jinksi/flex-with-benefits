<?php get_header(); ?>
<?php get_template_part('inc-edit');?>

<section class="blog-nav--section section light">
	<div class="container skinny tacenter">
		<h2 class="blog-nav--title">Blog categories</h2>
		<ul class="blog-nav--list">
			<?php wp_list_categories(array(
				'hide_title_if_empty' => true,
				'title_li' => '',
				'show_option_all' => 'All'
			)); ?>
		</ul>
	</div>
</section>

<section class="blog-list--section light">
	<div class="blog-list--container container wide">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'components/blog-item' ); ?>
		<?php endwhile; // End the loop. Whew. ?>
	</div>
</section>

<section class="section light">
  <div class="container">
		<?php numeric_posts_nav(); ?>
  </div>
</section>

<?php get_footer(); ?>
