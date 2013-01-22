<?php
/*
Template Name: Apply
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            	<div class="page-header"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/about-page-header.png" alt="" /></div>
                 <div class="sidebar">
					<?php get_sidebar( 'about' ); ?>
				</div>
				<div class="maincontent">
					<?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					get_template_part( 'loop', 'page' );
					?>
					<div id="apply-form">
						<h1>Submit your CV</h1>
						<?php echo do_shortcode( '[contact-form-7 id="252" title="Join the team"]' ); ?>
					</div>
					<div id="apply-positions">
						<h1>Available Positions</h1>
						<?php 
							$args = array( 'category' => 10 );
							$posts = get_posts( $args ); 
						?>
						<?php if( $posts ) : ?>
							<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
			
								<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to overload this in a child theme then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content', 'job' );
								?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div style="clear: both;"></div>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
