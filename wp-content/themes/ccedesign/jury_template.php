<?php
/**
 Template Name:Jury
 */

get_header(); ?>

<style>
.container_box
{
	min-height:420px;
}
</style>

  <section id="content" class="content">
  
	  <div class="container" style="padding-left: 4%;">
	 <?php  $page_image =wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
	        if($page_image!="")
			{
	 ?>
			<img src="<?php echo $page_image; ?>"  style="width:100%;height:250px;"> <br/><br/>

			<?php } else {		 ?>
			
			<img src="http://localhost/ccedesign/wp-content/uploads/2018/03/slide2.jpg"  style="width:100%;height:250px;"> <br/><br/>
			
			<?php } ?>
			
			 <h2  class="page_title"><?php  the_title(); ?></h2>
			 <br/>
			 <br/>
			<div class="col-md-8">
			
                
			<?php 

             while(have_posts()): the_post();
			 
			     the_content();
			 
			 endwhile;
			
?><br/><br/><?php 
			$args = array(  
					'post_type' => 'team', 
					'showposts'=>'-1',
					'order'=>'asc',
					'tax_query' => array( 
						array( 
							'taxonomy' => 'team_categories', 
							'field' => 'id', 
							'terms' => array('6') 
							) 
						) 
					); 

				query_posts($args);

				  while(have_posts()): the_post();	?>
				  
				  <div class="container_box" data-toggle="modal" data-target="#exampleModal<?php echo $post->ID?>">
					  <?php the_post_thumbnail(); ?>
					  <!--div class="overlay">
						<div class="text"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  </div-->
					  
					  <div class="text1" style="text-align: center;padding:1%;"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  
					</div>

			<?php endwhile;  wp_reset_query();?>
			
			
			<div style="width: 100%; display: inline-block; padding: 4% 0 4% 0;"><b>Brokers/Bankers</b></div>
			
			
			<?php 
			
			$args = array(  
					'post_type' => 'team', 
					'showposts'=>'-1',
					'order'=>'asc',
					'tax_query' => array( 
						array( 
							'taxonomy' => 'team_categories', 
							'field' => 'id', 
							'terms' => array('7') 
							) 
						) 
					); 

				query_posts($args);

				  while(have_posts()): the_post();	?>
				  
				  <div class="container_box" data-toggle="modal" data-target="#exampleModal<?php echo $post->ID?>">
					  <?php the_post_thumbnail(); ?>
					  <!--div class="overlay">
						<div class="text"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  </div-->
					  <div class="text1" style="text-align: center;padding:1%;"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					</div>

			<?php endwhile;  wp_reset_query();?>
			
			
			
			<div style="width: 100%; display: inline-block; padding: 4% 0 4% 0;"><b>Institutional and Media Partners</b></div>
			
			<?php 
			
			$args = array(  
					'post_type' => 'team', 
					'showposts'=>'-1',
					'order'=>'asc',
					'tax_query' => array( 
						array( 
							'taxonomy' => 'team_categories', 
							'field' => 'id', 
							'terms' => array('8') 
							) 
						) 
					); 

				query_posts($args);

				  while(have_posts()): the_post();	?>
				  
				  <div class="container_box" data-toggle="modal" data-target="#exampleModal<?php echo $post->ID?>">
					  <?php the_post_thumbnail(); ?>
					  <!--div class="overlay">
						<div class="text"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  </div-->
					  <div class="text1" style="text-align: center;padding:1%;"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  
					</div>

			<?php endwhile;  wp_reset_query();?>
			
			
			
			<div style="width: 100%; display: inline-block; padding: 4% 0 4% 0;"><b>Stock Exchanges in the CEE region</b></div>
			
			<?php 
			
			$args = array(  
					'post_type' => 'team', 
					'showposts'=>'-1',
					'order'=>'asc',
					'tax_query' => array( 
						array( 
							'taxonomy' => 'team_categories', 
							'field' => 'id', 
							'terms' => array('9') 
							) 
						) 
					); 

				query_posts($args);

				  while(have_posts()): the_post();	?>
				  
				  <div class="container_box" data-toggle="modal" data-target="#exampleModal<?php echo $post->ID?>">
					  <?php the_post_thumbnail(); ?>
					  <!--div class="overlay">
						<div class="text"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					  </div-->
					  <div class="text1" style="text-align: center;padding:1%;"><?php the_title(); ?> <br/> <div style="font-size:12px;"><?php the_excerpt(); ?></div></div>
					</div>

			<?php endwhile;  wp_reset_query();?>
			
			<div style="width: 100%; display: inline-block; padding: 4% 0 4% 0;">
			<?php the_field("bottom_content"); ?>
			</div>
      </div>
	  
	<!-------- Sider Started -------------->
	  <?php get_sidebar(); ?>
	  
</section>	
<?php get_footer();
