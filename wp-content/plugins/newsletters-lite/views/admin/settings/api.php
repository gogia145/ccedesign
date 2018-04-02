<!-- API -->

<?php

$api_enable = $this -> get_option('api_enable');
$api_endpoint = admin_url('admin-ajax.php?action=newsletters_api');
$api_key = $this -> get_option('api_key');
$api_hosts = $this -> get_option('api_hosts');

?>

<div class="wrap newsletters">
	<h1><?php _e('JSON API', 'wp-mailinglist'); ?></h1>
	
	<?php $this -> render('settings-navigation', false, true, 'admin'); ?>
	
	<p><?php _e('Use the JSON API to perform certain functions via API calls.', 'wp-mailinglist'); ?><br/>
	<?php _e('It can be from a remote server or from a 3rd party application, plugin, template, etc.', 'wp-mailinglist'); ?></p>
	
	<form action="<?php echo admin_url('admin.php?page=' . $this -> sections -> settings_api); ?>" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="api_enable"><?php _e('Enable API', 'wp-mailinglist'); ?></label></th>
					<td>
						<label><input onclick="if (jQuery(this).is(':checked')) { jQuery('#api_div').show(); } else { jQuery('#api_div').hide(); }" <?php echo (!empty($api_enable)) ? 'checked="checked="' : ''; ?> type="checkbox" name="api_enable" value="1" id="api_enable" /> <?php _e('Yes, enable the API.', 'wp-mailinglist'); ?></label>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div id="api_div" style="display:<?php echo (!empty($api_enable)) ? 'block' : 'none'; ?>;">
			<table class="form-table">
				<tbody>
					<tr>
						<th><label for=""><?php _e('API Endpoint', 'wp-mailinglist'); ?></label></th>
						<td>
							<code><?php echo $api_endpoint; ?></code>
							<span class="howto"><?php _e('The URL to submit API calls to', 'wp-mailinglist'); ?></span>
						</td>
					</tr>
					<tr>
						<th><label for=""><?php _e('API Key', 'wp-mailinglist'); ?></label></th>
						<td>
							<code><span id="api_key"><?php echo $api_key; ?></span></code>
							<a class="button button-secondary button-small" onclick="if (confirm('<?php _e('Are you sure you want to generate a new key? The previous key will stop working.', 'wp-mailinglist'); ?>')) { newsletters_api_newkey(); } return false;"><?php _e('Generate New Key', 'wp-mailinglist'); ?></a>
							<span id="api_key_loading" style="display:none;"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
							<span class="howto"><?php _e('Unique key to use for authentication with the API', 'wp-mailinglist'); ?></span>
						</td>
					</tr>
					<tr>
						<th><label for="api_hosts"><?php _e('Allowed Hosts', 'wp-mailinglist'); ?></label></th>
						<td>
							<select name="api_hosts[]" id="api_hosts" multiple="multiple" style="width:100%;" class="widefat">
								<?php if (!empty($api_hosts)) : ?>
									<?php foreach ($api_hosts as $host) : ?>
										<option selected="selected" value="<?php echo esc_attr(stripslashes($host)); ?>"><?php echo $host; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<span class="howto">
								<?php _e('Specify allowed IPs that can access the API to prevent abuse and spam.', 'wp-mailinglist'); ?><br/>
								<?php _e('Leave empty/blank to allow all hosts to access the API.', 'wp-mailinglist'); ?>
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<p class="submit">
			<button value="1" type="submit" name="save" class="button button-primary">
				<i class="fa fa-check fa-fw"></i> <?php _e('Save Settings', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
	
	<h2><?php _e('Making an API Call', 'wp-mailinglist'); ?></h2>
	<p><?php _e('Below is an example of making a JSON API call', 'wp-mailinglist'); ?></p>
	
	<script src="https://gist.github.com/tribulant/846400b10de1897de805.js"></script>

	<h2><?php _e('API Methods', 'wp-mailinglist'); ?></h2>
	
	<!-- Subscribers API methods -->
	<h3><?php _e('Subscribers', 'wp-mailinglist'); ?></h3>
	
	<h4>subscriber_add</h4>
	<script src="https://gist.github.com/tribulant/aa76b890e48e2da1ece8.js"></script>
	
	<h4>subscriber_delete</h4>
	<script src="https://gist.github.com/tribulant/3452bd0769dbd7c1a0db.js"></script>
	
	<!-- Newsletters API methods -->
	<h3><?php _e('Newsletters', 'wp-mailinglist'); ?></h3>
	
	<h4>send_newsletter</h4>
	<p class="howto"><?php _e('Queue a saved history/draft newsletter by ID.', 'wp-mailinglist'); ?></p>
	<script src="https://gist.github.com/tribulant/dc64ee236c309cce0ca1eba44eedd7f7.js"></script>
	
	<h4>send_email</h4>
	<p class="howto"><?php _e('Send a single email to a specific email address.', 'wp-mailinglist'); ?></p>
	<script src="https://gist.github.com/tribulant/a82a8f1487e1afcf01eb.js"></script>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#api_hosts').select2({
		tags: true
	});
});
	
function newsletters_api_newkey() {
	jQuery('#api_key_loading').show();

	jQuery.ajax({
		url: newsletters_ajaxurl + 'action=newsletters_api_newkey',
		success: function(response) {
			jQuery('#api_key_loading').hide();
			jQuery('#api_key').html(response);
		}
	});
}
</script>