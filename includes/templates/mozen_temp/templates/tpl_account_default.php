<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 4086 2006-08-07 02:06:18Z ajeh $
 */
?>

<div class="centerColumn" id="accountDefault">

<div class="review_box">
<div class="product_info_left">
<span class="title"><?php echo HEADING_TITLE; ?></span>
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>

<?php
    if (zen_count_customer_orders() > 0) {
  ?>
<p class="forward"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . OVERVIEW_SHOW_ALL_ORDERS . '</a>'; ?></p>
</div>
</div>

<br class="clearBoth" />
<div class="review_box">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="prevOrders">
<caption><span class="title"><?php echo OVERVIEW_PREVIOUS_ORDERS; ?></span></caption>
    <tr class="tableHeading">
    <th scope="col"><?php echo TABLE_HEADING_DATE; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_STATUS; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_TOTAL; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_VIEW; ?></th>
  </tr>
<?php
  foreach($ordersArray as $orders) {
?>
  <tr class="mj-accountinfo">
    <td width="100px"><?php echo zen_date_short($orders['date_purchased']); ?></td>
    <td width="50px"><?php echo TEXT_NUMBER_SYMBOL . $orders['orders_id']; ?></td>
    <td><address><?php echo zen_output_string_protected($orders['order_name']) . '<br />' . $orders['order_country']; ?></address></td>
    <td width="100px"><?php echo $orders['orders_status_name']; ?></td>
    <td width="100px"><?php echo $orders['order_total']; ?></td>
    <td><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '"> ' . zen_image_button(BUTTON_IMAGE_VIEW_SMALL, BUTTON_VIEW_SMALL_ALT) . '</a>'; ?></td>
  </tr>

<?php
  }
?>
</table>
</div>
<?php
  }
?>
<br class="clearBoth" />
<div id="accountLinksWrapper" class="back">
<div class="review_box">
<div class="product_info_left">
<span class="title"><?php echo MY_ACCOUNT_TITLE; ?></span>
<ul id="myAccountGen" class="list">
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></li>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></li>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></li>
</ul>
</div>
</div>

<?php
  if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK !='false' or CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS !='0') {
?>
<div class="review_box">
<div class="product_info_left">
<span class="title"><?php echo EMAIL_NOTIFICATIONS_TITLE; ?></span>
<ul id="myAccountNotify" class="list">
<?php
  if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK=='true') {
?>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?></li>
<?php } //endif newsletter unsubscribe ?>
<?php
  if (CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS == '1') {
?>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?></li>

<?php } //endif product notification ?>
</ul>
</div>
<?php } // endif don't show unsubscribe or notification ?>
</div>
</div>

<?php
// only show when there is a GV balance
  if ($customer_has_gv_balance ) {
?>
<div id="sendSpendWrapper">
<?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
</div>
<?php
  }
?>
<br class="clearBoth" />
</div>