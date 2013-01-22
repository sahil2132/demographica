<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
		</div>
  		<?php
    		global $sa_options;
			$sa_settings = get_option( 'sa_options', $sa_options );
		?>
  		
  		<div id="logos">
  			<div class="center">
            	<hr/>
  				<table width="100%" style="text-align: center;">
  					<tr>
  						<td style="vertical-align:middle;"><a href="http://www.thesaci.co.za/" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/saci-footer-logo.png" alt="The SACI" /></a></td>
                        <td style="vertical-align:middle;"><a href="http://www.bizcommunity.com/Article/196/14/67367.html" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/assegai-logo.png" alt="Demograpgica" /></a></td>
                    	<td style="vertical-align:middle;"><a href="http://www.nationalbusinessawards.co.za/2012-photos/" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/nba-logo.png" alt="Demograpgica" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmasa.org/dmasa/dma_cofe.php" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/dlists-footer-logo.png" alt="Center of Excellence D-Lists" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmasa.org/" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/dma-footer-logo.png" alt="Direct Marketinging Association of SA" /></a></td>
  						<td style="vertical-align:middle;"><a href="http://www.dmma.co.za/" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/dmma-footer-logo.png" alt="Digital Media and Marketing Association" /></a></td>
  					</tr>
  				</table>
  			</div>
  		</div>
  		
  		<footer>
			<div id="footer">
				<div id="footer-address">
					<p><strong>Phone:</strong> <?php echo $sa_settings['footer_phone']; ?> <strong>Physical:</strong> <?php echo $sa_settings['footer_address']; ?></p>
				</div>
				<div id="footer-links">
					<?php wp_nav_menu( array('menu' => 'footermenu' )); ?>
				</div>
				<div id="footer-newsletter">
					<?php get_sidebar( 'newsletter' ); ?>
				</div>
				<div style="clear: both;"></div>
			</div>
  		</footer>
  	</div>
  	<?php
	   /* Always have wp_footer() just before the closing </body>
	    * tag of your theme, or you will break many plugins, which
	    * generally use this hook to reference JavaScript files.
	    */
	
	    wp_footer();
	?>

  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  


  <!-- scripts concatenated and minified via build script -->
  <script defer src="<?php echo get_bloginfo('template_directory'); ?>/js/plugins.js"></script>
  <script defer src="<?php echo get_bloginfo('template_directory'); ?>/js/script.js"></script>
  <!-- end scripts -->


  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-18383518-1'],['_trackPageview'],['_trackPageLoadTime']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
 <div id="case-study-container">
 	<div class="main-hover">
 		
 	</div>
 </div>
</body>
</html>