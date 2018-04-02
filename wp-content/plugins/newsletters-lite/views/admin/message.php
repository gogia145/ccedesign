<?php if (!empty($message)) : ?>
	<div id="error" class="updated notice is-dismissible">
		<p><i class="fa fa-check"></i> <?php echo $message; ?></p>
		<?php if (!empty($dismissable)) : ?>
			<button value="1" type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo __('Dismiss this notice.', 'wp-mailinglist'); ?></span></button>
		<?php endif; ?>
	</div>
<?php endif; ?>