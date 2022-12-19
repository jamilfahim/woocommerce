
 // Add new stock status options
function filter_woocommerce_product_stock_status_options( $status ) {
	// Add new statuses
	$status['on_demand'] = __( 'On Demand', 'woocommerce' );
	$status['special'] = __( 'Special', 'woocommerce' );

	return $status;
}
add_filter( 'woocommerce_product_stock_status_options', 'filter_woocommerce_product_stock_status_options', 10, 1 );

// Availability text
function filter_woocommerce_get_availability_text( $availability, $product ) {
	// Get stock status
	switch( $product->get_stock_status() ) {
		 case 'on_demand':
			  $availability = __( 'On Demand', 'woocommerce' );
		 break;
		 case 'special':
			  $availability = __( 'special', 'woocommerce' );
		 break;
	}

	return $availability; 
}
add_filter( 'woocommerce_get_availability_text', 'filter_woocommerce_get_availability_text', 10, 2 );

// Availability CSS class
function filter_woocommerce_get_availability_class( $class, $product ) {
	// Get stock status
	switch( $product->get_stock_status() ) {
		 case 'on_demand':
			  $class = 'on-demand';
		 break;
		 case 'special':
			  $class = 'special';
		 break;
	}

	return $class;
}
add_filter( 'woocommerce_get_availability_class', 'filter_woocommerce_get_availability_class', 10, 2 );

// Admin stock html
function filter_woocommerce_admin_stock_html( $stock_html, $product ) {
	// Simple
	if ( $product->is_type( 'simple' ) ) {
		 // Get stock status
		 $product_stock_status = $product->get_stock_status();
	// Variable
	} elseif ( $product->is_type( 'variable' ) ) {
		 foreach( $product->get_visible_children() as $variation_id ) {
			  // Get product
			  $variation = wc_get_product( $variation_id );
			  
			  // Get stock status
			  $product_stock_status = $variation->get_stock_status();
			  
		 }
	}
	
	// Stock status
	switch( $product_stock_status ) {
		 case 'on_demand':
			  $stock_html = '<mark class="on-demand" style="background:transparent none;color:#33ccff;font-weight:700;line-height:1;">' . __( 'On Demand', 'woocommerce' ) . '</mark>';
		 break;
		 case 'special':
			  $stock_html = '<mark class="special" style="background:transparent none;color:#cc33ff;font-weight:700;line-height:1;">' . __( 'Special', 'woocommerce' ) . '</mark>';
		 break;
	}

	return $stock_html;
}
add_filter( 'woocommerce_admin_stock_html', 'filter_woocommerce_admin_stock_html', 10, 2 );
