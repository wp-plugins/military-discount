<div class="woocommerce-info" id="grprompt">
	<a href="#" id="grlink"><?php echo get_option("gr_discount_prompt");?></a>
</div>

<form method="post" style="display:none" id="grform">
	<?php
	if (get_option("gr_show_learn_more") == 1){
	?>
		<p>Learn more about this 
			<a href="http://businesses.gruntroll.com/end-users" target="_blank">verification process</a>.
		</p>	
	<?php	
	}
	?>
	<p id="gr_rejection" style="display:none;color:red;"><!--AJAX Content--></p>
	<p class="form-row form-row-first">
		<input type="password" id="grssn" class="input-text" placeholder="Social Security/Tax ID #" value="" />
	</p>
	<p class="form-row form-row-first">
		<input type="name" id="grname" class="input-text" placeholder="Last name" value="" />
	</p>
	<p class="form-row form-row-first">
		<select id="gryear" class="state_select">
		<option value="0">Enlistment year&hellip;</option>
		<?php
		$year = date('Y');$i = 0;
		while ($year > 1985){
			echo '<option value="' . $year . '">' . $year . '</option>';
			$year--;
		}
		?>                                              
		</select>
	</p>
	<p class="form-row form-row-last">
		<input type="submit" class="button" name="apply_coupon" value="Verify Status" id="grbtn" />
	</p>
	<div class="clear"></div>
</form>
