<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function bellaciao_child_enqueue_scripts() {
	wp_enqueue_style(
		'bellaciao-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
	wp_enqueue_script( 'bellaciao-script', get_stylesheet_directory_uri() . '/assets/custom.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'bellaciao_child_enqueue_scripts', 20 );



require_once( get_stylesheet_directory() . '/inc/jet-woo-builder-wpml-integration.php');





// // fix flash of unstyled content for JWB templates (enqueue css in head instead footer)
// // https://elementor.com/help/dealing-with-flickers-fouc/
// add_action('wp_enqueue_scripts', function(){

// 	if ( !class_exists( 'WooCommerce' ) || !class_exists( 'Elementor\Core\Files\CSS\Post' ) ) return; // check classes

// 	$jet_woo_builder_options = get_option('jet_woo_builder'); // if jetwoobuilder installed
// 	$jet_cw_settings = get_option('jet-cw-settings'); // if jet whishlist & compare installed

// 	if(empty($jet_woo_builder_options)) return;

// 	// error_log( "jet_woo_builder_options\n" . print_r($jet_woo_builder_options, true) . "\n");

// 	if(is_shop() || is_product_category() || is_product_tag()) {
// 		// shop template
// 		if($jet_woo_builder_options['custom_shop_page'] != 'no' && $jet_woo_builder_options['shop_template'] != 'default') {
// 			$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['shop_template']);
// 			$css_file->enqueue();
// 		}
// 		// item template
// 		if($jet_woo_builder_options['archive_template'] != 'default') {
// 			$swithed_archive_layout = !empty( $_COOKIE['jet_woo_builder_layout'] ) ? absint( $_COOKIE['jet_woo_builder_layout'] ) : false;
// 			if($swithed_archive_layout) {
// 				$css_file = new \Elementor\Core\Files\CSS\Post($swithed_archive_layout);
// 				$css_file->enqueue();
// 			} else {
// 				$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['archive_template']);
// 				$css_file->enqueue();
// 			}
// 		}
// 	}

// 	// wishlist template
// 	if($jet_woo_builder_options['wishlist_template'] != 'default' && isset($jet_cw_settings['wishlist_page']) && is_page($jet_cw_settings['wishlist_page'])) {
// 		$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['wishlist_template']);
// 		$css_file->enqueue();
// 	}
	
// 	// cart template
// 	if(is_cart() && !WC()->cart->is_empty()){
// 		if($jet_woo_builder_options['cart_template'] != 'default') {
// 			$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['cart_template']);
// 			$css_file->enqueue();
// 		}
// 	}
	
// 	// empty cart template
// 	if (is_cart() && WC()->cart->is_empty()) {
// 		if($jet_woo_builder_options['empty_cart_template'] != 'default') {
// 			$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['empty_cart_template']);
// 			$css_file->enqueue();
// 		}
// 	}
	
// 	// checkout template
// 	if(is_cart() && !WC()->cart->is_empty()){
// 		if($jet_woo_builder_options['checkout_template'] != 'default') {
// 			$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['checkout_template']);
// 			$css_file->enqueue();
// 		}
// 	}

// 	// checkout top template
// 	if(is_cart() && !WC()->cart->is_empty()){
// 		if($jet_woo_builder_options['checkout_top_template'] != 'default') {
// 			$css_file = new \Elementor\Core\Files\CSS\Post($jet_woo_builder_options['checkout_top_template']);
// 			$css_file->enqueue();
// 		}
// 	}

// }, 500);







// mini-cart images
add_filter( 'woocommerce_cart_item_thumbnail', 'change_image_size_in_cart', 10, 2 );
function change_image_size_in_cart( $product_image, $cart_item ) {
		$product = $cart_item['data'];
		$product_image = $product->get_image( 'medium' );
	return $product_image;
}






// add-to-cart text
// add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
// function custom_woocommerce_product_add_to_cart_text( $text ) {
// 	return __( 'To Cart' );
// }







add_filter( 'woocommerce_loop_add_to_cart_link', 'woocommerce_loop_add_to_cart_link_fn', 10, 3 );
function woocommerce_loop_add_to_cart_link_fn( $html, $product, $args ) {

	// $in_cart = WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) );
	$product_type = $product->get_type();
	// error_log( "product_type\n" . print_r($product_type, true) . "\n" );

	$icon = '';
	$text = '<span class="jet-add-to-cart-button__text">' . __('To Cart', 'ocean-child') . '</span>';
	

	// // add class if in cart
	// if ( $in_cart != '' ) {
	// 	$args['class'] = $args['class'] . ' ' . 'in_cart';
	// 	$text = '<span class="jet-add-to-cart-button__text">In Cart</span>';
	// }

	// icon for simple product
	if($product->get_type() == 'simple') {
		$icon = '<span class="jet-add-to-cart-button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></span>';
	}

	// icon for variable product
	if($product->get_type() == 'variable') {
		$icon = '<span class="jet-add-to-cart-button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>';
		$text = '<span class="jet-add-to-cart-button__text">' . __('Details', 'ocean-child') . '</span>';
	}

	// button html
	$add_to_cart_button_html = $icon . $text;
	
	$html = sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$add_to_cart_button_html
	);

	// Return Add to cart  html
	return $html;

}




/* LIMIT SEARCH RESULTS TO ONLY PRODUCTS */
add_filter('pre_get_posts','ms_searchfilter');
function ms_searchfilter($query) {
	if ($query->is_search && !is_admin() ) {
		 $query->set('post_type', array('product'));
	}
	return $query;
}



// plugin updates
require 'inc/vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/webdevs-pro/bellaciao',
	__FILE__,
	'bellaciao'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('theme');

