var $ = jQuery.noConflict(); $(document).ready(function(){

	// forms
		
		$('.gform_wrapper .btn').live('click', function() {
			$('.validation_error').addClass('alert alert-info');
		});
		
	// tabs
		$('#usertools a').not('.logoutlink').click(function () {
			target = $(this).attr('data-target');
			
			$('#usertools li').removeClass('active');
			$(this).parent().addClass('active');
			
			if (target) {
				$('.tab-pane').hide();
				$('#'+target).show().addClass('active');;
			}
			
			return false;
		})

});