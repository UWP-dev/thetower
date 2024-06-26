<?php ?>
<style>
.dropdown-menu {
    min-width: 240px;
}
</style>
<script type="text/javascript">
$(document).ready(function() 
{   //STAFF_CHECKIN_FORM
	"use strict";
	<?php
	if (is_rtl())
		{
		?>	
			$('#staff_checkin_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#staff_checkin_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
			<?php
		}
	?>
	var date = new Date();
	date.setDate(date.getDate()-0);
	jQuery('#checkin_date').datepicker({
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
	$('.timepicker').timepicki();
	
});
</script>
<?php 
//STAFF_CHECKIN TAB
if($active_tab == 'staff-checkin')
{
   	$vcheckin_id=0;
	if(isset($_REQUEST['staff_checkin_id']))
		$vcheckin_id=$_REQUEST['staff_checkin_id'];
		$edit=0;
		if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit'){
			$edit=1;
			$result = $obj_gate->MJ_amgt_get_single_checkin($vcheckin_id);
		} ?>
		<div class="panel-body"><!--PANEL BODY-->
		    <!--STAFF_CHECKIN_FORM-->
			<form name="staff_checkin_form" action="" method="post" class="form-horizontal" id="staff_checkin_form">
			 <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
			<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
			<input type="hidden" name="vcheckin_id" value="<?php echo esc_attr($vcheckin_id);?>"  />
			<input type="hidden" name="checkin_type" value="staff_checkin"  />
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="gate"><?php esc_html_e('Choose Gate','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-8">
					<?php $gateval = "0"; if($edit){ $gateval=$result->gate_id; }elseif(isset($_POST['gate'])) {$gateval=$_POST['gate'];}
					if(!empty($gatedata))
						{
							$i=1;
							foreach($gatedata as $gate)
							{
								if($edit)
								{
									?>
									<label class="radio-inline">
									<input type="radio" value="<?php echo esc_attr($gate->id);?>" class="tog validate[required]" name="gate"  <?php  echo checked( $gate->id, $gateval);  ?>/><?php echo esc_attr($gate->gate_name);?>
									</label>
								<?php
								}
								else
								{?>
									<label class="radio-inline">
									<input type="radio" value="<?php echo esc_attr($gate->id);?>" class="tog validate[required]" name="gate"  <?php  if($i==1) echo "checked"; ?>/><?php echo esc_attr($gate->gate_name);?>
									</label>
								<?php
								}
								$i+=1;
							}
						}
						else
						{ ?>
							<label class="radio-inline">
							<?php esc_html_e('No Any Gates.','apartment_mgt');
							echo "</label>";
						}
						?>
					</div>
				</div>
			</div>
			<div class="form-group"><!--STAFF MEMBER-->
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"  for="member"><?php esc_html_e('Staff Member','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-8">
						<select class="form-select validate[required]" id="member_id" name="member_id">
							<option value=""><?php esc_html_e('Select Staff Member','apartment_mgt');?></option>
							<?php 
							if($edit)
								$memberid =$result->member_id;
							elseif(isset($_REQUEST['member_id']))
								$memberid =$_REQUEST['member_id'];  
							else 
								$memberid = "";
							
							$get_members = array('role' => 'staff_member');
							$membersdata=get_users($get_members);
							
							if(!empty($membersdata))
							{
								foreach ($membersdata as $staff_data)
								{
									echo '<option value="'.$staff_data->ID.'" '.selected($memberid,$staff_data->ID).'>'.$staff_data->display_name.'</option>';
								}
							} ?>
						</select>
					</div>
				</div>
			</div>
			
			<div id="staff-data">
				<!---Here Display staff member details---->
			</div>
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vehicle"><?php esc_html_e('Check in Date and Time','apartment_mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-5">
						<input id="checkin_date" class="form-control validate[required]" type="text"  autocomplete="off" name="checkin_date" 
						value="<?php if($edit){ echo date("Y-m-d",strtotime($result->checkin_date));}elseif(isset($_POST['checkin_date'])) echo esc_attr($_POST['checkin_date']); else echo date("Y-m-d");?>" readonly>
					 </div>
					<div class="col-sm-3">
						<input type="text" value="<?php if($edit){ echo $result->checkin_time;}elseif(isset($_POST['checkintime'])) echo esc_attr($_POST['checkintime']); else date_default_timezone_set('Asia/Kolkata'); echo date("h:i a");?>" class="form-control timepicker validate[required]" name="checkintime" readonly>
					 </div>
					</div>
			</div>
			
			<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?></label>
					<div class="col-sm-8">
						 <textarea name="description"  id="description" maxlength="150" class="form-control text-input"><?php if($edit) echo esc_textarea($result->description);?></textarea>
					</div>
				</div>
			</div>
			
			<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<input type="submit" value="<?php if($edit){ esc_html_e('Checkin','apartment_mgt'); }else{ esc_html_e('Checkin','apartment_mgt');}?>" name="save_staff_checkin" class="btn btn-success"/>
			</div>
			
			</form><!--END STAFF_CHECKIN_FORM-->
        </div><!--END PANEL BODY-->
     <?php }//End staff-checkin ?>