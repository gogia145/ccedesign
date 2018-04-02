<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory");?>/css/animate.css">
<?php wp_head(); ?>




</head>

<body <?php body_class(); ?>>

<div class="container">
 <div class="col-md-5 top_logo">
 <?php 	$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
    <a href="<?php bloginfo("siteurl"); ?>"><img src="<?php echo $image[0];  ?>" alt="logo" > </a>
	<p class="text-center"><b><?php echo "&nbsp;".get_bloginfo( 'description' ); ?></b><p>
 </div>
 <div class="col-md-4 top_bar_text ">
   <?php echo get_option("top_right_content"); ?>
 </div>
 
 </div>
 
 <div class="container">
		 <nav class="navbar navbar-default">
		 
		  <div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
		 </div>
		 <div class="collapse navbar-collapse navbar-right" id="myNavbar">
			
			<?php wp_nav_menu(array("theme_location"=>"primery","menu"=>"top_menu",'menu_class' => 'nav navbar-nav', 'container' => 'ul',)); ?>
			
		
		</nav>
 
    </div>
 </div>

 <?php if(is_front_page()) { ?>
  <section id="banner" class="banner">
 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	
	 <?php query_posts("post_type=slider&showposts=-1"); 
        $r=1; 	    
		while(have_posts()): the_post();
			$slider_image =wp_get_attachment_url( get_post_thumbnail_id($post->ID));;
			//print_r($slider_image);
		if($r==1)
		{			
	  ?>
	  <div class="item active">
        <img src="<?php echo $slider_image; ?>" alt="<?php the_title(); ?>" style="width:100%;">
      </div>
		<?php }
          else 
		  {?>
	  
	  <div class="item">
        <img src="<?php echo $slider_image; ?>" alt="<?php the_title(); ?>" style="width:100%;">
      </div>
		<?php }
		$r++; endwhile; wp_reset_query(); ?>

      
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"> << </span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right">>></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
 <div class="container">
          <div class="banner-info">
            <div class="banner-logo text-center">
              
            </div>
            <div class="banner-text ">
               <?php  echo get_option("slider_content"); ?>
            </div>
           
          </div>
    </div>   
  </section>
 <?php } ?> 