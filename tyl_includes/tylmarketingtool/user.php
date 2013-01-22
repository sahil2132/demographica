<?php $reset = $_GET['reset']; if($reset == true) { echo '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><p><strong>Thank you</strong><br />Please check your email for instructions on resetting your password.</p></div>'; } ?>

<?php if ( is_user_logged_in() ) { ?>
	
	<?php tylMain() ?>
	
<?php } else { ?>

	<ul class="tyl_nav nav-tabs" id="usertools">
		<li class="active"><a href="#login" data-target="login">Login</a></li>
		<li><a href="#register" data-target="register">Register</a></li>
		<li><a href="#forgot" data-target="forgot">Lost Password?</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="login">
			<form name="loginform" id="loginform" action="<?php echo bloginfo('url'); ?>/wp-login.php" method="post" class="">
				<div class="input-prepend">
					<span class="add-on">Email Address</span>
					<input type="text" name="log" id="user_login" class="" value="" />
				</div>			
				<div class="input-prepend">
					<span class="add-on">Password</span>
					<input type="password" name="pwd" id="user_pass" class="" value="" />
				</div>			
				
				<div class="input-prepend">
					<label class="checkbox"><input type="checkbox" name="rememberme" value="forever"> Remember me</label>
				</div>			

				<div class="clearfix buttonwrap">
					<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Log In" />
					<input type="hidden" name="redirect_to" value="<?php echo get_permalink(MAIN_PAGE_ID); ?>" />
				</div>				
			</form>
		</div><!-- login -->
		
		<div class="tab-pane" id="register">
			<?php gravity_form(1, false, false, '', '', true, ''); ?>
		</div><!-- register -->
		
		<div class="tab-pane" id="forgot">
			<div id="result"></div>

			<form id="wp_pass_reset" action="" method="post">
				<div class="input-prepend">
					<span class="add-on">Username or email address</span>
					<input type="text" name="user_input" id="user_login" value="" />
				</div>			

				<input type="hidden" name="action" value="tg_pwd_reset" />
				<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>" />

				<div class="clearfix buttonwrap">
					<input type="submit" id="submitbtn" name="submit" class="btn btn-primary" value="Reset my password" />
				</div>
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