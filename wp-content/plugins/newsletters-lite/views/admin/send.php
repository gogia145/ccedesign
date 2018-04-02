<script type="text/javascript">
var contentarea = 1;
</script>

<?php

global $ID, $post, $post_ID, $wp_meta_boxes, $errors;

$imagespost = $this -> get_option('imagespost');
$p_id = (empty($_POST['p_id'])) ? $imagespost : esc_html($_POST['p_id']);
$ID = $p_id;
$post_ID = $p_id;

wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false);

$builderon = get_user_option('newsletters_builderon', get_current_user_id());
if (empty($builderon) && !empty($_POST['builderon'])) {
	$builderon = 1;
}

?>

<div class="wrap <?php echo $this -> pre; ?> <?php echo $this -> sections -> send; ?> newsletters">
	<?php if (!empty($_GET['id'])) : ?>
		<h1><?php _e('Edit Newsletter', 'wp-mailinglist'); ?> <a href="?page=<?php echo $this -> sections -> send; ?>" class="add-new-h2"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>
	<?php else : ?>
		<h1><?php _e('Create Newsletter', 'wp-mailinglist'); ?></h1>
	<?php endif; ?>
	<form action="<?php echo admin_url('admin.php?page=' . $this -> sections -> send); ?>" method="post" id="post" name="post" enctype="multipart/form-data">
		<?php wp_nonce_field($this -> sections -> send); ?>
		<input type="hidden" name="newsletter" value="1" />
		<input type="hidden" name="group" value="all" />
		<input type="hidden" id="ishistory" name="ishistory" value="<?php echo esc_html($_POST['ishistory']); ?>" />
		<input type="hidden" id="p_id" name="p_id" value="<?php echo esc_html($_POST['p_id']); ?>" />
		<input type="hidden" name="inctemplate" value="<?php echo esc_html($_POST['inctemplate']); ?>" />
		<input type="hidden" id="builderon" name="builderon" value="<?php echo $builderon; ?>" />
		<input type="hidden" name="recurringsent" value="<?php echo esc_attr(stripslashes($_POST['sendrecurringsent'])); ?>" />
		<input type="hidden" name="post_id" value="<?php echo esc_attr(stripslashes($_POST['post_id'])); ?>" />
		
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<label class="screen-reader-text" for="title"></label>
							<input onclick="jQuery('iframe#content_ifr').attr('tabindex', '2');" tabindex="1" id="title" autocomplete="off" type="text" placeholder="<?php echo esc_attr(stripslashes(__('Enter email subject here', 'wp-mailinglist'))); ?>" name="subject" value="<?php echo esc_attr(stripslashes($_POST['subject'])); ?>" />
							
							<?php /*<div id="newsletters-emoticon">
								<a href="" class="button"><i class="fa fa-smile-o fa-fw"></i> <?php _e('Insert Emoticon', 'wp-mailinglist'); ?></a>
								
								<div id="newsletters-emoticon-selection">
								</div>
							</div>*/ ?>
						</div>
						<?php if (!empty($errors['subject'])) : ?>
							<div class="ui-state-error ui-corner-all">
								<p><i class="fa fa-exclamation-triangle"></i> <?php echo $errors['subject']; ?></p>
							</div>
						<?php endif; ?>
						<div class="inside">
						<div id="edit-slug-box" class="hide-if-no-js" style="display:<?php echo (!empty($_POST['ishistory'])) ? 'block' : 'none'; ?>;">
							<?php $newsletter_url = $Html -> retainquery($this -> pre . 'method=newsletter&id=' . esc_html($_POST['ishistory']), home_url()); ?>
							<strong><?php _e('Permalink:', 'wp-mailinglist'); ?></strong>
							<span id="sample-permalink" tabindex="-1"><?php echo $newsletter_url; ?></span>
							<span id="view-post-btn"><a href="<?php echo $newsletter_url; ?>" target="_blank" class="button button-small"><?php _e('View Newsletter', 'wp-mailinglist'); ?></a></span>
							<input id="shortlink" type="hidden" value="<?php echo $newsletter_url; ?>">
							<a href="#" class="button button-small" onclick="prompt('URL:', jQuery('#shortlink').val()); return false;"><?php _e('Get Link', 'wp-mailinglist'); ?></a></div>
						</div>
					</div>
					<?php do_action('edit_form_after_title', $post); ?>
					
					<div id="usebuilder-wrapper">
						<button type="button" name="usebuilder" id="usebuilder" class="btn btn-lg btn-success <?php echo (!empty($builderon)) ? 'active builderon' : 'builderoff'; ?>">
							<i class="fa fa-eye fa-fw"></i> <?php _e('Use Newsletter Builder', 'wp-mailinglist'); ?> <sup>beta</sup>
						</button>
						
						<script type="text/javascript">
						var usebuilder_request = false;
							
						jQuery('#usebuilder').on('click', function(event) {							
							var builderbutton = jQuery(this);
							var status = false;
							if (builderbutton.hasClass('builderoff')) {
								jQuery('input#builderon').val('1');
								builderbutton.removeClass('builderoff').addClass('builderon active');
								jQuery('#postdivrich, #postdiv, #previewdiv, #themesdiv').hide();
								jQuery('#newsletters_builder').show();
								status = true;
							} else if (builderbutton.hasClass('builderon')) {
								jQuery('input#builderon').val('');
								builderbutton.removeClass('builderon active').addClass('builderoff');
								jQuery('#postdivrich, #postdiv, #previewdiv, #themesdiv').show();	
								jQuery('#newsletters_builder').hide();
								status = false;
							}
							
							if (usebuilder_request) {
								usebuilder_request.abort();
							}
							
							usebuilder_request = jQuery.ajax({
								method: "POST",
								url: newsletters_ajaxurl + 'action=newsletters_builderon',
								data: {
									status: status
								}
							}).done(function(response) {
								//done
							}).error(function(response) {
								//error
							}).always(function(response) {
								//always
							});
						});
						</script>
					</div>
					
					<div id="newsletters_builder" style="display:<?php echo (!empty($builderon)) ? 'block' : 'none'; ?>;">
						<p>
							<select name="newsletters_builder_template" id="newsletters_builder_template">
								<option value=""><?php _e('- No Template -', 'wp-mailinglist'); ?></option>
								<?php if ($templates = newsletters_get_templates()) : ?>
									<?php foreach ($templates as $template) : ?>
										<option value="<?php echo esc_attr(stripslashes($template -> id)); ?>"><?php _e($template -> title); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<button type="button" id="updatebuilder" class="btn btn-sm btn-info">
								<i class="fa fa-paint-brush fa-fw"></i> <?php _e('Load Template', 'wp-mailinglist'); ?>
								<span id="newsletters_builder_template_loading" style="display:none;">
									<i class="fa fa-refresh fa-spin fa-fw"></i>
								</span>
							</button>
						</p>
						
						<div id="gjs">
		                    <!-- Builder content goes here -->
		                    <?php echo $this -> getbodyandcss($_POST['content']); ?>
	                    </div>
	                    
	                    <?php 
		                    
		                $assets = array();
		                
		                $args = array(
			                'post_type'				=>	"attachment",
							'orderby'				=>	"date",
							'order'					=>	"DESC",
							'numberposts'			=>	50,
		                );
		                
		                if ($attachments = get_posts($args)) {
			                foreach ($attachments as $attachment) {
				                $assets[] = array('src' => $attachment -> guid);
			                }
		                }  
		                    
		                ?>
						
						<script type="text/javascript">
						function startbuilder() {
							var assets = <?php echo json_encode($assets); ?>;
							
							var editor = grapesjs.init({
								container : '#gjs',
								clearOnRender: true,
								fromElement: true,
								storageManager: {
									id: 'newsletters-builder-<?php echo esc_js($_POST['ishistory']); ?>',
									autosave: true,
									stepsBeforeSave: 1,
									type: ''
								},
								assetManager: {
									assets: assets,
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
							
							jQuery('*[title]').each(function () {
								var el = $(this);
								var title = el.attr('title').trim();
								
								if(!title)
									return;
									
								el.attr('data-tooltip', el.attr('title'));
								el.attr('title', '');
						    });
							
							editor.on('change', function(event) {								
								var updatecontent = '<style>' + editor.getCss() + '</style>' + editor.getHtml();
								newsletters_tinymce_setcontent(updatecontent);
							});
						}
						
						startbuilder();
						
						jQuery(document).ready(function() {																					
							jQuery('#gjs .gjs-frame').attr('id', "gjs-frame");
							
							<?php if (!empty($builderon)) : ?>
								jQuery('#postdivrich, #postdiv, #previewdiv, #themesdiv').hide();
								//startbuilder();
							<?php endif; ?>
						});
						
						jQuery('#updatebuilder').on('click', function(event) {							
							if (!confirm('<?php echo esc_js(stripslashes(__('Current content in the builder will be lost, are you sure?', 'wp-mailinglist'))); ?>')) {
								return false;
							}
							
							var template_id = jQuery('#newsletters_builder_template').val();
							if (typeof template_id != 'undefined' && template_id != '') {
								jQuery('#newsletters_builder_template_loading').show();
								jQuery('#updatebuilder').prop('disabled', true);
								jQuery("input[name=theme_id]").val([template_id]);
								
								var buildertemplate_request = jQuery.ajax({
									method: "POST",
									url: newsletters_ajaxurl + 'action=newsletters_get_template',
									data: {
										template_id: template_id
									}
								}).done(function(response) {
									jQuery('#gjs').html(response);
									startbuilder();
									newsletters_tinymce_setcontent(response);
								}).error(function(response) {
									alert('<?php _e('Ajax call failed, please try again', 'wp-mailinglist'); ?>');
								}).always(function(response) {
									jQuery('#newsletters_builder_template_loading').hide();
									jQuery('#updatebuilder').prop('disabled', false);
								});
							}
							
							return false;
						});
						</script>					
					</div>
					
					<div id="<?php echo (user_can_richedit()) ? 'postdivrich' : 'postdiv'; ?>" class="postarea edit-form-section" style="position:relative; display:<?php echo (!empty($builderon)) ? 'none' : 'block'; ?>;">
						<!-- The Editor -->
						
						<?php
						
						$setup = "";
						ob_start();
						
						echo "function (ed) {
							
							ed.on('change', function(e) {
								jQuery('#previewiframe').contents().find('html div.newsletters_content').html(ed.getContent());
							});
							
							ed.on('keyup', function(e) {
								var content = ed.getContent();
								var div = document.createElement('div');
								div.innerHTML = content;
								var preheader = div.textContent || div.innerText || '';
								preheader = preheader.substr(0,100);
								jQuery('.newsletters-preview-preheader').text(preheader);
							});
						
							//ed.onKeyDown.add(function (ed, evt) {
							ed.on('keydown', function(e) {
				            	//var content = jQuery('iframe#content_ifr').contents().find('body#tinymce').html();
				            	var content = ed.getContent();
				            	jQuery('#previewiframe').contents().find('html div.newsletters_content').html(content);
				            	
								var val = jQuery.trim(content),  
								words = val.replace(/\s+/gi, ' ').split(' ').length,
								chars = val.length;
								if(!chars)words=0;
								
								jQuery('#word-count').html(words + ' " . __('words and', 'wp-mailinglist') . " ' + chars + ' " . __('characters', 'wp-mailinglist') . "');
				            });
						}";
						
						$setup = ob_get_clean();
						
						$tinymce = array('setup' => $setup);
						
						?>
						
						<?php if (version_compare(get_bloginfo('version'), "3.3") >= 0) : ?>
							<?php wp_editor(stripslashes($_POST['content']), 'content', array('tabindex' => "2", 'tinymce' => $tinymce)); ?>
						<?php else : ?>
							<?php the_editor(stripslashes($_POST['content']), 'content', 'title', true, 2); ?>
						<?php endif; ?>
						
						<table id="post-status-info" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td id="wp-word-count">
										<?php _e('Word Count:', 'wp-mailinglist'); ?>
										<span id="word-count">0</span>
									</td>
									<td class="autosave-info">
										<span id="autosave" style="display:none;">
											
										</span>
									</td>
								</tr>
							</tbody>
						</table>
						
						<?php if (!empty($errors['content'])) : ?>
							<div class="ui-state-error ui-corner-all">
								<p><i class="fa fa-exclamation-triangle"></i> <?php echo $errors['content']; ?></p>
							</div>
						<?php endif; ?>
						
						<p>
							<button value="1" type="button" class="button button-secondary" id="addcontentarea_button" onclick="addcontentarea(); return false;">
								<i class="fa fa-plus-circle fa-fw"></i> <?php _e('Add Content Area', 'wp-mailinglist'); ?>
								<span id="contentarea_loading" style="display:none;"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
							</button>							
						</p>
						<div id="contentareas">
							<!-- Content Areas Go Here -->
						</div>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<?php do_action('submitpage_box'); ?>
					<?php do_meta_boxes("newsletters_page_" . $this -> sections -> send, 'side', $post); ?>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<?php do_meta_boxes("newsletters_page_" . $this -> sections -> send, 'normal', $post); ?>
                    <?php do_meta_boxes("newsletters_page_" . $this -> sections -> send, 'advanced', $post); ?>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	
<?php $history_id = (empty($_POST['ishistory'])) ? esc_html($_GET['id']) : esc_html($_POST['ishistory']); ?>

<?php if (!empty($history_id)) : ?>
var history_id = "<?php echo $history_id; ?>";
<?php else : ?>
var history_id = false;
<?php endif; ?>
	
var warnMessage = "<?php echo addslashes(__('You have unsaved changes on this page! All unsaved changes will be lost and it cannot be undone.', 'wp-mailinglist')); ?>";

function deletecontentarea(number, history_id) {
	if (history_id != "") {
		var data = {number:number, history_id:history_id};
		jQuery.post(newsletters_ajaxurl + 'action=newsletters_deletecontentarea', data, function(response) {
			//all good, the request was successful
			
		});
	} else {
		tinyMCE.execCommand("mceRemoveEditor", false, 'contentarea' + number);
		contentarea--;
	}
	
	jQuery('#contentareabox' + number).remove();
}

function addcontentarea() {	
	jQuery('#addcontentarea_button').prop('disabled', true);
	jQuery('#contentarea_loading').show();
	jQuery.post(newsletters_ajaxurl + 'action=newsletters_load_new_editor', {contentarea:contentarea}, function(response) {
		jQuery('#contentareas').append(response);
		jQuery('#addcontentarea_button').prop('disabled', false);
		
		if (typeof(tinyMCE) == "object" && typeof(tinyMCE.execCommand) == "function") {
			jQuery('#contentarea_loading').hide();
			quicktags({id:'contentarea' + contentarea});
			tinyMCE.execCommand("mceAddEditor", false, 'contentarea' + contentarea);	
			wpml_scroll('#contentareabox' + contentarea);		
			contentarea++;
		}
	});
}

var newsletter_autosave_request = false;

function newsletter_autosave() {	
	if (newsletter_autosave_request) {
		newsletter_autosave_request.abort();
	}
	
	var content = newsletters_tinymce_content('content');
	
	if (typeof(tinyMCE) == "object" && typeof(tinyMCE.execCommand) == "function") {
		tinyMCE.triggerSave();
	}
	
	var formvalues = jQuery('form#post').serialize();
	newsletter_autosave_running();
	
	newsletter_autosave_request = jQuery.ajax({
		cache: false,
		data: formvalues,
		dataType: "json",
		url: newsletters_ajaxurl + 'action=newsletters_autosave',
		type: "POST",
		success: function(response) {			
			jQuery('#spamscore_result').html(response.parts.spamscore.output);
			jQuery('#newwindowbutton').removeAttr('disabled').attr('href', response.parts.preview.url);
			jQuery('#ishistory').val(response.history_id); 
			jQuery('#p_id').val(response.post_id);
			jQuery('#edit-slug-box').show();
			jQuery('#sample-permalink').html(response.parts.preview.url);
			jQuery('#view-post-btn a').attr('href', response.parts.preview.url);
			jQuery('#shortlink').attr('value', response.parts.preview.url).val(response.parts.preview.url);
			
			if (typeof response.parts.preview.html != 'undefined') { jQuery('#previewiframe').contents().find('html').html(response.parts.preview.html); }
			var iframeheight = jQuery("#previewiframe").contents().find("html").outerHeight();
			jQuery("#previewiframe").height(iframeheight).css({height: iframeheight}).attr("height", iframeheight);
			var date = new Date();
			var year = date.getFullYear();
			var month = ("0" + (date.getMonth() + 1)).slice(-2);
			var day = ("0" + date.getDate()).slice(-2);
			var hours = ("0" + date.getHours()).slice(-2);
			var minutes = ("0" + date.getMinutes()).slice(-2);
			var today = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
			var autosavedate = year + '-' + ('0' + (month + 1)).slice(-2) + '-' + day + ' ' + hours + ':' + minutes;
			jQuery('#autosave').html('<?php _e('Draft saved at', 'wp-mailinglist'); ?> ' + autosavedate).show();
			
			newsletter_autosave_done();
		}
	});
	
	return true;
}

function newsletter_autosave_running() {
	jQuery('#sendbutton, #sendbutton2').prop('disabled', true);	
	jQuery('#spamscore_report_link_holder').hide();
	jQuery('iframe#content_ifr').attr('tabindex', "2");
	jQuery('#spamscorerunnerbutton').attr('disabled', "disabled");
	jQuery('#spamscorerunnerloading').show();
	jQuery('#previewrunnerbutton').attr('disabled', "disabled");
	jQuery('#previewrunnerloading').show();
}

function newsletter_autosave_done() {
	jQuery('#sendbutton, #sendbutton2').prop('disabled', false);
	//jQuery('#savedraftbutton, #savedraftbutton2').prop('disabled', false);
	
	jQuery('#spamscorerunnerloading').hide();
	jQuery('#spamscorerunnerbutton').removeAttr('disabled');
	jQuery('#previewrunnerbutton').removeAttr('disabled');
	jQuery('#previewrunnerloading').hide();
	
	warnMessage = null;
}

jQuery(document).ready(function() {
	
	newsletters_focus('#title');
	
	jQuery('#title').on('keyup', function(e) {
		jQuery('.newsletters-preview-subject').html(jQuery(this).val());
	});
	
	jQuery('#fromname').on('change', function(e) {
		jQuery('.newsletters-preview-fromname').html(jQuery(this).val());
	});
	
	_wpMediaViewsL10n.insertIntoPost = "<?php _e('Insert into Newsletter', 'wp-mailinglist'); ?>";
	_wpMediaViewsL10n.uploadedToThisPost = "<?php _e('Uploaded to this Newsletter', 'wp-mailinglist'); ?>";
	
	jQuery('iframe#content_ifr').attr('tabindex', "2");

    jQuery('input:not(:button,:submit),textarea,select').change(function() {    
        window.onbeforeunload = function () {
            if (warnMessage != null) return warnMessage;
        }
    });
    
    if (history_id != false) {
	    setTimeout(function() {
	    	newsletter_autosave();
	    }, 30000);
    }
    
    setTimeout(function() {
    	var newsletter_autosave_interval = setInterval(newsletter_autosave, 60000);
    }, 30000);
    
    jQuery(':submit').click(function(e) {
        warnMessage = null;
    });
});
</script>