<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_reviews_default.php 2905 2006-01-28 01:25:36Z birdbrain $
 */
?>
<div class="centerColumn" id="reviewsDefault">

<h1 id="reviewsDefaultHeading"><?php echo $breadcrumb->last();  ?></h1>

<div class="list-reviews">
<?php
  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>
<div id="reviewsDefaultListingTopNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>

<div id="reviewsDefaultListingTopLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
    }

    $reviews = $db->Execute($reviews_split->sql_query);
    while (!$reviews->EOF) {
?>

<div class="review_box">
	
    <span class="ratings">
		<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews->fields[
				'reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews->fields['reviews_rating']); ?></div>
	</span>

	<div class="mj-review">
    	
       <div class="review_img">
			<div class="smallProductImage back"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews->fields['products_id'] . 
				'&reviews_id=' . $reviews->fields['reviews_id']) . '">' . zen_image(DIR_WS_IMAGES . $reviews->fields['products_image'], $reviews->fields['products_name'], 
						SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></div>
       </div>

		<div class="product_title">
			<h3><?php echo $reviews->fields['products_name']; ?></h3>
		</div>
        
        <?php $product_review = $reviews->fields['reviews_text'];
				$product_review = ltrim(substr($product_review, 0, 100) . '...'); //Trims and Limits the Review
			?>

		<div class="review_content"><?php echo $product_review; //echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 25, '-	
					//<br />') . ((strlen($reviews->fields['reviews_text']) >= 50) ? '...' : ''); ?></div> 
        
        <div class="review_left">	
			<div class="user_detail">
			
            	<span class="bold">
            		<?php echo sprintf(zen_output_string_protected($reviews->fields['customers_name'])); ?>
            	</span>
            	<span class="date">
					<?php echo sprintf(zen_date_short($reviews->fields['date_added'])); ?>
           		</span>
        	</div>
            
            <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews->fields['products_id'] . '&reviews_id=' . 
					$reviews->fields['reviews_id']) . '">' . zen_image_button(BUTTON_IMAGE_READ_REVIEWS , BUTTON_READ_REVIEWS_ALT) . '</a>'; ?></div>

			<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(zen_get_info_page($reviews->fields['products_id']), 'products_id=' . 
						$reviews->fields['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?></div>
    
        </div>
			
 		
			<br class="clearBoth" />
	
</div> <!--mj-review ends -->
</div> <!--Reviewbox ends -->


<?php
      $reviews->MoveNext();
    }
?>
</div> <!-- List Reviews end -->
<?php
  } else {
?>
<div id="reviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS; ?></div>
<?php
  }
?>
<?php
  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div id="reviewsDefaultListingBottomNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>

<div id="reviewsDefaultListingBottomLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>
<br class="clearBoth" />
<?php
  }
?>

</div>
