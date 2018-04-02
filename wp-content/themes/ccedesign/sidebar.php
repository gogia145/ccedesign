<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

//if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	//return;
//}
?>

  <div class="col-md-4">
	  <br/>
       <ul class="side_country">
	   <li>POLAND</li>
	   <li>CZECH REPUBLIC</li>
	   <li>HUNGRY</li>
	   <li>SLOVAKIA</li>
	   <li>THE BALTICS</li>
	   <li>ROMANIA</li>
	   <li>BULGARIA</li>
	   <li>UKRAINE</li>
	   </ul>
<br/>
<br/>

	   <div class="col-md-12 institutional_partner">
	        <h3>Institutional Partners</h3>
			<br/>
            <?php echo do_shortcode('[metaslider id="57"]'); ?>
			
	  </div> 	

<br/>
<br/>
	  
	  <div class="col-md-12 shortlisted_companies">
	        <h3>Short Listed Companies</h3>
			<br/>
			
			<?php echo do_shortcode('[metaslider id="80"]'); ?>
			

	  </div> 	
	  
	  
	   <div class="col-md-12 shortlisted_companies">
	        <h3>Facebook Feed</h3>
			
			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/BiznesPolskaGroup" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/BiznesPolskaGroup" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BiznesPolskaGroup">BiznesPolska</a></blockquote></div>

		</div>
		
	    <div class="col-md-12 shortlisted_companies">
	        <h3>Twitter Feed</h3>
			<div style="max-height:500px;overflow:scroll;">
			<a class="twitter-timeline"  href="https://twitter.com/CeeCapMarkets">National Park Tweets - Curated tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
			</div>
		</div>
	   
	  </div>
