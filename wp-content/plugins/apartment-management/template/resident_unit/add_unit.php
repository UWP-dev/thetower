<script type="text/javascript">
$(document).ready(function()
{   //UNIT FORM VALIDATIONENGINE
	"use strict";
	<?php
	if (is_rtl())
		{
		?>	
			$('#unit_form_admin_side').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#unit_form_admin_side').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
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
  //ADD UNIT TAB
  if($active_tab == 'addunit')
    {
		$unit_id=0;
		if(isset($_REQUEST['unit_id']))
			$unit_id=$_REQUEST['unit_id'];
		$edit=0;
			if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
			  {
				$edit=1;
				$result = $obj_units->MJ_amgt_get_single_unit($unit_id);
			  } ?>
		<div class="panel-body"><!--- PANEL BODY  DIV START  ---->
			<form name="unit_form" action="" method="post" class="form-horizontal" id="unit_form_admin_side"><!---UNIT FORM---->
				<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="unit_id" value="<?php echo esc_attr($unit_id);?>"  />
				<?php  if(isset($_REQUEST['index']))
				{
				?>
				<input type="hidden" name="unit_index" value="<?php echo $_REQUEST['index']; ?>"  />
				<?php } ?>
				<!---BUILDING DETAIL---->
				<div class="form-group">
					<div class="mb-3 row">
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
						<?php
						if($edit)
						{
							$building = get_post($result->building_id);
						?>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">					
								<input class="form-control text-input" type="hidden" value="<?php echo esc_attr($result->building_id); ?>" name="building_id">
								<input class="form-control text-input" type="text" value="<?php echo esc_attr($building->post_title); ?>" name="" readonly>
							</div>	
						<?php
						}
						else
						{		
						?>	
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select class="form-select validate[required] building_category" name="building_id" <?php if($edit){ echo'readonly'; } ?>>
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
							<div class="col-sm-2">
								<button class="btn btn-default" id="addremove_new" model="building_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button>
							</div>				
						<?php
						}
						?>
					</div>	
				</div><!---BUILDING DETAIL END---->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
						<?php
						if($edit)
						{
							$unit_cat=get_post($result->unit_cat_id);
						?>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">					
								<input class="form-control text-input" type="hidden" value="<?php echo esc_attr($result->unit_cat_id); ?>" name="unit_cat_id">
								<input class="form-control text-input" type="text" value="<?php echo esc_attr($unit_cat->post_title); ?>" name="" readonly>
							</div>	
						<?php
						}
						else
						{		
						?>	
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select validate[required] unit_category" name="unit_cat_id" <?php if($edit){ echo'readonly'; } ?>>
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
							<div class="col-sm-2"><button class="btn btn-default" id="addremove_new" model="unit_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
							<?php
							}
							?>
					</div>	
				</div>
				<?php if($edit)
				{					
				    $all_entry=json_decode($result->units);
				}
				else
				{
					if(isset($_POST['unit_names'])){
						
						$all_data=$obj_units->MJ_amgt_get_entry_records($_POST);
						$all_entry=json_decode($all_data);
					}
				}
				if(!empty($all_entry))
					{					
					foreach($all_entry as $entry)
					{
						$entry_obj=array($entry);
						$entry_array=$entry_obj[0];
						$unit_name=$_REQUEST['unit_name'];
						$uname=$entry->entry;
						if($unit_name==$uname)
						{	
						?>
						<div id="unit_name_entry">
							<div class="form-group">
								<div class="mb-3 row">	
									<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"><?php esc_html_e('Unit Name','apartment_mgt');?><span class="require-field">*</span></label>
								
									<div class="col-sm-2">
										<input class="form-control onlyletter_number_space_validation text-input  unit_name" type="text" value="<?php echo esc_attr($entry->entry);?>" name="unit_names[]" placeholder="<?php esc_html_e('Unit Name','apartment_mgt');?>" readonly>
									</div>
									<?php $unit_measerment_type=get_option( 'amgt_unit_measerment_type' );?>
									
									 <label class="col-sm-2 control-label margin_top_10_res margin_top_8 margin_bottom_10_res" for="unit_entry"><?php esc_html_e('Unit Size','apartment_mgt');?>(<?php 
									 if($unit_measerment_type =='square_meter')
									{
										echo esc_html_e('square meter','apartment_mgt');
									}
									else
									{
										echo esc_attr($unit_measerment_type);
									}
										
										?>)</label>  
									<div class="col-sm-2 margin_bottom_10_res">
										<input  class="form-control text-input" type="number" value="<?php echo esc_attr($entry->measurement); ?>" onKeyPress="if(this.value.length==6) return false;"  min="0" name="unit_size[]" placeholder="<?php esc_html_e('Unit Size','apartment_mgt');?>">
									</div>
								</div>
							
							</div>	
						</div>
					
						  <?php 
						}
					}
				}
				else
				{ ?>				
					<div id="unit_name_entry"><!---UNIT NAME ENTRY---->
						<div class="form-group my_unit_div">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"><?php esc_html_e('Unit Name','apartment_mgt');?><span class="require-field">*</span></label>
							
								<div class="col-sm-2">
								<input class="onlyletter_number_space_validation form-control validate[required] text-input unit_name" type="text" value="" maxlength="30" name="unit_names[]" placeholder="<?php esc_html_e('Unit Name','apartment_mgt');?>" >
								</div>	
								<?php $unit_measerment_type=get_option( 'amgt_unit_measerment_type' );?>						
								<label class="col-sm-2 control-label margin_top_10_res margin_top_8 margin_bottom_10_res" for="unit_entry"><?php esc_html_e('Unit Size','apartment_mgt');?>(<?php if($unit_measerment_type =='square_meter'){
									echo esc_html_e('square meter','apartment_mgt');
									}
									else{
										echo esc_attr($unit_measerment_type);
									}
									
									?>)</label>
								<div class="col-sm-2 margin_bottom_10_res">
									<input  class="form-control text-input" type="number" value="" min="0" name="unit_size[]" onKeyPress="if(this.value.length==6) return false;" placeholder="<?php esc_html_e('Unit Size','apartment_mgt');?>" >
								</div>
								<div class="col-sm-2">
								<button type="button" class="btn btn-danger delete_btn" onclick="deleteParentElement(this)">
								<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
								</button>
								</div>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"></label>
							<div class="col-sm-3">
								
								<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_entry()"><?php esc_html_e('Add More Unit','apartment_mgt'); ?>
								</button>
							</div>
						</div>
					</div>
					<?php 
				} ?>
					<hr>
					<?php wp_nonce_field( 'save_residential_unit_nonce' ); ?>					
					<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<?php $unit_type=get_option( 'amgt_apartment_type' ); ?>
						<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add '.$unit_type.' Unit','apartment_mgt');}?>" name="save_residential_unit" class="btn btn-success"/>
					</div>
			</form><!---END UNIT FORM---->
        </div><!--- END PANEL DIV   ---->
     <?php 
    }
	?>
<script>
	// CREATING BLANK INVOICE ENTRY
   	var blank_income_entry ='';
   	$(document).ready(function() { 
   		blank_expense_entry = $('#unit_name_entry').html();
   	}); 

   	function add_entry()
   	{
		alert("hello");
   		$("#unit_name_entry").append(blank_expense_entry);
   	}
   	
   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n)
	{

		if(confirm(language_translate.add_remove))
		{
			n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
		}	
   	}
</script>