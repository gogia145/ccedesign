(function($) {	
	$.fn.newsletters_subscribe_form = function() {		
		var $form = this, 
			$submit = $form.find('[type="submit"]'),
			$fields = $form.find('.newsletters-fieldholder :input'),
			$fieldholders = $form.find('.newsletters-fieldholder'),
			$selectfields = $form.find('select'),
			$filefields = $form.find(':file'),
			$errorfields = $form.find('.has-error'),
			$errors = $form.find('.newsletters-field-error'),
			$wrapper = $form.parent(), 
			$loading = $form.find('.newsletters-loading-wrapper'),
			$scroll = $form.find('input[name="scroll"]'),
			$progress = $form.find('.newsletters-progress'),
			$progressbar = $form.find('.newsletters-progress .progress-bar'),
			$progresspercent = $form.find('.newsletters-progress .sr-only'), 
			$postpageclasses = '.newsletters-management, .entry-content, .post-entry, .entry', 
			$postpagecontainer = $form.closest($postpageclasses), 
			$recaptcha_id, 
			$recaptcha_element, 
			$recaptcha_loaded = false;
			
		var on_form_submit = function() {			
			$($form).trigger('newsletters_subscribe_form_submit');
			
			// reCAPTCHA stuff
			if (typeof grecaptcha !== 'undefined' && newsletters.has_captcha && newsletters.captcha === 'recaptcha' && newsletters.recaptcha_type === 'invisible') {							
				if (typeof $recaptcha_id !== 'undefined') {								
					var token = grecaptcha.getResponse($recaptcha_id);
		
					if (!token) {
						grecaptcha.execute($recaptcha_id);
						return false;
					}
				}
			}
				
			$loading.show();
			if (typeof $filefields !== 'undefined' && $filefields.length > 0) {
				$progress.show();
			}
			
			if (typeof $errors !== 'undefined') { $errors.slideUp(); }
			if (typeof $errorfields !== 'undefined') { $errorfields.removeClass('has-error'); }
			$submit.prop('disabled', true);
			$fields.attr('readonly', true);
			
			if ($.isFunction($.fn.select2) && typeof $selectfields !== 'undefined' && $selectfields.length > 0) {
				$selectfields.select2('destroy');
				$selectfields.attr('readonly', true);
				$selectfields.select2();
			}
			
			$($form).trigger('newsletters_subscribe_form_submitted');
		};
		
		var on_form_error = function() {
			alert(newsletters.ajax_error);
			
			$loading.hide();
			if (typeof $filefields !== 'undefined' && $filefields.length > 0) {
				$progress.hide();
			}
			
			$submit.prop('disabled', false);
			$fields.removeAttr('readonly');
			
			if ($.isFunction($.fn.select2) && typeof $selectfields !== 'undefined' && $selectfields.length > 0) {
				$selectfields.select2('destroy');
				$selectfields.removeAttr('readonly');
				$selectfields.select2();
			}
		};
		
		if ($form.hasClass('newsletters-subscribe-form-ajax')) {
			$form.on('submit', on_form_submit);
		}
		
		$fields.on('focus click', function() {
			$(this).removeClass('newsletters_fielderror').nextAll('div.newsletters-field-error').slideUp();	
		});
		
		if ($.isFunction($.fn.select2) && typeof $selectfields !== 'undefined' && $selectfields.length > 0) {
			$selectfields.select2();
		}
		
		if (!$form.hasClass('form-inline')) {						
			$postpagecontainer.find($form).find('.newsletters-fieldholder').addClass('col-md-6');
			$postpagecontainer.find($form).find('.newsletters-progress').addClass('col-md-12');
		}
		
		if ($form.hasClass('newsletters-subscribe-form-ajax')) {			
			if ($.isFunction($.fn.ajaxForm)) {
				$form.ajaxForm({
					url: newsletters_ajaxurl + 'action=wpmlsubscribe',
					data: (function() {	
						var formvalues = $form.serialize();							
						return formvalues;
					})(),
					type: 'POST',
					cache: false,
					beforeSubmit: function() {																		
						// we can do things before the form is submitted
					},
					beforeSend: function() {
				        var percentVal = '0%';
				        $progressbar.width(percentVal);
				        $progresspercent.html(percentVal);
				        $($form).trigger('newsletters_subscribe_form_before_ajax');
				    },
				    uploadProgress: function(event, position, total, percentComplete) {
				        var percentVal = percentComplete + '%';
				        $progressbar.width(percentVal);
				        $progresspercent.html(percentVal);
				        $($form).trigger('newsletters_subscribe_form_upload_progress');
				    },
					success: function(response) {							
						if ($('.newsletters-subscribe-form', $('<div/>').html(response)).length > 0) {			
							$wrapper.html($(response).find('.newsletters-subscribe-form'));
						} else {
							$wrapper.html(response);
						}
						
						$wrapper.find('.newsletters-subscribe-form').newsletters_subscribe_form();
						
						if (typeof $scroll !== 'undefined' && $scroll.val() === 1) {	
							var targetOffset = ($wrapper.offset().top - 50);
							$('html,body').animate({scrollTop: targetOffset}, 500);
						}
						
						$($form).trigger('newsletters_subscribe_form_success_ajax');
					    
					},
					error: function() {
						// an error occurred
						on_form_error();
						
						$($form).trigger('newsletters_subscribe_form_error_ajax');	
					},
					complete: function() {
						var percentVal = '100%';
				        $progressbar.width(percentVal);
				        $progresspercent.html(percentVal);
				        
				        $($form).trigger('newsletters_subscribe_form_complete_ajax');
					}
				});
			}
		}
		
		var recaptcha_callback = function() {
			if (newsletters.has_captcha && newsletters.captcha === 'recaptcha' && $recaptcha_loaded == false) {				
				$recaptcha_element = $form.find('.newsletters-recaptcha-challenge');

				if (typeof grecaptcha !== 'undefined') {
					var recaptcha_options = {
						sitekey: newsletters.recaptcha_sitekey,
						theme: newsletters.recaptcha_theme,
						type: 'image',
						size: (newsletters.recaptcha_type === 'invisible' ? 'invisible' : 'normal'),
						callback: function() {							
							if (newsletters.recaptcha_type === 'invisible') {
								$form.submit();
							}
						},
						'expired-callback': function() {							
							if (typeof $recaptcha_id !== 'undefined') {
								grecaptcha.reset($recaptcha_id);
							}
						}
					};
					
					$recaptcha_id = grecaptcha.render($recaptcha_element[0], recaptcha_options, true);
					$recaptcha_loaded = true;
				}
			}
		}
		
		$(window).on('load', recaptcha_callback);
		recaptcha_callback();
		
		$form.trigger('newsletters_subscribe_form_after_create');
		return $form;
	};
	
	$(function() {
		$('.newsletters-subscribe-form').each( function() {
			$(this).trigger('newsletters_subscribe_form_before_create');
			$(this).newsletters_subscribe_form();
		});
	});
})(jQuery);