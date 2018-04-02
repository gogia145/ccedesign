<!-- Save a Newsletter Template -->

<div class="wrap <?php echo $this -> pre; ?> newsletters">
	<h1><?php _e('Save a Template', 'wp-mailinglist'); ?></h1>
    
    <p>
    	<?php _e('This is a full HTML template and should contain at least <code>[newsletters_main_content]</code> somewhere.', 'wp-mailinglist'); ?><br/>
        <?php _e('You may use any of the', 'wp-mailinglist'); ?> <a class="button button-secondary" href="" onclick="jQuery.colorbox({title:'<?php _e('Shortcodes/Variables', 'wp-mailinglist'); ?>', maxHeight:'80%', maxWidth:'80%', href:'<?php echo admin_url('admin-ajax.php'); ?>?action=<?php echo $this -> pre; ?>setvariables'}); return false;"> <?php _e('shortcodes/variables', 'wp-mailinglist'); ?></a> <?php _e('inside templates.', 'wp-mailinglist'); ?><br/>
        <?php _e('Upload your images, stylesheets and other elements via FTP or the media uploader in WordPress.', 'wp-mailinglist'); ?><br/>
        <?php _e('Please ensure that all links, images and other references use full, absolute URLs.', 'wp-mailinglist'); ?>
    </p>
    
    <form action="?page=<?php echo $this -> sections -> themes; ?>&amp;method=save" method="post" enctype="multipart/form-data" id="newsletters-themes-form">
    	<?php echo $Form -> hidden('Theme[id]'); ?>
    	<?php echo $Form -> hidden('Theme[name]'); ?>
    	
    	<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
                            <label class="screen-reader-text" for="title"></label>
							<input placeholder="<?php echo esc_attr(stripslashes(__('Enter template title here', 'wp-mailinglist'))); ?>" onclick="jQuery('iframe#content_ifr').attr('tabindex', '2');" tabindex="1" id="title" autocomplete="off" type="text" name="Theme[title]" value="<?php echo esc_attr(stripslashes($Html -> field_value('Theme[title]'))); ?>" />
                        </div>
                    </div>
                    
                    <p>
                    	<label><input <?php echo ($Html -> field_value('Theme[type]') == "upload") ? 'checked="checked"' : ''; ?> onclick="newsletters_theme_change_type(this.value);" type="radio" name="Theme[type]" value="upload" id="Theme.type_upload" /> <?php _e('Upload an HTML File', 'wp-mailinglist'); ?></label>
						<label><input <?php echo ($Html -> field_value('Theme[type]') == "paste") ? 'checked="checked"' : ''; ?> onclick="newsletters_theme_change_type(this.value);" type="radio" name="Theme[type]" value="paste" id="Theme.type_paste" /> <?php _e('HTML Code', 'wp-mailinglist'); ?></label>
						<label><input <?php echo ($Html -> field_value('Theme[type]') == "builder" || $Html -> field_value('Theme[type]') == "") ? 'checked="checked"' : ''; ?> onclick="newsletters_theme_change_type(this.value);" type="radio" name="Theme[type]" value="builder" id="Theme.type_builder" /> <?php _e('Drag/Drop Builder', 'wp-mailinglist'); ?></label>
                    </p>
                    
                    <div id="Theme_type_builder_div" class="postarea edit-form-section" style="display:<?php echo ($Html -> field_value('Theme[type]') == "builder" || $Html -> field_value('Theme[type]') == "") ? 'block' : 'none'; ?>;">
	                    <div id="gjs">
		                    <?php if (empty($Theme -> data -> content)) : ?>
		                    	<?php 
			                    	
			                    ob_start();
			                    include($this -> plugin_base() . DS . 'views' . DS . 'email' . DS . 'builder-default.php');
								$content = ob_get_clean();
								echo stripslashes($content);
								
								?>
		                    <?php else : ?>
		                    	<?php echo stripslashes($Theme -> data -> content); ?>
		                    <?php endif; ?>
	                    </div>
	                    
	                    <textarea name="Theme[builder]" style="display:none;" id="Theme_builder"></textarea>
						
						<script type="text/javascript">
						var editor = grapesjs.init({
							container : '#gjs',
							clearOnRender: true,
							fromElement: true,
							storageManager: {
								id: 'newsletters-template-<?php echo $Theme -> data -> id; ?>',
								autosave: true,
								stepsBeforeSave: 1,
								type: ''
							},
							assetManager: {
								upload: newsletters_ajaxurl + "action=newsletters_importmedia",
							},
							plugins: ['gjs-preset-newsletter', 'gjs-plugin-wordpress'],
							pluginsOpts: {
								'gjs-preset-newsletter': {
									modalTitleImport: 'Import template',
									// ... other options
								},
								'gjs-plugin-wordpress': {
									// options here...
								}
							}
						});
						
						jQuery(document).ready(function() {
							jQuery('#gjs .gjs-frame').attr('id', "gjs-frame");
						});
						
						jQuery('#newsletters-themes-form').submit(function(event) {
							var content = '<!doctype html><html lang="en"><head><meta charset="utf-8"><style>' + editor.getCss() + '</style></head><body>' + editor.getHtml() + '</body></html>';
							jQuery('textarea#Theme_builder').text(content);
							return true;
						});
						</script>
						
						<?php echo $Html -> field_error('Template[builder]'); ?>
                    </div>
                    
                    <div id="Theme_type_paste_div" class="postarea edit-form-section" style="display:<?php echo ($Html -> field_value('Theme[type]') == "paste") ? 'block' : 'none'; ?>;">                        	                    
						<p>
							<button type="button" class="button button-secondary" id="thememediaupload" value="1">
								<i class="fa fa-image fa-fw"></i> <?php _e('Add Media', 'wp-mailinglist'); ?>
							</button>
						</p>
	        
				        <script type="text/javascript">
			        	jQuery(document).ready(function() {
							var file_frame;
							
							jQuery('#thememediaupload').on('click', function(event) {
								event.preventDefault();
								
								// If the media frame already exists, reopen it.
								if (file_frame) {
									file_frame.open();
									return;
								}
								
								// Create the media frame.
								file_frame = wp.media.frames.file_frame = wp.media({
									title: '<?php _e('Upload Media', 'wp-mailinglist'); ?>',
									button: {
										text: '<?php _e('Copy URL', 'wp-mailinglist'); ?>',
									},
									multiple: false  // Set to true to allow multiple files to be selected
								});
									
								// When an image is selected, run a callback.
								file_frame.on( 'select', function() {
									// We set multiple to false so only get one image from the uploader
									attachment = file_frame.state().get('selection').first().toJSON();
									
									// Do something with attachment.id and/or attachment.url here									
									window.prompt("Copy to clipboard: Ctrl+C, Enter", attachment.url);
								});
								
								// Finally, open the modal
								file_frame.open();
							});
			        	});
			        	</script>
				        
			        	<textarea name="Theme[paste]" class="widefat" contenteditable="true" id="Theme_paste" rows="10" cols="100%"><?php echo esc_attr(stripslashes($Theme -> data -> content)); ?></textarea>
                        
                        <?php echo $Html -> field_error('Template[content]'); ?>
                    </div>
                </div>
                <div id="postbox-container-1" class="postbox-container">
                	<?php do_action('submitpage_box'); ?>
                	<?php do_meta_boxes("admin_page_" . $this -> sections -> themes, 'side', $post); ?>
                </div>
                <div id="postbox-container-2" class="postbox-container">
                	<?php do_meta_boxes("admin_page_" . $this -> sections -> themes, 'normal', $post); ?>
                    <?php do_meta_boxes("admin_page_" . $this -> sections -> themes, 'advanced', $post); ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">	
jQuery(document).ready(function() {
	newsletters_focus('#Theme\\.title');
					
	jQuery('#Theme_acolor').iris({
		hide: true,
		change: function(event, ui) {
			jQuery('#acolorbutton').css('background-color', ui.color.toString());
		}
	});
	
	jQuery('#Theme_acolor').click(function(event) {
		event.stopPropagation();
	});
	
	jQuery('#acolorbutton').click(function(event) {							
		jQuery(this).attr('title', "Current Color");
		jQuery('#Theme_acolor').iris('toggle').toggle();								
		event.stopPropagation();
	});
	
	jQuery('html').click(function() {
		jQuery('#Theme_acolor').iris('hide').hide();
		jQuery('#acolorbutton').attr('title', "Select Color");
	});
	
	jQuery('textarea#Theme_paste').ckeditor({
    	fullPage: true,
		allowedContent: true,
		height: 500,
		entities: false,
		extraPlugins: 'image2,codesnippet,tableresize',
		autoGrow_onStartup: true
	});
});

function newsletters_theme_change_type(type) {
	if (type == "paste") {
		jQuery('#Theme_type_upload_div').hide();
		jQuery('#Theme_type_builder_div').hide();
		jQuery('#Theme_type_paste_div').show();
	} else if (type == "upload") {
		jQuery('#Theme_type_paste_div').hide();
		jQuery('#Theme_type_builder_div').hide();
		jQuery('#Theme_type_upload_div').show();
	} else if (type == "builder") {
		jQuery('#Theme_type_paste_div').hide();
		jQuery('#Theme_type_upload_div').hide();
		jQuery('#Theme_type_builder_div').show();
	}
	
}
</script>