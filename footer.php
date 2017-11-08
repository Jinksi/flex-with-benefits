<?php import('components/SocialList.php'); ?>
<?php import('components/InstagramFeed.php'); ?>

<footer class="footer section">
	<div class="container">
		<?php SocialList::render(); ?>
		<?php InstagramFeed::render([
			'username' => 'thrivegoldcoast'
		]); ?>
		<p>&copy; <?php echo date('Y'); ?> All rights Reserved.</p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
