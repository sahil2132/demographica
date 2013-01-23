var $ = jQuery.noConflict();

	var budget = "notset";
	var email_a_check = $('#emailagencycheck');
	var	email_d_check = $('#emaildirectcheck');
	var	sms_d_check = $('#smsdirectcheck');
	var	sms_a_check = $('#smsagencycheck');
	var notenoughmoneyintotal = false;
	var selectionTotal = {"smsdirect" : 0 ,"smsagency" : 0 ,"emaildirect" : 0 ,"emailagency" : 0  }; //used for calculating total when client selects how much of each he wants
	
	var pricing = [ 
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
	]


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
			$('#specify').keyup( function(e) {

				var budgetAmount = $(this).val();
				
			    if (budgetAmount != 'undefined') {
					$("#cat-select").show();
		 			$("#cat-select").addClass('budget');
		 			$("#cat-select").removeClass('nobudget');

		 			budget=true;
		 			console.log(budgetAmount);
		 			
		 		}
	 		});


	 	/*											*/
	 	/*	PRICE LINE BUTTON CHANGE LISTENER		*/
	 	/*											*/

		// set the value of the radio to 'checked' when a tr is clicked
		$('.product tr').click(function() {
			itemindex  = $(this).attr('data-index');
	 		catname = $(this).attr('data-name');
	 		
	 		$(this).find('.priceline').attr('name');
			
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
					results.children('.thetotals').children('.totalstable').append('<tr><th class="totalsitem">'+cat+'</td><td>'+catamount+'</td></tr>');
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
			results.append('<div class="span12 total"> Number of people: </div>');
			$.each( selectedCategories.data, function(index, obj){

					results.append('<div class="span12">'+ obj.name +': ' + obj.amount + '</div>');
			});

			

			if(selectedCategories.data.length==0){
				results.empty();
			}


	 	}



	/*								*/
 	/*	CATEOGORY CHECKBOX 		 	*/
 	/*	CHANGE LISTENER				*/
 	/*								*/	 	

 		// var for the layout of the tables
 		var totalTables = '0';
 		var tablesCount = '12';
 		
		// add the initial full-width class (cos there'll be 1 to start with), and then hide it again until the user clicks his first option
		$('.product').addClass('span'+tablesCount).hide();
 		
 		$(".productcheck").live('change',function(e){

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
	 		$('.product:visible').each( function () {
		 		$('.product').addClass('span'+tablesCount);
	 		})
	 		
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
		
		for (var catname in categories) {
			productarea.append('<form class="product" id="'+catname+'"><fieldset>');
			productarea.children('#'+catname).append('<legend>'+categories[catname] +'</legend>');
			productarea.children('#'+catname).append('<table class="productgrid table table-condensed table-hover table-striped table-bordered" id="'+catname+'table"><tr><th>Amount</th><th>Cost per</th><th>Total Cost</th></tr>');
			$.each( pricing, function(priceindex, catobject){

			 	if(catobject[catname]){
		 			$.each( catobject[catname], function(catindex, priceitems){
		 	 			$.each( priceitems, function(priceitemindex, priceline){
		 	 				// DWAIN - ENABLE THIS COMMENTED OUT LINE, ONCE YOU CAN FIGURE OUT HOW TO GET THE $.number() PLUGIN TO WORK
		 	 				//productarea.children('.product').children('#'+catname+'table').append('<tr> <td> <input type="radio" class="priceline" name="'+catname+'" value="'+priceitemindex+'" /> </td><td>'+ $.number(priceline.amount, 2) +'</td><td>'+$.number(priceline.cost, 2) +'</td><td>'+$.number(priceline.total, 2) +'</td></tr>'); 
		 	 				productarea.children('.product').children('#'+catname+'table').append('<tr data-name="'+catname+'" data-index="'+priceitemindex+'"><td>'+priceline.amount +'</td><td>'+priceline.cost +'</td><td>'+priceline.total +'</td></tr>');
		 	 			});
		 	 		}); 
			 	}

		 	});
			productarea.append('</table>');
		 	productarea.append('</fieldset></form>');
		 }

 	}


 	// append the alert to tell the user how to choose a product
 	//$('#productgrids').before('<div class="alert alert-info row-fluid"><strong>Note:</strong> Please choose which product(s) you\'d like to purchase.</div>');


 			
});