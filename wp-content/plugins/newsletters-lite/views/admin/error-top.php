<?php if (!empty($message)) : ?>
	<div id="error" class="updated notice is-dismissible error">
		<p><i class="fa fa-times"></i> <?php echo $message; ?></p>
		<button value="1" type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo __('Dismiss this notice.', 'wp-mailinglist'); ?></span></button>
	</div>
<?php endif; ?>