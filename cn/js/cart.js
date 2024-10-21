jQuery(document).ready(function(){
		
	jQuery(document).on('favorites-updated-single', function(event, favorites, post_id, site_id, status){
		if(typeof favorites != 'undefined')
		{
			jQuery('#phone').unmask().mask('000-000-000');
			jQuery("#phone").trigger('input');
	
			jQuery.ajax({
				url: ajaxcart.ajaxurl,
				type: 'post',
				data: {
					action: 'ajax_cart'
				},
				beforeSend: function() {
					jQuery('.cart-ajax-content').addClass('loading');
				},
				success: function(data) {
					jQuery('.cart-ajax-content').html(data);
					jQuery('.cart-ajax-content').removeClass('loading');
					
					var value = jQuery('#phone').val();
					jQuery('#phone').unmask().mask('000-000-000');
					jQuery("#phone").val(value).trigger('input');
					
				},
				error: function() {
					jQuery('.cart-ajax-content').removeClass('loading');
					alert("Error");
				}
			});
		}
	});
	
	jQuery(document.body).on('click', 'input[type=radio][name=payment_option], input.extra-video-input, input[type=radio][name=check_group], input[type=radio][name=check_sibling]', function() {
		if(jQuery(this).hasClass('active-radio'))
		{
			jQuery(this).prop('checked', false);
		}
		jQuery(this).not('[name=payment_option]').toggleClass('active-radio');
		ajax_cart();
	});
	
	jQuery(document.body).on('change', 'select[name=count_year]', function() {
		ajax_cart();
	});
	
	jQuery(document.body).on('click', '.extra-subject-check', function() {
		var cart_count = jQuery('.col-cart-subject');
		var extra_subject_check = jQuery('.extra-subject-check:checked');
		if(extra_subject_check.length > cart_count.length)
		{
			jQuery(this).prop('checked', false);
			alert('Możesz wybrać tylko ' + cart_count.length + ' opcje');
		}
	});
	
	jQuery(document.body).on('click', '.extra-subject-check', function() {
		jQuery('.extra-subject-none').prop('checked', false);
	});
	
	jQuery(document.body).on('click', '.extra-subject-none', function() {
		jQuery('.extra-subject-check').prop('checked', false);
	});
	
	jQuery(document.body).on('change', 'input#term_all', function() {
		var checkBoxes = jQuery('.cart-content .step-cart .step-cart-input p.term input').not('input#term_all');
		checkBoxes.attr('checked', !checkBoxes.attr('checked'));
	});
	
});

function ajax_cart() {	
	jQuery.ajax({
		url: ajaxcart.ajaxurl,
		type: 'post',
		data: {
			action: 'ajax_cart',
			data: jQuery('#cart-form').serializeArray()
		},
		beforeSend: function() {
			jQuery('.cart-ajax-content').addClass('loading');
		},
		success: function(data) {
			jQuery('.cart-ajax-content').html(data);
			jQuery('.cart-ajax-content').removeClass('loading');
			
			var value = jQuery('#phone').val();
			jQuery('#phone').unmask().mask('000-000-000');
			jQuery("#phone").val(value).trigger('input');
			
		},
		error: function() {
			jQuery('.cart-ajax-content').removeClass('loading');
			alert("Error");
		}
	});
}