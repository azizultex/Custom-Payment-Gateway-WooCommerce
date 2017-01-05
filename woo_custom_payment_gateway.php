<?php 

	class woo_custom_payment_gateway extends WC_Payment_Gateway {
		function __construct() {
			$this->id                 	= 'woo_custom_payment_gateway'; 
	    	$this->method_title       	= __( 'Woo Custom Payment', 'woo_custom_payment_gateway' );  
	    	$this->method_description 	= __( 'Woo Custom Payment Gateway for Client', 'woo_custom_payment_gateway' );
	    	$this->title              	= __( 'Woo Custom Payment', 'woo_custom_payment_gateway' );
			$this->has_fields = true;
			$this->supports = array( 
				'products',
				'default_credit_card_form'
			);
		   	// Load the settings.
    		$this->init_form_fields();
    		$this->init_settings();

    		// Turn these settings into variables we can use
			foreach ( $this->settings as $setting_key => $value ) {
				$this->$setting_key = $value;
			}
	    
		    // Save settings
  			if ( is_admin() ) {
  				// Versions over 2.0
  				// Save our administration options. Since we are not going to be doing anything special
  				// we have not defined 'process_admin_options' in this class so the method in the parent
  				// class will be used instead
  				add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
  			}
		}


		// Build the administration fields for this specific Gateway
		public function init_form_fields() {
			$this->form_fields = array(
				'enabled' => array(
					'title'		=> __( 'Enable / Disable', 'spyr-authorizenet-aim' ),
					'label'		=> __( 'Enable this payment gateway', 'spyr-authorizenet-aim' ),
					'type'		=> 'checkbox',
					'default'	=> 'no',
				),
				'title' => array(
					'title'		=> __( 'Title', 'spyr-authorizenet-aim' ),
					'type'		=> 'text',
					'desc_tip'	=> __( 'Payment title the customer will see during the checkout process.', 'spyr-authorizenet-aim' ),
					'default'	=> __( 'Credit card', 'spyr-authorizenet-aim' ),
				),
				'description' => array(
					'title'		=> __( 'Description', 'spyr-authorizenet-aim' ),
					'type'		=> 'textarea',
					'desc_tip'	=> __( 'Payment description the customer will see during the checkout process.', 'spyr-authorizenet-aim' ),
					'default'	=> __( 'Pay securely using your credit card.', 'spyr-authorizenet-aim' ),
					'css'		=> 'max-width:350px;'
				),
				'api_login' => array(
					'title'		=> __( 'Authorize.net API Login', 'spyr-authorizenet-aim' ),
					'type'		=> 'text',
					'desc_tip'	=> __( 'This is the API Login provided by Authorize.net when you signed up for an account.', 'spyr-authorizenet-aim' ),
				),
				'trans_key' => array(
					'title'		=> __( 'Authorize.net Transaction Key', 'spyr-authorizenet-aim' ),
					'type'		=> 'password',
					'desc_tip'	=> __( 'This is the Transaction Key provided by Authorize.net when you signed up for an account.', 'spyr-authorizenet-aim' ),
				),
				'environment' => array(
					'title'		=> __( 'Authorize.net Test Mode', 'spyr-authorizenet-aim' ),
					'label'		=> __( 'Enable Test Mode', 'spyr-authorizenet-aim' ),
					'type'		=> 'checkbox',
					'description' => __( 'Place the payment gateway in test mode.', 'spyr-authorizenet-aim' ),
					'default'	=> 'no',
				)
			);		
		}

	}