<ul class="tyl_nav nav-tabs" id="usertools">
	<li class="active"><a href="#welcome" data-target="welcome">Hello <?php echo get_the_author_meta('user_firstname', USERID); ?></a></li>
	<li><a href="#profile" data-target="profile">Update Profile</a></li>
	<li><a href="<?php echo wp_logout_url(get_permalink(MAIN_PAGE_ID)); ?>" class="text-warning logoutlink">Logout</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="welcome">
		<div id="mainchoice" class="row-fluid">
			<form name="mainchoice">
				<fieldset>
					<legend>Make your selection below:</legend>
					<label class="radio"><input class="mainchoice" type="radio" name="mainchoiceoptions" value="nobudget"> I own the bank</label>
					<label class="radio"><input class="mainchoice" type="radio" name="mainchoiceoptions" value="budget"> I'm on a budget</label>

					<div id="specify" class="input-prepend input-append">
						<span class="add-on">Specify your budget: R</span>
						<input type="text" name="budgetAmount" id="budgetAmount"/>
						<a class="add-on btn btn-primary" id="specifyupdate" href="#">Update</a>
					</div>			
				</fieldset>
			</form>	
		</div><!-- main choice -->

		<div id="cat-select" class="row-fluid">
			<form name="cat-options">
				<fieldset>
					<legend>Select the categories you would like to target:</legend>
					<label class="checkbox"><input type="checkbox" name="select-cat" class="productcheck" id="smsdirectcheck" value="smsdirect"> SMS Direct</label>
					<label class="checkbox"><input type="checkbox" name="select-cat" class="productcheck" id="smsagencycheck" value="smsagency"> SMS Agency</label>
					<label class="checkbox"><input type="checkbox" name="select-cat" class="productcheck" id="emaildirectcheck" value="emaildirect"> Email Direct</label>
					<label class="checkbox"><input type="checkbox" name="select-cat" class="productcheck" id="emailagencycheck" value="emailagency"> Email Agency</label>
				</fieldset>
			</form>	
		</div><!-- main choice -->
					
		<div id="productgrids" class="row-fluid"></div>
		<div id="results" class="row-fluid"></div>
		
		<div class="alert alert-info orderconfirm" style="display:none;">
			<p>
				<strong>What's next?</strong><br />If you are happy with the above transaction details, please click the button below. This button will take you to a payment gateway 
				where the above amount will be taken from your card. Once the transaction is successfully completed, your details will be sent to one of our account 
				managers who will be in touch with you shortly to proceed with your order.
			</p>
			
			<hr />
			<div class="input-prepend">
				<label class="checkbox"><input type="checkbox" name="iaccept" value="accept"> I have read, and agree to the <a href="#">Terms and Conditions</a></label>
			</div>			
			
			<div class="btn-group">
				<a href="<?php echo get_permalink(MAIN_PAGE_ID); ?>" class="btn">Start over</a><a href="" class="btn btn-success">I'm happy. Proceed to payment</a>
			</div>
		</div>
		
	</div><!-- welcome -->
	
	<div class="tab-pane" id="profile">
		<?php gravity_form(2, false, false, '', '', true, ''); ?>
	</div><!-- profile -->
</div>

