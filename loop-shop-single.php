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
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" class="shop-list-single">
    <div class="full-description">
    	<?php the_post_thumbnail('large'); ?>
        <br/><br/><br/><br/><br/><br/><br/>
    	<h6><?php the_title(); ?></h6>
    	<p><?php echo get_the_content(); ?></p>
        <br/>
		<p class="price">Price: R <?php echo get_post_meta(get_the_ID(),'shop-price',true); ?></p>
        <br/>
    	<a class="view-product buy" href="mailto:shop@demographica.co.za?subject=I would like to buy: <?php the_title(); ?>&body=Hi Demographica, I would really like to buy the product '<?php the_title(); ?>' from your website. Please contact me to let me know how to purchase this item." target="_blank">click here to order</a>
    </div>
</div><!-- #post-## -->
<?php endwhile; // end of the loop. ?>