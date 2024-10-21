jQuery(document).ready(function(){
	
	jQuery(document.body).on('change', '#comments_filters .subject-filter ul.subject-filter-list li input', function() {
							
		jQuery.ajax({
			url: ajaxcomments.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_comments',
				data: jQuery('#form_comments_filters').serializeArray()
			},
			beforeSend: function() {
				
			},
			success: function(data) {
				if(data)
				{
					jQuery('#comments_the_content').html(data);
				}
			},
			error: function() {
				alert("Error");
			}
		});
			
	});
	
});