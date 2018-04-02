<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<div class="col-md-12 home_footer_quate">
 The 3rd annual  CEE Capital markets & FinTech Awards, an evening dedicated to recognizing excellence in the sector. this celebration  <br/>will take place in WARSAW at the Hotel intercontinental on 12 September,2018.
</div>


<div  class="col-md-12 footer">

<div class="col-md-3 footer1">
 
 <?php wp_nav_menu(array("theme_location"=>"primery","menu"=>"footer_menu",'menu_class' => 'footer-navigation', 'container' => 'ul',)); ?>

</div>

<div class="col-md-3 footer2">
 <h4>MEDIA PARTNERS</h4>
 
 <ul class="footer_media_partner">
   
   <li> <img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner1.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner2.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner3.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner4.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner5.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner6.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner7.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner8.png"></li>
   <li><img src="<?php bloginfo("template_directory"); ?>/img/mpartner/mediaPartner9.png"></li>
   
 </ul>
 
</div>

<div class="col-md-3 footer3" style="text-align:center">
<h4>PREMIUM VODKA BY</h4>
<img src="<?php bloginfo("template_directory"); ?>/img/footer_vodka.png" style="background:white;">
</div>

<div class="col-md-3 footer4">
<h4>FINE VINES BY:</h4>
<img src="<?php bloginfo("template_directory"); ?>/img/finevines.jpg">

<div class="col-md-12 footer_social">
<a href="http://www.facebook.com" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/img/facebook.png"></a><a href="http://www.instagram.com" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/img/instagram.png"></a><a href="https://www.pinterest.com/" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/img/pininterst.png"></a><a href="http://www.twitter.com" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/img/twitter.png"></a><a href="http://www.youtube.com" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/img/youtube.png"></a>
</div>



 <div class="col-md-12" style="color:white;">
 <br/>
 <br/>
    <p>Website Design by:Bector Technologies</p><br/>
    <p>&copy; Copyright 2018</p>
    <p>CEE Capital markets & FinTech Awards</p>	
			
			

</div>



</div>


  <!--/ footer-->

  <script src="<?php bloginfo("template_directory"); ?>/js/jquery.min.js"></script>
  <script src="<?php bloginfo("template_directory"); ?>/js/jquery.easing.min.js"></script>
  <script src="<?php bloginfo("template_directory"); ?>/js/bootstrap.min.js"></script>


<?php wp_footer(); ?>

</body>
</html>
