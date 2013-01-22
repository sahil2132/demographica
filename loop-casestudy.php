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
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 10px;">
    <div class="case-studies-dropdown"><h1 class="arrow-side"><?php the_title(); ?></h1></div>

    <div class="case-studies-post-content">
        <?php the_content(); ?>
	<div style="clear: both;"></div>
    </div><!-- .entry-content -->


</div><!-- #post-## -->