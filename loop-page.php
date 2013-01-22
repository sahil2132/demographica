<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
					<?php } else { 
				
					?>
						<h1 class="entry-title"><?php if(is_page('1373') || is_page('1371') || is_page('1389') || is_page('1375') || is_page('1377') || is_page('1381') || is_page('1383') || is_page('1385') || is_page('1379') ){}else {?><?php the_title(); }?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php // comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>