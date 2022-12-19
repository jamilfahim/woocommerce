// Add new column(s) to the "My Orders" table in the account.
function sv_wc_add_my_account_orders_column( $columns ) {

	$new_columns = array();

	foreach ( $columns as $key => $name ) {

		 $new_columns[ $key ] = $name;

		 // add ship-to after order status column
		 if ( 'order-total' === $key ) {  //this is the line!
			  $new_columns['shipping-date-column'] = __( 'Shipping Date', 'woocommerce' );
		 }
	}

	return $new_columns;
}
add_filter( 'woocommerce_my_account_my_orders_columns', 'sv_wc_add_my_account_orders_column' );


function wc_custom_column_display( $order ) {
	
	foreach ( $order->get_items() as $item ){

		$item_shipping_date = $item->get_meta( 'Shipping Date' );
		$item_id = $item->get_id();
		
		echo $item->get_name() .'(';
		echo $item_shipping_date. ')<br>';
	
  }

}
add_action( 'woocommerce_my_account_my_orders_column_shipping-date-column', 'wc_custom_column_display', );


