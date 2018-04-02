<?php
/**
Template name:Nomination Form 2018
 */

get_header(); ?>

  <section id="content" class="content">
  
	  <div class="container" style="padding-left: 4%;">
	 <?php  $page_image =wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
	        if($page_image!="")
			{
	 ?>
			<img src="<?php echo $page_image; ?>"  style="width:100%;height:250px;"> <br/><br/>

			<?php } else {		 ?>
			
			<img src="<?php bloginfo("siteurl"); ?>/wp-content/uploads/2018/03/slide2.jpg"  style="width:100%;height:250px;"> <br/><br/>
			
			<?php } ?>
			
			 <h2  class="page_title"><?php  the_title(); ?></h2>
			 <br/>
			 <br/>
			<div class="col-md-8">
			<script>
				function myFunction(val) {
					//alert("The input value has changed. The new value is: " + val);
				   window.location = "?form="+val;
					//alert(val);
				}
			</script>

			<select name="country" onchange="myFunction(this.value)" style="width: 100%;margin: 0 auto;padding: 1%;border: 1px solid lightgray;text-align: center;">
				<option value="0">Select 1 of 15 Nomination Forms</option>
				 
				<option value="2">Top US SSC Investor in Poland</option>
				<option value="3">Top US SSC Investor in Hungary</option>
				<option value="4">Top US SSC Investor in Czech Republic</option>
				<option value="12">Top US SSC Investor in Slovakia</option>
				<option value="6">Top US SSC Investor in Baltics</option>
				<option value="5">Top US SSC Investor in Romania</option>
				 
				<option value="7"> Top US Financial Services SSC Investor in CEE</option>
				<option value="8">Top Robotics/RPA Implementation in CEE</option>
				<option value="9">Top Global BPO/ITO Investor in CEE</option>
				<option value="10">Top CSR Initiative of the Year in CEE </option>

				 
				<option value="11">Top Digital Solutions provider to the US from: Poland </option>
				<option value="13">Top Digital Solutions provider to the US from: Hungary </option>
				<option value="14">Top Digital Solutions provider to the US from: Romania</option>
				<option value="15">Top Digital Solutions provider to the US from: Czech Republic or Slovakia</option>

				<option value="16">Top Digital Solutions provider to the US from: Ukraine, Bulgaria or Belarus</option>


			</select>
			
			<div class="form_list">
			  <?php 
			      $form_id = $_REQUEST['form'];
				  if($form_id!="")
				  {
			       echo do_shortcode('[gravityform id="'.$form_id.'" title="true" description="false"]'); 
				  }
				  else 
				  {
					  echo "Kindly select form from dropdown";
				  }
			  ?>
            </div>
				<?php while ( have_posts() ) : the_post(); ?>
					
				<?php 	 the_content(); ?>

				<?php endwhile; ?>
			
            </div>
	  
	<!-------- Sider Started -------------->
	  <?php get_sidebar(); ?>
	  
</section>	
<?php get_footer();
