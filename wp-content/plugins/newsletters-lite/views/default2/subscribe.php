<!-- Subscribe Form -->

<?php do_action('newsletters_subscribe_before_form', $form); ?>
<?php echo wpautop(stripslashes(__($form -> styling_beforeform))); ?>

<div class="newsletters newsletters-form-wrapper" id="newsletters-<?php echo $form -> id; ?>-form-wrapper">	
	
	<?php $currentusersubscribed = $this -> get_option('currentusersubscribed'); ?>
	<?php if (!empty($currentusersubscribed)) : ?>
		<?php if (is_user_logged_in()) : ?>
		
			<?php $current_user = wp_get_current_user(); ?>
			<?php global $wpdb; ?>
			<?php if ($wpdb -> get_row("SELECT * FROM " . $wpdb -> prefix . $Subscriber -> table . " WHERE `email` = '" . $current_user -> user_email . "' AND `user_id` = '" . $current_user -> ID . "'")) : ?>
				<div class="alert alert-success">
					<p><i class="fa fa-check"></i> <?php echo sprintf(__('You are already subscribed with email address %s. Go to the %s page to manage your subscription.', 'wp-mailinglist'), '<strong>' . $current_user -> user_email . '</strong>', '<a href="' . $this -> get_managementpost(true) . '">' . __('manage subscriptions', 'wp-mailinglist') . '</a>'); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
		
	<?php if (!empty($form)) : ?>	
		<?php $form_styling = maybe_unserialize($form -> styling); ?>
		<?php if (!empty($form -> form_fields)) : ?>
			<form class="<?php echo (empty($form_styling['formlayout']) || $form_styling['formlayout'] == "normal") ? '' : (($form_styling['formlayout'] == "inline") ? 'form-inline' : 'form-horizontal'); ?> newsletters-subscribe-form <?php echo (!empty($form -> ajax)) ? 'newsletters-subscribe-form-ajax' : ''; ?>" action="<?php echo ((empty($action)) ? $Html -> retainquery($this -> pre . 'method=optin') : $action); ?>#newsletters-<?php echo $form -> id; ?>-form" method="post" id="newsletters-<?php echo $form -> id; ?>-form" enctype="multipart/form-data">
				<input type="hidden" name="form_id" value="<?php echo esc_attr(stripslashes($form -> id)); ?>" />
				<input type="hidden" name="scroll" value="<?php echo esc_attr($form -> scroll); ?>" />
				
				<?php do_action('newsletters_subscribe_inside_form_top', $form); ?>
				
				<?php foreach ($form -> form_fields as $field) : ?>
					<?php $this -> render_field($field -> field_id, true, $form -> id, false, false, false, false, $errors, $form -> id, $field); ?>
				<?php endforeach; ?>
				
				<?php if (!empty($form -> captcha)) : ?>
					<?php if ($captcha_type = $this -> use_captcha()) : ?>		
						<?php if ($captcha_type == "rsc") : ?>
							<div class="form-group<?php echo (!empty($errors['captcha_code'])) ? ' has-error' : ''; ?> newsletters-fieldholder newsletters-captcha">
						    	<?php 
						    	
						    	$captcha = new ReallySimpleCaptcha();
						    	$captcha -> bg = $Html -> hex2rgb($this -> get_option('captcha_bg')); 
						    	$captcha -> fg = $Html -> hex2rgb($this -> get_option('captcha_fg'));
						    	$captcha_size = $this -> get_option('captcha_size');
						    	$captcha -> img_size = array($captcha_size['w'], $captcha_size['h']);
						    	$captcha -> char_length = $this -> get_option('captcha_chars');
						    	$captcha -> font_size = $this -> get_option('captcha_font');
						    	$captcha_word = $captcha -> generate_random_word();
						    	$captcha_prefix = mt_rand();
						    	$captcha_filename = $captcha -> generate_image($captcha_prefix, $captcha_word);
						        $captcha_file = plugins_url() . '/really-simple-captcha/tmp/' . $captcha_filename; 
						    	
						    	?>
						    	<div class="newsletters-captcha-wrapper">
							    	<?php if (!empty($form_styling['fieldlabels'])) : ?>
						            	<label class="control-label" for="<?php echo $this -> pre; ?>captcha_code"><?php _e('Please fill in the code below:', 'wp-mailinglist'); ?></label>
						            <?php endif; ?>
						            <img class="newsletters-captcha-image" src="<?php echo $captcha_file; ?>" alt="captcha" />
						            <input size="<?php echo esc_attr(stripslashes($captcha -> char_length)); ?>" <?php echo $Html -> tabindex('newsletters-' . $form -> id); ?> class="form-control <?php echo $this -> pre; ?>captchacode <?php echo $this -> pre; ?>text <?php echo (!empty($errors['captcha_code'])) ? 'newsletters_fielderror' : ''; ?>" type="text" name="captcha_code" id="<?php echo $this -> pre; ?>captcha_code" value="" />
						            <input type="hidden" name="captcha_prefix" value="<?php echo $captcha_prefix; ?>" />
						    	</div>
						    	
						    	<?php if (!empty($errors['captcha_code']) && !empty($form_styling['fielderrors'])) : ?>
									<div id="newsletters-<?php echo $number; ?>-captcha-error" class="newsletters-field-error alert alert-danger">
										<p><i class="fa fa-exclamation-triangle"></i> <?php echo stripslashes($errors['captcha_code']); ?></p>
									</div>
								<?php endif; ?>
							</div>
						<?php elseif ($captcha_type == "recaptcha") : ?>
							<?php $recaptcha_type = $this -> get_option('recaptcha_type'); ?>
							<div class="newsletters-captcha-wrapper form-group newsletters-fieldholder <?php echo ($recaptcha_type == "invisible") ? 'newsletters-fieldholder-hidden hidden' : ''; ?>">
								<div id="newsletters-<?php echo $form -> id; ?>-recaptcha-challenge" class="newsletters-recaptcha-challenge"></div>
							</div>
						<?php endif; ?>
				    <?php endif; ?>
				<?php endif; ?>
				
				<div class="newslettername-wrapper" style="display:none;">
			    	<input type="text" name="newslettername" value="" id="newsletters-<?php echo $form -> id; ?>newslettername" class="newslettername" />
			    </div>
				
				<?php if (empty($form_styling['formlayout']) || $form_styling['formlayout'] == "normal") : ?>
					<div class="clearfix"></div>
				<?php endif; ?>
				
				<div id="newsletters-form-<?php echo $form -> id; ?>-submit" class="form-group newsletters-fieldholder newsletters_submit">
					<span class="newsletters_buttonwrap">
						<button value="1" type="submit" name="subscribe" id="newsletters-<?php echo $form -> id; ?>-button" class="btn btn-primary button newsletters-button">
							<?php if (!empty($form_styling['loadingindicator'])) : ?>
								<span id="newsletters-<?php echo $form -> id; ?>-loading" class="newsletters-loading-wrapper" style="display:none;">
									<?php if (!empty($form_styling['loadingicon'])) : ?>
										<i class="<?php echo $Html -> get_loading_icon($form_styling['loadingicon']); ?> newsletters-loading-icon"></i>
									<?php else : ?>
										<i class="fa fa-refresh fa-spin fa-fw newsletters-loading-icon"></i>
									<?php endif; ?>
								</span>
							<?php endif; ?>
							<span class="newsletters-button-label"><?php echo esc_attr(stripslashes(__($form -> buttontext))); ?></span>
						</button>
					</span>
				</div>
				
				<div class="newsletters-progress" style="display:none;">
					<div class="clearfix"></div>
					<div class="progress">
						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
							<span class="sr-only">0% Complete</span>
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				
				<!-- Subscribe Form Custom CSS -->
				<style type="text/css">
				#newsletters-<?php echo $form -> id; ?>-form {
					<?php echo (!empty($form_styling['background'])) ? 'background-color: ' . $form_styling['background'] . ';' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .control-label {
					<?php echo (!empty($form_styling['fieldlabelcolor'])) ? 'color: ' . $form_styling['fieldlabelcolor'] . ';' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .form-control {
					<?php echo (!empty($form_styling['fieldcolor'])) ? 'background-color: ' . $form_styling['fieldcolor'] . ';' : ''; ?>
					<?php echo (!empty($form_styling['fieldtextcolor'])) ? 'color: ' . $form_styling['fieldtextcolor'] . ';' : ''; ?>
					<?php echo (!empty($form_styling['fieldborderradius']) || $form_styling['fieldborderradius'] == 0) ? 'border-radius: ' . $form_styling['fieldborderradius'] . 'px;' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .btn {
					<?php echo (!empty($form_styling['buttonbordersize']) || $form_styling['buttonbordersize'] == 0) ? 'border-size: ' . $form_styling['buttonbordersize'] . 'px;' : ''; ?>
					<?php echo (!empty($form_styling['buttonborderradius']) || $form_styling['buttonborderradius'] == 0) ? 'border-radius: ' . $form_styling['buttonborderradius'] . 'px;' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary {
					<?php echo (!empty($form_styling['buttoncolor'])) ? 'background-color: ' . $form_styling['buttoncolor'] . ';' : ''; ?>
					<?php echo (!empty($form_styling['buttonbordercolor'])) ? 'border-color: ' . $form_styling['buttonbordercolor'] . ';' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary.active,
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary.focus,
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary:active,
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary:focus,
				#newsletters-<?php echo $form -> id; ?>-form .btn-primary:hover {
					<?php echo (!empty($form_styling['buttonhovercolor'])) ? 'background-color: ' . $form_styling['buttonhovercolor'] . ';' : ''; ?>
					<?php echo (!empty($form_styling['buttonhoverbordercolor'])) ? 'border-color: ' . $form_styling['buttonhoverbordercolor'] . ';' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form i.newsletters-loading-icon {
					<?php echo (!empty($form_styling['loadingcolor'])) ? 'color: ' . $form_styling['loadingcolor'] . ';' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .select2-container--default .select2-selection--single {
					<?php echo (!empty($form_styling['fieldcolor'])) ? 'background-color: ' . $form_styling['fieldcolor'] . ';' : ''; ?>
					<?php echo (!empty($form_styling['fieldborderradius']) || $form_styling['fieldborderradius'] == 0) ? 'border-radius: ' . $form_styling['fieldborderradius'] . 'px;' : ''; ?>
				}
				
				#newsletters-<?php echo $form -> id; ?>-form .select2-container .select2-selection--single .select2-selection__rendered {
					<?php echo (!empty($form_styling['fieldtextcolor'])) ? 'color: ' . $form_styling['fieldtextcolor'] . ';' : ''; ?>
				}
				
				<?php if (!empty($form -> styling_customcss)) : ?>
					<?php echo $this -> Subscribeform() -> customcss($form); ?>
				<?php endif; ?>
				</style>
			</form>
			
			<?php do_action('newsletters_subscribe_after_form', $instance); ?>			
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php echo wpautop(stripslashes(__($form -> styling_afterform))); ?>