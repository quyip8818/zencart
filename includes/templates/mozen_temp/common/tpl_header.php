<?php
/**
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 @version $Id: tpl_header.php 3392 2006-04-08 15:17:37Z birdbrain $
 */
?>


<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
?>
					<?php 
							$image = $slideshow_result->fields['logo_image'];
							$logo_txt = $slideshow_result->fields['logo_txt'];
							$tagline = $slideshow_result->fields['tagline'];
							$display_logo = $slideshow_result->fields['display_logo'];
							$call_us = $slideshow_result->fields['call_us'];
					?>
<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>
<div id="mj-topbar"><!-- mj-topabar -->
    	<div class="mj-subcontainer"><!-- mj-subcontainer -->
            <div class="mj-grid16 mj-lspace">
                CALL US : <?php echo $call_us; ?>
			</div>             	
            
            
            <div class="mj-grid40 mj-rspace"> <!--Top bar Links on the Right-->
            	<ul class="menu">
					<?php if ($_SESSION['customer_id']) { ?>
                    	<li><a><?php echo $currencies->format($_SESSION['cart']->show_total());?></a></li>
    					<li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
    					<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a></li>
                        <li><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG ?>index.php?main_page=shopping_cart"><?php echo BOX_HEADING_SHOPPING_CART; ?></a></li>
					<?php } 
					else 
					{
        				if (STORE_STATUS == '0') 
					{?>
					<li><a><?php echo $currencies->format($_SESSION['cart']->show_total());?></a></li>
					<li><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG ?>index.php?main_page=shopping_cart"><?php echo BOX_HEADING_SHOPPING_CART; ?></a></li>
					<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
    				<li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a></li>
					<?php }?>

                    <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a></li>
					<?php } } ?>
 					<li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a></li>
                </ul>
            </div><!--Top bar Links on the Right Ends-->
        </div><!-- mj-subcontainer End -->
	</div><!-- mj-topabar -->

	<div id="mj-header"><!-- mj-header -->
    	<div class="mj-subcontainer"><!-- mj-subcontainer -->
        	<div id="mj-logo" class="mj-grid48 mj-lspace">
				<a href="index.php?main_page=index">
                    
                    <?php 
					if($display_logo=="yes")
					{
						if($image!=NULL) { ?>
							<img alt="<?php if($image!=NULL){ echo "logo"; } ?>" src="<?php echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images')
								.'/logo/'.$image;?>"> 	
                    <?php } 
						 echo $logo_txt; 			//Logo Display
					}
					else{
					?>
					<?php echo $logo_txt; }  ?> 			<!--Logo Display-->
					
                    <span class="tagline"><?php echo $tagline; ?></span> <!--Tagline for the logo-->
				
                </a> 
            </div>
            
                    <div class="mj-grid16 mj-rspace mj-lspace">
                        <div id="mj-languagebar"><!-- mj-languagebar Start -->
                            
                            <div class="mj-currencies"><!--mj-currencies Start--> 
                                <?php echo zen_draw_form('currencies', zen_href_link(basename(ereg_replace('.php','', $PHP_SELF)), '', $request_type, false), 'get')?>
                                <?php if (isset($currencies) && is_object($currencies)) 
                                {
                                  reset($currencies->currencies);
                                  $currencies_array = array();
                                  while (list($key, $value) = each($currencies->currencies)) 
                                  {
                                    $currencies_array[] = array('id' => $key, 'text' => $value['title']);
                                  }
                                  $hidden_get_variables = '';
                                  reset($_GET);
                                  while (list($key, $value) = each($_GET)) 
                                  {
                                    if ( ($key != 'currency') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) 
                                    {
                                        $hidden_get_variables .= zen_draw_hidden_field($key, $value);
                                    }
                                  }
                                }
                                ?>
                                <?php echo zen_draw_pull_down_menu('currency', $currencies_array, $_SESSION['currency'], ' onchange="this.form.submit();"') . 
                                $hidden_get_variables . zen_hide_session_id()?></form>
                            </div><!--mj-currencies End--> 
                        </div>
                    </div>
                    
                    <div class="mj-grid32 mj-lspace"> <!--Search Bar-->
                        <?php
                          $text = str_replace("ENTER SEARCH KEYWORDS HERE", "Search here..", "ENTER SEARCH KEYWORDS HERE");
                          $content = "";
                          $content .= zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
                          $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
                          $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
            
                          $content .= '<div class="search">' . zen_draw_input_field('keyword', '', 'class="search-text" maxlength="30" value="'.$text.'" 
						  onfocus="if(this.value == \''.$text.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . $text . '\';"') . 
						  '<button id="search-button" type="submit"><span>Search</span></button></div>';
                          $content .= "</form>";
						  
						  
                          echo($content);
                        ?>
                    </div><!--Search Bar Ends-->
            
        </div><!-- mj-subcontainer End-->
	</div><!-- mj-header End-->

	<div id="mj-righttop">
    		<div class="mj-subcontainer">
                <div id="mj-menubar">
                    <?php require($template->get_template_dir('tpl_drop_menu.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_drop_menu.php');?>
  		   		</div><!--Menu-->
           </div>
    </div><!-- mj-righttop End-->
                
    <!--bof-header ezpage links-->
    <?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
    <?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
    <?php } ?>
    <!--eof-header ezpage links-->
                
            


<?php if ($this_is_home_page) { ?>


			<div id="mj-slideshow">
            	<div class="mj-subcontainer">
            		 <div class="flexslider">
                      <ul class="slides">
                      	
                        <!--Slide-1-->
                      	<li>
                             <div class="caption_text">
                                    <p class="flex-caption">Furniture </p>
                                            <div class="slide-description">
                                            	<p>Exclusive range of Furnitures to Decorate your Home and Office.</p>
                                            </div>
                                   
                                    <div class="content">
                                            <div class="button-wrapper">
                                            	<div class="a-btn">
                                                	<a href="index.php?main_page=product_info&cPath=66_76&products_id=208"<span class="a-btn-text">Shop now!</span></a> 
                                                    <a href="index.php?main_page=index&pg=store&cPath=66_75"><span class="a-btn-slide-text">View More</span></a>
													<span class="a-btn-icon-right"><span></span></span>
                                                </div>
                                            </div>
                                    </div>
                              </div>
                            <div class="slide_img">
                            	<div class="price-tag" style="background:#A52223;">
                                		<div style="color:#FFFFFF">
                                        		<span class="tag">Special</span>
                                                <span class="price">$428</span>
                                                <span class="discount">-25%</span>
                                       </div>
                                </div>
                              <img src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/bed-2.png'?>" alt="Slide-3" />
                            </div>
                        </li>
                        <!--Slide-1 ends-->
                        <!--Slide-2-->
                      	<li>
                            <div class="caption_text">
                                        <p class="flex-caption">Living room</p>
                                                <div class="slide-description">
                                                	<p>Fabulous fabric sofa collection - Jute, Leather or Silk.</p>
                                                </div>
                                        
                                        <div class="content">
                                            <div class="button-wrapper">
                                            	<div class="a-btn">
                                                	<a href="index.php?main_page=product_info&cPath=65_80&products_id=214"><span class="a-btn-text">Shop now!</span></a> 
                                                    <a href="index.php?main_page=index&cPath=65_80"><span class="a-btn-slide-text">View More</span></a>
													<span class="a-btn-icon-right"><span></span></span>
                                                </div>
                                            </div>
                                        </div>
                              </div>
                            <div class="slide_img">
                            	<div class="price-tag" style="background:#23054F">
                                			 <div style="color:#FFFFFF">
                                        		<span class="tag">Special</span>
                                                <span class="price">$428</span>
                                                <span class="discount">-25%</span>
                                            </div>
                                </div>
                                
                              <img src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/sofa-1.png'?>" alt="Slide-2" />
                            </div>
                        </li>
                        <!--Slide-2 ends-->
                        <!--Slide-3-->
                        <li>
                             <div class="caption_text">
                                <p class="flex-caption"> Bedroom Collection</p>
                                        <div class="slide-description">
                                        	<p>Range of beds, Pillows, bedsides, dressing tables and Mattresses.</p>
                                        </div>
                                
                                <div class="content">
                                            <div class="button-wrapper">
                                            	<div class="a-btn">
 													<a href="index.php?main_page=product_info&cPath=66_68&products_id=191"><span class="a-btn-text">Shop now!</span></a>
                                                    <a href="index.php?main_page=index&pg=store&cPath=66_76"><span class="a-btn-slide-text">View More</span></a>
													<span class="a-btn-icon-right"><span></span></span>
                                                </div>
                                            </div>
                                 </div>
                              </div>
                            <div class="slide_img">
                            	<div class="price-tag" style="background:#3692CA;">
                                		 <div style="color:#FFFFFF">
                                        		<span class="tag">Special</span>
                                                <span class="price">$428</span>
                                                <span class="discount">-25%</span>
                                        </div>
                                </div>
                              <img src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/bed-3.png'?>" alt="Slide-5" />
                            </div>
                        </li>
                        <!--Slide-3 ends-->
                        <!--Slide-4-->
                        <li>
                             <div class="caption_text">
                                <p class="flex-caption">Vintage Sofa</p>
                                        <div class="slide-description">
                                        	<p>Hand crafted vintage collection of sofas and chairs.</p>
                                        </div>
                                
                                <div class="content">
                                            <div class="button-wrapper">
                                            	<div class="a-btn">
                                                	<a href="index.php?main_page=product_info&cPath=65_81&products_id=215"><span class="a-btn-text">Shop now!</span></a>
                                                    <a href="index.php?main_page=index&pg=store&cPath=65_81"><span class="a-btn-slide-text">View More</span></a>
													<span class="a-btn-icon-right"><span></span></span>
                                                </div>
                                            </div>
                                 </div>
                              </div>
                            <div class="slide_img">
                            	<div class="price-tag" style="background:#322416;">
                                		 <div style="color:#FFFFFF">
                                        		<span class="tag">Special</span>
                                                <span class="price">$428</span>
                                                <span class="discount">-25%</span>
                                        </div>
                                </div>
                              <img src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/sofa-2.png'?>" alt="Slide-4" />
                            </div>
                        </li>
                        <!--Slide-4 ends-->
                        <!--Slide-5-->
                        <li>
                            <div class="caption_text">
                                  <p class="flex-caption">King and Queen Beds </p>
                                        <div class="slide-description">
                                             <p>We offer 30 months interest free credit and 24 X 7 helpline.</p>
                                        </div>
                                 
                                  <div class="content">
                                        <div class="button-wrapper">
                                        	<div class="a-btn">
                                            	<a href="index.php?main_page=product_info&cPath=66_68&products_id=188"><span class="a-btn-text">Shop now!</span></a> 
                                                <a href="index.php?main_page=index&pg=store&cPath=66_68"><span class="a-btn-slide-text">View More</span></a>
												<span class="a-btn-icon-right"><span></span></span>
                                            </div>
                                        </div>
                                  </div>
                             </div>
                            <div class="slide_img">
                            	<div class="price-tag" style="background:#FAD575;">
                                		 <div style="color:#6B5444">
                                        		<span class="tag">Special</span>
                                                <span class="price">$428</span>
                                                <span class="discount">-25%</span>
                                        </div>
                                </div>
                              <img src="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images').'/slideshow/bed-1.png'?>" alt="Slide-1" />
                            </div>
                        </li>
                        <!--Slide-5 ends-->
                      </ul>
                    </div>
               </div> 
			</div>


			<div id="mj-featured1">
                <div class="mj-subcontainer">
                    <div class="mj-grid96"> <!--Free Shipping Text-->
                    		<div class="mj-grid16 mj-rspace mj-lspace">Free Shipping</div>
                            <div class="mj-grid80 mj-rspace mj-lspace">On Orders Over $599. This Offer is valid on all our Store Items.</div>
                     </div>
                </div>	
            </div>
            
            
<div id="headerpic">
<?php
    if (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2)) {
                if ($banner->RecordCount() > 0) {
?>
      <div id="bannerTwo" class="banners"><?php echo zen_display_banner('static', $banner);?></div>
	  
	 <?php } } ?>
</div>
<?php } ?>

<?php if (!$this_is_home_page) { ?>
<div id="headerpic">
<?php
  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
</div>
<?php } ?>


<?php } ?>



