ASSETS = MAIN_URL+"/assets";
CSS = ASSETS+"/dist/css";
IMG = ASSETS+"/dist/img";
JS = ASSETS+"/dist/js";
PLUGINS = ASSETS+"/plugins";
ACE_THEME = 'chrome';
var pl_page;
loading = '<div class="center loading">Loading <img src="'+IMG+'/loadingIcon.gif"/></div>';

jQuery.fx.interval = 50;

var duration = 5000;
var interval;

function redirect(location) {
//	if (!time) time = 200;
//	setTimeout(function () {
		if (!location) location.reload();
		else window.location.href = location;
//	}, time)
}
$.fn.digits = function(){
	return this.each(function(){
		$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
	})
}

function mtip(a, c, title, content) {
	$(".alert").length && $(".alert").remove();
	if (a && a.length) {
		if (a == 'alert') {
			$('body').append('<div class="the-board-fixed"></div><div class="alert-fixed alert-' + c + '"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
		} else $(a).prepend('<div class="alert alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	} else $('body').append('<div class="alert alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	wi = $('.just-add').width()/2;
	$('.just-add').css("left", "calc(50% - "+wi+"px)").animate({
		bottom: "+=50"
	}, 200);
	stip('just-add')
}
function htip(a) {
	var l = $('.' + a).attr('class');
	if (l.indexOf('alerts') > -1) {
		$("." + a).slideUp(function () {
			$("." + a).remove().prev('.the-board-fixed').remove()
		})
	} else {
		$(".alert").animate({
			bottom: "-=150"
		}, 500, function () {
			$(".alert").remove().prev('.the-board-fixed').remove()
		})
	}
}
function stip(d) {
		$("." + d).fadeIn(1E3);
		setTimeout("htip('" + d + "')", 5E3)
}

function validator (a, href) {
	if (!a) a = '.bootstrap-validator-form';
//	console.log(a);
//	console.log(href);
	$(a).bootstrapValidator({
		excluded: [':disabled'],
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		live: 'disabled',
	}).on('error.form.bv', function (e) {
		e.preventDefault();
		var $form = $(e.target);
		$form.find('textarea').focus();
	}).on('success.form.bv', function (e) {
		e.preventDefault();
		var $form = $(e.target),
			validator = $form.data('bootstrapValidator'),
			submitButton = validator.getSubmitButton();
		formDatas = getFormData($form);
		formData = new FormData($(this)[0]);
//		console.log(formData);
		$form.children('*:visible').hide().addClass('visible hide-to-load');
		$form.append('<div class="spinner loading-sending"><div></div><div></div><div></div></div>');
//		console.log(formDatas);
		if ($form.is('.comment-form-feed') && !$form.is('.comment-form-status')) {
			$post = $(this).closest('.feed-load');
			type = $post.attr('data-type');
			id = $post.attr('data-iid');
//			action = MAIN_URL+'/'+type+'/'+id+'?do=reply';
			action = href+'&do=reply';
		} else {
			action = $form.attr('action');
		}
		if ($form.is('.comment-form-status')) type = 'status';
		$.ajax({
			url: action,
			type: 'post',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
//				console.log(action);
//				console.log(formDatas);
				console.log(data);
				alertsContent = data.split(/\[content\]|\[\/content]/)[1];
				alertsType = data.split(/\[type\]|\[\/type\]/)[1];
				alertsDataID = data.split(/\[dataID\]|\[\/dataID\]/)[1];
				if (alertsType == 'success') {
					if ($form.find('.sceditor-container').length) {
						$form.find('textarea').each(function () {
							$(this).val('').sceditor('instance').val('');
						})
					} else {
						$form.find('textarea').val('');
					}
				}
				$form.addClass('just-sent').children('.spinner.loading-sending').remove();
				$form.children('*.visible.hide-to-load').show().removeClass('visible hide-to-load');
				if (alertsContent) mtip('', alertsType, '', alertsContent);
				$form.find('[type^="submit"]').attr('disabled', false);
				if ($form.is('.signup')) {
					if (alertsType == 'success') location.reload();
					else if (alertsDataID == 'username') $('[name="username"]').next('.form-control-feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove').closest('.has-feedback').removeClass('has-success').addClass('has-error');
					else if (alertsDataID == 'password') $('[name="confirm_password"]').next('.form-control-feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove').closest('.has-feedback').removeClass('has-success').addClass('has-error');
				}
				else if ($form.is('.ratings-form')) {
					table.ajax.reload(function (json) {
						$('.r-cmts').show();
						table.page('last').draw('page');
					});
				}
				else if ($form.is('.new-post')) {
					href = MAIN_URL+'/status/'+alertsDataID+'?temp=feed';
					$('#post-list').prepend('<div data-type="status" data-iid="'+alertsDataID+'" class="feed-load"><span class="feed-href hidden">'+href+'</span></div>');
					$this = $('.feed-load[data-type="status"][data-iid="'+alertsDataID+'"]');
					loadFeed(href, $this, alertsDataID, 'status');
				}
				else if ($form.is('.comment-form-feed')) {
					$form.find('.cmt-textarea').attr('readonly', false);
					if (alertsType == 'success') {
					meName = $('#top_navbar .s-title').text();
					meAvt = $('#top_navbar .avatar').attr('src');
					meUname = $('#top_navbar .myID').attr('id');
					ratingsHTML = '';
					if (type != 'status') {
						rate = $form.find('.rate-val').val();
						ratingsHTML += '<span class="ratings text-warning">';
						uPost = $form.closest('.one-group-feed').find('.feed-note-user').text();
						$fCoin = $post.find('.feed-coins strong');
						oldcoin = parseInt($fCoin.text());
						coin = parseInt(data.split(/\[coin\]|\[\/coin\]/)[1]);
						$fCoin.text(oldcoin*1+coin*1);
						for (i = 1; i <= 5; i++) {
							if (rate > i && rate < (i+1)) ratingsHTML += '<i class="fa fa-star-half-o"></i>';
							else if (rate < i) ratingsHTML += '<i class="fa fa-star-o"></i>';
							else ratingsHTML += '<i class="fa fa-star"></i>';
						}
						ratingsHTML += '</span>\
				<span class="coins-plus" title="Review của '+meName+' đã cộng thêm cho '+uPost+' '+coin+' điểm">\
					<span class="text-success">'+coin+'</span>\
				</span>';
					}
					$form.before('<div class="box-comment">\
					<div class="box-comment-left">\
						<a href="'+MAIN_URL+'/user/'+meUname+'" data-online="1" class="left">\
							<img class="img-sm img-circle" src="'+meAvt+'">\
						</a>\
					</div>\
					<div class="comment-text">\
						<span class="username">\
							<a href="'+MAIN_URL+'/user/'+meUname+'">'+meName+'</a>\
							'+ratingsHTML+'\
							<span class="text-muted pull-right">Just now</span>\
						</span><!-- /.username -->\
						'+alertsDataID+'</div><!-- /.comment-text -->\
				</div>');
				} // end if (alertsType == 'success')
				} else if (alertsDataID) {
					if (alertsType == 'success') redirect(alertsDataID);
				}
			},
			error: function (data) {
				console.log(data);
				$form.addClass('just-sent').children('.spinner.loading-sending').remove();
				$form.children('*.visible.hide-to-load').show().removeClass('visible hide-to-load');
//				mtip('.bootstrap-validator-form', 'error', '', 'Oops! Seems like something went wrong. Please contact the administrators for help.')
			}
		})
	});

	if ($('.btn-file').length > 0){
		$(document).on('change', '.btn-file :file', function() {
				"use strict";
				var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [numFiles, label]);
		});
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			if( input.length ) {
				input.val(log);
			} else {
				if (log) alert(log);
			}
		});
	}
}

function goToByScroll (id) {
	$('html,body').animate({
		scrollTop: $("#"+id).offset().top
	}, 'slow');
}

function sce (a) {
	$(a).find('textarea').not('.one-cmt textarea, .non-sce, .non-me, .ace_text-input, .add-comment-line-textarea, .comment-form-feed textarea, .comment-form-status textarea, .stt-form textarea').each(function () {
		$(this).sceditor({
			plugins: "bbcode",
			style: PLUGINS+"/sceditor/minified/jquery.sceditor.default.min.css",
			parserOptions: {
				breakAfterBlock: false
			},
			toolbar:	'bold,italic,underline,strike,left,center,right,justify,' +
				'font,size,color,removeformat,bulletlist,orderedlist,' +
				'quote,horizontalrule,image,email,link,unlink,emoticon,source',
			convertEmoticons: false
		}).sceditor('instance');
	});
	$(a).find('.stt-form textarea').each(function () {
		$(this).sceditor({
			plugins: "bbcode",
			style: PLUGINS+"/sceditor/minified/jquery.sceditor.sttform.min.css",
			parserOptions: {
				breakAfterBlock: false
			},
			toolbar:	'bold,italic,underline,strike,' +
				'bulletlist,orderedlist,' +
				'image,email,link,unlink,emoticon,removeformat',
			convertEmoticons: false
		}).sceditor('instance');
	});
	$(a).find('textarea.add-comment-line-textarea').each(function () {
		$(this).sceditor({
			style: PLUGINS+"/sceditor/minified/jquery.sceditor.default.min.css",
			toolbar:	'bold,italic,underline,strike,' +
				'color,removeformat,' +
				'link,unlink,emoticon,' +
				'source',
		}).sceditor('instance');
	})
}


function getFormData ($form) {
	if ($form.find('.sceditor-container').length) {
		$form.find('.sceditor-container').each(function () {
			var vl = $(this).prev('textarea').sceditor('instance').val();
			vl = $(this).prev("textarea").sceditor('instance').fromBBCode(vl, true);
			$(this).prev('textarea').val(vl);
		})
	}
	formData = $form.serialize();
	return formData;
}

function choosen (a) {
	"use strict";
	var configChosen = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"100px"}
	}
	for (var selector in configChosen) {
		if (a) $(a).find(selector).chosen(configChosen[selector]);
		else $(selector).chosen(configChosen[selector]);
	}
}

var createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function flatApp () {
	$('input[type="submit"], button, .button').not('[class*="btn "]').not('[data-online]').addClass('btn btn-success');
	$('input[type="reset"]').addClass('btn btn-default');

	if ($('.bootstrap-validator-form').length) validator();
	sce('#main-content');
	if ($('.chosen-select').length) choosen();
	if ($(':checkbox').length) $(':checkbox').not('[data-toggle="switch"], .onoffswitch-checkbox').checkbox();
	if ($(':radio').length) $(':radio').radio();
}

function openInNewTab (url) {
	var $a = $('<a/>').appendTo('body');
	$a.attr("href", url).attr("target", "_blank").click();
	window.open(url);
}

function popup (type, bg, href) {
	old_href = window.location.href;
	if (!type) type = 'dark';
	if (href) history.pushState('', '', href);
	var topp = $(document).scrollTop() + 100;
	$('.popup').addClass('popup-'+type).show();
	if (bg) $('.popup-inner').prepend('<div class="popup-bg" style="background-image:url('+bg+')"></div>');
	$('.popup-content').slideDown(400, function () {
		//if (page != 'popup') sce('popup-content', 'class');
		flatApp();
		hidden = false;
		if ($('body').css('overflow') == 'hidden') {
			$('body').css('overflow', 'auto');
			hidden = true;
		}
		$(this).css({
			'overflow': 'visible'
		});
		$('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
			if (href) remove_popup(type, hidden, old_href)
			remove_popup(type, hidden)
		});
	}).css('top', topp);
}

function remove_popup (type, hidden, old_href) {
	if (!type) type = 'dark';
//	if (href) history.pushState('', '', href);
	$('.popup-content').slideUp(400, function () {
		$('.popup').removeClass('popup-'+type).hide();
		if (hidden == true) $('body').css('overflow', 'hidden');
		if (old_href) history.pushState('', '', old_href);
		$('.popup-bg').remove()
	})
}


function activeTab (tab) {
	$('.nav-tabs a[href="#' + tab + '"]').tab('show');
}

function chat () {
	$.get(MAIN_URL+'/chat?v=view', function (data) {
		$('#right-side').html(data);
//		runChat()
	})
}

function setRead (a) {
	$.get(MAIN_URL+'/noti/'+a+'?do=setRead', function (data) {
		console.log(data);
		$('.notification-load .one-noti[data-id="'+a+'"]').attr('data-new', 0);
	})
}

function getNoti () {
	$.get(MAIN_URL+'/noti?do=get', function (data) {
		$('.notification-load').html(data);
		var new_num = $('.notification-load .one-noti[data-new="1"]').length;
		if (new_num > 0) $('.noti-new-num').show().text(new_num);
		else $('.noti-new-num').hide();
		$('.notification-load .one-noti[data-new="1"] .noti-post-link').each(function () {
			$(this).click(function () {
				setRead($(this).closest('.one-noti').attr('data-id'));
				location.href = $(this).attr('href');
				return false;
			})
		})
	})
}

var TOKEN = getCookie('token');
$(document).ready(function() {
	console.log(TOKEN);
/*	if (!TOKEN && location.href.indexOf('login') == -1) {
		location.href = MAIN_URL+'/login';
	} else {
		flatApp();
		getMyInfo();
	}
*/
})
