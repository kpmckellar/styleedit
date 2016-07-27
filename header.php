<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- jQuery! -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<!-- Fonts.com fonts incluide -->
<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/f57bee99-b897-470d-99d0-b25cbf760386.css"/>

<?php wp_head(); ?>

<!-- Mobile Menu Icon -->
<script type="text/javascript">
	jQuery(function($){
	     $( '.menu-btn' ).click(function(){
	     	$('.main_navigation').toggleClass('expand')
	     	$('.menu-btn').toggleClass('close_icon')
	     })
	})
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
