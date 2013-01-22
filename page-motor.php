<?php
/*
Template Name: Motor Solutions
*/
get_header(); ?>
		<div id="container">
			<div id="content" role="main">
                <div class="sidebar">
					<?php get_sidebar( 'motor' ); ?>
				</div>
				<div class="maincontent">
					<?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					get_template_part( 'loop', 'page-solutions' );
					?>
					<?php 
						$args = array( 'numberposts' => 100, 'category' => 17,'order' => 'ASC' );
						$posts = get_posts( $args ); 
					?>
					<?php if( $posts ) : ?>
						<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
		
							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', 'solutions' );
							?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>
