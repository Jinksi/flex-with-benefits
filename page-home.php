<?php

/*
Template Name: Home page
*/

get_header(); ?>
<?php get_template_part('inc-edit'); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="section">
		<div class="container skinny">
			<?php the_content();?>
		</div>
	</div>

<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>
