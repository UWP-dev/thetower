<script type="text/javascript">
$(document).ready(function() {
	"use strict";
	//RECURING_CHARGES_FORM
	$('#recuring_charges_form').validationEngine();
	var date = new Date();
	date.setDate(date.getDate()-0);
	jQuery('.date').datepicker({
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

	var start = new Date();
	var end = new Date(new Date().setYear(start.getFullYear()+1));
	$("#start_date_one_charge").datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	onSelect: function (selected) {
		var dt = new Date(selected);
		dt.setDate(dt.getDate() + 0);
		$("#end_date_one_charge").datepicker("option", "minDate", dt);
	}
	});
	$("#end_date_one_charge").datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
		onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() - 0);
			$("#start_date_one_charge").datepicker("option", "maxDate", dt);
		}
	});	
	
	$("body").on("click",".amgt_charge_period_value",function(){
		"use strict";
		if( $('.amgt_charge_period_value_one_charge').prop("checked") )
	    {
			$('.one_time_reccuring').show(); 
		}
		else
		{
			$('.one_time_reccuring').hide(); 
		}
    });

	//ONLYLETTER_NUMBER_SPACE_VALIDATION
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
$pay_charges_id=0;
if(isset($_REQUEST['pay_charges_id']))
	$pay_charges_id=$_REQUEST['pay_charges_id'];
	$edit=0;
	if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
	{
		$edit=1;
		$result = $obj_account->MJ_amgt_get_single_charges_list($pay_charges_id);
	} 
?>

<div class="panel-body"><!--Panel-body-->
     <!----RECURING_CHARGES_FORM--->
    <form name="recuring_charges_form" action="" method="post" class="form-horizontal" id="recuring_charges_form">
        <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
		<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
		<input type="hidden" name="pay_charges_id" value="<?php echo esc_attr($pay_charges_id);?>"  />		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="Charge Period"><?php esc_html_e('Charge Period','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<?php  
					$charge_period='0';
					if($edit)
					{
						$charge_period=$result->amgt_charge_period;				  
					}
					?>				
						<label class="radio-inline">
							<input type="radio" value="0" class="tog validate[required] amgt_charge_period_value amgt_charge_period_value_one_charge" name="amgt_charge_period"  <?php  checked( '0', $charge_period);  if($edit){ if($charge_period != '0'){ echo 'disabled="disabled"'; } }?> attr="amgt_charge_period_one"/><?php esc_html_e('One Time','apartment_mgt');?> 
						</label>
						<label class="radio-inline">
						<input type="radio" value="1" class="tog validate[required] amgt_charge_period_value" name="amgt_charge_period"  <?php  checked( '1', $charge_period);  if($edit){ if($charge_period != '1'){ echo 'disabled="disabled"'; } }?>/><?php esc_html_e('Monthly','apartment_mgt');?>
						</label>
						<label class="radio-inline">
						<input type="radio" value="3" class="tog validate[required] amgt_charge_period_value" name="amgt_charge_period"  <?php  checked( '3', $charge_period);  if($edit){ if($charge_period != '3'){ echo 'disabled="disabled"'; } }?>/><?php esc_html_e('Quarterly','apartment_mgt');?> 
						</label>
						<label class="radio-inline">
						<input type="radio" value="12" class="tog validate[required] amgt_charge_period_value" name="amgt_charge_period"  <?php  checked( '12', $charge_period);  if($edit){ if($charge_period != '12'){ echo 'disabled="disabled"'; } }?>/><?php esc_html_e('Yearly','apartment_mgt');?> 
						</label>
				</div>
			</div>
		</div> 
		<div class="one_time_reccuring <?php if($edit){  if($result->one_time_recurring_option == 0){ echo "display_none"; } } ?>">			
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="start"><?php esc_html_e('Start Date','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-3">
						<input id="start_date_one_charge" class="form-control validate[required] start_date datepicker1" autocomplete="off" type="text"  name="start_date_one_charge" 
						value="<?php if($edit){ echo date("Y-m-d",strtotime($result->start_date_one_charge));}elseif(isset($_POST['start_date_one_charge'])) echo esc_attr($_POST['start_date_one_charge']); ?>" placeholder="<?php esc_html_e('Charge Start Date','apartment_mgt'); ?>">
					</div>

					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="start"><?php esc_html_e('End Date','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-3">
						<input id="end_date_one_charge" class="form-control validate[required] start_date datepicker1" autocomplete="off" type="text"  name="end_date_one_charge" 
						value="<?php 
						if($edit){ echo date("Y-m-d",strtotime($result->end_date_one_charge));}elseif(isset($_POST['end_date_one_charge'])) echo esc_attr($_POST['end_date_one_charge']); ?>" placeholder="<?php esc_html_e('Charge End Date','apartment_mgt'); ?>">
					</div>
				</div>
			</div>	
		</div>	
		<div class="form-group">
				<div class="mb-3 row">	
					<div class="enable-massage col-sm-1 one_time_recurring_option_cs">
						<input type="checkbox" name="one_time_recurring_option" class="checkbox-massage col-sm-1 control-label float_right" value="1" <?php if($edit){ if($result->one_time_recurring_option == '1') { echo 'checked'; } } ?> />
					</div>
					<label class="enable-massage1 col-sm-11" for="start"><?php esc_html_e('If you want to generate recurring invoices every month until the charge end date. so Please enable checkbox.','apartment_mgt');?>
					</label>
				</div>	
		</div>		
		<div class="form-group"><!--FORM GROUP-->
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="enable"><?php esc_html_e('Select Invoice Option','apartment_mgt');?></label>
				<div class="col-sm-8">
					<?php 
					$select_serveice ='all_member';
					if($edit)
					{
						 $select_serveice=$result->invoice_options;
						 $select_option=$result->invoice_options;
					} 			 
					 ?>
					<div class="radio">
						<label class="radio-btn">
							<input  type="radio" name="select_serveice" <?php  checked( 'all_member', $select_serveice);  ?>  value="all_member" 
							<?php if($edit){ if($select_option != 'all_member'){ echo 'disabled="disabled"'; } }?> > <?php esc_html_e('All Member','apartment_mgt');?> 
						</label> 
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="radio-btn">
							<input  type="radio" name="select_serveice" <?php  checked( 'Building', $select_serveice);  ?> value="Building" <?php if($edit){ if($select_option != 'Building'){ echo 'disabled="disabled"'; }}?>> <?php esc_html_e('Building Member','apartment_mgt');?> 
						</label> 
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="radio-btn">
							<input type="radio"  name="select_serveice" <?php  checked( 'Unit Category', $select_serveice);  ?> value="Unit Category" <?php if($edit){ if($select_option != 'Unit Category'){ echo 'disabled="disabled"'; } }?>>  <?php esc_html_e('Unit Category Member','apartment_mgt');?>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="radio-btn">
							<input type="radio"  name="select_serveice" <?php  checked( 'one_member', $select_serveice);  ?> value="one_member" <?php if($edit){ if($select_option != 'one_member'){ echo 'disabled="disabled"'; } }?>>  <?php esc_html_e('One Member','apartment_mgt');?>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;
					</div>				 
				</div>
			</div>
		</div><!--END FORM GROUP-->		
		<?php 
		if($edit)
		{
			$select_option=$result->invoice_options;
			if($select_option == "one_member")
			{ ?>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] building_category" name="building_id">
								<option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
								<?php 
								if($edit)
									$category =$result->building_id;
								elseif(isset($_REQUEST['building_id']))
									$category =$_REQUEST['building_id'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('building_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} ?>
							</select>
						</div>
					</div>
				</div>
				<!--UNIT CATEGORY-->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] unit_categorys" name="unit_cat_id">
								<option value=""><?php esc_html_e('Select Unit Category','apartment_mgt');?></option>
								<?php 						
								if($edit)
									$category =$result->unit_cat_id;
								elseif(isset($_REQUEST['unit_cat_id']))
									$category =$_REQUEST['unit_cat_id'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('unit_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} 	
								?>
							</select>
						</div>
					</div>
				</div>	
                <!---UNIT-->				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Unit','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] account_unit_name" name="unit_name">
								<option value=""><?php esc_html_e('Select Unit Name','apartment_mgt');?></option>
								<?php 
								if($edit)
								{
									 $unitname =$result->unit_name;
									 $building_id=$result->building_id;
									 $unitsarray=$obj_units->MJ_amgt_get_single_cat_units($building_id,$result->unit_cat_id);
									 $all_entry=json_decode($unitsarray);
									
									if(!empty($all_entry))
									{
										foreach($all_entry as $unit)
										{ ?>
											<option value="<?php echo esc_attr($unit->value); ?>" <?php selected($unitname,$unit->value);?>><?php echo esc_html($unit->value);?> </option>
										<?php 
										}
									}							
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group"><!--FORM-GROUP--->
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"  for="member"><?php esc_html_e('Member','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] member_id" id="member_id" name="member_id">
								<option value=""><?php esc_html_e('Select Member','apartment_mgt');?></option>
								<?php if($edit)
								{
									$memberid =$result->member_id;
									$unitname =$result->unit_name;
									$category =$result->unit_cat_id;
									$building =$result->building_id;
									
								   $args = array(
											'role' => 'member',
											'meta_query'=>
											 array(
												'relation' => 'AND',
												array(
													'relation' => 'AND',
												array(
													'key'	  =>'building_id',
													'value'	=>	$building,
													'compare' => '=',
												),
												array(
													'key'	  =>'unit_cat_id',
													'value'	=>	$category,
													'compare' => '=',
												),
												array(
													'key'	  =>'unit_name',
													'value'	=>	$unitname,
													'compare' => '=',
												)
											  ),
											  array(
													'relation' => 'OR',
												array(
													'key'	  =>'occupied_by',
													'value'	=>	'Owner',
													'compare' => '=',
												),
												array(
													'key'	  =>'occupied_by',
													'value'	=>	'tenant',
													'compare' => '=',
												)
											  )
										   )
										);

										 $allmembers = get_users($args);
									
									   foreach($allmembers as $allmembers_data)
									  {
										 echo '<option value="'.$allmembers_data->ID.'" '.selected($memberid,$allmembers_data->ID).'>'.$allmembers_data->display_name.'</option>';
									  }
								}
								 ?>
							</select>
						</div>					
					</div>					
				</div><!--END FORM-GROUP--->				
			<?php
			}
			elseif($select_option == "Unit Category")
			{ ?>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] building_category" name="building_id">
								 <option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
								<?php 
								if($edit)
									$category =$result->building_id;
								elseif(isset($_REQUEST['building_id']))
									$category =$_REQUEST['building_id'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('building_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] unit_categorys" name="unit_cat_id">
								<option value=""><?php esc_html_e('Select Unit Category','apartment_mgt');?></option>
								<?php 
									if($edit)
										$category =$result->unit_cat_id;
									elseif(isset($_REQUEST['unit_cat_id']))
										$category =$_REQUEST['unit_cat_id'];  
									else 
										$category = "";
									
									$activity_category=MJ_amgt_get_all_category('unit_category');
									if(!empty($activity_category))
									{
										foreach ($activity_category as $retrive_data)
										{
											echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
										}
									} ?>
							</select>
						</div>
					</div>
				</div>				 
			<?php  
			}
			//BUILDING
			elseif($select_option == 'Building')
			{ ?>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<select class="form-select validate[required] building_category" name="building_id">
								<option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
								<?php 
								if($edit)
									$category =$result->building_id;
								elseif(isset($_REQUEST['building_id']))
									$category =$_REQUEST['building_id'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('building_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} ?>
							</select>
						</div>
					</div>
				</div>				
			<?php 
			}			
			elseif($select_option == 'all_member')
			{
		   }			
		  } 		
		    if($edit)
		    { ?> 
			<div ></div>
		    <?php  
		    }
            else
		    { ?>
			<div id="invoice_setting_block"> </div>
			<hr>
		   <?php  
		    } 
		    ?>
		   <div class="form-group"><!--FORM GROUP-->
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Charges','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<select class="form-select validate[required] charges_category" name="charges_id" id="">
						<option value="0"><?php esc_html_e('Maintenance Charges','apartment_mgt');?></option>
						<?php 
						if($edit)
							$category =$result->charges_type_id;
						elseif(isset($_REQUEST['charges_id']))
							$category =$_REQUEST['charges_id'];  
						else 
							$category = 0;
						
						$activity_category=MJ_amgt_get_all_category('charges_category');
						if(!empty($activity_category))
						{
							foreach ($activity_category as $retrive_data)
							{
								echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
							}
						} ?>
					</select>
				</div>
				<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="charges_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
			</div>	
		</div><!--END FORM GROUP-->		
		<?php
		$select_charge_cal ='fix_charge';
		if($edit)
		{
			$select_charge_cal=$result->charges_calculate_by;
		} 
		?>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="enable"><?php esc_html_e('Charge Calculate By ','apartment_mgt');?></label>
				<div class="col-sm-8">
					 <div class="radio">				    
						<label class="radio-btn">
							<input  type="radio" class="tax_div_clear" name="charge_cal" <?php  checked( 'fix_charge', $select_charge_cal);  ?> value="fix_charge" <?php if($edit){ if($select_charge_cal != 'fix_charge'){ echo 'disabled="disabled"'; } }?>> <?php esc_html_e('Fix Charge','apartment_mgt');?> 
						</label> 
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<label class="radio-btn">
							<input  type="radio" class="tax_div_clear" name="charge_cal" <?php  checked( 'measurement_charge', $select_charge_cal);  ?>  value="measurement_charge" <?php if($edit){ if($select_charge_cal != 'measurement_charge'){ echo 'disabled="disabled"'; } }?>> <?php esc_html_e('Measurement Charge','apartment_mgt');?> 
						</label> 
						&nbsp;&nbsp;&nbsp;&nbsp; 					
					</div>				 
				</div>
			</div>
		</div>
		<?php 
		if($edit)
		{
			$all_entry=json_decode($result->charges_payment);
		}		
		if(!empty($all_entry))
		{
			foreach($all_entry as $entry)
			{   //FIX CHARGES
				if($select_charge_cal=='fix_charge')
				{
				?>  
					<div id="charges_entry"><!--CHARGES PAYMENT-->
						<div class="form-group">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Charges Payment','apartment_mgt'); ?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>						
								<div class="col-sm-2 margin_bottom_10_res">
									<input id="income_amount" class="form-control validate[required] text-input income_amount" type="number" min="0" value="<?php echo esc_attr($entry->amount);?>" name="income_amount[]" >
								</div>						
								<div class="col-sm-4 margin_bottom_10_res">
									<input id="income_entry" maxlength="50" class="form-control validate[required] text-input onlyletter_number_space_validation" maxlength="50" type="text" value="<?php echo esc_attr($entry->entry);?>" name="income_entry[]">
								</div>							
								<div class="col-sm-2">
									<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
									<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
									</button>
								</div>
							</div>
						</div>	
					</div><!--END CHARGES PAYMENT-->
				<?php 
				}
				else if($select_charge_cal=='measurement_charge')
				{
					$unit_measerment_type=get_option( 'amgt_unit_measerment_type' );
				?>
					<div id="charges_entry">
						<div class="form-group">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Charges Payment','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
								<div class="col-sm-2">
									<input id="income_amount" class="form-control validate[required] text-input income_amount" type="number" min="0" value="<?php echo esc_attr($entry->amount);?>" name="income_amount[]" >
								</div>	
								<div class="float_left_top_font_size_13 w-auto">
								<?php  esc_html_e('/ per','apartment_mgt'); 
									if($unit_measerment_type == 'square_meter')
									{
										echo esc_html_e('Square Meter','apartment_mgt');
									}
									elseif($unit_measerment_type == 'square_feet')
									{
										echo esc_html_e('Square Feet','apartment_mgt');
									}
									elseif($unit_measerment_type == 'square_yards')
									{
										echo esc_html_e('Square Yards','apartment_mgt');
									}
									?>
								</div>								
							</div>								
						</div>	
					</div>
				<?php	
				}						
			}			
		}
		else
		{
		?>
			<div id="charges_entry"><!-----CHARGES ENTRY----->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Charges Payment','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>						
						<div class="col-sm-2 margin_bottom_10_res">
							<input id="income_amount" class="form-control validate[required] text-input income_amount" type="number" min="0" value="" name="income_amount[]" placeholder="<?php esc_html_e('Charges Amount','apartment_mgt');?>">
						</div>										
						<div class="col-sm-4 margin_bottom_10_res">
							<input id="income_entry" maxlength="50" class="form-control validate[required] text-input onlyletter_number_space_validation" maxlength="50" type="text" value="" name="income_entry[]" placeholder="<?php esc_html_e('Charges Entry Label','apartment_mgt');?>">
						</div>					
						<div class="col-sm-2">
							<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
							<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
							</button>
						</div>
					</div>
				</div>	
			</div><!-----END CHARGES ENTRY----->					
		<?php 
		} 
		if($edit)
		{
			if($select_charge_cal=='fix_charge')
			{
			?>
				<div class="form-group measurement_hide_div">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="expense_entry"></label>
						<div class="col-sm-3">
							<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left new_entry_charges" type="button"   name="add_new_entry"><?php esc_html_e('Add Charges Entry','apartment_mgt'); ?>
							</button>
						</div>
					</div>
				</div>	
			<?php
			}
		}
		else
		{
		?>
			<div class="form-group measurement_hide_div">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="expense_entry"></label>
					<div class="col-sm-3">
						<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left new_entry_charges" type="button"   name="add_new_entry"><?php esc_html_e('Add Charges Entry','apartment_mgt'); ?>
						</button>
					</div>
				</div>
			</div>	
		<?php
		}				
		?>	
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="discount-amount">
				<?php esc_html_e('Discount Amount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)</label>
				<div class="col-sm-8">
					<input id="discount-amount" class="form-control discount-amount" type="number" min="0"  
					value="<?php if($edit){ echo esc_attr($result->discount_amount);}
					elseif(isset($_POST['discount_amount'])) echo esc_attr($_POST['discount_amount']);?>" name="discount_amount">
				</div>			
			</div>			
		</div>
		<?php
		if($edit)
		{
			if($select_charge_cal=='fix_charge')
			{
			?>
				<div class="form-group measurement_hide_div">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="amount">
						<?php esc_html_e('Amount After Discount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
						<div class="col-sm-8">
							<input id="amount" class="form-control validate[required,custom[number]] amount" type="number" min="0"	value="<?php if($edit){ echo esc_attr($result->amount);}
							elseif(isset($_POST['amount'])) echo esc_attr($_POST['amount']);?>" name="amount">
						</div>
					</div>
				</div>
			<?php
			}	
		}
		else
		{
		?>
			<div class="form-group measurement_hide_div">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="amount">
					<?php esc_html_e('Amount After Discount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
					<div class="col-sm-8">
						<input id="amount" class="form-control validate[required,custom[number]] amount" type="number" min="0" value="<?php if($edit){ echo esc_attr($result->amount);}
						elseif(isset($_POST['amount'])) echo esc_attr($_POST['amount']);?>" name="amount">
					</div>
				</div>
			</div>
		<?php	
		}		
		if($edit)
		{
		?>	
			<div id="charges_entry1"><!--CHARGES PENTRY-->
				<?php 
				$obj_tax =new MJ_amgt_Tax;
				$tax_data_value= $obj_tax->MJ_amgt_get_all_tax_by_charge_id($pay_charges_id);
				if(!empty($tax_data_value))
				{	$i=1;			
					foreach ($tax_data_value as $data)
					{
						$i--;
						if($select_charge_cal=='fix_charge')
						{						
						?>
							<div class="form-group">
								<div class="mb-3 row">	
									<input type="hidden" id="increament_val" name="increament_val" value="<?php echo $i;?>">
									<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Tax','apartment_mgt');?><span class="require-field"></span></label>
									<div class="col-sm-4">
										<select name="tax_title[]" id="<?php echo $i;?>" class="form-select valid tax_selection">
											<option value=""><?php esc_html_e('Select Tax','apartment_mgt');?></option>
											<?php 
											$obj_tax =new MJ_amgt_Tax;
											$tax_data= $obj_tax->Amgt_get_all_tax();
											$tax_id=$data->tax_id;
											 if(!empty($tax_data))
											 {
												foreach ($tax_data as $retrive_data)
												{ 
													echo '<option value="'.$retrive_data->id.'" '.selected($tax_id,$retrive_data->id).'>'.$retrive_data->tax_title.'</option>';						
												}
											 }	
											 ?>
										</select>
									</div>
									<div class="col-sm-2 margin_bottom_10_res">
										<input id="tax_entry_<?php echo $i;?>" class="form-control  text-input" type="text" value="<?php echo esc_attr($data->tax);?>" name="tax_entry[]" placeholder="<?php esc_html_e('Tax','apartment_mgt');?>" readonly>
									</div>											
									<div class="col-sm-1">
										<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
										<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
										</button>
									</div>
								</div>
							</div>	
						<?php
						}
						elseif($select_charge_cal=='measurement_charge')
						{
						?>
							<div class="form-group">
								<div class="mb-3 row">	
									<input type="hidden" id="increament_val" name="increament_val" value="<?php echo $i;?>">
									<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Tax','apartment_mgt');?><span class="require-field"></span></label>
									<div class="col-sm-4">
										<select name="tax_title[]" id="<?php echo $i;?>" class="form-select valid tax_selection">
											<option value=""><?php esc_html_e('Select Tax','apartment_mgt');?></option>
											<?php 
											$obj_tax =new MJ_amgt_Tax;
											$tax_data= $obj_tax->Amgt_get_all_tax();
											$tax_id=$data->tax_id;
											 if(!empty($tax_data))
											 {
												foreach ($tax_data as $retrive_data)
												{ 
													echo '<option value="'.$retrive_data->id.'" '.selected($tax_id,$retrive_data->id).'>'.$retrive_data->tax_title.'</option>';						
												}
											 }	
											 ?>
										</select>
									</div>
									<div class="col-sm-2 margin_bottom_10_res">
										<input id="tax_entry_<?php echo $i;?>" class="form-control  text-input" type="text" value="<?php echo esc_attr($data->tax);?>" name="tax_entry[]" placeholder="<?php esc_html_e('Tax','apartment_mgt');?>" readonly>
									</div>					
									<div class="col-sm-1">
										<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
										<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
										</button>
									</div>
								</div>
							</div>
						<?php	
						}	
					}
				}
				?>
			</div>				
			<?php 			
		}
		else
		{ ?>
			<div id="charges_entry1"><!--CHARGES ENTRY-->
				<div class="form-group">
					<div class="mb-3 row">	
						<input type="hidden" id="increament_val" name="increament_val" value="1">
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Tax','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-4">
							<select name="tax_title[]" id="1" class="form-select valid tax_selection">
								<option value=""><?php esc_html_e('Select Tax','apartment_mgt');?></option>
								<?php 
									$obj_tax =new MJ_amgt_Tax;
									$tax_data= $obj_tax->Amgt_get_all_tax();
									 if(!empty($tax_data))
									 {
										foreach ($tax_data as $retrieved_data)
										{ ?>
											<option value="<?php echo esc_attr($retrieved_data->id);?>"><?php echo esc_html($retrieved_data->tax_title);?></option>
										<?php
										}
									}	
									?>
							</select>
						</div>
						<div class="col-sm-2 margin_bottom_10_res">
							<input id="tax_entry_1" class="form-control validate[required] text-input" type="text" value="" name="tax_entry[]" placeholder="<?php esc_html_e('Tax','apartment_mgt');?>" readonly>
						</div>							
						<div class="col-sm-1">
							<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
							<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
							</button>
						</div>
					</div>
				</div>	
			</div>
		<?php 
		} 
		?>		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="expense_entry"></label>
				<div class="col-sm-3">
					<button id="add_new_entry1" class="btn btn-default btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_entry1()"><?php esc_html_e('Add More Tax','apartment_mgt'); ?>
					</button>
				</div>
			</div>
		</div>
		<?php
		if($edit)
		{
			if($select_charge_cal=='fix_charge')
			{
			?>	
				<div class="form-group measurement_hide_div">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="taxamount">
						<?php esc_html_e('Tax Amount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
						<div class="col-sm-8">
							<input id="taxamount" value="<?php if($edit){ echo esc_attr($result->tax_amount);}elseif(isset($_POST['tax_amount'])) echo esc_attr($_POST['tax_amount']);?>" class="form-control validate" type="text"  
							 name="tax_amount">
						</div>					
					</div>					
				</div>		
				<div class="form-group measurement_hide_div">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="taxamount">
						<?php esc_html_e('Total Amount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
						<div class="col-sm-8">
							<input id="totalamount"  class="form-control validate" type="text"
							value="<?php if($edit){ echo esc_attr($result->total_amount); }elseif(isset($_POST['total_amount'])) echo esc_attr($_POST['total_amount']);?>"				
							 name="total_amount">
						</div>					
					</div>					
				</div>
			<?php
			}
		}
		else
		{
		?>
			<div class="form-group measurement_hide_div">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="taxamount">
					<?php esc_html_e('Tax Amount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
					<div class="col-sm-8">
						<input id="taxamount" value="<?php if($edit){ echo esc_attr($result->tax_amount);}elseif(isset($_POST['tax_amount'])) echo esc_attr($_POST['tax_amount']);?>" class="form-control validate" type="text"  
						 name="tax_amount">
					</div>			
				</div>			
			</div>		
			<div class="form-group measurement_hide_div">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="taxamount">
					<?php esc_html_e('Total Amount','apartment_mgt');?> (<?php echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ));?>)<span class="require-field">*</span></label>
					<div class="col-sm-8">
						<input id="totalamount"  class="form-control validate" type="text"
						value="<?php if($edit){ echo esc_attr($result->total_amount); }elseif(isset($_POST['total_amount'])) echo esc_attr($_POST['total_amount']);?>"				
						 name="total_amount">
					</div>			
				</div>			
			</div>
		<?php
		}	
		?>
		<hr>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?></label>
				<div class="col-sm-8">
					 <textarea name="description" maxlength="150" class="form-control text-input"><?php if($edit) echo esc_html($result->description);?></textarea>
				</div>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="offset-sm-2 w-auto margin_top_5 margin_bottom_10_res">
				<input type="submit" value="<?php  esc_html_e('Save Charges','apartment_mgt'); ?>" name="add_charges_all_member" class="btn btn-success "/>
			</div>
			<?php wp_nonce_field('add_charges_all_member_with_create_invoice_nonce'); ?>
			<div class="col-sm-2 margin_top_5">
				<input type="submit" value="<?php if($edit){ esc_html_e('Save Charges & Update Invoice','apartment_mgt'); }else{ esc_html_e('Save Charges & Create Invoice','apartment_mgt');}?>" name="add_charges_all_member_with_create_invoice" class="btn btn-success"/>
			</div>
		</div>	
    </form>
</div>
<script> 
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n)
	{
		if(confirm(language_translate.add_remove))
		{
			n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
		}	
   	}
</script>
<script>
	// CREATING BLANK INVOICE ENTRY
   	var blank_custom_label ='';   					
   	function add_entry1()
   	{
		var increament_val = $('#increament_val').val();
		var charge_cal = $("input[name='charge_cal']:checked").val();		
		if(charge_cal=='fix_charge')
		{
			increamentval= parseInt(increament_val) + 1;
			$('#increament_val').val(increamentval);
			blank_custom_label='<div class="form-group">';
			blank_custom_label='<div class="mb-3 row">';
			blank_custom_label+='<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Tax','apartment_mgt');?><span class="require-field">*</span></label>';
			blank_custom_label+='<div class="col-sm-4">';
			blank_custom_label+='<select name="tax_title[]" id="'+increamentval+'" class="form-select valid tax_selection">';
			blank_custom_label+='<option value=""><?php esc_html_e('Select Tax','apartment_mgt');?></option>';
			<?php $obj_tax =new MJ_amgt_Tax;
						$tax_data= $obj_tax->Amgt_get_all_tax();
							 if(!empty($tax_data))
							 {
								foreach ($tax_data as $retrieved_data){ ?>
			blank_custom_label+='<option value="<?php echo $retrieved_data->id;?>"><?php echo $retrieved_data->tax_title;?></option>';
								<?php }
							 } ?>
			blank_custom_label+='</select>';
			blank_custom_label+='</div>';
			blank_custom_label+='<div class="col-sm-2 margin_bottom_10_res">';
			blank_custom_label+='<input id="tax_entry_'+increamentval+'" class="form-control validate[required] text-input" type="text" value="" name="tax_entry[]" placeholder="<?php esc_html_e('Tax','apartment_mgt');?>" readonly>';
			blank_custom_label+='</div>';					
			blank_custom_label+='<div class="col-sm-1">';
			blank_custom_label+='<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">';
			blank_custom_label+='<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>';
			blank_custom_label+='</button>';
			blank_custom_label+='</div>';
			blank_custom_label+='</div>';
			blank_custom_label+='</div>';
		}
		else if(charge_cal=='measurement_charge')
		{
			
			var increamentval= parseInt(increament_val) + 1;
			$('#increament_val').val(increamentval);
			blank_custom_label='<div class="form-group">';
			blank_custom_label='<div class="mb-3 row">';
			blank_custom_label+='<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="income_entry"><?php esc_html_e('Tax','apartment_mgt');?><span class="require-field">*</span></label>';
			blank_custom_label+='<div class="col-sm-4">';
			blank_custom_label+='<select name="tax_title[]" id="'+increamentval+'" class="form-select valid tax_selection">';
			blank_custom_label+='<option value=""><?php esc_html_e('Select Tax','apartment_mgt');?></option>';
			<?php $obj_tax =new MJ_amgt_Tax;
						$tax_data= $obj_tax->Amgt_get_all_tax();
							 if(!empty($tax_data))
							 {
								foreach ($tax_data as $retrieved_data){ ?>
			blank_custom_label+='<option value="<?php echo $retrieved_data->id;?>"><?php echo $retrieved_data->tax_title;?></option>';
								<?php }
							 } ?>
			blank_custom_label+='</select>';
			blank_custom_label+='</div>';
			blank_custom_label+='<div class="col-sm-2">';
			blank_custom_label+='<input id="tax_entry_'+increamentval+'" class="form-control validate[required] text-input" type="text" value="" name="tax_entry[]" placeholder="<?php esc_html_e('Tax','apartment_mgt');?>" readonly>';
			blank_custom_label+='</div>';	
			blank_custom_label+='<div class="col-sm-2">';
			blank_custom_label+='<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">';
			blank_custom_label+='<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>';
			blank_custom_label+='</button>';
			blank_custom_label+='</div>';
			blank_custom_label+='</div>';
			blank_custom_label+='</div>';
		}
   		$("#charges_entry1").append(blank_custom_label);   		
   	}   	
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n)
	{
		//if(confirm("Are you sure want to delete this record?"))
		if(confirm(language_translate.add_remove))
		{
			n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
		}	
   	}
</script>