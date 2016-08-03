	</div> <!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<div class="social">			
			
				<?php $settings = get_option('custom_options'); ?>

				<a class="social_icon" target="_blank" href="<?php echo $settings['custom_twitter_url']; ?>"><img class="twitter" src="<?php bloginfo('template_directory'); ?>/img/twitter.png" /></a>
				<a class="social_icon" target="_blank" href="<?php echo $settings['custom_instagram_url']; ?>"><img class="instagram"  src="<?php bloginfo('template_directory'); ?>/img/instagram.png" /></a>
				<a class="social_icon" target="_blank" href="<?php echo $settings['custom_facebook_url']; ?>"><img class="facebook"  src="<?php bloginfo('template_directory'); ?>/img/facebook.png" /></a>
				<a class="social_icon" target="_blank" href="<?php echo $settings['custom_youtube_url']; ?>"><img class="youtube"  src="<?php bloginfo('template_directory'); ?>/img/youtube.png" /></a>
			</div>

			<div class="">
				<p class="tagline_footer"><?php bloginfo('description'); ?></p>
				<p class="copyright">&copy;<?php echo date("Y") ?> <?php bloginfo('name'); ?></p>
			</div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type=text/javascript src="https://services.xg4ken.com/js/kenshoo.js?cid=f15b3992-46df-44e1-a2f9-a3191e71b7bc" ></script>
<script>
	$('#spa').click(function() {
		kenshoo.trackConversion('113','f15b3992-46df-44e1-a2f9-a3191e71b7bc',{
		   //OPTIONAL PARAMETERS. FILL VALUES OR REMOVE UNNEEDED PARAMETERS
		   conversionType: 'spa', //specific conversion type. example: type:'AppInstall' default is 'conv'
		   revenue: 0.0, //numeric conversion value. example convValue: 12.34
		   currency:'USD', //example currency:'USD'
		   orderId:'',//example orderId: 'abc'
		   promoCode:'',
		   customParam1:'', //any custom parameter. example: Airport: 'JFK'
		   customParam2:'', //any custom parameter. example: Rooms: '3'
		   customParamN:'' })
		})

	$('#locate').click(function() {
		kenshoo.trackConversion('113','f15b3992-46df-44e1-a2f9-a3191e71b7bc',{
		   //OPTIONAL PARAMETERS. FILL VALUES OR REMOVE UNNEEDED PARAMETERS
		   conversionType: 'locate', //specific conversion type. example: type:'AppInstall' default is 'conv'
		   revenue: 0.0, //numeric conversion value. example convValue: 12.34
		   currency:'USD', //example currency:'USD'
		   orderId:'',//example orderId: 'abc'
		   promoCode:'',
		   customParam1:'', //any custom parameter. example: Airport: 'JFK'
		   customParam2:'', //any custom parameter. example: Rooms: '3'
		   customParamN:'' })
	})
</script>

<noscript>
   <img src="https://113.xg4ken.com/pixel/v1?track=1&token=f15b3992-46df-44e1-a2f9-a3191e71b7bc&conversionType=conv&revenue=0.0&currency=USD&orderId=&promoCode=&customParam1=&customParam2=" width="1" height="1" />
</noscript>

</body>
</html>
