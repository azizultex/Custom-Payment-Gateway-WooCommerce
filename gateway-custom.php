<?php
/**
 * Plugin Name: WooCommerce Custom Payment Gateway
 * Plugin URI: https://azizultex.me
 * Description: 
 * Version: 1.0
 * Author: Azizul Haque
 * Author URI: https://azizultex.me
 * Tested up to: 4.6.1
 * Text Domain: customgatewaytext
 * Domain Path: /languages/
 *
 * @package Custom Gateway for WooCommerce
 * @author Azizul Haque
 */


/*
RESOURCES: 

1. https://www.sitepoint.com/building-a-woocommerce-payment-extension/
2. http://stackoverflow.com/questions/17081483/custom-payment-method-in-woocommerce
3. https://www.skyverge.com/blog/how-to-create-a-simple-woocommerce-payment-gateway/
4. http://www.ibenic.com/how-to-create-a-custom-woocommerce-payment-gateway/


*/

if ( ! defined('WPINC')) {
    die; // if accessed directly
}

// check woocommerce activation
$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
if ( ! in_array( 'woocommerce/woocommerce.php', $active_plugins ) ) {
	return;
}

// plugin directory
define( 'WOO_CUSTOM_PAYMENT_DIR', plugin_dir_path( __FILE__ )); 

// Include our Gateway Class and register Payment Gateway with WooCommerce
add_action( 'plugins_loaded', 'woo_custom_payment_gateway_init', 0 );
function woo_custom_payment_gateway_init() {

	// load text domain
	load_plugin_textdomain( 'woo_custom_payment_gateway', FALSE, WOO_CUSTOM_PAYMENT_DIR . '/languages/' );

	// Lets add it too WooCommerce
	add_filter( 'woocommerce_payment_gateways', 'woo_custom_payment_gateway' );
	function woo_custom_payment_gateway( $methods ) {
		$methods[] = 'woo_custom_payment_gateway';
		return $methods;
	}

	// include extended gateway class 
	include_once( 'woo_custom_payment_gateway.php' );



}