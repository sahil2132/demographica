<?php
/**
 * The template used for displaying solutions in the various solutions pages
 *
 * @package WordPress
 * @subpackage bluemoon
 */
?>
<div class="solutions-post">
	<div class="solutions-dropdown"><h1 class="arrow-side"><?php the_title(); ?></h1></div>
    <div class="solutions-post-content">
    	<table>
			<tr>
				<td><?php the_post_thumbnail( 'large-feature', array('class' => 'solutions-img') ); ?></td>
				<td><?php the_content(); ?></td>
            </tr>
        </table>
    </div>
</div>

