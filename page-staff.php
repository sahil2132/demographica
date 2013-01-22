<?php
/*
Template Name: Staff
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
					<?php 
						$args = array( 'numberposts' => 100, 'category' => 11,'order' => 'ASC' );
						$posts = get_posts( $args ); 
					?>
					<?php if( $posts ) : ?>
						<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
		
							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', 'staff' );
							?>
						<?php endforeach; ?>
					<?php endif; ?>
                    <div style="clear: both;"></div>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
