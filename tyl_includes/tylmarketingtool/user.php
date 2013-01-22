<?php $reset = $_GET['reset']; if($reset == true) { echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><p><strong>Thank you</strong><br />Please check your email for instructions on resetting your password.</p></div>'; } ?>

<?php if ( is_user_logged_in() ) { ?>
	
	<?php tylMain() ?>
	
<?php } else { ?>
	
	<ul class="nav nav-tabs" id="usertools">
		<li class="active"><a href="#login">Login</a></li>
		<li><a href="#register">Register</a></li>
		<li><a href="#forgot">Lost Password?</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="login">
			<?php echo wp_login_form(); ?>
		</div><!-- login -->
		
		<div class="tab-pane" id="register">
			<?php gravity_form(1, false, false, '', '', true, ''); ?>
		</div><!-- register -->
		
		<div class="tab-pane" id="forgot">
			<div id="result"></div>
			<form id="wp_pass_reset" action="" method="post">
			 
			<label for="user_login">Enter your username or email address: </label>
			<input type="text" name="user_input" id="user_login" value="" /><br />
			<input type="hidden" name="action" value="tg_pwd_reset" />
			<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>" />
			<input type="submit" id="submitbtn" name="submit" class="btn btn-primary" value="Reset my password" />
			 
			</form>
			<script type="text/javascript">
			jQuery("#wp_pass_reset").submit(function() {
				jQuery("#result").html("<div class='alert alert-info alert-validating'>Validating...</div>").slideDown();
				var input_data = jQuery("#wp_pass_reset").serialize();
				jQuery.ajax({
					type: "POST",
					url:  "<?php echo get_permalink(MAIN_PAGE_ID); ?>",
					data: input_data,
					success: function(msg){
						jQuery(".loading").remove();
						jQuery("<div>").html(msg).appendTo("div#result").hide().slideDown(100);
						jQuery(".alert-validating").slideUp(100);
					}
				});
				return false;
			});
			</script>


		</div><!-- forgot -->
	</div>
	
<?php } ?>