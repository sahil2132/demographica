<?php

add_action('admin_menu', 'market_menu');

function market_menu() {
    $pending = '<span class="update-plugins"><span class="pending-count">: )</span></span>';
	add_menu_page('Manage Categories', 'Categories'.$pending, 'manage_options', 'categories', 'category_manage'); 
}


function category_manage(){

  	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	 <div class="wrap">
     <h2>Manage Categories</h2>
	 <p>Include PHP file for better readability of your code.</p>


	 <form id="marketcategories" name="marketcategories" action="">
		 <div id="emaildirect" class="marketcat">
		 	<h3>Email Direct</h3>
		 	<table>
		 		<tr>
		 		<th>Amount</th>
		 		<th>Cost</th>
		 		<th>Total</th>
		 		</tr>	
		 		<?php 
		 		$rowcount = 0;
		 		$email_direct_data = unserialize(get_option('emaildirect')); 
			 	if(!empty($email_direct_data)){	
			 		foreach( $email_direct_data as  $line ) { ?>
			 			$rowcount
			 			<tr class="<?php echo $rowcount; ?>">
				 			<td><input type="text" class="amount" value="<?php $line[amount]; ?>">  </td>
				 			<td><input type="text" class="cost" value="<?php $line[cost]; ?>">  </td>
				 			<td><input type="text" class="total" value="<?php $line[total]; ?>">  </td>
			 			</tr>
			 			

			 	<?php
			 			} 
			 	}else{
			 		$rowcount = 1;	
			 	?>
			 	
			 			<tr class="<?php echo $rowcount; ?>">
				 			<td><input name="amount" type="text" class="amount" value="">  </td>
				 			<td><input name="cost" type="text" class="cost" value="">  </td>
				 			<td><input name="toital" type="text" class="total" value="">  </td>
			 			</tr>

			 	<?php	

			 	}


		 	?>
		 		
		 	</table>
		 </div>	
		 <div id="emailagency" class="marketcat">
		 		<h3>Email Agency</h3>
		 			 	<table>
		 		<tr><td>field from db</td><td>field from db</td><td>field from db</td></tr>
		 	</table>
		 </div>	
		  <div id="smsdirect" class="marketcat">
		  	<h3> SMS Direct</h3>
		  	 	<table>
		 		<tr><td>field from db</td><td>field from db</td><td>field from db</td></tr>
		 	</table>	
		 </div>	
		  <div id="smsagency" class="marketcat">
		  	<h3>SMS Agency</h3>
		  	<table>
		 		<tr><td>field from db</td><td>field from db</td><td>field from db</td></tr>
		 	</table>
		 </div>	

		 <br>
		 <br>
	<input type="submit" class="button button-primary button-large" value="Save" />	 
	<?php
		wp_nonce_field();
	?>
	</form>
	 </div>

	<?php
} 


// save category data



add_action('admin_init','save_cat_data');

function save_cat_data(){

 	//print_r($_POST);
 	//die();

}





?>