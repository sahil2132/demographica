var $ = jQuery.noConflict();
	

	var pricing = php_data_price ; // data loaded in <script> tags of pag-tyl_order.php
	var budget = "notset";
	var email_a_check = $('#emailagencycheck');
	var	email_d_check = $('#emaildirectcheck');
	var	sms_d_check = $('#smsdirectcheck');
	var	sms_a_check = $('#smsagencycheck');
	var notenoughmoneyintotal = false;
	var selectionTotal = {"smsdirect" : 0 ,"smsagency" : 0 ,"emaildirect" : 0 ,"emailagency" : 0  }; //used for calculating total when client selects how much of each he wants
	
	

 	$(document).ready(function(){

 		constructTables(pricing);


 	
 	
 		/*													*/
	 	/*	MAIN CHOICE RADIO BUTTON CHANGE LISTENER		*/
	 	/*													*/
	 			
	 	$(".mainchoice").change(function(){
	 		$('#results').empty();
	 		$("#specify").val("") ;
	 		$('.productcheck').removeAttr('checked').triggerHandler('click');
	 		$('.product').hide();
	 		
	 		if($(this).val()=="budget"){
	 			/* cat select function below - checks to see if budget specified */
	 			$("#specify").show();
	 		}else{
	 			$("#cat-select").show();
	 			$("#specify").hide();
	 			$("#cat-select").addClass('nobudget');
	 			$("#cat-select").removeClass('budget');
	 			budget=false;
	 		}
	 	});	
	 	
	 		// only show cat-select once value is specified
			$('#specifyupdate').live('click',function() {

 				budgetAmount = $("#budgetAmount").val(); 
				
			    if (budgetAmount != 'undefined') {
					$("#cat-select").show();
		 			$("#cat-select").addClass('budget');
		 			$("#cat-select").removeClass('nobudget');

		 			budget=true;
		 		}
		 		
 				budgetDivide(budgetAmount,$(this));
		 		
		 		return false;
	 		});
	 		

	 	/*											*/
	 	/*	PRICE LINE BUTTON CHANGE LISTENER		*/
	 	/*											*/

		// set the value of the radio to 'checked' when a tr is clicked
		$('.product tr').click(function() {
			itemindex  = $(this).attr('data-index');
	 		catname = $(this).attr('data-name');
	 		
	 		$(this).find('.priceline').attr('name');
			
			$.each( pricing, function(price_catname, catobject){
			 	if(price_catname==catname){
		 			$.each( catobject, function(linendex, priceitems){
		 			//	
		 	 			$.each( priceitems, function(priceitemindex, priceline){

		 	 				if(itemindex ==  priceitemindex){
		 	 					selectionTotal[catname] =  priceline.total;

		 	 				}
		 	 			});
		 	 		}); 
			 	}
			 });


			//update UI //

			$('.orderconfirm').show();			

			$(this).parent().find('tr').removeClass('success');
			$(this).addClass('success');

			update_ui_selection_results();

	 	}); 



	 	function update_ui_selection_results(){
	 		results = $('#results');

			var total = 0;
			results.empty();

			results.append('<form class="thetotals row-fluid"><fieldset><legend>Transaction Total</legend>');
			results.children('.thetotals').append('<table class="totalstable table table-condensed"><thead><tr><th>Item</th><th>Amount</th></tr></thead><tbody>');
	 		
			$.each( selectionTotal, function(cat, catamount){
					total += selectionTotal[cat];
					results.children('.thetotals').children('.totalstable').append('<tr><td class="totalsitem">'+cat+'</td><td>'+catamount+'</td></tr>');
			});
			
			results.children('.thetotals').children('.totalstable').append('</tbody><tfoot><tr class="finaltotal"><td>&nbsp;</td><th>'+total+'</th></tr></tfoot>');
			
			results.append('</table>');
		 	results.append('</fieldset></form>');
	
			if(total==0){
				results.empty();
			}			
	 	}




	 	function update_ui_budget_results(selectedCategories){
	 	
			results = $('#results');
			results.empty();

			$.each( selectedCategories.data, function(index, obj){
				results.append('<form class="span6 budget_results"><fieldset><legend>'+obj.name+'</legend><div class="budget_count"><i class="icon-user"></i>'+obj.amount+' <small>recipients</small></div></fieldset></form>');
			});

			$('.budget_results:eq(0), .budget_results:eq(1)').wrapAll('<div class="row-fluid results_row" />');
			$('.budget_results:eq(2), .budget_results:eq(3)').wrapAll('<div class="row-fluid results_row" />');

			
			if(selectedCategories.data.length==0){
				results.empty();
			} else {
			
				// build the totals form
				results.append('<form class="thetotals row-fluid"><fieldset><legend>Transaction Total</legend>');
				results.children('.thetotals').append('<table class="totalstable table table-condensed"><thead><tr><th>Item</th><th>Amount</th></tr></thead><tbody>');
				results.children('.thetotals').children('.totalstable').append('<tr><td class="totalsitem">Online Marketing</td><td>'+budgetAmount+'</td></tr>');
				results.children('.thetotals').children('.totalstable').append('</tbody><tfoot><tr class="finaltotal"><td>&nbsp;</td><th>'+budgetAmount+'</th></tr></tfoot>');
				results.append('</table>');
			 	results.append('</fieldset></form>');
				
				$('.orderconfirm').show();
			}
			
	 	}



	/*								*/
 	/*	CATEOGORY CHECKBOX 		 	*/
 	/*	CHANGE LISTENER				*/
 	/*								*/	 	

 		// var for the layout of the tables
 		var totalTables = '0';
 		var tablesCount = '12';
 		
 		$(".productcheck").live('change',function(e){

 			var grid = "#" + $(this).val()+"";

				if(budget==true) {

	 				budgetAmount = $("#budgetAmount").val(); 
	 				budgetDivide(budgetAmount,$(this));

	 			}else{	

	 				if ($(this).is(":checked")){

	 					$(grid).show();
	 					
	 					totalTables = ++ totalTables;

	 				}else{

	 					$(grid).hide();
	 					//remove the current category from the results
	 					selectionTotal[$(this).val()] = 0;
	 					radioitem = $(grid +" .priceline") ;
	 					radioitem.attr('checked', false);
	 					update_ui_selection_results();
	 					
	 					totalTables = -- totalTables;

	 				}
	 			}
	 		
	 		// count how many options are selected, devide by 12 = spanX <-- the correct bootstrap class applied...
	 		var tablesCount = 12 / totalTables;
	 		$('.product').removeClass('span12').removeClass('span6').removeClass('span4').removeClass('span3');
	 		$('.product').not(':hidden').addClass('span'+tablesCount);
	 		
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
    			object =  JSON.parse('{ "' + $(this).val()+ '" : 0  , "id" : "' + $(this).val()+ '", "amount" : 0 , "name": "'+ $(this).parent().text() +'"  }');
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

			$.each( pricing, function(price_catname, catobject){
			 	if(catname == price_catname ){
		 			$.each( catobject, function(catindex, priceitems){
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
		 	 				catamount = catbudget / previouscost;
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
 		
 		// create a list of items to reference
 		categories = new Array();
		categories['smsdirect'] = "SMS Direct";
		categories['smsagency'] = 'SMS Agency';
		categories['emaildirect'] = 'Email Direct';
		categories['emailagency'] = 'Email Agency';
		
		//for (var catname in categories) {

			$.each( pricing, function(catname, catobject){
				productarea.append('<form class="product" id="'+catname+'"><fieldset>');
				productarea.children('#'+catname).append('<legend>'+categories[catname] +'</legend>');
				productarea.children('#'+catname).append('<table class="productgrid table table-condensed table-hover table-striped table-bordered" id="'+catname+'table"><tr><th>Amount</th><th>Cost per</th><th>Total Cost</th></tr>');
			 		
		 			$.each( catobject, function(priceitemindex, priceitems){
		 	 			$.each( priceitems, function(priceitemindex, priceline){
						productarea.children('.product').children('#'+catname+'table').append('<tr data-name="'+catname+'" data-index="'+priceitemindex+'"><td>'+formatnum(priceline.amount, 2)+'</td><td>'+ formatnum(priceline.cost, 2) +'</td><td>'+formatnum(priceline.total, 2) +'</td></tr>');
		 	 			});
		 	 		}); 

		 	});
			productarea.append('</table>');
		 	productarea.append('</fieldset></form>');

 	}

 	/*													*/
 	/*	Format amount function 							*/
 	/*	arguments number and the number or 				*/	
 	/*	decimal places wanted							*/	
 	/*													*/	
 	function formatnum(number, decimalplaces){

 			var decimal = ".00" ;
 			var amount ;
 			var formatedamount = "";
 			var parts ; 
 			var powerholder;

 			parts = String(number).split(".");

 			//string format to have space after every third character
 			amount = parts[0];
 			amountparts = String(amount).split("");
 			var tempstring = new Array();
 			var counter = 0;
 			for(i=amountparts.length-1; i >= 0 ; i--){
 				counter++;
 				if(counter%3==0)
 				{	
 					tempstring[i] = " " + amountparts[i];

 				}else{

 					tempstring[i] = amountparts[i];
 				}

 			}

 			for(i=0; i < tempstring.length; i++){

 				formatedamount += tempstring[i];
 			}

 			//Decimal places calculations
 			if(parts.length > 1){ // check if it has a decimal part
 				decimal = parseFloat("0."+ parts[1]); 		

 				//set decimal places 
 				powerholder = Math.pow(10,decimalplaces);
 				decimal =  Math.round(decimal*powerholder)/powerholder; 
 				decimal = "." + String(decimal).split(".")[1];	
 			}

 			return formatedamount + decimal;
 	}

 	
 	$('#termsagree').live('click',function() {
	 	if ( $(this).is(':checked') ) {
		 	$('#paymentbutton').removeAttr('disabled');
	 	} else {
		 	$('#paymentbutton').attr('disabled', 'disabled');
	 	}
 	});

 			
});