<?php 
//ADD SLOT TAB
if($active_tab == 'add_sloat') { ?>
		<script type="text/javascript">
		$(document).ready(function() {
			 //SLOT FORM VALIDATIONENGINE
			 "use strict";
			 <?php
			if (is_rtl())
				{
				?>	
					$('#sloat_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
				<?php
				}
				else{
					?>
					$('#sloat_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
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
		<?php 
			$sloat_id=0;
			if(isset($_REQUEST['sloat_id']))
				$sloat_id=$_REQUEST['sloat_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
				{
					$edit=1;
					$result = $obj_parking->MJ_amgt_get_single_sloat($sloat_id);
				
				} ?>
		<div class="panel-body"><!--PANEL BODY DIV-->
		    <!--SLOT FORM-->
			<form name="sloat_form" action="" method="post" class="form-horizontal" id="sloat_form">
				 <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="sloat_id" value="<?php echo esc_attr($sloat_id);?>"  />
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="sloat_name"><?php esc_html_e('Slot Name','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="sloat_name" maxlength="20" class="form-control text-input validate[required,custom[address_description_validation]]" type="text"  value="<?php if($edit){ echo esc_attr($result->sloat_name);}elseif(isset($_POST['sloat_name'])) echo esc_attr($_POST['sloat_name']);?>" name="sloat_name">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="sloat_for"><?php esc_html_e('Slot For','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $sloattype = "member"; if($edit){ $sloattype=$result->sloat_type; }elseif(isset($_POST['sloat_type'])) {$sloattype=$_POST['sloat_type'];}?>
							<label class="radio-inline front_radio">
							 <input type="radio" value="member" class="tog validate[required] radio_border_radius" name="sloat_type"  <?php  checked( 'member', $sloattype);  ?>/><?php esc_html_e('Member','apartment_mgt');?>
							</label>
							<label class="radio-inline front_radio">
							  <input type="radio" value="Staff" class="tog validate[required] radio_border_radius" name="sloat_type"  <?php  checked( 'Staff', $sloattype);  ?>/><?php esc_html_e('Staff','apartment_mgt');?> 
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Comment','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							 <textarea name="comment" maxlength="150" class="form-control validate[custom[address_description_validation]] text-input"><?php if($edit) echo esc_textarea($result->comment);?></textarea>
						</div>
					</div>
				</div>
				<?php wp_nonce_field( 'save_sloat_nonce' ); ?>
				<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input type="submit" value="<?php if($edit){ esc_html_e('save','apartment_mgt'); }else{ esc_html_e('Add Slot','apartment_mgt');}?>" name="save_sloat" class="btn btn-success"/>
				</div>
			</form><!--END SLOT FORM-->
        </div><!--END PANEL BODY DIV-->
     <?php } ?>