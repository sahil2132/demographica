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
 * @subpackage PI_Benchmark
 * @since PI Benchmark 1.0
 */
?>
<?php $first = 0; ?>
<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
        	<?php if ($first != 0) { ?>
            	<hr/>
            <?php } ?>
			<div class="pink-thumb">
				<?php the_post_thumbnail();?>
			</div>
			<div class="pink-content">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
                    <a href="<?php echo get_post_meta($post->ID, 'pink-link', true); ?>" class="pink" target="_blank">&gt; DOWNLOAD</a>
				</div><!-- .entry-content -->
			</div>
			<div style="clear: both;"></div>
		</div><!-- #post-## -->
		
	<?php $first++; ?>
<?php endwhile; // End the loop. Whew. ?>
