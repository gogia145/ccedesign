<?php

global $ID, $post, $post_ID, $wp_meta_boxes;

$ID = $this -> get_option('imagespost');
$post_ID = $this -> get_option('imagespost');

?>

<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
<?php global $errors; ?>

<div class="wrap newsletters <?php echo $this -> pre; ?>">
    <h1><?php _e('Save a Snippet', 'wp-mailinglist'); ?></h1>
    <form action="?page=<?php echo $this -> sections -> templates_save; ?>" method="post" onsubmit="">
        <?php wp_nonce_field($this -> sections -> templates_save); ?>
        <?php echo $Form -> hidden('Template[id]'); ?>
        <?php echo $Form -> hidden('Template[sent]'); ?>
        <div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
                            <label class="screen-reader-text" for="title"></label>
							<input placeholder="<?php echo esc_attr(stripslashes(__('Enter snippet title here', 'wp-mailinglist'))); ?>" onclick="jQuery('iframe#content_ifr').attr('tabindex', '2');" tabindex="1" id="title" autocomplete="off" type="text" name="Template[title]" value="<?php echo esc_attr(stripslashes($Html -> field_value('Template[title]'))); ?>" />
                        </div>
                    </div>
                    <div id="<?php echo (user_can_richedit()) ? 'postdivrich' : 'postdiv'; ?>" class="postarea edit-form-section">                        
                        <!-- The Editor -->
						<?php if (version_compare(get_bloginfo('version'), "3.3") >= 0) : ?>
							<?php wp_editor(stripslashes($_POST['content']), 'content', array('tabindex' => 2)); ?>
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
										<span id="autosave" style="display:none;"></span>
									</td>
								</tr>
							</tbody>
						</table>
                        
                        <?php echo $Html -> field_error('Template[content]'); ?>
                    </div>
                </div>
                <div id="postbox-container-1" class="postbox-container">
                	<?php do_action('submitpage_box'); ?>
                	<?php do_meta_boxes("admin_page_" . $this -> sections -> templates_save, 'side', $post); ?>
                </div>
                <div id="postbox-container-2" class="postbox-container">
                	<?php do_meta_boxes("admin_page_" . $this -> sections -> templates_save, 'normal', $post); ?>
                    <?php do_meta_boxes("admin_page_" . $this -> sections -> templates_save, 'advanced', $post); ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	newsletters_focus('#title');
});
</script>