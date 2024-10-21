jQuery(document).ready(function(){
	
	jQuery(document.body).on('click', '#subject_filter .subject-filter ul.subject-filter-list.subject-filter-list-subject li input', function() {
		var slug = jQuery(this).parent().data('slug');
		if(slug != '')
		{
			jQuery('#subject_filter .subject-filter ul.subject-filter-list.subject-filter-list-level li input').prop('checked',false);
			jQuery('#subject_filter .subject-filter ul.subject-filter-list.subject-filter-list-level li').hide();
			jQuery(slug).show();
		}
	});
	
	jQuery(document.body).on('change', '#subject_filter .subject-filter ul.subject-filter-list li input', function() {
							
		jQuery.ajax({
			url: ajaxfilter.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_filter',
				data: jQuery('#form_filter').serializeArray()
			},
			beforeSend: function() {
				
			},
			success: function(data) {
				if(data)
				{
					jQuery('.grid-list-subject').html(data);
				}
			},
			error: function() {
				alert("Error");
			}
		});
			
	});
	
	jQuery(document.body).on('click', '#subject_filter .filter-reset', function() {
							
		jQuery.ajax({
			url: ajaxfilter.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_filter',
				data: jQuery('#form_filter').serializeArray()
			},
			beforeSend: function() {
				
			},
			success: function(data) {
				if(data)
				{
					jQuery('.grid-list-subject').html(data);
				}
			},
			error: function() {
				alert("Error");
			}
		});
			
	});
	
});