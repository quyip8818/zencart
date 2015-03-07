<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=adress_book.<br />
 * Allows customer to manage entries in their address book
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_default.php 5369 2006-12-23 10:55:52Z drbyte $
 */
?>
<div class="centerColumn" id="addressBookDefault">

<?php	$heading = str_replace('My Personal Address Book', 'Address Book', 'My Personal Address Book'); ?>
<h1><?php echo $heading; ?></h1>
 
<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?> 
      
<div class="review_box">
<div class="product_info_left">
<span class="title"><?php echo PRIMARY_ADDRESS_TITLE; ?></span>


<address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br />'); ?></address>
</div>


<div class="product_info_right">
<div class="mj-boxcontent">
<div class="instructions"><?php echo PRIMARY_ADDRESS_DESCRIPTION; ?></div>

<fieldset>
<legend><?php echo ADDRESS_BOOK_TITLE; ?></legend>
<div class="alert forward"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
</div>
</div>
</div>
<?php
/**
 * Used to loop thru and display address book entries
 */
  foreach ($addressArray as $addresses) {
?>

<div class="review_box">
<div class="product_info_left">
<span class="title"><?php echo zen_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?><?php if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']) echo '&nbsp;' . PRIMARY_ADDRESS ; ?></span>

<address><?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br />'); ?></address>

<div class="buttonRow back change_add"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT); ?></div>

<div class="buttonRow back change_add"><?php echo  '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_DELETE_SMALL, BUTTON_DELETE_SMALL_ALT) . '</a>'; ?></div>
</div>
</div>
<?php
  }
?>

<?php
  if (zen_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
?>
   <div class="buttonRow back change_add"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_ADD_ADDRESS, BUTTON_ADD_ADDRESS_ALT) . '</a>'; ?></div>
<?php
  }
?>
<div class="buttonRow back change_add"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

</fieldset>


<br class="clearBoth" />
</div>
