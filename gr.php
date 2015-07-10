<?php
/**
 * @package Military Discount
 * @version 1.2
 */
/*
Plugin Name: Military Discount
Plugin URI: https://wordpress.org/plugins/military-discount/
Description: This WooCommerce plugin provides a military discount option for your checkout.
Author: GruntRoll
Version: 1.2
Author URI: https://gruntroll.com/business
*/


class gruntroll{

        private $cartShown;
        
        /*************************************
        Construct:
        -Assume cart is not shown
        -Declare actions/filter
        -Check if coupon was deleted (any page)
        *************************************/
        public function __construct(){
                $this->cartShown = false;
                add_action('woocommerce_before_checkout_form', array($this,'hook_before_checkout'));
                add_action('wp_ajax_grverify', array($this,'hook_verify_and_apply'));
                add_action('wp_ajax_nopriv_grverify', array($this,'hook_verify_and_apply'));      
		add_action('woocommerce_cart_totals_coupon_label', array($this,'hook_discount_label'));
                add_action('wp_footer', array($this,'hook_footer'));
                add_filter('woocommerce_coupon_message', array($this,'filter_success_message'));                
                if (get_option("gr_disable_coupons") == "1"){
                	add_filter( 'woocommerce_coupons_enabled', array($this,'hide_other_coupons') );
                }
		if (isset($_GET['remove_coupon'])){
			if (strpos($_GET['remove_coupon'],'mildisc-') !== false) {
				global $wpdb;
				$wpdb->query(
					"
					DELETE FROM $wpdb->posts
					WHERE post_name = '" . $_GET['remove_coupon'] . "'
					"
				);
			}
                }
 		add_filter('plugin_action_links', array($this, 'add_settings_link'), 10, 2 );
 		add_action('admin_menu', array($this,'add_admin_page'));
        }

        /*************************************
        Hook: plugin_action_links
        -Create settings link in plugin page
        *************************************/
        public function add_settings_link($links, $file){
		static $this_plugin;
		if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

		if ($file == $this_plugin){
			$settings_link = '<a href="admin.php?page=gruntroll.php">'.__("Settings", "gruntroll").'</a>';
			array_unshift($links, $settings_link);
		}
		return $links;
        }

        /*************************************
        Admin load
        -Load page into site
        *************************************/        
        public function add_admin_page($action = NULL){
		add_submenu_page( $parent_slug = NULL, 
				  "Military Discounts", 
				  "menu title", 
				  "manage_options", 
				  "gruntroll", 
				  array($this,'show_admin_page'));
        }
        
        /*************************************
        Admin page load
        -Set default options if missing
        -Show admin page
        *************************************/
        public function show_admin_page(){
        	if (!get_option("gr_discount_prompt")){
        		update_option("gr_discount_prompt", "Military and Veterans receive a 10% discount on this purchase");
        		update_option("gr_success_message", "Thanks for your service. A 10% discount has been applied to your order.");
        		update_option("gr_rejection_message", "Unfortunately, we were unable to verify your status.");
        		update_option("gr_eligibility", "1,1");
        		update_option("gr_type", "percent");
        		update_option("gr_amount", "10");
        		update_option("gr_disable_coupons", "0");
        		update_option("gr_show_rejection_message", "1");
        		update_option("gr_show_learn_more", "0");
        		update_option("gr_enable_testing", "0");
        	}
        	include 'gr_admin.php';
        }

        /*************************************
        Hook: woocommerce_coupon_message
        -Override coupon success message
        *************************************/        
        public function filter_success_message(){
        	return get_option("gr_success_message");
        }
        
        /*************************************
        Hook: woocommerce_coupons_enabled
        -Hide regular WC coupons
        *************************************/
	public function hide_other_coupons($coupons_enabled){
		if ( is_cart() || is_checkout() ) {
			return false;
		}
		return $coupons_enabled;	
	}        

        /*************************************
        Hook: woocommerce_before_checkout_form
        -Switch cartShown to true so other 
         methods know checkout page is loaded
        -Delete old military discount coupons
        -Show form if Access Token is set
        *************************************/ 
        public function hook_before_checkout(){
                $this->cartShown = true;
                $this->deleteOld();
                $at = get_option("gr_access_token");
                $et = get_option("gr_enable_testing");
                if (!$this->inCart() && (!empty($at) || !empty($et))){
		        include 'gr_form.php';
        	}
        }
        
        /*************************************
        Hook: woocommerce_cart_totals_coupon_label
        -Check if discount is applied
        -If yes: override label in order to
         hide coupon code
        *************************************/        
        public function hook_discount_label(){
        	if ($this->inCart()){
        		echo 'Military Discount';        	
        	}
        }        

         /*************************************
        Hook (custom): wp_ajax_grverify
        -Retrieve/validate POST data
        -Send request to GruntRoll
        -Handle result
        -Stop further processing
        *************************************/       
        public function hook_verify_and_apply(){
                /**********************************
                Get POST data
                **********************************/
                $name = $_POST['name'];
                $dob = $_POST['dob'];
                $date = $_POST['date'];

                /**********************************
                Validate data (most happens on GR)
                **********************************/
                if (empty($_POST['name']) && $_POST['dob'] && $_POST['date']){
                	die('Fill out the required information');
                }
                if (strlen($dob) != 10){
                	die('Invalid DOB format');
                }
                if (strlen($name) < 2){
                	die('Invalid name format');
                }
                if (strlen($date) != 10 && !empty($date)){
                	die('Invalid date of service format');
                }                        
                
                /**********************************
                Check for test mode
                **********************************/
                if (get_option('gr_enable_testing') == 1){
                        sleep(2);
                	$result='{"request":"active","is_active":1,"is_veteran":1,"active_start":"01/01/2015","component":"Marine Corps Active Duty"}';
                }
                else{
		        /**********************************
		        Ensure Access Token exists
		        **********************************/
                	$access_token = get_option("gr_access_token");
                	if (strlen($access_token) > 1){
                		
				/**********************************
				Create Data
				**********************************/                 		
                		if (!empty($date)){
					$post_fields = array(
						'dob' 		=> $dob,
						'name' 		=> $name,
						'date' 		=> $date
				    	);
                		}
                		else{
					$post_fields = array(
						'dob' 		=> $dob,
						'name' 		=> $name
				    	);                		
                		}
                	
				/**********************************
				Perform request
				**********************************/ 
				$ch = curl_init();
				$curlConfig = array(
				    CURLOPT_URL            => "https://gruntroll-military-verification-v1.p.mashape.com/verify/active",
				    CURLOPT_POST           => true,
				    CURLOPT_CONNECTTIMEOUT => 10,
				    CURLOPT_TIMEOUT 	   => 30,
				    CURLOPT_RETURNTRANSFER => true,
				    CURLOPT_SSL_VERIFYPEER => true,
				    CURLOPT_SSL_VERIFYHOST => 2,
				    CURLOPT_HTTPHEADER	   => array(
				    	'X-Mashape-Key: ' . $access_token
				    ),   
				    CURLOPT_POSTFIELDS     => $post_fields
				);
				curl_setopt_array($ch, $curlConfig);
				$result = curl_exec($ch);
				$curl_errno = curl_errno($ch);
				$curl_error = curl_error($ch);		
				curl_close($ch);
                	}
                	else{
                		die('Access Token does not exist.');
                		
                	}
                }

                /**********************************
                Handle Result
                **********************************/
		$json = json_decode($result);

                //CURL error
		if ($curl_errno > 0) {
			die("cURL Error ($curl_errno): $curl_error\n");
		}
		//GruntRoll error	
		if (isset($json->error)){
			die($json->message);
		}
		//If eligible, apply discount
		if ($json->is_active){
			$this->apply();
			die('1');
		}
		else if ($json->is_veteran){
			if (get_option("gr_eligibility") == "1,0"){
				die('Discount is for Active Duty only');
			}
			else{
				$this->apply();
				die('1');		
			}
		}
		else if ($json->message){
			die($json->message);
		}
		else{
			die('Servicemember not found');
		}
		
                //Default response
                die('Unable to verify');
        }
        
        /*************************************
        Hook: wp_footer
        -Load JS without additional file DL
        (This is a small JS chunk)
        *************************************/
        public function hook_footer(){
                if ($this->cartShown){
                	include 'gr_js.php';
                }       
        }
        
        /*************************************
        Void:
        -Clears old military discount coupons
        from database. Since we want the
        coupons to delete regardless of whether
        they were used or not, this must be 
        called every time the checkout page
        is loaded.
        *************************************/ 
        public function deleteOld(){
        	global $wpdb;
		$wpdb->query(
			"
			DELETE FROM $wpdb->posts
			WHERE post_name LIKE 'mildisc-%' 
				AND post_date <= (NOW() - INTERVAL 10 MINUTE)
				AND post_type='shop_coupon'
			"
		);		     
        }        

        /*************************************
        Void:
        -Remove existing coupons from cart
        -Create coupon
        -Add coupon to cart
        *************************************/        
        private function apply(){
                global $woocommerce;
                //Remove all other coupons (prevent stacking discounts)
                $woocommerce->cart->remove_coupons();
                
                //Create coupon name (invisible to customer)
		$coupon_code = 'mildisc-' . rand(10000, 99999);

		//Create coupon
                $amount = get_option("gr_amount"); // Amount
                $discount_type = get_option("gr_type"); // Type: fixed_cart, percent, fixed_product, percent_product					
                $coupon = array(
	                'post_title' 	=> $coupon_code,
	                'post_content' 	=> '',
	                'post_status' 	=> 'publish',
	                'post_author' 	=> 1,
	                'post_type'	=> 'shop_coupon'
                );
                $new_coupon_id = wp_insert_post( $coupon );
                
                //Update coupon settings
                update_post_meta($new_coupon_id, 'discount_type', $discount_type);
                update_post_meta($new_coupon_id, 'coupon_amount', $amount);
                update_post_meta($new_coupon_id, 'individual_use', 'no');
                update_post_meta($new_coupon_id, 'product_ids', '');
                update_post_meta($new_coupon_id, 'exclude_product_ids', '');
                update_post_meta($new_coupon_id, 'usage_limit', '');
                update_post_meta($new_coupon_id, 'expiry_date', '');
                update_post_meta($new_coupon_id, 'apply_before_tax', 'yes');
                update_post_meta($new_coupon_id, 'free_shipping', 'no');
                
                //Add coupon to cart
                $woocommerce->cart->add_discount(sanitize_text_field($coupon_code));       
        }
        
        /*************************************
        Boolean:
        Returns if military discount has been
        applied and is in the cart.
        *************************************/
        private function inCart(){
                global $woocommerce;
                $r = false;
                $coupons = $woocommerce->cart->applied_coupons;
                if (sizeof($coupons) > 0){                
		        foreach($coupons as $c){
		        	if (strpos($c,'mildisc-') !== false) {
		        		$r = true;
		        	}
		        }
                }
                return $r;
        }
}


/*************************************
Loads the plugin
*************************************/
$GLOBALS['gruntroll'] = new gruntroll();

?>
