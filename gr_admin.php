<?php
$saved = false;
//Access token
if (isset($_POST['gr_access_token'])){
	update_option("gr_access_token", trim($_POST['gr_access_token']));
	$saved = true;
}
//Discount prompt
if (isset($_POST['gr_discount_prompt'])){
	update_option("gr_discount_prompt", $_POST['gr_discount_prompt']);
	$saved = true;
}
//Success message
if (isset($_POST['gr_success_message'])){
	update_option("gr_success_message", $_POST['gr_success_message']);
	$saved = true;
}
//Rejection message
if (isset($_POST['gr_rejection_message'])){
	update_option("gr_rejection_message", $_POST['gr_rejection_message']);
	$saved = true;
}
//Eligibility
if (isset($_POST['gr_eligibility'])){
	update_option("gr_eligibility", $_POST['gr_eligibility']);
	$saved = true;
}
//Type
if (isset($_POST['gr_type'])){
	update_option("gr_type", $_POST['gr_type']);
	$saved = true;
}
//Amount
if (isset($_POST['gr_amount'])){
	update_option("gr_amount", preg_replace("/[^0-9]/","",$_POST['gr_amount']));
	$saved = true;
}

//Checkboxes
if ($saved){
	//Checkbox - disable other coupons
	$v = $_POST['gr_disable_coupons'];
	if ($v == 'on'){$v='1';}else{$v='0';}
	update_option("gr_disable_coupons", $v);	
	
	//Checkbox - show rejection message
	$v = $_POST['gr_show_rejection_message'];
	if ($v == 'on'){$v='1';}else{$v='0';}
	update_option("gr_show_rejection_message", $v);	
	
	//Checkbox - show "learn more"
	$v = $_POST['gr_show_learn_more'];
	if ($v == 'on'){$v='1';}else{$v='0';}
	update_option("gr_show_learn_more", $v);
	
	//Checkbox - Test Mode
	$v = $_POST['gr_enable_testing'];
	if ($v == 'on'){$v='1';}else{$v='0';}
	update_option("gr_enable_testing", $v);		
}
?>

<div class="wrap">
<h1>Military Discount Option at Checkout</h1>

<?php
if (!get_option("gr_access_token")){
	?>
	<hr>
	<h3>Setup</h3>
	<ol>
		<li>Make sure <a href="http://www.woothemes.com/woocommerce/" target="_blank">WooCommerce</a> is installed.</li>
		<li>Make sure coupons are Enabled in 
		<a href="/wp-admin/admin.php?page=wc-settings&tab=checkout">WooCommerce->Settings->Checkout</a>.</li>
		<li>Create a <a href="https://www.mashape.com/register" target="_blank">Mashape</a> account.</li>
		<li>Choose a <a href="https://www.mashape.com/gruntroll/military-verification/pricing" target="_blank">pricing plan</a> and <b>Subscribe</b> to it.</li>
		<li>Locate your <b>X-Mashape-Key</b> on <a href="https://www.mashape.com/gruntroll/military-verification" target="_blank">this page</a> (in the <b>Request Example</b> box).</li>
		<li>Paste your <b>X-Mashape-Key</b> value into the box below.
		<br>Example: Lps0y6eqSOms5HB8e27FPQaZ34jnV1zw6jwjsSpJ3JmW8aSwpZ</li>
		<li>Save settings.</li>
	</ol>
	<hr>
	<?php
}
else{
	?>
	<hr>
	You can view your usage by logging into
	<a href="https://www.mashape.com/login" target="_blank">Mashape</a>.
        <br>Contact us: sales@gruntroll.com
	<hr>
	<?php
}

if ($saved){
	echo '<div id="message" class="updated fade"><p><b>Your settings have been saved.</b></p></div>';
}
	
?>



<form method="post" action="admin.php?page=gruntroll.php">

<h3>Connection Settings</h3>

<table class="form-table">

        <tr valign="top">
        <th scope="row">X-Mashape-Key:</th>
        <td>
                <input size="50" type="text" name="gr_access_token" value="<?php echo get_option('gr_access_token') ; ?>" />
        </td>
        </tr>
             
        <tr valign="top">
        <th scope="row">Use SSL</th>
        <td>
                <input type="checkbox" checked disabled>
        </td>
        </tr>        
        
</table>

<hr>

<h3>General Settings</h3>
<table class="form-table">

        <tr valign="top">
        <th scope="row">Disable WC Coupons:</th>
        <td><input type="checkbox" name="gr_disable_coupons" <?php echo (get_option('gr_disable_coupons') =='1' ? 'checked="checked"' : ''); ?>>
        WooCommerce Coupons must be enabled. You may disable them here.
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Test Mode:</th>
        <td><input type="checkbox" name="gr_enable_testing" <?php echo (get_option('gr_enable_testing') =='1' ? 'checked="checked"' : ''); ?>>
	Emulates positive verification regardless of data submitted.
	</td>
        </tr>
        
</table>

<hr>

<h3>Display Settings</h3>
<table class="form-table">        
        <tr valign="top">
        <th scope="row">Discount Prompt:</th>
        <td><input type="text" size="60" name="gr_discount_prompt" value="<?php echo stripslashes( get_option('gr_discount_prompt') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Success Message:</th>
        <td><input type="text" size="60" name="gr_success_message" value="<?php echo stripslashes( get_option('gr_success_message') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Rejection Message:</th>
        <td><input type="text" size="60" name="gr_rejection_message" value="<?php echo stripslashes( get_option('gr_rejection_message') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Show Rejection Reason:</th>
        <td>
       	<input type="checkbox" name="gr_show_rejection_message" <?php echo (get_option('gr_show_rejection_message') =='1' ? 'checked="checked"' : ''); ?>>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">"Learn more":</th>
        <td>
       	<input type="checkbox" name="gr_show_learn_more" <?php echo (get_option('gr_show_learn_more') =='1' ? 'checked="checked"' : ''); ?>>
       	<b>Note:</b> Enabling a "Learn More" link creates extra assurance for your customers.
        </td>
        </tr>        
</table>

<hr>

<h3>Discount Settings</h3>
<table class="form-table">
        <tr valign="top">
        <th scope="row">Eligibility:</th>
        <td>
		<select name="gr_eligibility">
			<option value="1,0" <?php echo (get_option('gr_eligibility') =='1,0' ? 'selected' : ''); ?>>Active Duty Only</option>
			<option value="1,1" <?php echo (get_option('gr_eligibility') =='1,1' ? 'selected' : ''); ?>>Active Duty + Veterans</options>
		</select>        
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Type:</th>
        <td>
		<select name="gr_type">
			<option value="percent" <?php echo (get_option('gr_type') =='percent' ? 'selected' : ''); ?>>Percent</option>
			<option value="fixed_cart" <?php echo (get_option('gr_type') =='fixed_cart' ? 'selected' : ''); ?>>Fixed</options>
		</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Amount (number):</th>
        <td>
		<input type="text" size="5" name="gr_amount" value="<?php echo esc_attr( get_option('gr_amount') ); ?>" />       
        	<b>Good Examples:</b> 5, 10, 20. <b>Bad Examples:</b> 5%, $10, 20 percent.
        </td>        
        </tr>
</table>

<?php submit_button(); ?>

</form>

</div>
