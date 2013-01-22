<?php
/*
Template Name: Culture
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            	<div class="page-header"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/culture-header.jpg" alt="" /></div>
				<div class="sidebar">
					<?php get_sidebar( 'culture' ); ?>
				</div>
				<div class="maincontent">
					<?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					get_template_part( 'loop', 'page' );
					?>
					
					<?php get_template_part( 'loop', 'culture' ); ?>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
