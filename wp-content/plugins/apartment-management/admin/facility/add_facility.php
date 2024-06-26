<script type="text/javascript">
$(document).ready(function() {
	//FACILITY FORM VALIDATIONENGINE
	"use strict";
	<?php
	if (is_rtl())
		{
		?>	
			$('#facility_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#facility_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
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
});
</script>
    <?php 	
		$facility_id=0;
		if(isset($_REQUEST['facility_id']))
			$facility_id=$_REQUEST['facility_id'];
			$edit=0;
		if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit'){
			$edit=1;
			$result = $obj_facility->MJ_amgt_get_single_facility($facility_id);
		} ?>
 
	<div class="panel-body"><!-- PANEL BODY DIV -->
	    <!--ADD FACILITY FORM-->
        <form name="facility_form" action="" method="post" class="form-horizontal" id="facility_form">
			<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
			<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
			<input type="hidden" name="facility_id" value="<?php echo esc_attr($facility_id);?>"  />
			
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="facility_name">
					<?php esc_html_e('Facility Name','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input id="facility_name" maxlength="50" class="form-control validate[required] text-input onlyletter_number_space_validation" 
						type="text" value="<?php if($edit){ echo esc_attr($result->facility_name);}
						elseif(isset($_POST['facility_name'])) echo esc_attr($_POST['facility_name']);?>" name="facility_name">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="facility_charge">
					<?php esc_html_e('Amount Charge','apartment_mgt');?> <span class="require-field">*</span></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input  class="form-control validate[required]" type="number" min="0" onKeyPress="if(this.value.length==8) return false;"  
						value="<?php if($edit){ echo esc_attr($result->facility_charge);}
						elseif(isset($_POST['facility_charge'])) echo esc_attr($_POST['facility_charge']);?>" name="facility_charge">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="charge_per">
					<?php esc_html_e('Charge Per','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $charge_per = "hour"; if($edit){ $charge_per=$result->charge_per; }elseif(isset($_POST['charge_per'])) {$complaintval=$_POST['charge_per'];}?>
						<label class="radio-inline">
						 <input type="radio" value="hour" 
						 class="tog validate[required]" name="charge_per"  
						 <?php  checked( 'hour', $charge_per);  ?>/><?php esc_html_e('By Hour','apartment_mgt');?>
						</label>
						<label class="radio-inline">
						  <input type="radio" value="date" class="tog validate[required]" name="charge_per"  
						  <?php  checked( 'date', $charge_per);  ?>/><?php esc_html_e('By Date','apartment_mgt');?> 
						</label>
						
					</div>
				</div>
			</div>
		
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="mobile_number"> </label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<?php $allow_booking_multiple_base = "hour"; if($edit){ $allow_booking_multiple_base=$result->allow_booking_multiple_base; }elseif(isset($_POST['allow_booking_multiple_base'])) {$allow_booking_multiple_base=$_POST['allow_booking_multiple_base'];}?>
						 <label class="checkbox">
						  <input type="checkbox" value="1" 
						  class="tog" 
						  name="allow_booking_multiple_base"  <?php  checked( '1', $allow_booking_multiple_base);  ?>/><?php esc_html_e('Allow booking for multiple days','apartment_mgt');?> 
						</label>
					</div>
				</div>
			</div>
			<?php wp_nonce_field( 'save_facility_nonce' ); ?>
			<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<input type="submit" 
				value="<?php if($edit){ esc_html_e('Save Facility','apartment_mgt'); }else{ esc_html_e('Add Facility','apartment_mgt');}?>" 
				name="save_facility" 
				class="btn btn-success"/>
			</div>
			
        </form><!--END FACILITY FORM-->
    </div><!-- END PANEL BODY DIV -->