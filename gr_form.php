<div class="woocommerce-info" id="grprompt">
	<a href="#" id="grlink"><?php echo get_option("gr_discount_prompt");?></a>
</div>

<form method="post" style="display:none" id="grform">
	<?php
	if (get_option("gr_show_learn_more") == 1){
	?>
		<p>Learn more about <a href="https://gruntroll.com/business" target="_blank">military verification</a>.
		</p>
	<?php	
	}
	?>
	
	<p id="gr_rejection" style="display:none;color:red;"><!--AJAX Content--></p>
	<p class="form-row form-row-first">
	        Last Name:
		<input type="text" id="gr_name" class="input-text" value="" />
	</p>
	<p class="form-row form-row-first">
	        Date of Birth
	        (MM/DD/YYYY)
		<input type="name" id="gr_dob" class="input-text" value="" />
	</p>
	
	<?php
	if (get_option("gr_eligibility") == "1,1"){
	?>
	<p class="form-row form-row-first">
	        Date of Service (MM/DD/YYYY):<br>
	        &bull;&nbsp;This may be <b>any date</b> you served on Active Duty.<br>       	        
	        &bull;&nbsp;Leave blank if you're on Active Duty.<br>
	        &bull;&nbsp;Minimum date is 10/01/1985.	        
		<input type="name" id="gr_date" class="input-text" value="" />
	</p>	
	<?php	
	}
	?>
	
	<p class="form-row form-row-first">
		<input type="submit" class="button" name="apply_coupon" value="Apply Discount" id="grbtn" />
	</p>
	<div class="clear"></div>
</form>
