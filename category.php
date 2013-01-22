<?php
/*
Template Name: Press
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            	<div class="page-header"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/about-page-header.png" alt="" /></div>
				<div class="sidebar">
					<?php get_sidebar( 'press' ); ?>
				</div>
				<div class="maincontent">
                	<h1 class="entry-title">COMING TO A SHELF NEAR YOU:</h1>
					<?php get_template_part( 'loop', 'archivetemplate' ); ?>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
