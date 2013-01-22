var $ = jQuery.noConflict(); $(document).ready(function(){

	// gforms
		
		$('.gform_wrapper .btn').live('click', function() {
			$('.validation_error').addClass('alert alert-info');
		});

	// tabs
	
		$('.nav-tabs a').click(function() { $(this).tab('show'); return false; });





		
		/*************************************/
		/*	Category Selection Logic:		*/
		/***********************************/
			var data = [ "A", "B", "C" ];
		 
				// Pop the element off of the end of the array.
	
					console.log( data.pop() );
					console.log( data );
					var budget = "notset";
					var email_a_check = $('#emailagencycheck');
					var	email_d_check = $('#emaildirectcheck');
					var	sms_d_check = $('#smsdirectcheck');
					var	sms_a_check = $('#smsagencycheck');
					var notenoughmoneyintotal = false;
				
					var pricing = [ 
						{ "smsdirect" :   {"grid" : [ 
							{"amount":30000, "cost":0.5, "total" :15000} ,
							{"amount":50000, "cost":0.45, "total" :22500} ,
							{"amount":100000, "cost":0.4, "total" :40000} ,
							{"amount":300000, "cost":0.35, "total" :105000} ,
							{"amount":500000, "cost":0.3, "total" :150000} ,
							{"amount":1000000, "cost":0.25, "total" :250000} ,
							{"amount":3000000, "cost":0.15, "total" :450000}
							]}
						},
				
						{ "smsagency" : {"grid" : [ 
							{"amount":30000, "cost":0.5, "total" :15000} ,
							{"amount":50000, "cost":0.45, "total" :22500} ,
							{"amount":100000, "cost":0.4, "total" :40000} ,
							{"amount":300000, "cost":0.35, "total" :105000} ,
							{"amount":500000, "cost":0.3, "total" :150000} ,
							{"amount":1000000, "cost":0.25, "total" :250000} ,
							{"amount":3000000, "cost":0.15, "total" :450000}
							]}
						},
						
						{ "emaildirect" :  {"grid" : [ 
							{"amount":30000, "cost":0.5, "total" :15000} ,
							{"amount":50000, "cost":0.45, "total" :22500} ,
							{"amount":100000, "cost":0.4, "total" :40000} ,
							{"amount":300000, "cost":0.35, "total" :105000} ,
							{"amount":500000, "cost":0.3, "total" :150000} ,
							{"amount":1000000, "cost":0.25, "total" :250000} ,
							{"amount":3000000, "cost":0.15, "total" :450000}
							]}
						},
						
						{ "emailagency" :   {"grid" : [ 
							{"amount":30000, "cost":0.5, "total" :15000} ,
							{"amount":50000, "cost":0.45, "total" :22500} ,
							{"amount":100000, "cost":0.4, "total" :40000} ,
							{"amount":300000, "cost":0.35, "total" :105000} ,
							{"amount":500000, "cost":0.3, "total" :150000} ,
							{"amount":1000000, "cost":0.25, "total" :250000} ,
							{"amount":3000000, "cost":0.15, "total" :450000}
							]}
						}
					]
		
		
			$(".productcheck").change(function(e){

	 			grid = "#" + $(this).val()+"";
	 			$(grid).toggle();
	
	 			//which option did they take
	 			// this shouldnt be here as if the clint anc check thes check boxes her already chose no budget 
	 			if(budget=="notset"){
	 					alert('please select an option on top');
	 					$(grid).hide();
	 					$(this).prop('checked',false);
	
	 			}else if(budget==true) {
	 				budgetAmount = $("#budgetAmount").val(); 
	 				budgetDivide(budgetAmount,$(this));
	 			}else{	
	 				costCalc();
	 			}
	
	 		});
 		

		 	function budgetDivide(amount,checkbox){
		 		var checkedcount = 0;
		 		moneypockets = new Array();
		 		
		 		//how many and what is checked
		 		if($('#smsdirectcheck').is(':checked')){
		 			checkedcount++;
		 			moneypockets['smsdirect'] = 0;
		 		} 
		 		if($('#smsagencycheck').is(':checked')){
		 			checkedcount++;
		 			moneypockets['smsagency'] = 0;
		 		} 
				if($('#emaildirectcheck').is(':checked')){
		 			checkedcount++;
		 			moneypockets['emaildirect'] = 0;
		 		} 
		 		if($('#emailagencycheck').is(':checked')){
		 			checkedcount++;
		 			moneypockets['emailagency'] = 0;
		 		} 
		
		 		// the funds are allocated is in order of the layout
		 		// budget - (sum(selectedchaneltotals));
		
		 		//split money btween categories
		
				  if(allocatefunds(moneypockets,amount,checkedcount).length < 1){
				  	//moneypockets
				  	console.log('length less than 1');
				  	//decrease pockets
				  	temp = new Array();
				  	i = 0;
					for(cat in moneypockets){
						temp[i] = new Array();
						console.log(moneypockets[cat]);
			 			temp[i][cat] = moneypockets[cat] + (moneypockets[cat]/(checkedcount-1));
			 			console.log('tempinsideloop:');
			 			console.log(temp);
			 			i++;
			 		}
		
			 		console.log("temp before pop: "+ temp);
			 		temp.pop();
		 			console.log("temp after pop: "+ temp);
			 		$.each( temp, function(index, tempobjs){
		 				 console.log("each: "+ tempobjs);
					});
		
			 		//console.log(moneypockets);
			 		removed = moneypockets.splice(1, 1);
			 		//console.log('afterpop');
			 		//console.log(removed);
				  	checkedcount= checkedcount - 1; 
		
		
				  }
				 
				// console.log("FINISH!");
				 if(notenoughmoneyintotal){
		
				 	alert('the amount you enetered wont allow you to buy anyhthing at all');
				 	$(grid).hide();
			 		checkbox.prop('checked',false);
				 }
				 // after not enough run it through with less cateogries
		 		//console.log(moneypockets);
		 		//assign to categories
		
		 		// if less or more than category go to the closest met amount an transfer the rest 
		
		
		 	}	

		 	function costCalc(){
		 		console.log('Cost calc');
		 	}	

		 	function reallocate(moneypockets,count) {
		 		//console.log('reallocate');
		 		//console.log(message);
		
		 		// return new object
		 	}
 	
		 	function allocatefunds(moneypockets,amount,checkedcount){
		 		eqaulysplittedamount = amount /  checkedcount; 
		 		notenough = new Array();
		 		previoustotal = 0;
		 		previouscost = 0.0;
		 		previousamount = 0;
		 		leftover = new Array();
		 		allocations = new Array();
				for (catname in moneypockets){
					moneypockets[catname] = eqaulysplittedamount;
					$.each( pricing, function(priceindex, catobject){
					 	if(catobject[catname]){
				 			$.each( catobject[catname], function(catindex, priceitems){
				 	 			$.each( priceitems, function(priceitemindex, priceline){
		
				 	 				if(  priceline.total >= moneypockets[catname] && priceitemindex ==0)
				 	 				{
		
				 	 					//if total can not buy anything ->> no good total
		 		 	 					if( priceline.total == moneypockets[catname])
				 	 					{
				 	 					// check if the total can buy anything befor dividing it
					 	 					if( priceline.total > amount ){
					 	 						notenoughmoneyintotal = true;
					 	 					}
					 						previoustotal = priceline.total;
				 	 						previouscost = priceline.cost;
				 	 						previousamount = priceline.amount;
				 	 						return true;
				 	 					}else{
				 	 						notenough[catname] = true;
		
				 	 						return false;
				 	 					}
		
				 	 				}else if( priceline.total > moneypockets[catname] && priceitemindex > 0 ){
				 	 					//console.log(catname+" matching "+ (priceitemindex-1));
				 	 					//console.log(previoustotal);
				 	 					currentamount = 0;
		
				 	 					//check if the previous item was the first one
				 	 					if(previoustotal!=0){
				 	 						leftover[catname] = moneypockets[catname] - previoustotal;
				 	 						currentamount = (moneypockets[catname] - previoustotal) * priceline.cost;
				 	 						linenumber = priceitemindex;
				 	 					}else{
				 	 						currentamount = priceline.amount;
				 	 						linenumber = priceitemindex -1;
				 	 					}
		
				 	 					// add number of people reached on this chanel
										 
				 	 					amount =  previousamount + currentamount;
		
				 	 					allocations[catname] = new Array();
				 	 					allocations[catname]["linenumber"] = linenumber;
				 	 					allocations[catname]["total"] = moneypockets[catname];
				 	 					allocations[catname]["amount"] = amount;
				 	 					console.log(moneypockets);
				 	 					return false;
				 	 				}else{
				 	 					//console.log('continue');
				 	 					previoustotal = priceline.total;
				 	 					previouscost = priceline.cost;
				 	 					previousamount = priceline.amount;
		
				 	 				}
				 	 			});
				 	 		}); 
					 	}
				 	});
				 }
				 //set the numbe of categories allocated 
				 counter=0;
				 for (x in allocations) {
				 	counter++;
				 }
				 allocations.length = counter;
				 console.log("infunctionlength: "+allocations.length);
				 return allocations;
				}		
		
			 	$(".mainchoice").change(function(){
			
			 		if($(this).val()=="budget"){
			 			$("#specify").show();
			 			$("#cat-select").show();
			 			$("#cat-select").addClass('budget');
			 			$("#cat-select").removeClass('nobudget');
			 			 
			 			budget=true;
			 		}else{
			 			$("#specify").hide();
			 			$("#cat-select").show();
			 			$("#cat-select").addClass('nobudget');
			 			$("#cat-select").removeClass('budget');
			 			budget=false;
			 		}
			 		console.log();
			 	});	
		 	});







});