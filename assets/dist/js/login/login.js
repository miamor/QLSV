$(function () {
    $('header,aside,footer,.main-footer').addClass('hidden').remove();
    $('.page-login').attr({
    	class: 'page-login login-page',
    	id: ''
    });
    $('.wrapper').attr('class', '');
	$('.login').submit(function () {
        $form = $(this);
		$.ajax({
			url: MAIN_URL+'/requests/login/login.php',
			type: 'POST',
			data: $form.serialize(),
			success: function (data) {
				console.log(data);
				if (data == 1) location.href = MAIN_URL;
			}
		});
		return false
	})
})
