<script type='text/javascript'>
jQuery('#grlink').on('click', function(event){
        event.preventDefault();
        jQuery('#grform').toggle('slide');
});

jQuery('#grbtn').on('click', function(event){
        event.preventDefault();
        jQuery.ajax({
                type: "POST",
                url: "/wp-admin/admin-ajax.php",
                data: {
                        action: "grverify",
                        name: jQuery('#grname').val(),
                        ssn:  jQuery('#grssn').val(),
                        year: jQuery('#gryear').val()
                },
                timeout:5000,
                error: function(){
                        alert('Connection error. Try again.');
                },
                beforeSend: function(){
			jQuery("#grbtn").prop("disabled",true);
			jQuery("#grbtn").val("Verifying...");
                },
                success: function(d){
                        if (d == '1'){
                                jQuery('body').trigger('update_checkout');
                                jQuery('#grprompt').hide('slide');
                                jQuery('#grform').hide('slide'); 
                        }
                        else{
                        	jQuery("#grbtn").prop("disabled",false);
                        	jQuery("#grbtn").val("Verify");
                        	<?php
                        	if (get_option("gr_show_rejection_message") == "1"){
                        	?>
                        		jQuery('#gr_rejection').html("<?php echo get_option('gr_rejection_message');?><br>Reason: " + d);
                        	<?php
                        	}
                        	else{
                        	?>
                        		jQuery('#gr_rejection').html("<?php echo get_option('gr_rejection_message');?>");
                        	<?php                        	
                        	}                        	
                        	?>                        	
				jQuery('#gr_rejection').show('slide');                        
                        }
                }
        });
});
</script>
