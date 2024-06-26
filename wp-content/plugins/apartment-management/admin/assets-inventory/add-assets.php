<?php $obj_facility =new MJ_amgt_Facility; ?>
<script type="text/javascript">
$(document).ready(function() {
	//ASSETS_FORM VALIDATIONENGINE
	"use strict";
	<?php
	if (is_rtl())
		{
		?>	
			$('#assets_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#assets_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
			<?php
		}
	?>
       var date = new Date();
	   date.setDate(date.getDate()-0);
       jQuery('#purchage_date').datepicker({
			dateFormat: "yy-mm-dd",
			minDate:'today',
			changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+25',
			beforeShow: function (textbox, instance) 
			{
				instance.dpDiv.css({
					marginTop: (-textbox.offsetHeight) + 'px'                   
				});
			},    
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "/" + year);
	        }                    
		});  		
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
		$assets_id=0;
		if(isset($_REQUEST['assets_id']))
			$assets_id=$_REQUEST['assets_id'];
		$edit=0;
			if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit'){
				
				$edit=1;
				$result = $obj_assets->MJ_amgt_get_single_assets($assets_id);
			
			} ?>
	
		<div class="panel-body"><!--PANEL BODY-->
		     <!--ASSETS_FORM-->
			<form name="assets_form" action="" method="post" class="form-horizontal" id="assets_form">
					<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
					<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
					<input type="hidden" name="assets_id" value="<?php echo esc_attr($assets_id);?>"  />
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="assets"><?php esc_html_e('Asset No','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="assets_no" maxlength="20" class="form-control validate[required] text-input onlyletter_number_space_validation" type="text"  value="<?php if($edit){ echo esc_attr($result->assets_no);}elseif(isset($_POST['assets_no'])) echo esc_attr($_POST['assets_no']);?>" name="assets_no">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="assets_name"><?php esc_html_e('Asset Name','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="assets_name" maxlength="50" class="form-control text-input validate[required,custom[onlyLetter_specialcharacter]]" type="text"  value="<?php if($edit){ echo esc_attr($result->assets_name);}elseif(isset($_POST['assets_name'])) echo esc_attr($_POST['assets_name']);?>" name="assets_name">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vender_name"><?php esc_html_e('Vendor Name','apartment_mgt');?></label>
							<div class="col-sm-8">
								<input id="vender_name" maxlength="50" class="form-control text-input validate[custom[onlyLetter_specialcharacter]]" type="text"  value="<?php if($edit){ echo esc_attr($result->vender_name);}elseif(isset($_POST['vender_name'])) echo esc_attr($_POST['vender_name']);?>" name="vender_name">
							</div>
						</div>
					</div> 
					<div class="form-group">
						<div class="mb-3 row">	
							<!------ASSET CATEGORY----->
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="assets_category"><?php esc_html_e('Asset Category','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select class="form-select validate[required] assets_category" name="assets_cat_id" id="">
								<option value=""><?php esc_html_e('Select Asset Category','apartment_mgt');?></option>
								<?php 
								if($edit)
									$category =$result->assets_cat_id;
								elseif(isset($_REQUEST['assets_cat_id']))
									$category =$_REQUEST['assets_cat_id'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('assets_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} ?>
								</select>
							</div>
							<!-----ADD OR REMOVE ---->
							<div class="col-sm-2 margin_top_10_res"><button class="btn btn-default" id="addremove" model="assets_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
						</div>	
					</div>
					
					<div class="form-group"><!-----SELECT A FACILITY ---->
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="facility_name">
							<?php esc_html_e('Select A Facility To Book','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select name="location" id="" class="form-select validate[required]">
									<option value=''><?php esc_html_e('Select Facility','apartment_mgt');?></option>
									<?php
									if($edit)
										$facility_id =$result->location;
									elseif(isset($_REQUEST['location']))
										$facility_id =$_REQUEST['location'];  
									else 
										$facility_id = "";
									$all_facility = $obj_facility->MJ_amgt_get_all_facility();
									if(!empty($all_facility))
									{
										foreach($all_facility as $retrive_data)
										{
											echo '<option value="'.$retrive_data->facility_name .'" '.selected($facility_id,$retrive_data->facility_name).'>'.$retrive_data->facility_name .'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
				    </div>
					<style>
					.dropdown-menu {
						min-width: 240px;
					}
                    </style>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="purchage_date"><?php esc_html_e('Purchase Date','apartment_mgt');?></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="purchage_date" class="form-control validate[required]" autocomplete="off" type="text"  name="purchage_date" 
								value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->purchage_date)));}elseif(isset($_POST['purchage_date'])) echo esc_attr($_POST['purchage_date']); else echo esc_attr(date("Y-m-d"));?>">
							 </div>
							</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="asset_cost">
							<?php esc_html_e('Asset Cost','apartment_mgt'); echo ' '. '('. MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code')).')';?> </label>
							</label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="asset_cost" class="form-control text-input" min="0" type="number" onKeyPress="if(this.value.length==8) return false;"  value="<?php if($edit){ echo esc_attr($result->assets_cost);}elseif(isset($_POST['asset_cost'])) echo esc_attr($_POST['asset_cost']);?>" name="asset_cost">
							</div>
						</div>
					</div>
					<?php wp_nonce_field( 'save_assets_nonce' ); ?>
					<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="submit" value="<?php if($edit){ esc_html_e('save','apartment_mgt'); }else{ esc_html_e('Add Asset','apartment_mgt');}?>" name="save_assets" class="btn btn-success"/>
					</div>
				
			</form><!--END ASSETS_FORM-->
        </div><!-- END PANEL BODY DIV -->
<?php ?>