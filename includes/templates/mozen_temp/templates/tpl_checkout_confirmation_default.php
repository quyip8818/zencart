<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_confirmation.<br />
 * Displays final checkout details, cart, payment and shipping info details.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_confirmation_default.php 6247 2007-04-21 21:34:47Z wilt $
 */
?>
<div class="centerColumn" id="checkoutConfirmDefault">

<h3 id="checkoutConfirmDefaultHeading"><?php //echo HEADING_TITLE; ?><span class="mj-step1">STEP1</span> &nbsp; <span class="mj-step1">STEP2</span> &nbsp; <span class="mj-step">STEP3</span></h3>

<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

<div class="review_box">
	<div class="product_info_left">
		<span class="title"><?php echo HEADING_BILLING_ADDRESS; ?></span>
			<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>
		
        	<?php if (!$flagDisablePaymentAddressChange) { ?>
        		<div class="buttonRow forward change_add"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . 'Change Address' . '</a>'; ?>
        		</div>
        	<?php } ?>
    </div>
    
	<?php
         if ($_SESSION['sendto'] != false) {
	?>
     <div class="product_info_right">
     	<span class="title"><?php echo HEADING_DELIVERY_ADDRESS; ?></span>
        	<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
	     	<div class="buttonRow forward change_add"><?php echo '<a href="' . $editShippingButtonLink . '">' . 'Change Address' . '</a>'; ?></div>
	 </div>
	<?php } ?>
    
</div> <!-- review_box ends -->
     	
		<?php
          $class =& $_SESSION['payment'];
        ?>

<div class="review_box">
	<div class="product_info_left">
		<span class="title"><?php echo 'PAYMENT METHOD';//HEADING_PAYMENT_METHOD;  ?></span> 
		<span class="add_title"><?php echo $GLOBALS[$class]->title; ?></span>

		<?php
          if (is_array($payment_modules->modules)) {
            if ($confirmation = $payment_modules->confirmation()) {
        ?>
		<div class="important"><?php echo $confirmation['title']; ?></div>
		<?php
            }
        ?>

		<div class="important">
			<?php
                  for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
            ?>
            <div class="back"><?php echo $confirmation['fields'][$i]['title']; ?></div>
            <div ><?php echo $confirmation['fields'][$i]['field']; ?></div>
			<?php
                 }
            ?>
      </div>
    </div> <!-- product_info_left ends -->
<?php
  }
?>
	<div class="product_info_right">	
		<?php
            if ($order->info['shipping_method']) {
        ?>
        <span class="title"><?php echo 'SHIPPING METHOD';//HEADING_SHIPPING_METHOD; ?></span>
        <span class="add_title"><?php echo $order->info['shipping_method']; ?></span>
        
        <?php
          }
        ?>
        <br class="clearBoth" />
	</div> <!-- product_info_right ends -->

</div> <!--review_box ends -->

<?php
// always show comments
//  if ($order->info['comments']) {
?>


<div class="review_box">
	<span class="title"><?php echo HEADING_ORDER_COMMENTS; ?></span>

	<p><?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->
			info['comments'])); ?>
    </p>

	<div class="buttonRow forward change_add"><?php echo  '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(
			BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?>
    </div>

</div>
<?php
//  }
?>


<div class="review_box">
	<span class="title"><?php echo HEADING_PRODUCTS; ?></span>

		<?php  if ($flagAnyOutOfStock) { ?>
        <?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>
        <div class="mj-boxhint"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
		<?php    } else { ?>
        <div class="mj-boxhint"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
        <?php    } //endif STOCK_ALLOW_CHECKOUT ?>
        <?php  } //endif flagAnyOutOfStock ?>


      <table style="border-bottom:1px solid #D2D2D2" width="100%" cellspacing="0" cellpadding="0" id="cartContentsDisplay">
        <tr class="cartTableHeading">
        <th scope="col" id="ccQuantityHeading" width="30"><?php echo TABLE_HEADING_QUANTITY; ?></th>
        <th scope="col" id="ccProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
<?php
  // If there are tax groups, display the tax columns for price breakdown
  if (sizeof($order->info['tax_groups']) > 1) {
?>
          <th scope="col" id="ccTaxHeading"><?php echo HEADING_TAX; ?></th>
<?php
  }
?>
          <th scope="col" id="ccTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
          
          <th scope="col"> Edit </th>
        </tr>
<?php // now loop thru all products to display quantity and price ?>
<?php for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $order->products[$i]['rowClass']; ?>" style="border-bottom:1px solid">
          <td  class="cartQuantity"><?php echo $order->products[$i]['qty']; ?>&nbsp;x</td>
          <td class="cartProductDisplay"><?php echo $order->products[$i]['name']; ?>
          <?php  echo $stock_check[$i]; ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul class="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>

<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <td class="cartTotalDisplay">
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
        <td class="cartTotalDisplay">
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?>
        </td>
        
        <td style="text-align:center; vertical-align:middle"><div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . 
				zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div> </td>
        
      </tr>
<?php  }  // end for loopthru all products ?>
      </table>

<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
?>
<div id="orderTotals"><?php $order_total_modules->output(); ?></div>
<?php
  }
?>


<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>
		<br class="clearBoth" />

</div>


<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"') ;?></div>
</form>

<?php /*?><div class="buttonRow back"><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . '<br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div><?php */?>

</div>