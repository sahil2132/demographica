/* Author: Nicework (JP Jenkinson)
 * 
 */

$(document).ready(function(){
	pinkOpen = false;
	$('#pink-tab').click(function() {
		if (pinkOpen) {
			$("#side-box").animate({width:120},"slow");
			$("#side-box-popout").animate({width:0},"slow", function() {
				$("#side-box-popout .text").hide();
			});
			pinkOpen = false;
		} else {
			$("#side-box").animate({width:420},"slow");
			$("#side-box-popout").animate({width:300},"slow");
			$("#side-box-popout .text").show();
			pinkOpen = true;
		}
	});
	
	$('#ns_widget_mailchimp-email-3').val('your email');
	
	$('#ns_widget_mailchimp-email-3').focus(function() {
		if($('#ns_widget_mailchimp-email-3').val() === 'your email') {
			$('#ns_widget_mailchimp-email-3').val('');
		}
	});
	
	$('#ns_widget_mailchimp-email-3').blur(function() {
		if ($('#ns_widget_mailchimp-email-3').val() === '') {
			$('#ns_widget_mailchimp-email-3').val('your email');
		}
	});
	
	$('#ns_widget_mailchimp-email-2').val('your email');
	
	$('#ns_widget_mailchimp-email-2').focus(function() {
		if($('#ns_widget_mailchimp-email-2').val() === 'your email') {
			$('#ns_widget_mailchimp-email-2').val('');
		}
	});
	
	$('#ns_widget_mailchimp-email-2').blur(function() {
		if ($('#ns_widget_mailchimp-email-2').val() === '') {
			$('#ns_widget_mailchimp-email-2').val('your email');
		}
	});
	
	$('.dollop').click(function(e) {
		if ($(this).attr('href') === '#newsletterdropdown') {
			e.preventDefault();
			$('.header-newsletter').slideToggle('fast');
		}
	});
	
	$('.close-btn-blue').click(function(e) {
		e.preventDefault();
		$('.header-newsletter').slideUp('fast');
	});
	
	$('.close-btn-pink').click(function(e) {
		e.preventDefault();
		$("#side-box").animate({width:120},"slow");
		$("#side-box-popout").animate({width:0},"slow", function() {
			$("#side-box-popout .text").hide();
		});
		pinkOpen = false;
	});
	
	$('a').click(function(e){
		if ($(this).attr('href') === '#popupcasestudy') {
			e.preventDefault();
			$('#case-study-container').fadeIn();
			$('#case-study-container .main-hover').html('<iframe width="960px" height="500px" frameborder="0" src="http://demographica.nicework.co.za/?page_id=233"></iframe><div id="close-popup"></div>');
		}
	});
	
	$('#case-study-container').click(function(event) {
		event.preventDefault();
		$('#case-study-container').fadeOut();
	});
	
	$('#close-popup').click(function() {
		$('#case-study-container').fadeOut();
	});
	
	$('#main-menu .parent').mouseover(function() {
		$(this).children('.sub-menu').show();
	});
	
	$('#main-menu .parent').mouseout(function() {
		$(this).children('.sub-menu').hide();
	});
	
	//job deploy button
	$('.job-link').click(function(e) {
		e.preventDefault();
		$(this).siblings('.job-content').slideToggle();
		if ($(this).hasClass('arrow-side')) {
			$(this).removeClass('arrow-side');
			$(this).addClass('arrow-down');
		} else {
			$(this).addClass('arrow-side');
			$(this).removeClass('arrow-down');
		}
	});
	
	//solutions deploy button
	$('.solutions-dropdown').click(function(e) {
		e.preventDefault();
		$(this).siblings('.solutions-post-content').slideToggle();
		if ($(this).children().hasClass('arrow-side')) {
			$(this).children().removeClass('arrow-side');
			$(this).children().addClass('arrow-down');
		} else {
			$(this).children().addClass('arrow-side');
			$(this).children().removeClass('arrow-down');
		}
	});
	
	//solutions deploy button
	$('.case-studies-dropdown').click(function(e) {
		e.preventDefault();
		$(this).siblings('.case-studies-post-content').slideToggle();
		if ($(this).children().hasClass('arrow-side')) {
			$(this).children().removeClass('arrow-side');
			$(this).children().addClass('arrow-down');
		} else {
			$(this).children().addClass('arrow-side');
			$(this).children().removeClass('arrow-down');
		}
	});
	
	//var original_image = 'url(http://www.demographica.co.za/images/drop.png)';
	//var second_image = 'url(http://www.demographica.co.za/images/down.png)'; 
	
	//$('#apply-positions .post-meta-key').click(function() {
	//	$(this).next('ul').slideToggle('fast');
	//	if ($(this).css('background-image').replace(/"/g, '') == original_image) {
	//		$(this).css('background-image', second_image);
	//	} else {
	//		$(this).css('background-image', original_image);
	//	} 
	//});
	
});