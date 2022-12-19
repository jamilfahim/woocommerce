// Show shipping date in admin order details
function cloudways_display_order_data_in_admin( $order ){  ?>
	<div class="shipping_column form-field form-field-wide">
		 <h4 style="margin-top:4px;">Shipping Date</h4>
		 <div class="shipping-date">
		 <?php
						$order_date = $order->order_date;
						//$Today=date('y:m:d');
						// Declare a date 
						$date = "2019-05-10"; 
		
						
						//$stock_status = $item->get_meta('_stock_status');

						// Get and Loop Over Order Items
foreach ( $order->get_items() as $item_id => $item ) {
   $product_id = $item->get_product_id();
   $item_type = $item->get_type(); // e.g. "line_item"
}

						$stockstatus = get_post_meta(  $product_id, '_stock_status', true );
						//var_dump($stockstatus);
						//var_dump($order_date);
						//if already have time  then use this  =============
						
						if($stockstatus == 1 ){
							
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 3 days'))."</span> to ";
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 4 days'))."</span>";
		
						}
						else if($stockstatus == 'on_demand' ){
							
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 21 days'))."</span> to ";
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 28 days'))."</span>";
							
						}else if($stockstatus == 'special' ){
						
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 42 days'))."</span> to ";
							echo "<span>". date('m/d/Y', strtotime($order_date. ' + 56 days'))."</span>";
		
						}else {
		
							echo "<p>No Date</p>";
		
						}
						
						?>
		 </div>
	</div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'cloudways_display_order_data_in_admin' );
