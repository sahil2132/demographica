<?php

// Default options values
$sa_options = array(
	'positioning_statement' => '',
	'footer_phone' => '',
	'footer_address' => '',
	'newsletter_signup' => ''
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );


function sa_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );

// Function to generate options page
function sa_theme_options_page() {
	global $sa_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'sa_options', $sa_options ); ?>
	
	<?php settings_fields( 'sa_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	
		<tr valign="top"><td><h3>Header Options</h3></td></tr>
	
		<tr valign="top">
			<th scope="row"><label for="positioning_statement">Positioning Statement</label></th>
			<td>
				<textarea id="positioning_statement" name="sa_options[positioning_statement]" rows="5" cols="40"><?php echo stripslashes($settings['positioning_statement']); ?></textarea>
			</td>
		</tr>

		<tr valign="top"><td><h3>Footer Options</h3></td></tr>
		
		<tr valign="top">
			<th scope="row"><label for="footer_jointheteam">Join the team message</label></th>
			<td>
				<textarea id="footer_jointheteam" name="sa_options[footer_jointheteam]" rows="5" cols="40"><?php echo stripslashes($settings['footer_jointheteam']); ?></textarea>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="footer_phone">Footer Phone Number</label></th>
			<td>
				<input id="footer_phone" name="sa_options[footer_phone]" value="<?php echo stripslashes($settings['footer_phone']); ?>"  />
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="footer_address">Footer Address</label></th>
			<td>
				<textarea id="footer_address" name="sa_options[footer_address]" rows="5" cols="40"><?php echo stripslashes($settings['footer_address']); ?></textarea>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="newsletter_signup">Newsletter Signup Text</label></th>
			<td>
				<textarea id="newsletter_signup" name="sa_options[newsletter_signup]" rows="5" cols="40"><?php echo stripslashes($settings['newsletter_signup']); ?></textarea>
			</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $sa_options;

	$settings = stripslashes_deep(get_option( 'sa_options', $sa_options ));
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['positioning_statement'] = stripslashes_deep(wp_filter_nohtml_kses( $input['positioning_statement'] ));
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['footer_phone'] = stripslashes_deep(wp_filter_nohtml_kses( $input['footer_phone'] ));
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['footer_address'] = stripslashes_deep(wp_filter_post_kses( $input['footer_address'] ));
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['newsletter_signup'] = stripslashes_deep(wp_filter_post_kses( $input['newsletter_signup'] ));
	
	return $input;
}

endif;  // EndIf is_admin()