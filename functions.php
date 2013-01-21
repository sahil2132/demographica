<?php

	// gets

		get_template_part('includes/tylmarketingtool/tool');

	// admin

		add_filter( 'show_admin_bar', '__return_false' );

	// thumbs

		add_theme_support( 'post-thumbnails' );

	// menus

		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'topmenu' => 'Main Menu',
				)
			);
		}

	// excerpt

	function custom_excerpt($count, $syntax) {
		$return = get_the_excerpt();
		$return = preg_replace('`\[[^\]]*\]`','',$return);
		$return = strip_tags($return);
		$return = substr($return, 0, $count);
		$return = substr($return, 0, strripos($return, " "));
		$return = $return.$syntax;
		return $return;
	}

	//marketing grid

		get_template_part('includes/tylmarketingtool/marketgrid');
