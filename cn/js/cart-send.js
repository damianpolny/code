jQuery(document).ready(function(){
	
	jQuery(document.body).on('submit', '#cart-form', function(event){
		
		event.preventDefault();
		
		if(jQuery('input#email').val() == jQuery('input#repeat_email').val())
		{
			jQuery.ajax({
				url: ajaxsendcart.ajaxurl,
				type: 'post',
				data: {
					action: 'ajax_send_cart',
					data: jQuery(this).serializeArray()
				},
				beforeSend: function() {
					jQuery('.cart-ajax-content').addClass('loading');
				},
				success: function(data) {
					if(data != 0)
					{
						jQuery('.page-wraper img.wp-post-image').remove();
						jQuery('.cart-ajax-content').html(data);
						jQuery('button.simplefavorites-clear').trigger('click');
						jQuery('html, body').animate({scrollTop: 0}, 'slow');
					}
					else
					{
						alert('Błąd wysyłania formularza. Spróbój jeszcze raz.');
					}
					jQuery('.cart-ajax-content').removeClass('loading');
				},
				error: function() {
					jQuery('.cart-ajax-content').removeClass('loading');
					alert("Error");
				}
			});
		}
		else
		{
			alert('Wpisane adresy email różnią się.');
		}		
	});
	
});