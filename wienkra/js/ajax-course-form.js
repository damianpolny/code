jQuery(document).ready(function () {
	jQuery("form#form_save_course").submit(function (event) {
		event.preventDefault();
		
		jQuery.ajax({
			url: ajaxrcourseform.ajaxurl,
			type: 'post',
			data: {
			  action: 'ajax_course_form',
			  data_form: jQuery(this).serializeArray()
			},
			beforeSend: function() {
				jQuery('.form-save-course').addClass('loading');
			},
			success: function(data) {
				if(data == '1')
				{
					jQuery('.form-save-course .form-save-course-info').html('<div class="success-content">Zostałeś zapisany na szkolenie.</div>');
					jQuery('form#form_save_course').remove();
				}
				else
				{
					jQuery('.form-save-course .form-save-course-info').html(data);
				}
				jQuery('.form-save-course').removeClass('loading');
			},
			error: function() {
			  alert("Error");
			  jQuery('.form-save-course').removeClass('loading');
			}
		})
	});
});