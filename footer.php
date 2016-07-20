<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package styleedit
 */

?>

	<!-- removed content div -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<div class="social">
			<!-- <?php wp_nav_menu( array( 'menu' => 'social', 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> -->
			
			<?php $settings = get_option('custom_options'); ?>

				<a class="social_icon" href="<?php echo $settings['custom_twitter_url']; ?>"><img  src="<?php bloginfo('template_directory'); ?>/img/twitter.png" /></a><a class="social_icon" href="<?php echo $settings['custom_instagram_url']; ?>"><img  src="<?php bloginfo('template_directory'); ?>/img/instagram.png" /></a><a class="social_icon" href="<?php echo $settings['custom_facebook_url']; ?>"><img  src="<?php bloginfo('template_directory'); ?>/img/facebook.png" /></a><a class="social_icon" href="<?php echo $settings['custom_youtube_url']; ?>"><img  src="<?php bloginfo('template_directory'); ?>/img/youtube.png" /></a>
			</div>

			<div class="">
				<p class="tagline_footer"><?php bloginfo('description'); ?></p>
				<p class="copyright">&copy;<?php echo date("Y") ?> <?php bloginfo('name'); ?></p>
			</div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
