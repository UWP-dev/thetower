<?php ?>
<script type="text/javascript">
function fileCheck(obj)
{    //FILE PDF VALIDATION
	"use strict";
	var fileExtension = ['pdf','doc','jpg','jpeg','png'];
	if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
	{
		alert("<?php esc_html_e('Sorry, only JPG, pdf, docs., JPEG, PNG And GIF files are allowed.','apartment_mgt');?>");
		$(obj).val('');
	}	
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	//SLOT VALIDATIONENGINE
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
		 var start = new Date();
		var end = new Date(new Date().setYear(start.getFullYear()+1));
		$(".datepicker1").datepicker({
       dateFormat: "yy-mm-dd",
		minDate:0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 0);
            $(".datepicker2").datepicker("option", "minDate", dt);
        }
	    });
	    $(".datepicker2").datepicker({
	      dateFormat: "yy-mm-dd",
	        onSelect: function (selected) {
	            var dt = new Date(selected);
	            dt.setDate(dt.getDate() - 0);
	            $(".datepicker1").datepicker("option", "maxDate", dt);
	        }
	    });	

//------ADD MEMBER AJAX----------
	 $('#member_form').on('submit', function(e) {
		"use strict";
		e.preventDefault();
		
		var form = $(this).serialize();
		
		var valid = $('#member_form').validationEngine('validate');
		if (valid == true)
		{
		$.ajax({
			type:"POST",
			url: $(this).attr('action'),
			data:form,
			success: function(data){
								
				if(data!="")
				{ 
				  $('#member_form').trigger("reset");
				  $('#member_id').append(data);
				//   $('#staff_member_id').append(data);
				  $('.upload_user_avatar_preview').html('<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">');
				  $('.amgt_user_avatar_url').val('');
				  $('.unnit_measurement').val('');	
		           $('.unnit_chanrges').val('');
				  $('.modal').modal('hide');
				  
				}
				
			},
			error: function(data){

			}
		})
	}
	});

   //ADD_BULDING_FORM AJAX
	$('#unit_form').on('submit', function(e)
	{
		"use strict";
		e.preventDefault();
		var form = $(this).serialize(); 
		var valid = $('#unit_form').validationEngine('validate');
		if (valid == true)
		{
			$.ajax({
				type:"POST",
				url: $(this).attr('action'),
				data:form,
				success: function(data)
				{
					 if(data!="")
					 { 
						$('#unit_form').trigger("reset");
						$('.modal').modal('hide');
					 } 
				},
				error: function(data){
				}
			
		    })
		}
	});
//USERNAME NOT  ALLOW SPACE VALIDATION
	$('#username').keypress(function( e ) {
		"use strict";
       if(e.which === 32) 
         return false;
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
   $('.remove_unused_model').on('click', function(e)
	{
		$(".modal-backdrop").addClass("background_color_black");
	});	

} );

</script>

<!-- POP UP CODE -->
<div class="popup-bg z_index_100000">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"> </div>
		</div>
    </div>    
</div>
<!-- END POP-UP CODE -->
<?php
// ASSIGN SLOAT	TAB
if($active_tab == 'assign_sloat')
	 {
		$sloat_assign_id=0;
		if(isset($_REQUEST['sloat_assign_id']))
			$sloat_assign_id=$_REQUEST['sloat_assign_id'];
		$edit=0;
			if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
			{
				$edit=1;
				$result = $obj_parking->MJ_amgt_get_single_assigned_sloat($sloat_assign_id);
			} 
		
			?>
		
		<div class="panel-body"><!------PANEL BODY------->	
	        <!------ADD SLOT FORM------->		
			<form name="sloat_form" action="" method="post" class="form-horizontal" id="sloat_form">
				 <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="sloat_assign_id" value="<?php echo esc_attr($sloat_assign_id);?>"  />
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="sloat"><?php esc_html_e('Slot','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form_sloat_select form-select validate[required]" name="sloat_id" id="slaot_name">
							<option value="" class="slot-value"><?php esc_html_e('Select Slot','apartment_mgt');?></option>
							<?php 
							if($edit)
								 $sloatid =$result->sloat_id;
							elseif(isset($_POST['sloat_id']))
								$sloatid =$_POST['sloat_id'];
							else
								$sloatid ="";
							
							$sloatdata=$obj_parking->MJ_amgt_get_all_sloats();
							 if(!empty($sloatdata))
							 {
								foreach ($sloatdata as $sloat)
									{ ?>
										<option value="<?php echo esc_attr($sloat->id); ?>" <?php selected($sloatid,$sloat->id);?>><?php echo esc_html($sloat->sloat_name);?> </option>
									<?php }
								}
							 ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vehicle"><?php esc_html_e('Vehicle Number','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input type="text" maxlength="20" value="<?php  if($edit){ echo esc_attr($result->vehicle_number); } elseif(isset($_POST['vehicle_number'])){ echo esc_attr($_POST['vehicle_number']); }?>" class="form-control validate[required,custom[address_description_validation]] text-input" name="vehicle_number"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="model"><?php esc_html_e('Vehicle Model','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input type="text" value="<?php  if($edit){ echo esc_attr($result->vehicle_model); } elseif(isset($_POST['vehicle_model'])){ echo esc_attr($_POST['vehicle_model']); }?>" class="form-control text-input onlyletter_number_space_validation" maxlength="30" name="vehicle_model"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="RFID"><?php esc_html_e('RFID','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input type="text" value="<?php  if($edit){ echo esc_attr($result->RFID); } elseif(isset($_POST['RFID'])){ echo esc_attr($_POST['RFID']); }?>" class="form-control text-input onlyletter_number_space_validation" maxlength="50" name="RFID"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vehicle_type"><?php esc_html_e('Vehicle Type','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $vehicletype = "2"; if($edit){ $vehicletype=$result->vehicle_type; }elseif(isset($_POST['sloat_type'])) {$vehicletype=$_POST['vehicle_type'];}?>
							<label class="radio-inline">
							 <input type="radio" value="2" class="tog validate[required]" name="vehicle_type"  <?php  checked( '2', $vehicletype);  ?>/><?php esc_html_e('Two Wheeler','apartment_mgt');?>
							</label>
							<label class="radio-inline">
							  <input type="radio" value="4" class="tog validate[required]" name="vehicle_type"  <?php  checked( '4', $vehicletype);  ?>/><?php esc_html_e('Four Wheeler','apartment_mgt');?> 
							</label>
						</div>
					</div>
				</div>
         <?php
		 if($edit)
		 { 
			global $wpdb;
			$table_name = $wpdb->prefix. 'amgt_sloats';
			$slot_result = $wpdb->get_row("select * from $table_name where id=".$sloatid);
			$sloat_type = $slot_result->sloat_type;
            
			      if($sloat_type == 'member')
					{
						$member_list="display:block;";
						$staff_member_list = "display: none;";
					}
					else if($sloat_type == 'Staff')
					{
						$member_list="display:none;";
						$staff_member_list = "display: block;";
					}
					
		 }
		 else
		 {
			 $member_list="display:block;";
			 $staff_member_list="display:none;";
		 }         
			 ?>
	        <div class="member-list member_part" style="<?php echo $member_list;?>">	
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
						<div class="col-sm-2">
						   <button type="button" id="add_bulding" class="btn btn-default remove_unused_model" data-bs-toggle="modal" data-bs-target="#myModal_add_building"> <?php esc_html_e('Add Building','apartment_mgt');?></button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Unit','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select validate[required] unit_name" name="unit_name" id="">
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
							}	
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"  for="member"><?php esc_html_e('Member','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select validate[required] member_id" id="member_id" name="member_id">
							<option value=""><?php esc_html_e('Select Member','apartment_mgt');?></option>
								<?php if($edit)
								{
									$memberid =$result->member_id;
									$unitname =$result->unit_name;
									$category =$result->unit_cat_id;
									$building =$result->building_id;
									
								  $user_query = new WP_User_Query(
									 array(
									'meta_key'	  =>	'unit_name',
									'meta_value'	=>	$unitname
									 ),
									array( 'meta_key'	  =>	'building_id',
									'meta_value'	=>	$building ),
									array( 'meta_key'	  =>	'unit_cat_id',
									'meta_value'	=>	$category )
										 ); 
									  $allmembers = $user_query->get_results();
									  
									   foreach($allmembers as $allmembers_data)
									  {
										 echo '<option value="'.$allmembers_data->ID.'" '.selected($memberid,$allmembers_data->ID).'>'.$allmembers_data->display_name.'</option>';
									  }
								}
								 ?>
							</select>
						</div>

						<div class="col-sm-2">
						  <button type="button" class="btn btn-default remove_unused_model" data-bs-toggle="modal" data-bs-target="#myModal_add_member"> <?php esc_html_e('Add Member','apartment_mgt');?></button>
					   </div>
					</div>				
				</div>		
				<style>
					.dropdown-menu {
						min-width: 240px;
					}
                </style>
			</div>
		    <!-- staff member list div -->
			<div class="staff-member-list" style="<?php echo $staff_member_list; ?>">
			   <div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"  for="member"><?php esc_html_e('Staff Member','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<?php
							$users = get_users( [ 'role__in' => [ 'gatekeeper', 'accountant', 'staff_member' ] ] );
							$memberid ='0';
							?>
							<select class="form-select validate[required] member_id" id="staff_member_id" name="staff_member_id">
							<option value=""><?php esc_html_e('Select Staff Member','apartment_mgt'); ?></option>
							<?php
							foreach($users as $displayname)
							{
							   echo '<option value="'.$displayname->ID.'" '.selected($memberid,$displayname->ID).'>'.$displayname->display_name.'</option>';
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
			</div>
            <!-- end staff member div -->
			
			<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="from_date"><?php esc_html_e('From Date','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="from_date" class="form-control validate[required] datepicker1" autocomplete="off" type="text"  name="from_date" 
							value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->from_date)));}elseif(isset($_POST['from_date'])) echo esc_attr($_POST['from_date']); else echo date("Y-m-d");?>">
						 </div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="to_date"><?php esc_html_e('To Date','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="to_date" class="form-control validate[required] datepicker2" autocomplete="off" type="text"  name="to_date" 
							value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->to_date)));}elseif(isset($_POST['to_date'])) echo esc_attr($_POST['to_date']); else echo date("Y-m-d");?>">
						 </div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							 <textarea name="description" maxlength="150" class="form-control validate[custom[address_description_validation]] text-input"><?php if($edit){ echo esc_textarea($result->description); }elseif(isset($_POST['description'])) echo esc_textarea($_POST['description']);?></textarea>
						</div>
					</div>
				</div>
				<?php wp_nonce_field( 'assign_sloat_nonce' ); ?>
				<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Assign Slot','apartment_mgt');}?>" name="assign_sloat" class="btn btn-success"/>
				</div>
		
			</form><!------END ADD SLOT FORM------->	
        </div><!------END PANEL BODY------->	
        
<?php  } ?>
<!----------ADD_MEMBER_FORM---------------------->
<script type="text/javascript">
$(document).ready(function() {
	 //MEMBER FORM VALIDATIONENGINE
	 "use strict";
	$('#member_form').validationEngine();
    jQuery('.birth_date').datepicker({
			dateFormat: "yy-mm-dd",
			maxDate : 0,
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
	$('#occupied_date').datepicker({	
	dateFormat: "yy-mm-dd",  
	  autoclose: true
	}); 
	}); 
</script>	
<div class="modal fade" id="myModal_add_member" tabindex="-1" aria-labelledby="myModal_add_member" role="dialog" aria-modal="true"><!---MYMODAL_ADD_MEMBER--->
    <div class="modal-dialog modal-lg">
      <div class="modal-content"><!---MODAL CONTENT--->
        <div class="modal-header"><!---MODAL HEADER--->
          <h3 class="modal-title"><?php esc_html_e('Add Member','apartment_mgt');?></h3>
		   <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"><!---MODEL BODY--->
         <?php $role='member';?>
		 <!--ADD_MEMBER FORM--->
		<form name="member_form" action="<?php echo admin_url('admin-ajax.php'); ?>"  method="post" class="form-horizontal" id="member_form" enctype="multipart/form-data">
	    <input type="hidden" name="action" value="MJ_amgt_add_member_popup">
		<input type="hidden" name="role" value="<?php echo esc_attr($role);?>"  />	
		<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<select class="form-select validate[required] popup_member_building_category" name="building_id" >
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
						<button type="button" id="add_bulding" class="btn btn-default remove_unused_model" data-bs-toggle="modal" data-bs-target="#myModal_add_building"> <?php esc_html_e('Add Building','apartment_mgt');?></button>					
					</div>
				</div>
		</div>		
		<div id="hello"></div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">			
					<select class="form-select validate[required] popup_member_unit_category" name="unit_cat_id" >
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
		
		<div class="form-group"><!---UNIT--->
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Unit','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required] popup_member_unit_name" name="unit_name" >
					<option value=""><?php esc_html_e('Select Unit Name','apartment_mgt');?></option>
					<?php 
					if($edit)
					{
						$unitname =$result->unit_name;
						$building_id=$result->building_id;
						$unit_category=$result->unit_cat_id;
						$unitsarray=$obj_units->MJ_amgt_get_single_cat_units($building_id,$unit_category);
						$all_entry=json_decode($unitsarray);
						
						$i=0;
						
						foreach ($all_entry as $key => $value) 
						{
							$unit_value[] = $value;
							
						}
						
						if(!empty($unit_value))
						{
							foreach ($all_entry as $key1 => $value1) 
							{?>
								<option value="<?php echo esc_attr($value1->value); ?>" <?php selected($unitname,$value1->value);?>><?php echo esc_html($value1->value);?> </option>
							<?php }
						}					
					} ?>
					</select>
				</div>			
			</div>			
		</div>
		<!---GENERAL INFORMATION--->
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="first_name"><?php esc_html_e('First Name','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="first_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text" value="<?php if($edit){ echo esc_attr($result->first_name);}elseif(isset($_POST['first_name'])) echo esc_attr($_POST['first_name']);?>" name="first_name">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">
			<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="middle_name"><?php esc_html_e('Middle Name','apartment_mgt');?></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="middle_name" class="form-control validate[custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->middle_name);}elseif(isset($_POST['middle_name'])) echo esc_attr($_POST['middle_name']);?>" name="middle_name">
				</div>
				</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="last_name"><?php esc_html_e('Last Name','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="last_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->last_name);}elseif(isset($_POST['last_name'])) echo esc_attr($_POST['last_name']);?>" name="last_name">
				</div>
				</div>
		</div>
<!-- 		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="gender"><?php //esc_html_e('Gender','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<?php// $genderval = "male"; if($edit){ $genderval=$result->gender; }elseif(isset($_POST['gender'])) {$genderval=$_POST['gender'];}?>
					<label class="radio-inline">
					 <input type="radio" value="male" class="tog validate[required]" name="gender"  <?php // checked( 'male', $genderval);  ?>/><?php //esc_html_e('Male','apartment_mgt');?>
					</label>
					<label class="radio-inline">
					  <input type="radio" value="female" class="tog validate[required]" name="gender"  <?php // checked( 'female', $genderval);  ?>/><?php// esc_html_e('Female','apartment_mgt');?> 
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="birth_date"><?php// esc_html_e('Date of birth','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="birth_date" class="form-control validate[required] birth_date" type="text" autocomplete="off" name="birth_date" 
					value="<?php //if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->birth_date)));}elseif(isset($_POST['birth_date'])) echo esc_attr($_POST['birth_date']);?>">
				</div>
			</div>
		</div> -->
		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Member Type','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required]" name="member_type" id="member_type">
					<option value=""><?php esc_html_e('Select Member Type','apartment_mgt');?></option>
					<?php 
					if($edit)
						$category =$result->member_type;
					elseif(isset($_POST['member_type']))
						$category =$_POST['member_type'];
					else
						$category ="";?>
					<option value="Owner" <?php selected($category,'Owner');?>><?php esc_html_e('Owner','apartment_mgt');?></option>
					<option value="tenant" <?php selected($category,'tenant');?>><?php esc_html_e('Tenant','apartment_mgt');?></option>
					<option value="owner_family" <?php selected($category,'owner_family');?>><?php esc_html_e('Owner Family','apartment_mgt');?></option>
					<option value="tenant_family" <?php selected($category,'tenant_family');?>><?php esc_html_e('Tenant Family','apartment_mgt');?></option>
					<option value="care_taker" <?php selected($category,'care_taker');?>><?php esc_html_e('Care Taker','apartment_mgt');?></option>
					</select>
				</div>
			</div>
		</div>
		<!--END GENERAL INFORMATION------>
		<?php
		if($edit)		 
		{
			if(!empty($result->occupied_by))
			{
			?>
				<div class="occupied_div_edit">
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Occupied By','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select validate[required] allready_occupied" name="occupied_by">
							<option value=""><?php esc_html_e('Select Occupied By','apartment_mgt');?></option>
							<?php 
							if($edit)
								$occupied_by =$result->occupied_by;
							elseif(isset($_POST['occupied_by']))
								$occupied_by =$_POST['occupied_by'];
							else
								$occupied_by ="";?>
							<option value="Owner" <?php selected($occupied_by,'Owner');?>><?php esc_html_e('Owner','apartment_mgt');?></option>
							<option value="tenant" <?php selected($occupied_by,'tenant');?>><?php esc_html_e('Tenant','apartment_mgt');?></option>			
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" ><?php esc_html_e('Occupied Date','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="occupied_date" class="form-control" type="text" autocomplete="off" name="occupied_date" 
							value="<?php if($edit){ echo date("Y-m-d",strtotime($result->occupied_date));}elseif(isset($_POST['occupied_date'])) echo esc_attr($_POST['occupied_date']);?>">
						</div>
					</div>
				</div>
				</div>
			<?php
			}
			else
			{	
			?>
			<div class="occupied_div">
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Occupied By','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<select class="form-select validate[required] allready_occupied" name="occupied_by">
						<option value=""><?php esc_html_e('Select Occupied By','apartment_mgt');?></option>
						
						<option value="Owner"><?php esc_html_e('Owner','apartment_mgt');?></option>
						<option value="tenant"><?php esc_html_e('Tenant','apartment_mgt');?></option>			
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" ><?php esc_html_e('Occupied Date','apartment_mgt');?></label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input id="occupied_date" class="form-control" type="text"  name="occupied_date" 
						value="">
					</div>
				</div>
			</div>
			</div>
			<?php
			}						
		}
		else
		{	
		?>
		<div class="occupied_div">
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Occupied By','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required] allready_occupied" name="occupied_by">
					<option value=""><?php esc_html_e('Select Occupied By','apartment_mgt');?></option>
					<?php 
					if($edit)
						$occupied_by =$result->occupied_by;
					elseif(isset($_POST['occupied_by']))
						$occupied_by =$_POST['occupied_by'];
					else
						$occupied_by ="";?>
					<option value="Owner" <?php selected($occupied_by,'Owner');?>><?php esc_html_e('Owner','apartment_mgt');?></option>
					<option value="tenant" <?php selected($occupied_by,'tenant');?>><?php esc_html_e('Tenant','apartment_mgt');?></option>			
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" ><?php esc_html_e('Occupied Date','apartment_mgt');?></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="occupied_date" class="form-control" type="text"  autocomplete="off" name="occupied_date" 
					value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->occupied_date)));}elseif(isset($_POST['occupied_date'])) echo esc_attr($_POST['occupied_date']);?>">
				</div>
			</div>
		</div>
		</div>
		<?php
		}
		?>
		<div class="form-group"><!---COMMITEE MEMBER--->
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label " for="committee_member"><?php esc_html_e('Commitee Member','apartment_mgt');?></label>
				<div class="col-sm-1">
					<div class="col-sm-1">
					<input id="committee_member" class="margin_top_20px form-control text-input" type="checkbox" <?php if($edit==1 && $result->committee_member=='yes'){ echo "checked";}?> name="committee_member" 
					value="yes"></div>	
				</div>	
				<?php if($edit==1 && $result->committee_member=='yes'){ ?>
				<div class="col-sm-9 d-flex" id="designaion_area">
					<div class="col-sm-6">
					<select class="form-select validate[required] designation_cat" name="designation_id">
					<option value=""><?php esc_html_e('Select Designation','apartment_mgt');?></option>
					<?php 
					if($edit)
						$category =$result->designation_id;
					else 
						$category = "";
					
					$activity_category=MJ_amgt_get_all_category('designation_cat');
					if(!empty($activity_category))
					{
						foreach ($activity_category as $retrive_data)
						{
							echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
						}
					} ?>
					</select>
				</div>
				<div class="col-sm-3"><button class="btn btn-default" id="addremove" model="designation_cat"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
				</div>
				<?php }
					else
					{?>
						<div class="col-sm-9 d-flex" id="designaion_area">
						</div>
					<?php }	?>
			</div>
		</div>		
		<!-- <div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="address"><?php// esc_html_e('Correspondence Address','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="address" class="form-control validate[required]" maxlength="150" type="text"  name="address" 
					value="<?php// if($edit){ echo esc_attr($result->address);}elseif(isset($_POST['address'])) echo esc_attr($_POST['address']);?>">
				</div>
			</div>
		</div> -->
					<!-- <div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="city_name"><?php// esc_html_e('City','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input id="city_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  name="city_name" 
								value="<?php //if($edit){ echo esc_attr($result->city_name);}elseif(isset($_POST['city_name'])) echo $_POST['city_name'];?>">
							</div>
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php //esc_html_e('State','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetter_specialcharacter]]" type="text" maxlength="50" name="state_name" 
								value="<?php// if($edit){ echo esc_attr($result->state_name);}elseif(isset($_POST['state_name'])) echo $_POST['state_name'];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php //esc_html_e('Country','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetter_specialcharacter]]" type="text" maxlength="50" name="country_name" 
								value="<?php //if($edit){ echo esc_attr($result->country_name);}elseif(isset($_POST['country_name'])) echo $_POST['country_name'];?>">
							</div>
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php// esc_html_e('Zip Code','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetterNumber]]" maxlength="10" type="text"  name="zipcode" 
								value="<?php //if($edit){ echo esc_attr($result->zipcode);}elseif(isset($_POST['zipcode'])) echo $_POST['zipcode'];?>">
							</div>
						</div>
					</div> -->
		<!--LOGIN CONTACT------>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="email"><?php esc_html_e('Email','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="email" class="form-control validate[required,custom[email]] text-input" maxlength="50" type="text"  name="email" 
					value="<?php if($edit){ echo esc_attr($result->user_email);}elseif(isset($_POST['email'])) echo esc_attr($_POST['email']);?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="mobile"><?php esc_html_e('Mobile Number','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-1 margin_bottom_10_res">
				
				<input type="text" readonly value="+<?php echo MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' ));?>"  class="form-control" name="phonecode">
				</div>
				<div class="col-sm-7">
					<input id="mobile" class="form-control validate[required,custom[phone]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;"  name="mobile" value="<?php if($edit){ echo esc_attr($result->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
				</div>
			</div>
		</div>
		<!--LOGIN INFORMATION------>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="username"><?php esc_html_e('User Name','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="username" class="form-control validate[required]" type="text" maxlength="30"  name="username" 
					value="<?php if($edit){ echo esc_attr($result->user_login);}elseif(isset($_POST['username'])) echo esc_attr($_POST['username']);?>" <?php if($edit) echo "readonly";?>>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="password"><?php esc_html_e('Password','apartment_mgt');?><?php if(!$edit) {?><span class="require-field">*</span><?php }?></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="password" class="form-control <?php if(!$edit) echo 'validate[required]';?>" type="password"  name="password" minlength="8" maxlength="12" value="">
				</div>
			</div>
		</div>	 
        <!--END LOGIN INFORMATION------>		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Member Image','apartment_mgt');?></label>
				<div class="col-sm-2 margin_bottom_10_res">
					<input type="text" id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
					value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['amgt_user_avatar'])) echo $_POST['amgt_user_avatar']; ?>" />
				</div>	
					<div class="col-sm-3">
						 <input id="upload_user_avatar_button" type="button" class="button" value="<?php esc_html_e('Upload image', 'apartment_mgt' ); ?>" />
						 <span class="description"><?php esc_html_e('Upload image', 'apartment_mgt' ); ?></span>
				
				</div>
				<div class="clearfix"></div>
				
				<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<div id="upload_user_avatar_preview" >
						 <?php 
						 if($edit) 
							{
							if($result->amgt_user_avatar == "")
							{?>
							<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
							<?php }
							else {
								?>
							<img class="max_width_100" src="<?php if($edit)echo esc_url( $result->amgt_user_avatar ); ?>" />
							<?php 
							}
							}
							else {
								?>
								<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
								<?php 
							}?>
					</div>
			 </div>
			 </div>
		</div>
		<?php 
		if($edit) 
		{
		?>
		<div class="form-group"><!--MEMBER ID PROOF------>
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Member ID Proof-1','apartment_mgt');?></label>
				<div class="col-sm-4 margin_top_12px">
					<input type="hidden" name="hidden_id_proof_1" value="<?php if($edit){ echo $result->id_proof_1;}elseif(isset($_POST['id_proof_1'])) echo $_POST['id_proof_1'];?>">
					<input onchange="fileCheck(this);" name="id_proof_1"  value="" type="file"/>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label">
					<?php if(isset($result->id_proof_1) && $result->id_proof_1 != ""){?>
					<a href="<?php echo content_url().'/uploads/apartment_assets/'.$result->id_proof_1;?>" class="btn btn-default"><i class="fa fa-download"></i> <?php esc_html_e('Member ID Proof-1','apartment_mgt');?></a>
					<?php } ?>			
				</div>
			</div>
		</div>	
		<?php	
		}
		else
		{		
		?>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Member ID Proof-1','apartment_mgt');?></label>
				<div class="col-sm-4 margin_top_12px">
					<input  onchange="fileCheck(this);" name="id_proof_1"  type="file"/>
				</div>
			</div>
		</div>
		<?php
		}
		if($edit) 
		{
		?>	
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Lease Agreement','apartment_mgt');?></label>
				<div class="col-sm-4 margin_top_12px">
					<input type="hidden" name="hidden_id_proof_2" value="<?php if($edit){ echo $result->id_proof_2;}elseif(isset($_POST['id_proof_2'])) echo $_POST['id_proof_2'];?>">
					<input onchange="fileCheck(this);" name="id_proof_2"  value="" type="file"/>
				</div>
				<div class="col-sm-2">				
					<?php if(isset($result->id_proof_2) && $result->id_proof_2 != ""){?>
					<a href="<?php echo content_url().'/uploads/apartment_assets/'.$result->id_proof_2;?>" class="btn btn-default"><i class="fa fa-download"></i> <?php esc_html_e('Lease Agreement','apartment_mgt');?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
		}
		else
		{
		?>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Lease Agreement','apartment_mgt');?></label>
				<div class="col-sm-4 margin_top_12px">
					<input  onchange="fileCheck(this);" name="id_proof_2"  type="file"/>
				</div>
			</div>
		</div>
		<?php
		}	
		?>		
		<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
        	<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add Member','apartment_mgt');}?>" name="save_member" class="btn btn-success"/>
        </div>		
        </form>		
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php esc_html_e('Close','apartment_mgt');?></button>
		</div>
      </div>
    </div>
  </div>
  
  <!----------ADD BUILDING POP UP FORM--------------------->
<div class="modal fade" id="myModal_add_building" tabindex="-1" aria-labelledby="myModal_add_building" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"><!--MODAL CONTENT------>
        <div class="modal-header"><!--MODAL HEADER--------->
          <h3 class="modal-title"><?php esc_html_e('Add Building','apartment_mgt');?></h3><!--MODAL TITLE------>
		  <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <script type="text/javascript">
		$(document).ready(function() {
			 //UNIT FORM VALIDATIONENGINE
			 "use strict";
			$('#unit_form').validationEngine();
			$('.onlyletter_number_space_validation').keypress(function( e ) 
			{     
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
		<!--UNIT FORM------>
		<form name="unit_form"  method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" class="form-horizontal" id="unit_form">
		<input id="" type="hidden" name="action" value="MJ_amgt_add_unit_popup">
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required] building_category" name="building_id" id="">
						<option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
						<?php 
						$activity_category=MJ_amgt_get_all_category('building_category');
						if(!empty($activity_category))
						{
							foreach ($activity_category as $retrive_data)
							{
								echo '<option value="'.$retrive_data->ID.'">'.$retrive_data->post_title.'</option>';
							}
						} ?>
						</select>
				</div>
				<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="building_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
			</div>	
		</div>
		<div class="form-group"><!--ACTIVITY CATEGORY------>
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required] unit_category"  name="unit_cat_id" id="">
						<option value=""><?php esc_html_e('Select Unit Category','apartment_mgt');?></option>
						<?php 

						$activity_category=MJ_amgt_get_all_category('unit_category');
						if(!empty($activity_category))
						{
							foreach ($activity_category as $retrive_data)
							{
								echo '<option value="'.$retrive_data->ID.'">'.$retrive_data->post_title.'</option>';
							}
						} ?>
					</select>
				</div>
				<!--UNIT CATEGORY------------>
				<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="unit_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
			</div>	
		</div>
		<?php 
			   if(isset($_POST['unit_names'])){
					$all_data=$obj_units->MJ_amgt_get_entry_records($_POST);
					$all_entry=json_decode($all_data);
				}
			   ?>
				<div id="unit_name_entry"><!--UNITNAME ENTRY------>
						<div class="form-group">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"><?php esc_html_e('Unit Name','apartment_mgt');?><span class="require-field">*</span></label>
								<div class="col-sm-2 margin_bottom_10_res">
									<input class="form-control validate[required] text-input onlyletter_number_space_validation unit_name" type="text" value="" name="unit_names[]" placeholder="<?php esc_html_e('Unit Name','apartment_mgt'); ?>">
								</div>
								<?php $unit_measerment_type=get_option( 'amgt_unit_measerment_type' );?>
								<label class="col-sm-3 control-label margin_bottom_10_res" for="unit_entry"><?php esc_html_e('Unit Size','apartment_mgt');?>(<?php if($unit_measerment_type =='square_meter'){
											 echo esc_html_e('square meter','apartment_mgt');
											 }
											 else{
												echo $unit_measerment_type;
											 }
								
										   ?>)</label> 
								<div class="col-sm-2 margin_bottom_10_res">
									<input  class="form-control text-input" type="number" onKeyPress="if(this.value.length==6) return false;"  min="0" value="" name="unit_size[]" placeholder="<?php esc_html_e('Unit Size','apartment_mgt');?>">
								</div>
								<div class="col-sm-2">
								<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
								<i class="entypo-trash"><?php esc_html_e('Delete','apartment_mgt');?></i>
								</button>
								</div>
							</div>
						</div>	
		        </div><!--END UNITNAME ENTRY------>		    
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"></label>
						<div class="col-sm-3">
							
							<button id="add_new_entry" class="btn btn-default btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_entry()"><?php esc_html_e('Add More Unit','apartment_mgt'); ?>
							</button>
						</div>
					</div>
				</div>
		<hr>			
		
		<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<?php $unit_type=get_option( 'amgt_apartment_type' ); ?>
        	<input type="submit" value="<?php  esc_html_e('Add '.$unit_type.' Unit','apartment_mgt'); ?>" name="save_residential_unit" class="btn btn-success"/>
        </div>
		
        </form>
		
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php esc_html_e('Close','apartment_mgt');?></button>
		</div>
      </div>
    </div>
  </div>
  <script>
	// CREATING BLANK INVOICE ENTRY
	
   	var blank_income_entry ='';
   	$(document).ready(function() { 
   		blank_expense_entry = $('#unit_name_entry').html();
   	}); 

   	function add_entry()
   	{
		
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