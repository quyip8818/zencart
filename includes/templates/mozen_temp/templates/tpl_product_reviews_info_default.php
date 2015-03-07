<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_reviews_info_default.php 2993 2006-02-08 07:14:52Z birdbrain $
 */
?>
<div class="centerColumn" id="reviewsInfoDefault">

<?php
  if (zen_not_null($products_image)) {
   	/**
     * require the image display code
     */
?>

<div class="product_info_left">
	<div id="reviewsInfoDefaultProductImage" class="centeredContent back"><?php require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, 
		$current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
    </div>
<?php
        }
?>
</div> <!-- product_info_left --> 

<div class="product_info_right">

	<div class="product_title">
		<h3><?php echo $products_name . $products_model; ?></h3>
	</div>
   	<div class="product_price" style="opacity:0.75"> 
   		<strong>Price : </strong>
        <div class="price_amount" style="display:inline-block">
			<span class="price_amount"><?php echo $products_price; ?></span>
        </div>
   	</div>
   
    <div class="forward">
		<div class="buttonRow product_price">
		<?php
        // more info in place of buy now
        if (zen_has_product_attributes($review_info->fields['products_id'] )) {
          //   $link = '<p>' . '<a href="' . zen_href_link(zen_get_info_page($review_info->fields['products_id']), 'products_id=' . $review_info->fields['products_id'] ) . '">' . MORE_INFO_TEXT . '</a>' . '</p>';
          	$link = '';
        	} else {
          		$link= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'reviews_id')) . 'action=buy_now') . '">' . zen_image_submit(
		  		BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
        		}

        	$the_button = $link;
        	$products_link = '';
        	echo zen_get_buy_now_button($review_info->fields['products_id'], $the_button, $products_link) . '<br />' . zen_get_products_quantity_min_units_display($review_info->
				fields['products_id']);
      		?>
		</div> <!-- buttonRow ends -->

		

		<?php /*?><div id="reviewsInfoDefaultReviewsListingLink" class="buttonRow"><?php echo ($reviews_counter > 1 ? '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, 
			zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_MORE_REVIEWS , BUTTON_MORE_REVIEWS_ALT) . '</a>' : ''); ?></div><?php */?>

	</div> <!--forward ends-->


</div> <!--product_info_right ends -->

<br class="clearBoth" />

<div class="list-reviews">

	<div class="review_box">
            <span class="ratings">
					<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $review_info->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, 
						$review_info->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating']); ?>
                    </div>
            </span>
                
            <div class="mj-review">
            	                    
					<div class="review_content">
						<div id="reviewsInfoDefaultMainContent" class="content"><?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($review_info->fields[
							'reviews_text']))), 60, '-<br />'); ?></div>
                	</div>
                    
                    <div class="review_left">
            		<div class="user_detail">
                    	<span class="bold">
                    		<?php echo sprintf(zen_output_string_protected($review_info->fields['customers_name'])); ?>
                    	</span>
                    	<span class="date">
							<?php echo sprintf(zen_date_short($review_info->fields['date_added'])); ?>
                    	</span>
                    </div>
                    
                    <div id="reviewsInfoDefaultReviewsListingLink" class="buttonRow"><?php echo ($reviews_counter > 1 ? '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, 
			zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_MORE_REVIEWS , BUTTON_MORE_REVIEWS_ALT) . '</a>' : ''); ?></div>
            
					<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))) . '">' . 
						zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></div>
                    <div id="reviewsInfoDefaultProductPageLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array(
			'reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?></div>
                    
				</div>
            </div> <!--mj-review ends -->
	</div> <!--Reviewbox ends -->
</div> <!--list reviews end -->

</div>