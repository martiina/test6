/* Kõige parem teha seda funktsioonina, aga kiirelt tehtud... */

$(document).ready(function() {
	/* [VALIDATING LOGIN FORM] */
	$('#login-form').on('submit', function(event) {
		// Prevent default form submission.
		event.preventDefault();
		var data = $(this).serialize();

		var username = $('#username');
		var password = $('#password');

		var user_group = $('#username-group');
		var pass_group = $('#password-group');

		var username_error = $('p#username-error');
		var password_error = $('p#password-error');

		$.ajax({
		  	type: "POST",
		  	url: 'ajax.php',
		  	data: data,
		  	dataType: 'json',
		  	success: function(result) {
		  		/* Assign new token from ajax file. */
		  		$('[name=_token]').attr('value', result['token']);
		  		if(result['status'] == 'error') {
		  			if(result['err_msg']['username']) { // Checking, if username has any errors
		  				username_error.removeClass('hidden').html(result['err_msg']['username']);
		  				user_group.addClass('has-error').effect('shake');
		  				username.focus();
		  			} else if(result['err_msg']['password']) { // Checking, if password has any errors
		  				password_error.removeClass('hidden').html(result['err_msg']['password']);
		  				pass_group.addClass('has-error').effect('shake');
		  				password.focus();
		  			}
		  		} else {
		  			if(user_group.hasClass('has-error')) {
		  				user_group.removeClass('has-error');
		  			}
		  			if(pass_group.hasClass('has-error')) {
		  				pass_group.removeClass('has-error');
		  			}
		  			user_group.addClass('has-success');
		  			pass_group.addClass('has-success');
		  			username_error.hide();
		  			password_error.hide();

		  			$('#login-form').fadeOut("slow", function() {
		  				location.reload();
		  			});
		  		}
		  	}
		});
		return false;
	});

	/* [VALIDATING REGISTER FORM] */
	$('#register-form').on('submit', function(event) {
		// Prevent default form submission.
		event.preventDefault();
		var data = $(this).serialize();

		var username = $('#username');
		var password = $('#password');

		var user_group = $('#username-group');
		var pass_group = $('#password-group');

		var username_error = $('p#username-error');
		var password_error = $('p#password-error');

		$.ajax({
		  	type: "POST",
		  	url: 'ajax.php',
		  	data: data,
		  	dataType: 'json',
		  	success: function(result) {
		  		/* Assign new token from ajax file. */
		  		$('[name=_token]').attr('value', result['token']);
		  		if(result['status'] == 'error') {
		  			if(result['err_msg']['username']) { // Checking, if username has any errors
		  				username_error.removeClass('hidden').html(result['err_msg']['username']);
		  				user_group.addClass('has-error').effect('shake');
		  				username.focus();
		  			} else if(result['err_msg']['password']) { // Checking, if password has any errors
		  				password_error.removeClass('hidden').html(result['err_msg']['password']);
		  				pass_group.addClass('has-error').effect('shake');
		  				password.focus();
		  			}
		  		} else {
		  			if(user_group.hasClass('has-error')) {
		  				user_group.removeClass('has-error');
		  			}
		  			if(pass_group.hasClass('has-error')) {
		  				pass_group.removeClass('has-error');
		  			}
		  			user_group.addClass('has-success');
		  			pass_group.addClass('has-success');
		  			username_error.hide();
		  			password_error.hide();

		  			$('#register-form').fadeOut("slow", function() {
		  				location.reload();
		  			});
		  		}
		  	}
		});
		return false;
	});

	$('#movie-form').on('submit', function(event) {
		// Prevent default form submission.
		event.preventDefault();
		var data = $(this).serialize();

		var title = $('#title');
		var rating = $('#rating');
		var release = $('#release');

		var title_group = $('#title-group');
		var rating_group = $('#rating-group');
		var release_group = $('#release-group');

		var title_error = $('p#title-error');
		var rating_error = $('p#rating-error');
		var release_error = $('p#release-error');

		$.ajax({
		  	type: "POST",
		  	url: 'ajax.php',
		  	data: data,
		  	dataType: 'json',
		  	success: function(result) {
		  		/* Assign new token from ajax file. */
		  		$('[name=_token]').attr('value', result['token']);
		  		if(result['status'] == 'error') {
		  			if(result['err_msg']['title']) { // Checking, if title has any errors
		  				title_error.removeClass('hidden').html(result['err_msg']['title']);
		  				title_group.addClass('has-error').effect('shake');
		  				title.focus();
		  			} else if(result['err_msg']['rating']) { // Checking, if rating has any errors
		  				rating_error.removeClass('hidden').html(result['err_msg']['rating']);
		  				rating_group.addClass('has-error').effect('shake');
		  				rating.focus();
		  			} else if(result['err_msg']['release']) { // Checking, if release date has any errors
		  				release_error.removeClass('hidden').html(result['err_msg']['release']);
		  				release_group.addClass('has-error').effect('shake');
		  				release.focus();
		  			}
		  		} else {
		  			if(title_group.hasClass('has-error')) {
		  				title_group.removeClass('has-error');
		  			}
		  			if(rating_group.hasClass('has-error')) {
		  				rating_group.removeClass('has-error');
		  			}
		  			if(release_group.hasClass('has-error')) {
		  				release_group.removeClass('has-error');
		  			}
		  			title_group.addClass('has-success');
		  			rating_group.addClass('has-success');
		  			release_group.addClass('has-success');
		  			title_error.hide();
		  			rating_error.hide();
		  			release_error.hide();

		  			location.reload();
		  		}
		  	}
		});
		return false;
	});

	$('#search-form').on('submit keyup', function(event) {
		// Prevent default form submission.
		event.preventDefault();

		var data = $(this).serialize();

		var search = $('#search');

		$.ajax({
		  	type: "POST",
		  	url: 'ajax.php',
		  	data: data,
		  	dataType: 'json',
		  	success: function(result) {
		  		if(result['search_data'].length != 0) {
		  			$('#refresh').html(result['search_data']);
		  		}
		  	}
		});
		return false;
	});
});