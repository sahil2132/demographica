<?php
/**
 * The template used for displaying jobs in the jobs page
 *
 * @package WordPress
 * @subpackage bluemoon
 */
?>
<div class="staff">
    <p style="text-align: center;"><?php the_post_thumbnail( 'large-feature' ); ?></p>
    <h1 style="text-align: center;"><?php the_title(); ?></h1>
	<div class="staff-description"><?php the_content(); ?></div>
</div>

