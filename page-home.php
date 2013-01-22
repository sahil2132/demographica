<?php
/*
Template Name: Single
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<div class="single">
                <div style="width: 920px;">
					<?php
					/* Run the loop to output the page.
					 * If you want to overload this in a child theme then include a file
					 * called loop-page.php and that will be used instead.
					 */
					get_template_part( 'loop', 'page' );
					?>
                </div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
