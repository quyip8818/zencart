<?php
/* @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 7085 2007-09-22 04:56:31Z ajeh $
 */
?>
<!--Query to fetch the color of template-->
<?php 
 $slideshow_query = "SELECT * FROM " . DB_PREFIX.mozen;
$slideshow_result = $db->Execute($slideshow_query);
//echo $slideshow_result->fields['color'];
if(strtolower($slideshow_result->fields['color'])=="slategray")
{
	$bgcolor = "#4B5668";
}
elseif(strtolower($slideshow_result->fields['color'])=="red")
{
	$bgcolor = "#A52223";
}
elseif(strtolower($slideshow_result->fields['color'])=="blue")
{
	$bgcolor = "#3692CA";
}
elseif(strtolower($slideshow_result->fields['color'])=="navyblue")
{
	$bgcolor = "#23054F";
}
elseif(strtolower($slideshow_result->fields['color'])=="brown")
{
	$bgcolor = "#322416";
}
elseif(strtolower($slideshow_result->fields['color'])=="cyan")
{
	$bgcolor = "#008080";
}
elseif(strtolower($slideshow_result->fields['color'])=="green")
{
	$bgcolor = "#509B00";
}
elseif(strtolower($slideshow_result->fields['color'])=="pink")
{
	$bgcolor = "#DE5DA2";
}
?>
<!--Query Ends-->
<!--Link to call the color css-->
<link href="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/mj-'.strtolower($slideshow_result->fields['color']);?>.css" rel="stylesheet" type="text/css" />
<!--Link Ends-->
<!--[if IE 8]>
 <link href="includes/templates/mozen_temp/css/mj-ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--Script to Change the top bar on Scroll-->
<script type="text/javascript">
	var tba = jQuery.noConflict();
	tba(document).ready(function(){       
            var scroll_pos = 0;
            tba(document).scroll(function() { 
                scroll_pos = tba(this).scrollTop();
                if(scroll_pos > 25) {
                    tba("#mj-topbar").css('background-color', '<?php echo $bgcolor; ?>');
					tba("#mj-topbar").css('background-image','url("<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images')."/topbar-bg.png" ?>") repeat scroll 0 0 transparent');
					tba("#mj-topbar a").css('color', '#FFFFFF');
					tba("#mj-topbar div").css('color', '#FFFFFF');
					tba("#mj-topbar li").css('background', 'url("<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images')."/topbar-arrow-white.png" ?>") no-repeat scroll right center transparent');
					tba("#mj-topbar li:first-child").css('background', 'none');
                } 
				else 
				{
					tba("#mj-topbar").css('background','url("<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images')."/topbar-bg.png" ?>") repeat scroll 0 0 transparent');
					tba("#mj-topbar a").css('color', '<?php echo $bgcolor; ?>');
					tba("#mj-topbar div").css('color', '<?php echo $bgcolor; ?>');
					tba("#mj-topbar li").css('background', 'url("<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'images/icons/').strtolower($slideshow_result->fields['color'])."-arrow.png" ?>") no-repeat scroll right center transparent');
					tba("#mj-topbar li:first-child").css('background', 'none');
                }
            });
        });
</script>
<!--Script to Change the top bar on Scroll Ends Here-->
<?php 
	if ($this_is_home_page)
	{
?>
<link href="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/homepage.css'?>" rel="stylesheet" type="text/css" />
<?php } else 
{ ?>
<link href="<?php  echo $template->get_template_dir('',DIR_WS_TEMPLATE, $current_page_base,'css').'/nohomepage.css'?>" rel="stylesheet" type="text/css" />
<?php } ?>
</head>
<?php
// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'product_info')) ) {
    $flag_disable_right = true;
	/*$flag_disable_left = true;*/
  }
  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  //$body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body>
	<div id="mj-container">
<?php
 /**
  * prepares and displays header output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_header = true;
  }
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
<div id="mj-slidetitle">
	<div class="mj-subcontainer">
		<span class="mj-title"><?php echo $var_pageDetails->fields['pages_title']; ?></span>
			<div class="moduletable mj-grid96 breadcrumb">
				<div class="breadcrumbs mj-grid96 breadcrumb">
                    <div id="navBreadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
				</div>
			</div>
	</div>
</div>
<?php } ?>
<div id="mj-maincontent">
	<div class="mj-subcontainer">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mj-grid96">
  <tr id="shopping_items">
<?php
if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_left
  $flag_disable_left = true;
}?>
<td valign="top" id="mj-contentarea" <?php if($flag_disable_left == true && $flag_disable_right == true ) { ?> class="mj-grid96 mj-lspace" style="right:0%; left:0%" <?php } elseif($flag_disable_left == true) { ?> class="mj-grid80 mj-lspace" style="right:17.5%" <?php } elseif($flag_disable_right == true) { ?> class="mj-grid80 mj-lspace" style="right:-1%" <?php }else { ?> class="mj-grid64 mj-lspace" <?php } ?> >
<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!-- bof upload alerts -->
<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
<!-- eof upload alerts -->
<?php
 /**
  * prepares and displays center column
  *
  */ ?>
<?php require($body_code); ?>
<?php
  if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  } ?> 
</td>
<?php
if (!isset($flag_disable_left) || !$flag_disable_left) {
?>
 <td id="mj-left" class="mj-grid16 mj-lspace">
<?php
 /**
  * prepares and displays left column sideboxes
  *
  */
?>
<div><?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?></div></td>
<?php
}
?>
<?php
//if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' && $_SESSION['customers_authorization'] != 0)) {
if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>
<td id="mj-right" class="mj-grid16 mj-lspace mj-rspace" <?php if($flag_disable_left == true) { ?> style="right:-82%" <?php } ?>>
<?php
 /**
  * prepares and displays right column sideboxes
  *
  */
?>
<div><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div></td>
<?php
}
?>
  </tr>
</table>
</div>
</div><!-- mainWrapper -->
<!--<div id="bottomShadow"></div>-->
<?php
 /**
  * prepares and displays footer output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_footer = true;
  }
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
?>
<!--bof- parse time display -->
<?php
  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
?>
<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
<?php
  }
?>
<!--eof- parse time display -->
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<?php
    }
  }
?>
<!--eof- banner #6 display -->
</body>
