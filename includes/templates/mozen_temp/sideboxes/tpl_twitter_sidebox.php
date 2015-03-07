<?php
//
// Twitter Sidebox Mod
// includes/templates/templates_default/sideboxes/tpl_twitter_sidebox.php
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
//
// $Id: tpl_twitter_sidebox.php,v 1.0 6/24/2006
 


  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';
  echo $_SESSION['id'];
  
  $content .= '<script src="http://widgets.twimg.com/j/2/widget.js" type="text/javascript"></script>
<script type="text/javascript">
new TWTR.Widget({
  version: 2,
  type: \'profile\',
  rpp: 3,
  interval: 6000,
  width: 175,
  height: 300,
  theme: {
    shell: {
      background: \'#ffffff\',
      color: \'#404040\'
    },
    tweets: {
      background: \'#ffffff\',
      links: \'#B60009\'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: \'all\'
  }
}).render().setUser(\'mojoomla\').start();
</script>';
  $content .= '</div>';
?>