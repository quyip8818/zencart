<?php 
/**
 * Mozen - Responsive Zencart Template
 *
 * @package mozen-admin
 * @author Mojoomla <sales@mojoomla.com> 
 * @author website www.mojoomla.com
 * @copyright Copyright 2012-2013 Das Infomedia
 * @license http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @version $Id: mozen.php 1.0 2012-10-10 11:50:04Z $ 
 */
 
require('includes/application_top.php');
require(DIR_WS_MODULES . 'prod_cat_header_code.php');
	
	$query = "SELECT * from " . DB_PREFIX.mozen;
			$query_result = $db->Execute($query);
			$color = $query_result->fields['color'];
			$image = $query_result->fields['logo_image'];
			$logo_txt = $query_result->fields['logo_txt'];
			$tagline = $query_result->fields['tagline'];
			$display_logo = $query_result->fields['display_logo'];
			$call_us = $query_result->fields['call_us'];
			
			/*Footer*/
			
			$address = $query_result->fields['address'];
			$email_id = $query_result->fields['email_id'];
			$phone_support = $query_result->fields['phone_support'];
			$skype_id = $query_result->fields['skype_id'];
			$copyright_text = $query_result->fields['copyright_text'];	
					

	if(isset($_POST['mozen_color']))
	{
		$color = $_POST['colors'];
		$logo_txt = $_POST['logo_txt'];
		$tagline = $_POST['tagline'];
		$call_us = $_POST['call_us'];
		
		$address = $_POST['address'];
		$email_id = $_POST['email_id'];
		$phone_support = $_POST['phone_support'];
		$skype_id = $_POST['skype_id'];
		$copyright_text = $_POST['copyright_text'];
		
		$display_logo = $_POST['display_logo'];
		$image_new=$_FILES["file"]["name"];
		if($image_new==NULL){ $image_new = $image ; }
			$slideshow_query = "UPDATE " . DB_PREFIX.mozen. " SET color='$color', logo_image='$image_new', display_logo='$display_logo', logo_txt='$logo_txt', tagline='$tagline', call_us='$call_us', address='$address', email_id='$email_id', phone_support='$phone_support', skype_id='$skype_id', copyright_text='$copyright_text' WHERE id=1";
			$slideshow_result = $db->Execute($slideshow_query );
			move_uploaded_file($_FILES["file"]["tmp_name"],"../includes/templates/" . $template_dir . "/images/logo/" . $_FILES["file"]["name"]);
		
	}
?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
	function init()
	{
		cssjsmenu('navbar');
		if (document.getElementById)
		{
		  var kill = document.getElementById('hoverJS');
		  kill.disabled = true;
		}
		if (typeof _editor_url == "string")
		{
			HTMLArea.replaceAll();
		}
	}
  // -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
</head>

<!-- body //-->
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<form name="mozen-color" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<table border="1" cellpadding="6" cellspacing="0" width="60%" align="center" style="border-collapse:collapse; margin-top:10px">
	<tbody>
    <tr>
		<th colspan="4" style="color:#666; font-size:18px">Customizations For Mozen Template</th>
    </tr>	
      	<tr>
    		<th colspan="2">Header Customization</th>
    	</tr>
    	<tr>
			<td width="150px">
				<label for="color">Choose Mozen Color :</label>
        	</td>
            <td>
                <select name="colors" id="colors">
                    <option <?php if($color == Blue){ echo 'selected' ; } ?> value="Blue">Blue</option>
                    <option <?php if($color == Navyblue){ echo 'selected' ; } ?> value="Navyblue">Violet</option>
                    <option <?php if($color == Green){ echo 'selected' ; } ?> value="Green">Green</option>
                    <option <?php if($color == Cyan){ echo 'selected' ; } ?> value="Cyan">Cyan</option>
                    <option <?php if($color == Red){ echo 'selected' ; } ?> value="Red">Red</option>
                    <option <?php if($color == Brown){ echo 'selected' ; } ?> value="Orange">Brown</option>
                    <option <?php if($color == Pink){ echo 'selected' ; } ?> value="Pink">Pink</option>
                    <option <?php if($color == Slategray){ echo 'selected' ; } ?> value="Slategray">Slategray</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="file">Logo Image:</label>
            </td>
            <td>
                <input type="file" name="file" id="file" value="<?php echo $image; ?>"/> &nbsp; &nbsp; <?php if($image != NULL) { echo "Current Image : ". $image;}
                             else { echo "No Image Selected"; } ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="file">Display Logo :</label>
            </td>
            <td>
                <input type="radio" name="display_logo" value="yes" <?php if($display_logo=="yes"){echo "checked";} ?>/>Yes &nbsp; &nbsp;
                <input type="radio" name="display_logo" value="no" <?php if($display_logo=="no"){echo "checked";} else{}?>/>No
            </td>
        </tr>
        <tr>
            <td>
                <label for="logo_txt">Logo Text:</label>
            </td>
            <td>
                <input type="text" name="logo_txt" size="40" id="logo_txt" value="<?php echo $logo_txt; ?>"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="tagline">Tagline:</label>
            </td>
            <td>
                <input type="text" name="tagline" size="40" id="tagline" value="<?php echo $tagline; ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="tagline">Call Us Number:</label>
            </td>
            <td>
                <input type="text" name="call_us" size="40" id="call_us" value="<?php echo $call_us; ?>" />
            </td>
        </tr>
	<tr>
    	<th colspan="2">Footer Customization</th>
        <tr>
        	<td>
            	<label for="address"> Address : </label>
            </td>
            <td>
            	<input type="text" name="address" size="40" id="address" value="<?php echo $address; ?>" />
            </td>
        </tr>
        <tr>
        	<td>
            	<label for="email_id"> Email Id : </label>
            </td>
            <td>
            	<input type="text" name="email_id" size="40" id="email_id" value="<?php echo $email_id; ?>" />
            </td>
        </tr>
        <tr>
        	<td>
            	<label for="phone_support"> 24/7 Phone Support Number : </label>
            </td>
            <td>
            	<input type="text" name="phone_support" size="40" id="phone_support" value="<?php echo $phone_support; ?>" />
            </td>
        </tr>
        <tr>
        	<td>
            	<label for="skype_id"> Skype Id : </label>
            </td>
            <td>
            	<input type="text" name="skype_id" size="40" id="skype_id" value="<?php echo $skype_id; ?>" />
            </td>
        </tr>
        <tr>
        	<td>
            	<label for="copyright_text"> Copy Right Text : </label>
            </td>
            <td>
            	<input type="text" name="copyright_text" size="40" id="copyright_text" value="<?php echo $copyright_text; ?>" />
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="submit" name="mozen_color" value="Submit" />
            </th>
        </tr>
    </tr>
</table>
<!-- body_eof //-->
</form>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>