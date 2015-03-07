<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_drop_menu.php  2005/06/15 15:39:05 DrByte Exp $
//

?>
<!-- menu area -->
<?php
  if(isset($_REQUEST['pg']))
  {
    $pg=$_REQUEST['pg'];
	?>
     <script>
	    $(document).ready(function(){
			  $('.nav li').removeClass('tab_active');
				$("#<?php echo $pg; ?>").addClass('tab_active');
			});

	 </script>
    <?php  
  }
?>
<script type="text/javascript">

</script>
        <div class="jsn-mainnav navbar"> 
          <div class="jsn-mainnav-inner navbar-inner"> 
            <div class="container clearfix"> 
            	<div class="mainnav-toggle clearfix">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span>Main Menu</span></button>
                </div>
              <div id="jsn-pos-mainnav" class="nav-collapse collapse clearfix">
                  <ul class="nav">
                    <li id='home' class="<?php if($this_is_home_page){ echo "tab_active"; } ?>" ><a href="<?php echo zen_href_link(FILENAME_DEFAULT."&pg=home"); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a>
                    </li>
					
                    	<!--Display the EZ Pages link in Menu -->
                    	<?php 
							global $languages_id, $db;
						 $ezpages_query = "select * from ".DB_PREFIX."ezpages where status_header='1' and languages_id = ".(int)$_SESSION['languages_id'];
						$ezpages = $db->Execute($ezpages_query);
						$pages_id=$ezpages->fields['pages_id'];
						?>
                     <li id='features' ><a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=features"); ?>"><?php echo HEADER_TITLE_FEATURES; ?></a>
                                            
                                            <ul class="nav-child unstyled">
                                                <?php
					  
						while (!$ezpages->EOF) {
								$pages_id=$ezpages->fields['pages_id'];
								$pages_title=$ezpages->fields['pages_title'];
							   if($pages_title !='' )
								 {
									?>
									 <li><a href="<?php echo zen_href_link("page&id=".$pages_id."&pg=features"); ?>"><?php echo $pages_title; ?></a>			
									 </li>
									<?php 
								  }
							$ezpages->MoveNext();
						}
				  ?>
                                    		</ul>
                                		</li>
                       	<!--EZ Pages Menu Ends Here-->
                        
                     <!--Categories Link in Menu-->
                    <?php 
                    $cat_query = "select * from ".DB_PREFIX."categories where categories_status='1' ORDER BY RAND() LIMIT 1";
						$category = $db->Execute($cat_query);
							$categories_id=$category->fields['categories_id'];
						 ?>
                    <li id='store'><a href="<?php echo zen_href_link(FILENAME_DEFAULT."&cPath=".$categories_id."&pg=store"); ?>"><?php echo HEADER_TITLE_CATEGORIES; ?></a>
					  <?php
        				
         // load the UL-generator class and produce the menu list dynamically from there
         require_once (DIR_WS_CLASSES . 'categories_ul_generator.php');
         $zen_CategoriesUL = new zen_categories_ul_generator;
        $menulist = $zen_CategoriesUL->buildTree(true);
         $menulist = str_replace('"level4"','"level5"',$menulist);
         $menulist = str_replace('"level3"','"level4"',$menulist);
         $menulist = str_replace('"level2"','"level3"',$menulist);
         $menulist = str_replace('"level1"','"level2"',$menulist);
         $menulist = str_replace('<li class="submenu">','<li class="submenu">',$menulist);
         $menulist = str_replace("</li>\n</ul>\n</li>\n</ul>\n","</li>\n</ul>\n",$menulist);
		 echo $menulist;
        ?>
        	         

                    </li>
                    <!--Categories Link in Menu Ends-->
                    
                    <!--Manufacturers Link in Menu-->
                      <?php 
                    $man_query = "select * from ".DB_PREFIX."manufacturers ORDER BY RAND() LIMIT 1";
						$man = $db->Execute($man_query);
							$manufacturers_id=$man->fields['manufacturers_id'];
						 ?>
                    <li id='brands' ><a href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id."&pg=brands"); ?>"><?php echo HEADER_TITLE_MANUFACTURER; ?></a>
                        <ul class="nav-child unstyled">
                      <?php
					  global $languages_id, $db;
							 $manufacturers_query = "select * from ".DB_PREFIX."manufacturers as m join ".DB_PREFIX."manufacturers_info as mi on                                                         m.manufacturers_id = mi.manufacturers_id
															where mi.languages_id = ". (int)$_SESSION['languages_id'];
							$manufacturers = $db->Execute($manufacturers_query);
							while (!$manufacturers->EOF) {
							        $manufacturers_id=$manufacturers->fields['manufacturers_id'];
								    $manufacturers_name=$manufacturers->fields['manufacturers_name'];
							       if($manufacturers_name !='' )
								     {
										?>
										 <li><a href="<?php echo zen_href_link("index&manufacturers_id=".$manufacturers_id."&pg=brands"); ?>"><?php echo $manufacturers_name; ?></a>			
                                         </li>
										<?php 
								      }
								$manufacturers->MoveNext();
							}
					  ?>
                       </ul>
                    </li>
                    <!--Manufacturers Link in Menu-->
                    
                                 
                    <li id='information' ><a  href="<?php echo zen_href_link(FILENAME_SHIPPING."&pg=information"); ?>"><?php echo HEADER_TITLE_INFORMATION; ?></a>
                      <ul class="nav-child unstyled">
                        <?php if (DEFINE_SHIPPINGINFO_STATUS <= 1) { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_SHIPPING."&pg=information"); ?>"><?php echo HEADER_TITLE_SHIPPING_INFO; ?></a></li>
                        <?php } ?>
                        <?php if (DEFINE_PRIVACY_STATUS <= 1)  { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_PRIVACY."&pg=information"); ?>"><?php echo HEADER_TITLE_PRIVACY_POLICY; ?></a></li>
                        <?php } ?>
                        <?php if (DEFINE_CONDITIONS_STATUS <= 1) { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_CONDITIONS."&pg=information"); ?>"><?php echo HEADER_TITLE_CONDITIONS_OF_USE; ?></a></li>
                        <?php } ?>
                        <!--<li><a href="<?php echo zen_href_link(FILENAME_ABOUT_US."&pg=information"); ?>"><?php echo HEADER_TITLE_ABOUT_US; ?></a></li>-->
                        <?php if (DEFINE_SITE_MAP_STATUS <= 1) { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_SITE_MAP."&pg=information"); ?>"><?php echo HEADER_TITLE_SITE_MAP; ?></a></li>
                        <?php } ?>
                        <?php if (MODULE_ORDER_TOTAL_GV_STATUS == 'true') { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_GV_FAQ."&pg=information", '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_GV_FAQ; ?></a></li>
                        <?php } ?>
                        <?php if (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true') { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_DISCOUNT_COUPON."&pg=information", '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_DISCOUNT_COUPON; ?></a></li>
                        <?php } ?>
                        <?php if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK == 'true') { ?>
                        <li><a href="<?php echo zen_href_link(FILENAME_UNSUBSCRIBE."&pg=information", '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_UNSUBSCRIBE; ?></a></li>
                        <?php } ?>
                        <?php require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . 'ezpages_drop_menu.php'); ?>
                      </ul>
                    </li>
                    <li id='contact_us'><a href="<?php echo zen_href_link(FILENAME_CONTACT_US."&pg=contact_us", '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CONTACT_US; ?></a></li>
                    
                    
                  </ul>
              </div>
            </div>
          </div>
        </div><!-- end dropMenuWrapper-->
	
    <div class="clearBoth"></div>