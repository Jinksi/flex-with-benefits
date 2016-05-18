<?php

/*
Template Name: Contact page
*/

get_header(); ?>
<?php get_template_part('inc-edit'); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<section class="section">
		<div class="container skinny">
			<?php the_content();?>
		</div>
	</section>

<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>
