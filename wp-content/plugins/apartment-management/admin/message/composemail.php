<?php ?>
<script type="text/javascript">
$(document).ready(function() {
	"use strict";
	 //MESSAGE FORM VALIDATIONENGINE
	 <?php
	if (is_rtl())
		{
		?>	
			$('#message_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#message_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
			<?php
		}
	?>
	$('.onlyletter_number_space_validation').keypress(function( e ) 
	{
		"use strict";     
		var regex = new RegExp("^[0-9a-zA-Z \b]+$");
		var key = String.fromCharCode(!event.charCode ? event.which: event.charCode);
		if (!regex.test(key)) 
		{
			event.preventDefault();
			return false;
		} 
   });  
} );
</script>
		<div class="mailbox-content"><!-- MAIL BOIX CONTENT DIV -->
			<h2>
			</h2>
			<?php
			if(isset($message))
			{
				echo '<div id="message" class="updated below-h2 notice is-dismissible"><p>'.esc_html($message).'</p></div>';
     		}		
			?>
			<!---COMPOSE MALI----->
			<form name="message_form" action="" method="post" class="form-horizontal" id="message_form"><!---MESSAGE FORM----->
			  <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
			  <input type="hidden" name="action" value="<?php echo esc_attr($action);?>">
                <div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="to"><?php esc_html_e('Message To','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select name="receiver" class="form-select validate[required] text-input" id="to">
								    <option value="" disabled selected>Select Member</option>
									<!--<option value="member"><?php esc_html_e('All Members','apartment_mgt');?></option>	-->
									<!--<option value="accountant"><?php esc_html_e('All Accountants','apartment_mgt');?></option>	-->
									<!--<option value="staff_member"><?php esc_html_e('All Staff Member','apartment_mgt');?></option>	-->
									<!--<option value="gatekeeper"><?php esc_html_e('All Gatekeeper','apartment_mgt');?></option>	-->
									<!--<option value="committee_member"><?php esc_html_e('All Committee Member','apartment_mgt');?></option>	-->
								
									<?php
									MJ_amgt_get_all_user_in_message();?>
								</select>
							</div>	
						</div>	
                </div>
			    <div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="subject"><?php esc_html_e('Subject','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="subject" maxlength="50" class="form-control validate[required,custom[address_description_validation]] text-input onlyletter_number_space_validation" type="text" name="subject" >
							</div>
						</div>
			    </div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="subject"><?php esc_html_e('Message Comment','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<textarea name="message_body" maxlength="150" id="message_body" class="form-control validate[required,custom[address_description_validation]] text-input"></textarea>
							</div>
						</div>
				</div>
			     <?php wp_nonce_field( 'save_message_nonce' ); ?>
				<div class="form-group">
					<div class="mb-3 row">	
						<div class="col-sm-10">
							<div class="pull-right">
								<input type="submit" value="<?php  esc_html_e('Send Message','apartment_mgt');?>" name="save_message" class="btn btn-success"/>
							</div>
						</div>
					</div>
				</div>
            </form><!--END MESSAGE FORM---->
			<!---End Compose Mali----->
        </div><!-- END MAIL BOIX CONTENT DIV -->
<?php ?>