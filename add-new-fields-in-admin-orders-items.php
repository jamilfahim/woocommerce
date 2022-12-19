
//shipping date in order admin items
function save_stock_status_order_item_meta( $item, $cart_item_key, $values, $order ) {
	$item->update_meta_data( '_stock_status', $values['data']->get_stock_status() );

	$stockstatus = $values['data']->get_stock_status();
	$order_date = $order->order_date;

	if($stockstatus == 'instock' ){
		  
	  $shipping_date =  date('m/d/Y', strtotime($order_date. ' + 3 days'))." to ".date('m/d/Y', strtotime($order_date. ' + 4 days'));
	  
  }
  else if($stockstatus == 'on_demand' ){

	  $shipping_date =   date('m/d/Y', strtotime($order_date. ' + 21 days'))." to ".date('m/d/Y', strtotime($order_date. ' + 28 days'));
  
	  
  }else if($stockstatus == 'special' ){

	  $shipping_date =   date('m/d/Y', strtotime($order_date. ' + 42 days'))." to ".date('m/d/Y', strtotime($order_date. ' + 56 days'));
  
  }else {

	  echo "<p>No Date</p>";

  }
	$item->update_meta_data( 'Shipping Date', $shipping_date );
}
add_action('woocommerce_checkout_create_order_line_item', 'save_stock_status_order_item_meta', 10, 4 );
