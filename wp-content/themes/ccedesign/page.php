<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
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
			
			 <h2  class="page_title"><?php  the_title(); ?> <div style="width:30%;float:right;margin-top: -1%;"><?php if(is_page('11')) { ?><a href="http://bectortechnologies.com/ccedesign/nomination-form-2018/"><button class="btn btn-appoint" style="margin-top:0px;" align="center">Nomination form 2018</button></a><?php  } ?> </div> </h2>
			 <br/>
			 <br/>
			<div class="col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
			
			 
                
			<?php 	 the_content(); ?>

			<?php endwhile; ?>
			
             </div>
	  
	<!-------- Sider Started -------------->
	  <?php get_sidebar(); ?>
	  
</section>	
<?php get_footer();
