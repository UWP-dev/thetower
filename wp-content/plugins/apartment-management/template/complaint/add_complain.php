<?php 
//ADDCOMPLAIN TAB
if($active_tab == 'addcomplaint')
 { ?>
	 <style>
	 .dropdown-menu {
		min-width: 240px;
	  }
	</style>
	<script type="text/javascript">
	$(document).ready(function() {
		"use strict";
		<?php
		if (is_rtl())
			{
			?>	
				$('#complaint_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
			<?php
			}
			else{
				?>
				$('#complaint_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
				<?php
			}
		?>
		var date = new Date();
		date.setDate(date.getDate()-0);
		jQuery('#complain_date').datepicker({
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
    	$('.timepicker').timepicki();	
	} );
	</script>
	<script type="text/javascript">
	function fileCheck(obj)
	{   //FILE VALIDATIONENGINE
		"use strict";
		var fileExtension = ['pdf','doc','jpg','jpeg','png'];
		if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
		{
			alert("<?php esc_html_e('Sorry, only JPG, pdf, docs., JPEG, PNG And GIF files are allowed.','apartment_mgt');?>");
			$(obj).val('');
		}	
	}
	</script>
       <?php 	$complaint_id=0;
			if(isset($_REQUEST['complaint_id']))
				$complaint_id=$_REQUEST['complaint_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
				{
					$edit=1;
					$result = $obj_complaint->MJ_amgt_get_single_complaint($complaint_id);
				} 
				
			    if($edit)
				{
                    if($result->complaint_nature == "Maintenance Request")
					{
						$time_date_div_css='display:block';
						$category_div='display:none';
						$status_div='display:block';
					}	
                    else
				    {
					    $time_date_div_css='display:none';
					    $category_div='display:block';
						$status_div='display:none';
				    }
					
					if($result->complaint_type == 'individual')
					{
						$members_bloack="display:block";
					}
					else
					{
						$members_bloack="display:none";
					}
				}
                 else
				 {
					 $members_bloack="display:block";
					  $time_date_div_css='display:none';
					  $category_div='display:block';
				 }					 
				?>
		<div class="panel-body"><!-- PANEL BODY DIV -->
		    <!--COMPLAIN_FORM-->
			<form name="complaint_form" action="" method="post" class="form-horizontal" id="complaint_form" enctype="multipart/form-data">
				<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="complaint_id" value="<?php echo esc_attr($complaint_id);?>"  />
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="complaint_nature"><?php esc_html_e('Nature','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $complaintval = "complaint"; if($edit){ $complaintval=$result->complaint_nature; }elseif(isset($_POST['complaint_nature'])) {$complaintval=$_POST['complaint_nature'];}?>
							<label class="radio-inline front front_radio">
							 <input type="radio" value="complaint" class="tog validate[required] radio_border_radius complaint_nature123" name="complaint_nature"  <?php  checked( 'complaint', $complaintval);  ?>/><?php esc_html_e('Complaint','apartment_mgt');?>
							</label>
							<label class="radio-inline front front_radio">
							  <input type="radio" value="suggestion" class="tog validate[required] radio_border_radius complaint_nature123" name="complaint_nature"  <?php  checked( 'suggestion', $complaintval);  ?>/><?php esc_html_e('Suggestion','apartment_mgt');?> 
							</label>
							 <label class="radio-inline front front_radio margin_left_0_res">
							  <input type="radio" value="request" class="tog validate[required] radio_border_radius complaint_nature123" name="complaint_nature"  <?php  checked( 'request', $complaintval);  ?>/><?php esc_html_e('Request','apartment_mgt');?> 
							</label>
							
							<label class="radio-inline front front_radio ">
							  <input type="radio" value="Maintenance Request" class="tog validate[required] radio_border_radius complaint_nature123 " name="complaint_nature"  <?php  checked( 'Maintenance Request', $complaintval);  ?>/><?php esc_html_e('Maintenance Request','apartment_mgt');?> 
							</label>
							
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Title','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							 <input id="complain_title" maxlength="50" class="form-control text-input validate[required,custom[onlyLetter_specialcharacter]] text-input" type="text"  value="<?php if($edit){ echo esc_attr($result->complain_title);}elseif(isset($_POST['complain_title'])) echo esc_attr($_POST['complain_title']);?>" name="complain_title">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="type"><?php esc_html_e('Type','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $complaintval = "individual"; if($edit){ $complaintval=$result->complaint_type; }elseif(isset($_POST['type'])) {$complaintval=$_POST['type'];}?>
							<label class="radio-inline front front_radio">
							 <input type="radio" id="type_individual" value="individual" class="tog radio_border_radius complain_type" name="type"  <?php  checked( 'individual', $complaintval);  ?>/><?php esc_html_e('Individual','apartment_mgt');?>
							</label>
							<label class="radio-inline front front_radio">
							  <input type="radio" id="type_society" value="society" class="tog complain_type radio_border_radius complain_type" name="type"  <?php  checked( 'society', $complaintval);  ?>/><?php esc_html_e('Society','apartment_mgt');?> 
							</label>
						
						</div>
					</div>
				</div>
				
						<?php 
						$user_meta = get_userdata(get_current_user_id());
						$user_roles[0] = $user_meta->roles;
						if($user_roles[0][0] == 'member')
						{
							?>
							<input type="hidden"  name="member_id" value=<?php echo get_current_user_id(); ?>
							>
						<?php 
						}
						else
						{
					  ?>
					<div class="form-group">
						
						<div class="form-group single_member" style="<?php echo $members_bloack; ?>">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="expense_type">
									<?php esc_html_e('Member','apartment_mgt');?></label>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<select class="form-select" name="member_id">
											<option value=""><?php esc_html_e('Select Member','apartment_mgt');?></option>
											<?php 
											if($edit)
											{
												$memberid =$result->complaint_member_id;
											}
											elseif(isset($_REQUEST['member_id']))
											{
												$memberid =$_REQUEST['member_id']; 
											}							
											else 
											{
												$memberid = 0;
											}
											$get_members = array('role' => 'member');
											$membersdata=get_users($get_members);
											if(!empty($membersdata))
											{
												foreach ($membersdata as $retrive_data)
												{
													echo '<option value="'.$retrive_data->ID.'" '.selected($memberid,$retrive_data->ID).'>'.MJ_amgt_get_display_name($retrive_data->ID).'</option>';
												}
											} ?>		
										</select>
								</div>
							</div> 
						</div> 
					</div> 
				<?php } ?>
			<div class="category_div" style="<?php echo $category_div;?>" >
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Category','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select complaint_category" name="category">
								<option value=""><?php esc_html_e('Select Category','apartment_mgt');?></option>
								<?php 
								if($edit)
								{
									$category =$result->complaint_cat;
								}
								elseif(isset($_REQUEST['category']))
								{
									$category =$_REQUEST['category'];  
								}
								else 
								{
									$category = "";
								}
								$activity_category=MJ_amgt_get_all_category('complaint_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								} ?>
							</select>
						</div>
						<div class="col-sm-2 margin_top_10_res"><button class="btn btn-default" id="addremove" model="complaint_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
					</div>	
				</div>
				
				<?php
				if($edit)
				{ ?>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="status"><?php esc_html_e('Status','apartment_mgt');?></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select class="form-select" name="status" id="status">
								<?php 
								if($edit)
								{
									$category =$result->complaint_status;
								}
								elseif(isset($_POST['status']))
								{
									$category =$_POST['status'];
								}
								else
								{
								$category ="";}?>
								<option value="open" <?php selected($category,'open');?>><?php esc_html_e('Open','apartment_mgt');?></option>
								<option value="close" <?php selected($category,'close');?>><?php esc_html_e('Closed','apartment_mgt');?></option>
								<option value="on_hold" <?php selected($category,'on_hold');?>><?php esc_html_e('On Hold','apartment_mgt');?></option>
								<option value="scheduled" <?php selected($category,'scheduled');?>><?php esc_html_e('Scheduled','apartment_mgt');?></option>
							</select>
							</div>
						</div>
				</div>
				<?php
				} ?>
				<div class="form-group">
					  <div class="mb-3 row"> 
					   <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vehicle"><?php esc_html_e('Complaint Date','apartment_mgt');?><span class="require-field">*</span></label>
					   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input id="complain_date" class="form-control validate[required]" type="text" autocomplete="off" name="complain_date" 
						value="<?php if($edit){ echo date("Y-m-d",strtotime($result->complain_date));}elseif(isset($_POST['complain_date'])) echo esc_attr($_POST['complain_date']); else echo date("Y-m-d");?>">
					   </div>
					  </div>
				</div>
			</div>
			<?php 
			if($edit)
			{  
				if($result->complaint_nature == "Maintenance Request")
				{?>
						<div class="form-group status_div" style="<?php echo $status_div;?>">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="status"><?php esc_html_e('Status','apartment_mgt');?></label>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<select class="form-select" name="status" id="status">
									<?php 
									if($edit)
									{
										$category =$result->complaint_status;
									}
									elseif(isset($_POST['status']))
									{
										$category =$_POST['status'];
									}
									else
									{
									$category ="";}?>
									<option value="open" <?php selected($category,'open');?>><?php esc_html_e('Open','apartment_mgt');?></option>
									<option value="close" <?php selected($category,'close');?>><?php esc_html_e('Closed','apartment_mgt');?></option>
									<option value="on_hold" <?php selected($category,'on_hold');?>><?php esc_html_e('On Hold','apartment_mgt');?></option>
									<option value="scheduled" <?php selected($category,'scheduled');?>><?php esc_html_e('Scheduled','apartment_mgt');?></option>
								</select>
								</div>
							</div>
						</div> <?php 
				} 
		   } ?>
			
			<div class="time_date_div" style="<?php echo esc_attr($time_date_div_css);?>">
				<div class="form-group">
						<div class="mb-3 row">  
						  <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="vehicle"><?php esc_html_e('Date','apartment_mgt');?><span class="require-field">*</span></label>
						   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input  class="form-control validate[required] date" type="text"  autocomplete="off" name="date" 
							value="<?php if($edit){ echo date("Y-m-d",strtotime($result->complain_date));}elseif(isset($_POST['date'])) echo esc_attr($_POST['date']); else echo date("Y-m-d");?>">
						   </div>
						  </div>
				</div>
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="facility_start_date">
						<?php esc_html_e('Time','apartment_mgt');?> <span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input type="text" autocomplete="off" value="<?php if($edit){ echo esc_attr($result->time);}elseif(isset($_POST['time'])) echo esc_attr($_POST['time']);?>" class="form-control timepicker start" name="time" />
						</div>
					</div>
				</div>
			</div>
			
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							 <textarea name="description" maxlength="150" id="description" class="form-control validate[required,custom[address_description_validation]] text-input"><?php if($edit) echo esc_textarea($result->complaint_description);?></textarea>
						</div>
					</div>
				</div>
				<?php
				if($edit) 
				{
				?>	
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Document','apartment_mgt');?></label>
						<div class="col-sm-4">
							<input type="hidden" name="hidden_complain_doc" value="<?php if($edit){ echo $result->complain_doc;}elseif(isset($_POST['complain_doc'])) echo $_POST['complain_doc'];?>">
							<input id="upload_file" onchange="fileCheck(this);" name="complain_doc"  value="" type="file"/>
						</div>
						<?php if(isset($result->complain_doc) && $result->complain_doc != ""){?>
						<div class="col-sm-2">				
							<a target="_blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$result->complain_doc;?>" class="btn btn-default"><i class="fa fa-eye"></i> <?php esc_html_e('View Document','apartment_mgt');?></a>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Document','apartment_mgt');?></label>
						<div class="col-sm-4">
							<input id="upload_file" onchange="fileCheck(this);" name="complain_doc"  type="file"/>
						</div>
					</div>
				</div>
				<?php
				}	
				if($edit)
				{ ?>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Resolution','apartment_mgt');?></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								 <textarea name="resolution" maxlength="150" id="Resolution" class="form-control text-input"><?php if($edit) echo esc_textarea($result->resolution);?></textarea>
							</div>
						</div>
					</div>
				<?php 
				} ?>
				<?php wp_nonce_field( 'save_complaint_nonce' ); ?>
				<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input type="submit" value="<?php if($edit){ esc_html_e('Submit','apartment_mgt'); }else{ esc_html_e('Submit','apartment_mgt');}?>" name="save_complaint" class="btn btn-success"/>
				</div>
			</form> <!--END COMPLAIN_FORM-->
        </div><!-- END PANEL BODY DIV -->
     <?php  } ?>