/**
 * Handles all the clicks on the like button
 */

jQuery(document).ready(function($) {
	// Add the like button functionality
	$(document).on('click', '.ipt_kb_like_article', function(e) {
		e.preventDefault();
		$(this).prop('disabled', true);
		$(this).find('span.text').html($(this).data('loading-text'));
		var nonce = $(this).data('nonce'),
		post_id = $(this).data('postid'),
		_self = this;
		$.get(iptKBJS.ajaxurl, {
			action : 'ipt_kb_like_article',
			_wpnonce : nonce,
			post_id : post_id
		}, function(data) {
			$(_self).find('span.text').html(data);
			// Set the cookie
			var cookie_str = 'ipt_kb_like_article_' + escape(post_id) + '=1;',
			exp_date = new Date();
			exp_date.setDate(exp_date.getDate() + 365);
			cookie_str += ' expires=' + exp_date.toUTCString() + '; path=/';
			document.cookie = cookie_str;
		}).fail(function() {
			$(_self).find('span.text').html(iptKBJS.ajax_error);
			$(_self).prop('disabled', false);
		});
	});

	// Affix Widget
	// Js'

	// A switch to check if sticky kit is activated
	// For the adjust_height function
	var sticky_on = false,
	sticked = false;

	// Adjust the height of the container
	// To make the footer stick to bottom and help with jQuery Sticky Kit
	var adjust_height = function() {
		$('#content').css('min-height', '0');
		$('#secondary').css('min-height', '0');
		var window_height = $(window).outerHeight(true) - $('#masthead').outerHeight(true) - $('#colophon').outerHeight(true) - parseInt($('html').css('margin-top'), 10),
		content_height = $('#content').outerHeight(true),
		min_height = Math.max(window_height, content_height),
		window_width = $(window).width();

		$('#content').css('min-height', min_height);
		if ( window_width >= 975 ) {
			$('#secondary').css('min-height', min_height);
		}
		if ( sticky_on ) {
			if ( window_width >= 975 ) {
				if ( ! sticked ) {
					$('.ipt_kb_affix').stick_in_parent({
						inner_scrolling : false,
						offset_top : 30
					});
					sticked = true;
				}
				$(document.body).trigger("sticky_kit:recalc");
			} else {
				if ( sticked ) {
					$('.ipt_kb_affix').data('stickyKit').destroy();
					sticked = false;
				}
			}
		}
	};
	adjust_height();
	$(window).on('resize', adjust_height);

	// Apply the scrollspy
	if ( $('#ipt-kb-toc-scrollspy').length ) {
		$('body').scrollspy({
			target : '#ipt-kb-toc-scrollspy',
			offset : 30
		});
		$(window).on('load resize', function() {
			$('body').scrollspy('refresh');
		});
	}

	// Apply the sticky kit
	// Couldn't do with bootstrap affix
	// Although I wanted to
	// If you are reading this, perhaps you can help me with the footer sticky flicky bug
	// Huh! I even gave it a name
	if ( $('.ipt_kb_affix').length ) {
		sticky_on = true;
		// Make sure the secondary height is same as the container
		// No need to do it here, as already done in the adjust_height
		if ( $(window).width() >= 975 ) {
			$('.ipt_kb_affix').stick_in_parent({
				inner_scrolling : false,
				offset_top : 30
			});
			sticked = true;
		}

		// Bind the event on collapsibles
		$(document).on('shown.bs.collapse hidden.bs.collapse', function() {
			$(document.body).trigger("sticky_kit:recalc");
			adjust_height();
		});
	}

	// Set the cookie for TOC and Subcat collapse shown & hidden
	$(document).on('shown.bs.collapse hidden.bs.collapse', function(e) {
		// Set the cookie
		var cookie_str = '',
		type = ( e.type == 'hidden' ? '0' : '1' ),
		exp_date = new Date();
		exp_date.setDate(exp_date.getDate() + 365);
		switch ( $(e.target).attr('id') ) {
			case 'ipt-kb-toc-scrollspy' :
				cookie_str = 'ipt_kb_toc=' + type + ';';
				break;
			case 'ipt-kb-affix-active-post' :
				cookie_str = 'ipt_kb_active_post=' + type + ';';
				break;
			default :
				cookie_str = '';
				break;
		}

		if ( cookie_str !== '' ) {
			cookie_str += ' expires=' + exp_date.toUTCString() + '; path=/';
			document.cookie = cookie_str;
		}
	});
});
