<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- Fonts.com fonts incluide -->
<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/f57bee99-b897-470d-99d0-b25cbf760386.css" />
<!-- Favicon -->
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
<?php wp_head(); ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-69291081-1', 'auto');
	  ga('send', 'pageview');

	</script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<header class="navigation">
		
		<h1><a href="<?php echo get_home_url() ?>"><?php bloginfo('name'); ?></a></h1>
		
		<div class="menu-btn" id="menu-btn" /></div>

		<nav class="main_navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
