<?php
//
// Twitter Sidebox Mod
// includes/languages/english/extra_definitions/twitter_sidebox.php
//
//  --------------------------------------------------
//  http://www.deliawilsondesign.com mod Zen-Cart                
//  --------------------------------------------------
//  zen-cart Open Source E-commerce                                      
//  Copyright (c) 2003-2006 The zen-cart developers                           
//  http://www.zen-cart.com/index.php                                    
//  Portions Copyright (c) 2003 osCommerce                               
//  --------------------------------------------------
//  This source file is subject to version 2.0 of the GPL license,       
//  that is bundled with this package in the file LICENSE, and is        
//  available through the world-wide-web at the following url:           
//  http://www.zen-cart.com/license/2_0.txt.                             
//  If you did not receive a copy of the zen-cart license and are unable 
//  to obtain it through the world-wide-web, please send a note to       
//  license@zen-cart.com so we can mail you a copy immediately.
//  --------------------------------------------------


// test if box should display
  $show_blank_sidebox = true;

  if ($show_blank_sidebox == true) {
      require($template->get_template_dir('tpl_twitter_sidebox.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_twitter_sidebox.php');
      $title =  BOX_HEADING_TWITTER_SIDEBOX;
      $left_corner = false;
      $right_corner = false;
      $right_arrow = false;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
 }
?>