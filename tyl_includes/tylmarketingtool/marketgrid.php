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
	<script type="text/javascript">
	var $ = jQuery.noConflict();

	$(document).ready(function(){

		$(".addrow").live("click",function(){

			var cur_row_num;
			var new_row ;
			var new_row_num
			var cur_table; 
			var cur_category = $(this).closest(".marketcat").attr("id");
			console.log(cur_category); 
			var this_total_field = $(this).closest("tr").find(".total");


			if(this_total_field.val()==0){

				$(this).closest("tr").find(".amount").focus();
				alert("Last line total can not be 0");

			}else{

				cur_table =  $(this).closest("tbody");
				cur_row = 	$(this).closest("tr");
				cur_row_num = cur_row.attr("Class");
				
				new_row_num  =  parseInt( cur_row_num ) + 1 ;

				console.log(new_row_num);
				new_row =  "<tr class=\""+ new_row_num +"\">";
				new_row += "<td><input type=\"text\" class=\"amount\" name=\""+cur_category+"["+ new_row_num + "][amount]\" value=\" \"> </td>" ;
				new_row += "<td><input type=\"text\" class=\"cost\" name=\""+cur_category+"["+ new_row_num + "][cost]\" value=\" \"> </td>" ;
				new_row += "<td><input type=\"text\" class=\"total\" name=\""+cur_category+"["+ new_row_num + "][total]\" value=\"0 \" readonly> </td>" ;
				new_row += "<td><a href=\"#\" class=\"addrow\">add line</a></td>";
				new_row += "</tr>";

				$(this).remove();
				cur_table.append(new_row).clone(true);
			}
			
			return false;
		});


		 $('.amount').live( "blur",function() {
		 		
    			//$(this).closest("tr").find(".cost").hide();
    			calculateTotal($(this));
    			console.log("focust out amount");
 		 }); 	

		 $('.cost').live("blur",function() {
		 		
    			calculateTotal($(this));
    			console.log("focust out cost");
 		 }); 	


		function calculateTotal(cur_field){

			var other_field;
			var total_field = cur_field.closest("tr").find(".total");

			//cur_field.val(cur_field.val().replace(/[^\d.]/, ''));
			if($.isNumeric(cur_field.val()) || cur_field.val().length < 1 ){

				if(cur_field.attr("class")=="cost"){

					other_field = cur_field.closest("tr").find(".amount");
				}else{
					other_field = cur_field.closest("tr").find(".cost");

				}

				
				if(other_field.val()==""){

					other_field.focus();

				}else{
					var total = other_field.val() * cur_field.val();
					total_field.val(total);
					
				}	
			}else{

				alert('Please enter a numeric value.');
				cur_field.val("");
				cur_field.focus();


			}
		}

	});

	</script>

	<?php

		/*							*/
		/*	Save specic category 	*/
		/*	to the pricing grid		*/
		/*							*/

	 	function add_to_grid($lines){

     	$count = count($lines);
     	$grid = array();

     	if($lines[$count-1]["total"]==0){
     		unset($lines[$count-1]);
     	}

     	$grid["grid"] = $lines;

     	return  $grid;

     	/*

	{ "smsdirect" :   {"grid" : [ 
				{"amount":50000, "cost":0.50, "total" :25000} ,
			   {"amount":100000, "cost":0.47, "total" :47000} ,
			   {"amount":150000, "cost":0.45, "total" :67500} ,
			   {"amount":200000, "cost":0.43, "total" :86000} ,
			   {"amount":250000, "cost":0.41, "total" :102500} ,
			   {"amount":3000000, "cost":0.39, "total" :117000} ,
			   {"amount":3500000, "cost":0.37, "total" :129500} ] 
			}
		}

     	*/

	}

	/*							*/
	/*	Print specic category 	*/
	/*	grid					*/
	/*							*/
	function print_grid( $id ,$data){
		 		$rowcount = 0;

		 		$element_count = count($data);
			 	if(!empty($data)){	
			 		foreach( $data as  $line ) { 
			 			?>
			 			<tr class="<?php echo $rowcount; ?>">
				 			<td><input type="text" class="amount" name="<?php echo $id;?>[<?php echo $rowcount;?>][amount]" value="<?php echo $line["amount"]; ?>">  </td>
				 			<td><input type="text" class="cost" name="<?php echo $id;?>[<?php echo $rowcount;?>][cost]" value="<?php echo $line["cost"]; ?>">  </td>
				 			<td><input type="text" class="total" name="<?php echo $id;?>[<?php echo $rowcount;?>][total]" value="<?php echo $line["total"]; ?>" readonly>  </td>

				 			<?php 

				 			if(($element_count-1)==$rowcount){ //only add add line to the last row ?>
				 				<td><a href="#" class="addrow">add line</a></td>
				 			<?php } ?>
			 			</tr>
			 			
					<?php	
			 		$rowcount++;
			 		} 


			 	}else{ // data empty print out default three items

			 		$rowcount = 0;	
			 	?>
			 	
			 			<tr class="<?php echo $rowcount; ?>">
				 			<td><input name="<?php echo $id;?>[0][amount]" type="text" class="amount" value="">  </td>
				 			<td><input name="<?php echo $id;?>[0][cost]" type="text" class="cost" value="">  </td>
				 			<td><input name="<?php echo $id;?>[0][total]" type="text" class="total" value="0" readonly>  </td>
				 			<td><a href="#" class="addrow">add line</a></td>
			 			</tr>

			 	<?php	

			 	}



	}
	

	/*
			Handle the Submitted data
			
	*/


	if($_POST['marketingdatasubmit'] == 'Y') {  
	      echo '<div class="updated">
	       <p>Data Saved!</p>
	    </div>';

	    $pricing = array();

	     if( $_POST['emaildirect'] ){

	     	$lines = $_POST['emaildirect'];
	     	$pricing["emaildirect"] = add_to_grid($lines);


	     }

	     if( $_POST['emailagency'] ){

	     	$lines = $_POST['emailagency'];
	     	$pricing["emailagency"] = add_to_grid($lines);

	     }

	    if( $_POST['smsdirect'] ){
	     	
	     	$lines = $_POST['smsdirect'];
	     	$pricing["smsdirect"] = add_to_grid($lines);

	     }

	     if( $_POST['smsagency'] ){

	     	$lines = $_POST['smsagency'];
	     	$pricing["smsagency"] = add_to_grid($lines);

	     }

	     update_option("tyl_market_cat_data", json_encode($pricing));
	     
	     // defulat data
	    /* $default_data = '[ 
		{ "smsdirect" :   {"grid" : [ 
				{"amount":50000, "cost":0.50, "total" :25000} ,
			   {"amount":100000, "cost":0.47, "total" :47000} ,
			   {"amount":150000, "cost":0.45, "total" :67500} ,
			   {"amount":200000, "cost":0.43, "total" :86000} ,
			   {"amount":250000, "cost":0.41, "total" :102500} ,
			   {"amount":3000000, "cost":0.39, "total" :117000} ,
			   {"amount":3500000, "cost":0.37, "total" :129500} ] 
			}
		},
		
		{ "smsagency" : {"grid" : [ 
				{"amount":50000, "cost":0.59, "total" :29000} ,
			   {"amount":100000, "cost":0.57, "total" :57000} ,
			   {"amount":150000, "cost":0.55, "total" :82500} ,
			   {"amount":200000, "cost":0.53, "total" :106000} ,
			   {"amount":250000, "cost":0.51, "total" :127000} ,
			   {"amount":3000000, "cost":0.49, "total" :147000} ,
			   {"amount":3500000, "cost":0.47, "total" :164000} ,
			   {"amount":4000000, "cost":0.45, "total" :180000} ,
			   {"amount":4500000, "cost":0.43, "total" :193000} ,
			   {"amount":5000000, "cost":0.41, "total" :205000} ,
			   {"amount":5500000, "cost":0.39, "total" :214000} ,
			   {"amount":6000000, "cost":0.37, "total" :222000} ] 
			}
		},
		
		{ "emaildirect" : {"grid" : [ 
				{"amount":30000, "cost":0.5, "total" :15000} ,
			   {"amount":50000, "cost":0.45, "total" :22500} ,
			   {"amount":100000, "cost":0.4, "total" :40000} ,
			   {"amount":300000, "cost":0.35, "total" :105000} ,
			   {"amount":500000, "cost":0.3, "total" :150000} ,
			   {"amount":1000000, "cost":0.25, "total" :250000} ,
			   {"amount":3000000, "cost":0.15, "total" :450000} ] 
			}
		},
		
		{ "emailagency" : {"grid" : [ 
				{"amount":30000, "cost":0.59, "total" :17700} ,
			   {"amount":50000, "cost":0.55, "total" :27500} ,
			   {"amount":100000, "cost":0.53, "total" :53000} ,
			   {"amount":300000, "cost":0.46, "total" :138000} ,
			   {"amount":500000, "cost":0.43, "total" :215000} ,
			   {"amount":1000000, "cost":0.39, "total" :390000} ,
			   {"amount":1700000, "cost":0.34, "total" :578000} ] 
			}
		}
	]' ;
		$default_array = json_decode($default_data,true);*/

	    // add data to wp option table

	 
    } 


	/*

		Get data for the tables
	*/    
	$option_data_pricing = "";
	$option_data_pricing = get_option('tyl_market_cat_data');
	$pricing_array = json_decode($option_data_pricing,true);


	?>
	 <div class="wrap">
     <h2>Manage Categories</h2>


	 <form method="POST"  name="marketcategories" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
	 	 <input type="hidden" name="marketingdatasubmit" value="Y"> 

		  <div id="smsdirect" class="marketcat">
		  	<h3> SMS Direct</h3>
		 		<table>
			 		<tr>
			 		<th>Amount</th>
			 		<th>Cost</th>
			 		<th>Total</th>
			 		<th></th>
			 		</tr>	
			 		<? 
			 			$sms_direct_data = $pricing_array['smsdirect']['grid'];
			 			print_grid("smsdirect",$sms_direct_data ) ;
			 		?>
		 		
		 		</table>
		 </div>	
		  <div id="smsagency" class="marketcat">
		  	<h3>SMS Agency</h3>
		 		<table>
			 		<tr>
			 		<th>Amount</th>
			 		<th>Cost</th>
			 		<th>Total</th>
			 		<th></th>
			 		</tr>	
			 		<? 
			 			$sms_agency_data = $pricing_array['smsagency']['grid'];
			 			print_grid("smsagency",$sms_agency_data ) ;
			 		?>
		 		
		 		</table>
		 </div>	
		 <div id="emaildirect" class="marketcat">
		 	<h3>Email Direct</h3>
		 	<table>
		 		<tr>
		 		<th>Amount</th>
		 		<th>Cost</th>
		 		<th>Total</th>
		 		<th></th>
		 		</tr>	
		 		<? 
		 			$email_direct_data = $pricing_array['emaildirect']['grid'];
		 			print_grid("emaildirect",$email_direct_data ) ;
		 		?>
		 		
		 	</table>
		 </div>	

		 <div id="emailagency" class="marketcat">
		 		<h3>Email Agency</h3>
		 		<table>
			 		<tr>
			 		<th>Amount</th>
			 		<th>Cost</th>
			 		<th>Total</th>
			 		<th></th>
			 		</tr>	
			 		<? 
			 			$email_agency_data = $pricing_array['emailagency']['grid'];
			 			print_grid("emailagency",$email_agency_data ) ;
			 		?>
		 		
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






?>