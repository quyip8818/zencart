<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_info_default.php 19103 2011-07-13 18:10:46Z wilt $
 */
?>
<div class="centerColumn" id="accountHistInfo">

<div class="forward"><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></div>
<br class="clearBoth" />

<div class="review_box">
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Itemized listing of previous order, includes number ordered, items and prices" style="border-bottom:1px solid #D2D2D2; margin-bottom:5px; padding-bottom:5px;">
<caption><h2 id="orderHistoryDetailedOrder"><span class="title"><?php echo HEADING_TITLE . ORDER_HEADING_DIVIDER . sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); ?></span></h2></caption>
    <tr class="tableHeading">
        <th scope="col" id="myAccountQuantity"><?php echo HEADING_QUANTITY; ?></th>
        <th scope="col" id="myAccountProducts"><?php echo HEADING_PRODUCTS; ?></th>
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
        <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
<?php
 }
?>
        <th scope="col" id="myAccountTotal"><?php echo HEADING_TOTAL; ?></th>
    </tr>
<?php
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
  ?>
    <tr class="mj-accounthist">
        <td class="accountQuantityDisplay"><?php echo  $order->products[$i]['qty'] //. QUANTITY_SUFFIX; ?></td>
        <td class="accountProductDisplay"><?php echo  $order->products[$i]['name'];

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      echo '<ul id="orderAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<li>' . $order->products[$i]['attributes'][$j]['option'] . TEXT_OPTION_DIVIDER . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])) . '</li>';
      }
        echo '</ul>';
    }
?>
        </td>
<?php
    if (sizeof($order->info['tax_groups']) > 1) {
?>
        <td class="accountTaxDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']) . '%' ?></td>
<?php
    }
?>
        <td class="accountTotalDisplay">
        <?php 
         $ppe = zen_round(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), $currencies->get_decimal_places($order->info['currency']));
         $ppt = $ppe * $order->products[$i]['qty']; 
        //        echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') 
        echo $currencies->format($ppt, true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : ''); 
        ?></td>
    </tr>
<?php
  }
?>
</table>
<div id="orderTotals">
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
?>
     <div class="lineTitle larger forward"><?php echo $order->totals[$i]['title'] ?></div>
     <div class="amount larger forward"><?php echo $order->totals[$i]['text'] ?></div>
<br class="clearBoth" />
<?php
  }
?>

</div>
</div>

<?php
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>


<?php
/**
 * Used to loop thru and display order status information
 */
if (sizeof($statusArray)) {
?>

<div class="review_box">
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="myAccountOrdersStatus" summary="Table contains the date, order status and any comments regarding the order">
<caption><span class="title"><?php echo HEADING_ORDER_HISTORY; ?></span></caption>
    <tr class="tableHeading">
        <th scope="col" id="myAccountStatusDate"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
        <th scope="col" id="myAccountStatus"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
        <th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       </tr>
<?php
  foreach ($statusArray as $statuses) {
?>
    <tr class="mj-accounthist">
        <td><?php echo zen_date_short($statuses['date_added']); ?></td>
        <td><?php echo $statuses['orders_status_name']; ?></td>
        <td><?php echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); ?></td> 
     </tr>
<?php
  }
?>
</table>
</div>
<?php } ?>

<div class="review_box">
<div class="mj-myaccountinfo">
<div id="myAccountShipInfo" class="floatingBox back">
<?php
  if ($order->delivery != false) {
?>
<div class="product_info_left"><span class="title"><?php echo HEADING_DELIVERY_ADDRESS; ?></span>
<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
<?php
  }
?>

<?php
    if (zen_not_null($order->info['shipping_method'])) {
?>
<span class="title"><?php echo HEADING_SHIPPING_METHOD; ?></span>
<div><?php echo $order->info['shipping_method']; ?></div>
<?php } else { // temporary just remove these 4 lines ?>
<div>WARNING: Missing Shipping Information</div>
<?php
    }
?>
</div>
</div>
<div id="myAccountPaymentInfo" class="floatingBox forward">
<div class="product_info_left"><span class="title"><?php echo HEADING_BILLING_ADDRESS; ?></span>
<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>

<span class="title"><?php echo HEADING_PAYMENT_METHOD; ?></span>
<div><?php echo $order->info['payment_method']; ?></div>


</div>

</div>
</div>
</div>
<br class="clearBoth" />
<div class="buttonRow forward change_add"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>