<?php import('/components/SocialList.php'); ?>

<footer class="footer section">
	<div class="container">
		<?php SocialList::render(); ?>
		<p>&copy; <?php echo date('Y'); ?> All rights Reserved.</p>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
