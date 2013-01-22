<ul class="tyl_nav nav-tabs" id="usertools">
	<li class="active"><a href="#welcome" data-target="welcome">Hello <?php echo get_the_author_meta('user_firstname', USERID); ?></a></li>
	<li><a href="#profile" data-target="profile">Update Profile</a></li>
	<li><a href="<?php echo get_permalink(MAIN_PAGE_ID); ?>" class="text-warning logoutlink">Logout</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="welcome">
		<div id="mainchoice">
			<form name="mainchoice">
				<fieldset>
					<legend>Make your selection below:</legend>
					<label class="radio"><input class="mainchoice" type="radio" name="mainchoiceoptions" value="nobudget"> I own the bank</label>
					<label class="radio"><input class="mainchoice" type="radio" name="mainchoiceoptions" value="budget"> I'm on a budget</label>

					<div id="specify" class="input-prepend">
						<span class="add-on">Specify your budget: R</span>
						<input type="text" name="budgetAmount" id="budgetAmount"/>
					</div>			
				</fieldset>
			</form>	
		</div><!-- main choice -->

		<div id="cat-select">
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
					
		<div id="results" class="clearfix"></div>	
		<div id="productgrids" class="clearfix"></div>	
	</div><!-- welcome -->
	
	<div class="tab-pane" id="profile">
		<?php gravity_form(2, false, false, '', '', true, ''); ?>
	</div><!-- profile -->
</div>

