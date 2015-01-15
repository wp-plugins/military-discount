<?php
$saved = false;
//Access token
if (isset($_POST['gr_access_token'])){
	update_option("gr_access_token", $_POST['gr_access_token']);
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
	
	$v = $_POST['gr_show_learn_more'];
	if ($v == 'on'){$v='1';}else{$v='0';}
	update_option("gr_show_learn_more", $v);	
}
?>

<div class="wrap">
<h1>WooCommerce Military Discount (by GruntRoll)</h1>

<?php
if (!get_option("gr_access_token")){
	?>
	<hr>
	<h3>Getting started</h3>
	<ol>
		<li>Make sure <a href="http://www.woothemes.com/woocommerce/" target="_blank">WooCommerce</a> is installed.</li>
		<li>Make sure coupons are Enabled in 
		<a href="/wp-admin/admin.php?page=wc-settings&tab=checkout">WooCommerce->Settings->Checkout</a>.</li>
		<li><a href="http://businesses.gruntroll.com/register" target="_blank">Create a GruntRoll business account</a>.</li>
		<li>Copy your private access token from the GruntRoll account page 
		and paste it into settings below.</li>
		<li>Save settings at the bottom of this page. You're done! Users can now redeem verified military discounts during checkout.</li>
	</ol>
	<hr>
	<?php
}
else{
	?>
	<hr>
	You may view your usage and upcoming bill by
	<a href="http://businesses.gruntroll.com/login" target="_blank">logging in</a>
	to GruntRoll.
	<hr>
	<?php
}

if ($saved){
	echo '<div id="message" class="updated fade"><p><strong>Your settings have been saved.</strong></p></div>';
}
	
?>



<form method="post" action="admin.php?page=gruntroll.php">

<h3>Basic</h3>

<table class="form-table">        
        <tr valign="top">
        <th scope="row">Access Token:</th>
        <td><input size="20" type="text" name="gr_access_token" value="<?php echo get_option('gr_access_token') ; ?>" /></td>
        </tr> 

        <tr valign="top">
        <th scope="row">Disable regular coupons:</th>
        <td><input type="checkbox" name="gr_disable_coupons" <?php echo (get_option('gr_disable_coupons') =='1' ? 'checked="checked"' : ''); ?>></td>
        </tr>               
</table>

<h3>Display</h3>
<table class="form-table">        
        <tr valign="top">
        <th scope="row">Discount prompt:</th>
        <td><input type="text" size="60" name="gr_discount_prompt" value="<?php echo stripslashes( get_option('gr_discount_prompt') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Success message:</th>
        <td><input type="text" size="60" name="gr_success_message" value="<?php echo stripslashes( get_option('gr_success_message') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Rejection message:</th>
        <td><input type="text" size="60" name="gr_rejection_message" value="<?php echo stripslashes( get_option('gr_rejection_message') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Rejection reason:</th>
        <td>
       	<input type="checkbox" name="gr_show_rejection_message" <?php echo (get_option('gr_show_rejection_message') =='1' ? 'checked="checked"' : ''); ?>>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">"Learn more":</th>
        <td>
       	<input type="checkbox" name="gr_show_learn_more" <?php echo (get_option('gr_show_learn_more') =='1' ? 'checked="checked"' : ''); ?>>
        <strong>Note:</strong>&nbsp;Enabling this creates assurance for your customers.
        </td>
        </tr>        
</table>

<h3>Discount Options</h3>
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
        	<strong>Good:</strong> 5, 10, 20. <strong>Bad:</strong> 5%, $10, 20 percent.
        </td>        
        </tr>
</table>

<?php submit_button(); ?>

</form>

</div>
