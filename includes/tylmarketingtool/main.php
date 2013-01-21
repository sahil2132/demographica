<ul class="nav nav-tabs" id="usertools">
	<li class="active"><a href="#login">Hello <?php echo get_the_author_meta('user_firstname', USERID); ?></a></li>
	<li><a href="#profile">Update Profile</a></li>
	<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="text-warning">Logout</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="login">

		<p><strong>Welcome back :)</strong></p>

<style>

#specify{
	display: none;
}
.productgrid td {
 	width: 50px;
 	border: 1px solid black;
}

.product{

	display: none;
}
#cat-select{
	display: none;
}
</style>

<script type="text/javascript">
	
	var $ = jQuery.noConflict();
	var budget = "notset";
	var email_a_check = $('#emailagencycheck');
	var	email_d_check = $('#emaildirectcheck');
	var	sms_d_check = $('#smsdirectcheck');
	var	sms_a_check = $('#smsagencycheck');
	var notenoughmoneyintotal = false;
	var selectionTotal = {"smsdirect" : 0 ,"smsagency" : 0 ,"emaildirect" : 0 ,"emailagency" : 0  }; //used for calculating total when client selects how much of each he wants
	
	var pricing = [ { "smsdirect" :   {"grid" : [ 
							{"amount":50000, "cost":0.50, "total" :25000} ,
						   {"amount":100000, "cost":0.47, "total" :47000} ,
						   {"amount":150000, "cost":0.45, "total" :67500} ,
						   {"amount":200000, "cost":0.43, "total" :86000} ,
						   {"amount":250000, "cost":0.41, "total" :102500} ,
						   {"amount":3000000, "cost":0.39, "total" :117000} ,
						   {"amount":3500000, "cost":0.37, "total" :129500} ] 
						}
					},

 { "smsagency" :   {"grid" : [ 
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

	{ "emaildirect" :  {"grid" : [ 
							{"amount":30000, "cost":0.5, "total" :15000} ,
						   {"amount":50000, "cost":0.45, "total" :22500} ,
						   {"amount":100000, "cost":0.4, "total" :40000} ,
						   {"amount":300000, "cost":0.35, "total" :105000} ,
						   {"amount":500000, "cost":0.3, "total" :150000} ,
						   {"amount":1000000, "cost":0.25, "total" :250000} ,
						   {"amount":3000000, "cost":0.15, "total" :450000} ] 
						}

					},

	{ "emailagency" :   {"grid" : [ 
							{"amount":30000, "cost":0.59, "total" :17700} ,
						   {"amount":50000, "cost":0.55, "total" :27500} ,
						   {"amount":100000, "cost":0.53, "total" :53000} ,
						   {"amount":300000, "cost":0.46, "total" :138000} ,
						   {"amount":500000, "cost":0.43, "total" :215000} ,
						   {"amount":1000000, "cost":0.39, "total" :390000} ,
						   {"amount":1700000, "cost":0.34, "total" :578000} ] 
						}
					

					}
					]

 	$(document).ready(function(){


 		constructTables(pricing);


 		/*													*/
	 	/*	MAIN CHOICE RADIO BUTTON CHANGE LISTENER		*/
	 	/*													*/
	 			
	 	$(".mainchoice").change(function(){
	 		$('#results').empty();
	 		$("#cat-select").show();
	 		$("#specify").val("") ;
	 		$('.productcheck').removeAttr('checked').triggerHandler('click');
	 		$('.product').hide();
	 		if($(this).val()=="budget"){
	 			$("#specify").show();
	 			$("#cat-select").addClass('budget');
	 			$("#cat-select").removeClass('nobudget');
	 			
	 			budget=true;
	 		}else{
	 			$("#specify").hide();
	 			$("#cat-select").addClass('nobudget');
	 			$("#cat-select").removeClass('budget');
	 			budget=false;
	 		}
	 	});	

	 	/*											*/
	 	/*	PRICE LINE BUTTON CHANGE LISTENER		*/
	 	/*											*/

	 	$(".priceline").change(function(e){

	 		itemindex  = parseInt($(this).attr('value'));
	 		catname = $(this).attr('name');

			$.each( pricing, function(priceindex, catobject){
				 	if(catobject[catname]){
			 			$.each( catobject[catname], function(catindex, priceitems){
			 	 			$.each( priceitems, function(priceitemindex, priceline){
			 	 				if(itemindex ==  priceitemindex){
			 	 					selectionTotal[catname] =  priceline.total;

			 	 				}
			 	 			});
			 	 		}); 
				 	}
			 });

			//update UI //

			update_ui_selection_results();

	 	}); 

	 	function update_ui_selection_results(){
			results = $('#results');
			var total = 0;
			results.empty();
			$.each( selectionTotal, function(cat, catamount){
					total += selectionTotal[cat];
					results.append('<div class="span2">'+ cat +': ' + catamount + '</div>');
			});

			results.append('<div class="span2 total"> Total : ' + total + '</div>');

			if(total==0){
				results.empty();
			}
   
	 	}

	 	function update_ui_budget_results(selectedCategories){
			results = $('#results');
			results.empty();
			results.append('<div class="span2 total"> Number of people: </div>');
			$.each( selectedCategories.data, function(index, obj){

					results.append('<div class="span2">'+ obj.name +': ' + obj.amount + '</div>');
			});

			

			if(selectedCategories.data.length==0){
				results.empty();
			}


	 	}



	/*								*/
 	/*	CATEOGORY CHECKBOX 		 	*/
 	/*	CHANGE LISTENER				*/
 	/*								*/	 	


 		$(".productcheck").change(function(e){

 			var grid = "#" + $(this).val()+"";

 			//which option did they take
 			// this shouldnt be here as if the clint anc check thes check boxes her already chose no budget 
				if(budget==true) {

	 				budgetAmount = $("#budgetAmount").val(); 
	 				if ($(this).is(":checked")){

		 				budgetDivide(budgetAmount,$(this));
		 			
		 			}

	 			}else{	

	 				if ($(this).is(":checked")){

	 					$(grid).show();

	 				}else{

	 					$(grid).hide();
	 					//remove the current category from the results
	 					selectionTotal[$(this).val()] = 0;
	 					radioitem = $(grid +" .priceline") ;
	 					radioitem.attr('checked', false);
	 					update_ui_selection_results();

	 				}
	 			}
 		});

 	/*								*/
 	/*	TAKE THE BUDGET AND 	 	*/
 	/*	DIVIDE IT BETWEEN THE		*/
 	/*	SELECTED CATEGORIES 		*/
 	/*								*/

 	function budgetDivide(amount,checkbox){
 		var checkedcount = 0;
 		var allocations;
 		var selectedCategories = {"data":[]};

 		$('#cat-select input[type=checkbox]').each(function () {
 			//loop through all the check boxes

    		if(this.checked){
    			object =  JSON.parse('{ "' + $(this).val()+ '" : 0  , "id" : "' + $(this).val()+ '", "amount" : 0 , "name": "'+ $(this).prev(".cb-lable").text() +'"  }');
    			selectedCategories.data.push(object);
    		}
		});

		divided = amount/selectedCategories.data.length;

 		for (index in selectedCategories.data){
 			cat = selectedCategories.data[index]["id"];
			selectedCategories.data[index][cat] = divided;
		}



 		selectedCategories = calculate_amounts(selectedCategories);

 		

 		//update UI
 		update_ui_budget_results(selectedCategories);
		return true;

 	}
 	/*										*/
 	/*	CALCULATE HOW MUCH OF 			 	*/
 	/*	EACH SELECTED CATEGORY THE USER		*/
 	/*	CAN PURCHASE WITH THEIR BUDGET		*/
 	/*										*/

 	function calculate_amounts(selectedCategories){
 		var previoustotal = 0;
 		var previouscost = 0.0;
 		var previousamount = 0;

 		for (index in selectedCategories.data){
 			var catamount = 0;
 			var allocated = false;
 			var catname = selectedCategories.data[index]["id"];
 			var catbudget = selectedCategories.data[index][catname];
			$.each( pricing, function(priceindex, catobject){
			 	if(catobject[catname]){
		 			$.each( catobject[catname], function(catindex, priceitems){
		 				allocated = false;	
				 	 	previoustotal = 0;
 						previouscost = 0;
 						previousamount = 0;

		 	 			$.each( priceitems, function(priceitemindex, priceline){

		 	 				if(  catbudget > priceline.total ){

		 	 						previoustotal = priceline.total;
		 	 						previouscost = priceline.cost;
		 	 						previousamount = priceline.amount;
		 	 				}else if(catbudget ==  priceline.total){

			 	 					catamount = priceline.amount;
			 	 					allocated = true;
		 	 				}else{

		 	 					if(!allocated){
			 	 					catamount = previousamount;
			 	 					catamount += (catbudget - previoustotal) /  priceline.cost;
			 	 					allocated = true;
		 	 					}
		 	 				
		 	 				}
		 	 				
		 	 			});

		 	 			if(!allocated){
		 	 				catamount = catbudget /  previouscost;
		 	 			}

		 	 			selectedCategories.data[index]["amount"] = Math.floor(catamount) ;

		 	 		}); 
			 	}
		 	});
		 }	

		return	selectedCategories;	
	}	

 	/*								*/
 	/*	BUILD PRICING TABLE 		*/
 	/*	FOR CLIENT TO SELECT		*/
 	/*	FROM						*/
 	/*								*/
 	function constructTables(pricingdata){
 		productarea = $('#productgrids');
 		//creat a list of items to reference
 		categories = new Array();
		categories['smsdirect'] = "SMS Direct";
		categories['smsagency'] = 'SMS Agency';
		categories['emaildirect'] = 'Email Direct';
		categories['emailagency'] = 'Email Agency';


		for (var catname in categories) {
			productarea.append('<div class="product span2"  id="'+catname+'">');
			productarea.children('#'+catname).append('<h6>'+categories[catname] +'</h6>');
			productarea.children('#'+catname).append('<table class="productgrid" id="'+catname+'table">');
			$.each( pricing, function(priceindex, catobject){

			 	if(catobject[catname]){
		 			$.each( catobject[catname], function(catindex, priceitems){
		 	 			$.each( priceitems, function(priceitemindex, priceline){
		 	 				productarea.children('.product').children('#'+catname+'table').append('<tr> <td> <input type="radio" class="priceline" name="'+catname+'" value="'+priceitemindex+'" /> </td><td>'+priceline.amount +'</td><td>'+priceline.cost +'</td><td>'+priceline.total +'</td></tr>'); 
		 	 			});
		 	 		}); 
			 	}

		 	});
				productarea.append('</table>');
			 	productarea.append('</div>');
		 }

 	}

 			
 });
</script>
</head>

<body <?php echo body_class(); ?>>

<div id="wrap">

<h6>Make your selection below:</h6>
 <div id="mainchoice" >
 	<form name="mainchoice">

 		<div>I own the bank <input class="mainchoice" type="radio" name="mainchoiceoptions" value="nobudget"> </div>
 		<br />
 		<div> I'm on a budget  <input class="mainchoice" type="radio" name="mainchoiceoptions" value="budget"> 

 					<div id="specify"> Specify your budget: R <input type="text" name="budgetAmount" id="budgetAmount"/> </div>

 			</div>
 	</form>	
</div>

 <div id="cat-select" >
 	<h4>Select the categories you would like to target:</h4>

 	<form name="cat-options">

 		<div><lable class="cb-lable">SMS Direct</lable> <input type="checkbox" name="select-cat" class="productcheck" id="smsdirectcheck" value="smsdirect"> </div>
 		<br />
 		<div><lable class="cb-lable">SMS Agency</lable> <input type="checkbox" name="select-cat" class="productcheck" id="smsagencycheck" value="smsagency"> </div>
 		<br />
 		<div><lable class="cb-lable">Email Direct</lable> <input type="checkbox" name="select-cat" class="productcheck" id="emaildirectcheck" value="emaildirect"> </div>
 		<br />
 		<div><lable class="cb-lable">Email Agency</lable><input type="checkbox" name="select-cat" class="productcheck" id="emailagencycheck" value="emailagency"> </div>
 	</form>	
</div>

<div id="results" class="row">

</div>	


<div id="productgrids" class="row">

</div>	


	<?php //tylUser(); ?>


</div>

	</div><!-- login -->
	
	<div class="tab-pane" id="profile">
		<?php gravity_form(2, false, false, '', '', true, ''); ?>
	</div><!-- register -->
</div>

