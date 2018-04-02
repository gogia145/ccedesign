<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section id="content" class="content">
  
	  <div class="container">
	  <div class="col-md-8">


			<?php
			while ( have_posts() ) : the_post();
                
				 the_content();

			endwhile; // End of the loop.
			?>
			
			
			
		

		
			<div  class="col-md-12 home_ticket_box"> 

			<div class="col-md-12 home_ticket_box_inner"> 
			   JOIN US AND NETWORK WITH THE ATTENDEES. &nbsp;&nbsp; <a href="<?php bloginfo("siteurl"); ?>/attandance/" class="btn btn-appoint" >TICKETS</a>
			</div>

			</div>

			<div class="col-md-12 home_video">
			   
			   <iframe src="https://www.youtube.com/embed/WKMHDDNwTZM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			   
			   <iframe src="https://www.youtube.com/embed/WKMHDDNwTZM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			   
			</div>

			<div class="col-md-12 home_newsletter"> 

			<p><b>NEWSLETTER REGISTRATION</b></p>
			<?php //echo do_shortcode('[newsletters_subscribe form=1]'); ?>
			
			<form class=" newsletters-subscribe-form newsletters-subscribe-form-ajax" action="/ccedesign/?wpmlmethod=optin#newsletters-1-form" method="post" id="newsletters-1-form" enctype="multipart/form-data">
				<input name="form_id" value="1" type="hidden">
				<input name="scroll" value="0" type="hidden">
				
								
									<div class="form-group newsletters-fieldholder newsletters-fieldholder-visible" style="width: 50%;float: left;"><label for="" class="control-label wpmlcustomfield wpmlcustomfield1">Email Address <sup class="newsletters_required text-danger"><i class="fa fa-asterisk"></i></sup></label> <input class="form-control wpml wpmltext" id="wpml-1email" tabindex="912" name="email" value="" type="text"></div>
									<div class="form-group newsletters-fieldholder newsletters-fieldholder-hidden hidden"><label for="" class="control-label wpmlcustomfield wpmlcustomfield2">Mailing List <sup class="newsletters_required text-danger"><i class="fa fa-asterisk"></i></sup></label> <input name="list_id[]" value="1" type="hidden"></div>
								
								
				<div class="newslettername-wrapper" style="display:none;">
			    	<input name="newslettername" value="" id="newsletters-1newslettername" class="newslettername" type="text">
			    </div>
				
				<div id="newsletters-form-1-submit" class="form-group newsletters-fieldholder newsletters_submit" style="float: left;">
					<span class="newsletters_buttonwrap">
						<button value="1" type="submit" name="subscribe" id="newsletters-1-button" class="btn btn-appoint" style="margin-top:20px;">Subscribe </button>
					</span>
				</div>
				
				
				
			</form>
			
			<!--b>EMAIL ADDRESS<span style="color:red;">*</span>:</b>&nbsp;<input type="text" class="texttype" required> &nbsp;<input type="submit" class="btn btn-appoint" value="SUBSCRIBE" style="margin-top:0px;"-->
			</div>




      </div>
	  
	<!-------- Sider Started -------------->
	  
    	<?php get_sidebar(); ?>
  
  </section>
 
 

  
		
<?php get_footer();
