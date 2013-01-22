<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>
<div id="post-<?php the_ID(); ?>" class="shop-list-single">
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    <h6><?php the_title(); ?></h6>
    <p><?php echo get_post_meta(get_the_ID(),'shop-short-description',true); ?></p>
	<p class="price">Price: R <?php echo get_post_meta(get_the_ID(),'shop-price',true); ?></p>
    <a class="view-product" href="<?php the_permalink(); ?>">view product</a>
</div><!-- #post-## -->