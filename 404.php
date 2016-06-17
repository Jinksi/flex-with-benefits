<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link href='https://fonts.googleapis.com/css?family=Arvo:400,700,400italic' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<?php wp_head();?>
	<style>
		.four04-wrap{
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: center;
			-webkit-justify-content: center;
			-ms-flex-pack: center;
			justify-content: center;
			min-height: 100vh;
		}
		.four04{
			line-height: 1.4;
			text-align: center;
			width: 90%;
			margin: 50px auto;
		}
		.four04 p{
			font-size: 1.5rem;
			max-width: 500px;
			margin: 25px auto;
		}
		.four04 a{
			display: inline-block;
		}
		.four04-logo{
			display: inline-block;
			width: 100%;
			max-width: 400px;
			height: auto;
			margin-bottom: 25px;
		}
		.four04-logo img{
			width: 100%;
			height: auto;
		}
	</style>
</head>
<body <?php body_class(); ?>>
	<div class="four04-wrap">
		<div class="four04">
			<a class="four04-logo" href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg"/></a>
			<h2>404 - Page Not Found</h2>
			<p>We can't find the page you are looking for!<br>Head back to <a href="<?php echo site_url(); ?>"><?php echo niceurl( site_url()); ?></a></p>
		</div>
	</div>
</body>
</html>
