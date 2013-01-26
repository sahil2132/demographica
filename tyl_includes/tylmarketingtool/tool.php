<?php

	/* TYL Marketing Tool */
	
		// define some globals
		
			define('MAIN_PAGE_ID', '2');
	
		// general functions

			// gravity forms
				
				add_filter("gform_submit_button", "tyl_submit_button", 10, 2);
				function tyl_submit_button($button, $form){
					return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>".$form['button']['text']."</span></button>";
				}
		
				add_filter("gform_validation_message", "change_message", 10, 2);
				function change_message($message, $form){
					return '<div class="alert alert-error validation_error">Sorry... there were some errors in the form. Please see below...</div>';
				}
				
			// set global with logged in user's ID
				
				$current_user = wp_get_current_user();
				define('USERID', $current_user->ID);
		
			// login failed redirect 
			
				add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login
				
				function my_front_end_login_fail( $username ) {
				   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
				   // if there's a valid referrer, and it's not the default log-in screen
				   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
				      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
				      exit;
				   }
				}		

		
		// User tool - login/register/forgot
		function tylUser() {
			// display register/login/password system
			get_template_part('tyl_includes/tylmarketingtool/user');
		}
		
		
		// Actual System - displayed if user_logged_in == true
		function tylMain() {
			// the magic
			get_template_part('tyl_includes/tylmarketingtool/main');
		}


?>