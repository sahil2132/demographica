<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Demographica
 * @since Demographica
 */
?>
<?php $odds = 0; ?>
<?php query_posts($query_string . '&cat=30&posts_per_page=100'); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php if (($odds%2) == 0): ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('left-culture'); ?>>
	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('right-culture'); ?>>
	<?php endif; ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="culture-content">
            	<?php the_content(); ?>
            </div>
            <div class="culture-thumb">
			<?php the_post_thumbnail('large'); ?>
			</div>
			<div style="clear: both;"></div>
		</div><!-- #post-## -->
	<?php $odds++; ?>
<?php endwhile; // End the loop. Whew. ?>
