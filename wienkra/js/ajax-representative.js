jQuery(document).ready(function(){
  jQuery('.terms-inline-button ul li a').click(function(){
    var term_id = jQuery(this).data('id');
    if(jQuery.isNumeric(term_id))
    {
      event.preventDefault();
	  if(!jQuery(this).hasClass('active'))
	  {
		  jQuery('.terms-inline-button ul li a').removeClass('active');
		  jQuery(this).addClass('active');
		  jQuery.ajax({
			url: ajaxrepresentative.ajaxurl,
			type: 'post',
			data: {
			  action: 'ajax_representative',
			  term_id: term_id
			},
			beforeSend: function() {
			  
			},
			success: function(data) {
				jQuery('.representative-contact-page').html(data);
				if(jQuery(window).width() < 768)
				{
					jQuery([document.documentElement, document.body]).animate({
						scrollTop: jQuery('.list-post.representative-post').offset().top
					}, 1000);
				}
			},
			error: function() {
			  alert("Error");
			}
		  })
	  }
    }
  });
  
	jQuery('a.js-load-all').on('click', function(){
		event.preventDefault();
		jQuery.ajax({
			url: ajaxrepresentative.ajaxurl,
			type: 'post',
			data: {
			  action: 'ajax_representative',
			  term_id: 'all'
			},
			beforeSend: function() {
				
			},
			success: function(data) {
				jQuery('.representative-contact-page').html(data);
				jQuery([document.documentElement, document.body]).animate({
					scrollTop: jQuery('.list-post.representative-post').offset().top
				}, 1000);
			},
			error: function() {
			  alert("Error");
			}
		})
	});
  
});