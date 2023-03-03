$(document).ready(function() {
	$('form').submit(function(event) {
		var pinTitle = $('#pin_title').val();
		var pinDesc = $('#pin_desc').val();
		var websiteUrl = $('#website_url').val();
		var category = $('#category').val();
		var errors = 0;
		
		// Validate pin title
		if (pinTitle == '') {
			$('#pin_title').addClass('error');
			errors++;
		} else {
			$('#pin_title').removeClass('error');
		}
		
		// Validate pin description
		if (pinDesc == '') {
			$('#pin_desc').addClass('error');
			errors++;
		} else {
			$('#pin_desc').removeClass('error');
		}
		
  })
