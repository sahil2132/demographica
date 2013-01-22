<?php
/*
Template Name: Shop - Posters
*/

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<div class="maincontent-store">
                    <div class="content-page-menu">
                        <div class="sidebar" id="store-sidebar">
                            <?php get_sidebar( 'store' ); ?>
                        </div>
                        <?php
                        /* Run the loop to output the page.
                         * If you want to overload this in a child theme then include a file
                         * called loop-page.php and that will be used instead.
                         */
                        get_template_part( 'content', 'shop' );
                        ?>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="shop-list">
                        <?php 
                            $args = array( 'numberposts' => 100, 'category' => 26,'order' => 'ASC' );
                            $posts = get_posts( $args ); 
                        ?>
                        <?php if( $posts ) : ?>
                            <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
            
                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'loop', 'shop' );
                                ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div style="clear: both;"></div>
                    </div>
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
