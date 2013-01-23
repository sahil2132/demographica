<?php

/* Template Name: TYL Order Page */

	
	// setup for ajax password reset
	
		global $wpdb, $user_ID;
		
		function tg_validate_url() {
			global $post;
			$page_url = esc_url(get_permalink(MAIN_PAGE_ID));
			$urlget = strpos($page_url, "?");
			if ($urlget === false) {
				$concate = "?";
			} else {
				$concate = "&";
			}
			return $page_url.$concate;
		}
		
		if(isset($_GET['key']) && $_GET['action'] == "reset_pwd") {
			$reset_key = $_GET['key'];
			$user_login = $_GET['login'];
			$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
			
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			
			if(!empty($reset_key) && !empty($user_data)) {
				$new_password = wp_generate_password(7, false);
					//echo $new_password; exit();
					wp_set_password( $new_password, $user_data->ID );
					//mailing reset details to the user
				$message = __('Your new password for the account at:') . "\r\n\r\n";
				$message .= get_option('siteurl') . "\r\n\r\n";
				$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
				$message .= sprintf(__('Password: %s'), $new_password) . "\r\n\r\n";
				$message .= __('You can now login with your new password at: ') . get_option('siteurl')."/login" . "\r\n\r\n";
				
				if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
					echo "<div class='alert'>Email failed to send for some unknown reason. Try again?</div>";
					exit();
				}
				else {
					$redirect_to = get_bloginfo('url')."/login?action=reset_success";
					wp_safe_redirect($redirect_to);
					exit();
				}
			} 
			else exit('Not a Valid Key.');
			
		}
		//exit();
	
		if($_POST['action'] == "tg_pwd_reset"){
			if ( !wp_verify_nonce( $_POST['tg_pwd_nonce'], "tg_pwd_nonce")) {
			  exit("No trick please");
		   }  
			if(empty($_POST['user_input'])) {
				echo "<div class='alert'>Please enter your Username or E-mail address</div>";
				exit();
			}
			//We shall SQL escape the input
			$user_input = $wpdb->escape(trim($_POST['user_input']));
			
			if ( strpos($user_input, '@') ) {
				$user_data = get_user_by_email($user_input);
				if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
					echo "<div class='alert'>Invalid E-mail address!</div>";
					exit();
				}
			}
			else {
				$user_data = get_userdatabylogin($user_input);
				if(empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
					echo "<div class='alert'>Invalid Username!</div>";
					exit();
				}
			}
			
			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;
			
			$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
			if(empty($key)) {
				//generate reset key
				$key = wp_generate_password(20, false);
				$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));	
			}
			
			//mailing reset details to the user
			$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
			$message .= get_option('siteurl') . "\r\n\r\n";
			$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
			$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
			$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
			$message .= tg_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . "\r\n";
			
			if ( $message && !wp_mail($user_email, 'Password Reset Request', $message) ) {
				echo "<div class='alert'>Email failed to send for some unknown reason.</div>";
				exit();
			}
			else {
				echo "<div class='alert alert-success'>We have just sent you an email with password reset instructions.</div>";
				exit();
			}
		}


	// call up required scripts & styling
	wp_enqueue_style('bootstrapcss', get_bloginfo('template_directory').'/tyl_includes/css/bootstrap.css' );
	wp_enqueue_style('style', get_bloginfo('template_directory').'/tyl_includes/css/tyl_style.css' );
	
	wp_enqueue_script('bootstrap', get_bloginfo('template_directory').'/tyl_includes/js/bootstrap.js', array('jquery'), '1.0' );
	wp_enqueue_script('number', get_bloginfo('template_directory').'/tyl_includes/js/number.js', array('jquery'), '1.0' );
	wp_enqueue_script('tyl_app', get_bloginfo('template_directory').'/tyl_includes/js/tyl_app.js', array('jquery'), '1.0' );
	wp_enqueue_script('theme', get_bloginfo('template_directory').'/tyl_includes/js/theme.js', array('jquery'), '1.0' );

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            	<div class="page-header"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/about-page-header.png" alt="" /></div>
                <div class="sidebar">
					<?php get_sidebar( 'about' ); ?>
				</div>
				<div class="maincontent">
					
					<?php tylUser(); ?>
										
				</div>
				<div style="clear: both;"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
