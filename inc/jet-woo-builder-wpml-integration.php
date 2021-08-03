<?php
// add jet widgets to WPML string translator 
add_filter( 'wpml_elementor_widgets_to_translate', 'ms_wpml_widgets_to_translate', 500);
function ms_wpml_widgets_to_translate($widgets) {

	// jet-auth-links widget
	$widgets[ 'jet-auth-links' ] = [
		'conditions' => [ 
			'widgetType' => 'jet-auth-links'
		],
		'fields' => [
			[
				'field'       => 'register_link_text',
				'type'        => 'Register link title',
				'editor_type' => 'LINE'
			],
			[
				'field'       => 'register_prefix',
				'type'        => 'Register link prefix',
				'editor_type' => 'LINE'
			],
		],
	];
	
	// jet-compare
	$widgets[ 'jet-compare' ] = [
		'conditions'        => [
			'widgetType' => 'jet-compare' 
		],
		'fields'            => [],
		'integration-class' => 'WPML_Jet_Woo_Builder_Compare',
	];

	// jet-cart-table
	$widgets[ 'jet-cart-table' ] = [
		'conditions'        => [
			 'widgetType' => 'jet-cart-table' 
		],
		'fields'            => [
			[
				'field'       => 'cart_table_update_button_text',
				'type'        => 'Cart Table: Update Cart Button Text',
				'editor_type' => 'LINE'
			],			
			[
				'field'       => 'cart_table_coupon_form_button_text',
				'type'        => 'Cart Table: Coupon Form Button Text',
				'editor_type' => 'LINE'
			],			
			[
				'field'       => 'cart_table_coupon_form_placeholder_text',
				'type'        => 'Cart Table: Coupon Form Placeholder Text',
				'editor_type' => 'LINE'
			],					
		],
		'integration-class' => 'WPML_Jet_Woo_Builder_Cart_Table',
	];
	
	// jet-checkout-billing widget
	$widgets[ 'jet-checkout-billing' ] = [
		'conditions' => [ 
			'widgetType' => 'jet-checkout-billing'
		],
		'fields' => [
			[
				'field'       => 'checkout_billing_form_title_text',
				'type'        => 'Checkout Billing Form: Heading',
				'editor_type' => 'LINE'
			],
			[
				'field'       => 'checkout_billing_form_label_title_text',
				'type'        => 'Checkout Billing Form: Create Account Label',
				'editor_type' => 'LINE'
			],
		],
	];

	// jet-checkout-shipping-form widget
	$widgets[ 'jet-checkout-shipping-form' ] = [
		'conditions' => [ 
			'widgetType' => 'jet-checkout-shipping-form'
		],
		'fields' => [
			[
				'field'       => 'checkout_shipping_form_title_text',
				'type'        => 'Checkout Shipping Form: Custom Title',
				'editor_type' => 'LINE'
			],
		],
	];

	// jet-checkout-additional-form widget
	$widgets[ 'jet-checkout-additional-form' ] = [
		'conditions' => [ 
			'widgetType' => 'jet-checkout-additional-form'
		],
		'fields' => [
			[
				'field'       => 'checkout_additional_form_title_text',
				'type'        => 'Checkout Additional Form: Heading',
				'editor_type' => 'LINE'
			],
		],
	];
	
	// error_log( "widgets\n" . print_r($widgets, true) . "\n" );
	return $widgets;
}




// add JetWooBuilder wishlist template to WPML translation 
add_filter('jet-woo-builder/elementor-views/frontend/archive-item-content', 'ms_translate_jwb_jcw_template', 10, 3);
function ms_translate_jwb_jcw_template($template_content, $current_wishlist_template, $product) {
	$wpml_treanslated_template_id = apply_filters( 'wpml_object_id', $current_wishlist_template, get_post_type($current_wishlist_template), true );
	$template_content = jet_woo_builder()->parser->get_template_content( $wpml_treanslated_template_id );
	return $template_content;
}





if(class_exists('WPML_Elementor_Module_With_Items')){
	class WPML_Jet_Woo_Builder_Compare extends WPML_Elementor_Module_With_Items {
		public function get_items_field() {
			return 'compare_table_data';
		}
		public function get_fields() {
			return array( 'compare_table_data_title', 'compare_table_data_remove_text' );
		}
		protected function get_title( $field ) {
			switch( $field ) {
				case 'compare_table_data_title':
					return 'Jet Compare: Title';
				case 'compare_table_data_remove_text':
					return 'Jet Compare: Remove';
				default:
					return '';
			}
		}
		protected function get_editor_type( $field ) {
			switch( $field ) {
				case 'compare_table_data_title':
					return 'LINE';
				case 'compare_table_data_remove_text':
					return 'LINE';
				default:
					return '';
			}
		}
	}

	class WPML_Jet_Woo_Builder_Cart_Table extends WPML_Elementor_Module_With_Items {
		public function get_items_field() {
			return 'cart_table_items_list';
		}
		public function get_fields() {
			return array( 'cart_table_heading_title');
		}
		protected function get_title( $field ) {
			switch( $field ) {
				case 'cart_table_heading_title':
					return 'Cart Table: Heading Title';
				default:
					return '';
			}
		}
		protected function get_editor_type( $field ) {
			switch( $field ) {
				case 'cart_table_heading_title':
					return 'LINE';
				default:
					return '';
			}
		}
	}
}