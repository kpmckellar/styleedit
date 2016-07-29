	</div> <!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<div class="social">			
			
				<?php $settings = get_option('custom_options'); ?>

				<a class="social_icon" href="<?php echo $settings['custom_twitter_url']; ?>"><img class="twitter" src="<?php bloginfo('template_directory'); ?>/img/twitter.png" /></a>
				<a class="social_icon" href="<?php echo $settings['custom_instagram_url']; ?>"><img class="instagram"  src="<?php bloginfo('template_directory'); ?>/img/instagram.png" /></a>
				<a class="social_icon" href="<?php echo $settings['custom_facebook_url']; ?>"><img class="facebook"  src="<?php bloginfo('template_directory'); ?>/img/facebook.png" /></a>
				<a class="social_icon" href="<?php echo $settings['custom_youtube_url']; ?>"><img class="youtube"  src="<?php bloginfo('template_directory'); ?>/img/youtube.png" /></a>
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
