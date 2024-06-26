<?php 
$curr_user_id=get_current_user_id();
$obj_apartment=new MJ_amgt_Apartment_management($curr_user_id);
$obj_doc = new MJ_amgt_Document;
?>
<?php $edit=0;	
    $member_id=0;
	if(isset($_REQUEST['member_id']))
		$member_id=$_REQUEST['member_id'];
		$edit=1;
	$user_info = get_userdata($member_id);
	
	//VIEW DETAILS VARIABLES
	
	$mobile = get_user_meta($member_id,'mobile',true);
	$first_name = get_user_meta($member_id,'first_name',true);
	$middle_name = get_user_meta($member_id,'middle_name',true);
	$last_name = get_user_meta($member_id,'last_name',true);
	$qualification = get_user_meta($member_id,'qualification',true);
	$username = get_user_meta($member_id,'user_login',true);
	$unit_name = get_user_meta($member_id,'unit_name',true);
    $gender = get_user_meta($member_id,'gender',true);
	$member_type = get_user_meta($member_id,'member_type',true);
	$address = get_user_meta($member_id,'address',true);
	$city_name = get_user_meta($member_id,'city_name',true);
	$state_name = get_user_meta($member_id,'state_name',true);
	$country_name = get_user_meta($member_id,'country_name',true);
	$zipcode = get_user_meta($member_id,'zipcode',true);
	$email = get_user_meta($member_id,'email',true);
	$building = get_the_title(get_user_meta($member_id,'building_id',true));
	$building_id =get_user_meta($member_id,'building_id',true);
	$staff_category = get_the_title(get_user_meta($member_id,'staff_category',true));
	$unit_category = get_the_title(get_user_meta($member_id,'unit_category',true));
	$skills = get_user_meta($member_id,'skills',true);
    $gate_name = get_user_meta($member_id,'gate_name',true);

?>
<div class="panel-body"><!--PANEL BODY-->
<!-- TOP PROFILE VIEW-->
  <div class="member_view_row1"><!--MEMBER VIEW ROW-->
	<div class="col-md-12 membr_left profile_view member_border padding_none row">
	  <div class="col-md-2 left_side padding_none margin_bottom_10_res">
			<?php 
				if($user_info->amgt_user_avatar == "")
				{ ?>
					<img class="user_profile" alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
				 <?php 
				}
				else 
				{ ?>
						<img class="user_profile max_width_100"src="<?php if($edit)echo esc_url( $user_info->amgt_user_avatar ); ?>" />
					<?php 
				} ?>
			
	  </div>
	    <div class="col-md-10 left_side padding_none"><!-- TOP PROFILE VIEW-->
		 <div class="col-md-12 col-sm-12 left_side view_data padding_none view_margin">
		   <div class="col-md-12 col-sm-12 padding_none">
			<div class="col-md-12 col-sm-12 left_side view_data d-flex">
			  <div class="col-md-1 user w-auto me-2">
			    <i class="fa fa-user"></i>
			  </div>
			  <div class="col-md-11">
			    <span class="newicon"><?php print esc_html($first_name); ?></span>
			  </div>
			</div>
			
			<div class="col-md-12 col-sm-12 left_side view_data d-flex">
			   <div class="col-md-1 user w-auto me-2">
			     <i class="fa fa-envelope"></i>
			   </div>
			   <div class="col-md-11">
			     <span class="email_color"><?php echo esc_html($user_info->user_email);?></span>
			   </div>
			</div>
			<div class="col-md-12 col-sm-12 left_side view_data d-flex">
			  <div class="col-md-1 user w-auto me-2">
			    <i class="fa fa-phone"></i>
			  </div>
			  <div class="col-md-11">
			    <span class="newicon"><?php print esc_html($mobile); ?></span>
			  </div>
			</div>
		 </div>
	  </div>
	  </div>
	</div>
  </div>
  <!-- TOP PROFILE VIEW END-->
  <div class="col-md-12 padding_none">
   <!-- GENERAL INFORMATION VIEW START-->
	  <div class="member_view_row1">
	    <div class="col-md-12 main_info_view">
		  
		  	<div class="member_view_row1">
	           <div class="col-md-12 member_border padding_none">
			     <div class="col-md-2 profile_view_first p-2">
			       <span class="emp_info view_title_font view_title_font"><?php esc_html_e('General Information','apartment_mgt');?></span>
				 </div>  
				 <div class="col-md-12 padding_none bank_margin row">
				 <div class="col-md-6  padding_none"> 
				    <?php if($first_name){?>
					<div class="col-md-12 bank_padding row p-2">
					  <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-user newicon"></i><?php esc_html_e('Name','apartment_mgt');?>
					  </div>
					  <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php if(!empty($first_name)) { print esc_html($first_name); }else { print '' ;}?></span>
				    </div>
					<?php } ?>
					
				    <?php if($middle_name){?>
					<div class="col-md-12 bank_padding row p-2">
					   <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-user newicon"></i><?php esc_html_e('Middle Name','apartment_mgt');?>
						</div>
					   <span class="span_left span_padding w-auto padding_0_res">:</span>
					   <span class="txt_color w-auto"><?php if(!empty($middle_name)) { print esc_html($middle_name); }else { print '' ;}?></span>
				    </div>
					<?php } ?>
					
				    <?php if($last_name){?>
				    <div class="col-md-12 bank_padding row p-2">
					   <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-user last_name_padding"></i> <?php esc_html_e('Last Name','apartment_mgt') ?>
					   </div>
				       <span class="span_left span_padding w-auto padding_0_res">:</span>
					   <span class="txt_color w-auto"><?php if(!empty($last_name)) { print esc_html($last_name); }else { print '' ;}?></span>
				    </div>
					<?php } ?>
					
				   
				    <div class="col-md-12 bank_padding row p-2">
					  <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-user padding_right_3px_res"></i> <?php esc_html_e('User Name','apartment_mgt');?>
					  </div>
					  <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php echo chunk_split($user_info->user_login,25,"<BR>");?></span>
				    </div>
				</div>
				
			    <div class="col-md-6 padding_none">
				  
					 <?php if($mobile){?>
				   <div class="col-md-12 bank_padding row p-2">
				      <div class="col-md-4 bank_padding employee_weight padding_0_res">
						 <i class="fa fa-phone padding_right_3px_res"></i> <?php esc_html_e('Mobile','apartment_mgt') ?>
					  </div>
				      <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php if(!empty($mobile)) { print esc_html($mobile); }else { print '' ;}?></span>
				   </div>
				   <?php } ?>

				   <?php if($member_type){ 
						$str = str_replace('_', ' ', $member_type);
						 ?>

					<div class="col-md-12 bank_padding row p-2">
						<div class="col-md-4 bank_padding employee_weight padding_0_res">
							<i class="fa fa-user padding_right_3px_res"></i> <?php esc_html_e('Member Type','apartment_mgt') ?>
						</div>
						<span class="span_left span_padding w-auto padding_0_res">:</span>
						<span class="txt_color w-auto"><?php if(!empty($member_type)) { print esc_html__($str,'apartment_mgt'); }else { print '' ;}?></span>
				    </div>
					 <?php } ?>

				   <?php if($building != 'Untitled'){?>
				   <div class="col-md-12 bank_padding row p-2">
				      <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-university last_name_padding"></i> <?php esc_html_e('Building Name','apartment_mgt') ?>
					  </div>
				      <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php if(!empty($building)) { print esc_html($building); }else { print '' ;}?></span>
				   </div>
				   <?php } ?>
				   
				   <?php if($unit_name){?>
				   <div class="col-md-12 bank_padding row p-2">
				      <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-list-ol padding_right_3px_res"></i> <?php esc_html_e('Unit Name','apartment_mgt') ?>
					  </div>
				      <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php if(!empty($unit_name)) { print esc_html($unit_name); }else { print '' ;}?></span>
				   </div>
				   <?php } ?>
				   
				   
				   <?php if($staff_category != 'Untitled'){?>
				   <div class="col-md-12 bank_padding row p-2">
				      <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-calendar"></i> <?php esc_html_e('Staff Category','apartment_mgt') ?>
					  </div>
				      <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php 
					  if(!empty($staff_category)) { print esc_html($staff_category); }else { print '-' ;}?></span>
				   </div>
				   <?php } ?>
				   
				  
				   
				   <?php if($gate_name){?>
				   <div class="col-md-12 bank_padding row p-2">
				      <div class="col-md-4 bank_padding employee_weight padding_0_res">
						  <i class="fa fa-calendar"></i> <?php esc_html_e('Gate Name','apartment_mgt') ?>
					  </div>
				      <span class="span_left span_padding w-auto padding_0_res">:</span>
					  <span class="txt_color w-auto"><?php
					  if(!empty($gate_name)) { print esc_html($gate_name); }else { print '' ;}?></span>
				   </div>
				   <?php } ?> 
				</div>
		        </div>

		      </div>
	        </div>
	      </div>
        </div>
	
  <!-- END ADDRESS INFORMATION VIEW-->
  </div>
  </div>
 <!-- UNIT MEMBER LIST-->
  <?php if(!empty($member_type)){ ?>
<div class="panel-body"><!--PANEL BODY-->
	<div class="clear"></div>
	<div class="row">
		<div class="col-sm-6 groups-list unit_member_list_div padding_0_res">
			<div class="border float-start h-100">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-users fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php esc_html_e('Unit Member List','apartment_mgt');?></span>
			</span>
			<div class="my-group-list"><!--MY GROUP LIST-->
				<table class="table">
				<?php 
					$unit_name=get_user_meta($member_id,'unit_name',true);

					$unit_groupdata = MJ_amgt_get_unit_members($unit_name);

					 if(!empty($unit_groupdata))

						{
							$i= 1;
							foreach ($unit_groupdata as $retrieved_data)
							{
								$user=get_userdata($retrieved_data->ID);
								?>
								<tr>
									<td class="d-flex"><?php $memberimage=$user->amgt_user_avatar;
											if(empty($memberimage))
											{?>
												<a class="float-start" href="?page=amgt-member&tab=viewmember&action=view&member_id=<?php echo esc_attr($user->ID);?>">
												<?php echo '<img src='.esc_url(get_option( 'amgt_system_logo' )).' height="25px" width="25px" class="img-circle" />';
												   
												 ?>
												 
												</a>											
												<span class="txt_color_member padding_7"><?php echo esc_html($user->display_name); ?></span> 
											<?php
											}
											else
											 { ?>
												<a href="?page=amgt-member&tab=viewmember&action=view&member_id=<?php echo esc_attr($user->ID);?>">
												<?php echo '<img src='.$memberimage.' height="25px" width="25px" class="img-circle"/>';
												  
												 ?>
												</a>
                                                <span class="txt_color_member padding_7"><?php echo esc_html($user->display_name); ?></span> 												
											<?php } ?>
											
									</td>
									<td>
										  <span class="txt_color padding_7"><?php echo MJ_amgt_get_member_status_label($user->member_type);?></span>
									</td>
								</tr>
								<?php 
								$i++;
							}
						} else
						{?>
							<tr><td> <p><?php _e("No any Unit Members yet.","apartment_mgt");?></p></td></tr>
						<?php 
						}
				    ?>
				</table>
			</div>
			</div>
		</div>
		
		<div class="col-sm-6 groups-list view_user_document_list_div padding_0_res">
			<div class="border float-start h-100">
			<span class="report_title"><!--REPORT TITLE----->
				<span class="fa-stack cutomcircle">
					<i class="fa fa-file-text fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php esc_html_e('Document List','apartment_mgt');?></span>
			</span>
			<div class="my-group-list padding_0_and_21">
			<?php $alldocuments = $obj_doc->MJ_amgt_get_units_all_documents_new($unit_name,$building_id);
				
				if(!empty($alldocuments))
				{
					$i= 1; 
					?>
					<table class="table">
						<?php 
						foreach ($alldocuments as $retrieved_data)
						{ ?>
							<tr>
								<td>
								<span class="document_title"><i class="fa fa-file-text" aria-hidden="true"></i> 
								<?php echo esc_html($retrieved_data->doc_title);?>
								</span>
								</td>
								<td>
								<?php if($retrieved_data->document_content != ''){?>
								<a target="blank" href="<?php echo esc_attr($retrieved_data->document_content); ?>"><button class="btn btn-default margin_top_5" type="button">
								<i class="fa fa-eye"></i> <?php esc_html_e('View Document','apartment_mgt');?></button></a>
								<?php }?>
								</td>
							</tr>
							<?php 
						} ?>
					<?php 
					}
					else
					{ ?>
						<tr>
							<td><?php _e("No any Documents yet.","apartment_mgt");?></td>
						</tr>
					<?php  
					} ?>
		    	</table>
			</div>
			
			<span class="report_title"><!--REPORT TITLE--->
				<span class="fa-stack cutomcircle padding_bottom_15">
					<i class="fa fa-file-text fa-stack-1x" ></i>
				</span> 
				<span class="shiptitle padding_bottom_15"><?php esc_html_e('Proof Document List','apartment_mgt');?></span>
			</span>
			<div class="my-group-list">							 
				<table class="table">	
				<?php
					$id_proof_1 = get_user_meta( $member_id, 'id_proof_1' , true );			
					$id_proof_2 = get_user_meta( $member_id, 'id_proof_2' , true );			
								
					   if($id_proof_1 != '')
					   {
						?>
						<tr>
							<td>
							<span class="document_title"><i class="fa fa-file-text" aria-hidden="true"></i> 
							<!-- <?php echo 'Id Proof 1';?> -->
							
							<?php esc_html_e('Member ID Proof-1','apartment_mgt');?>
							</span>
							</td>
							<td>
							
							<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$id_proof_1; ?>"><button  class="btn btn-default margin_top_5" type="button">
							<i class="fa fa-eye"></i> <?php esc_html_e('View Document','apartment_mgt');?></button></a>
							
							</td>
						</tr>
						<?php 
						}
						if($id_proof_2 != '')
						{
						?>
						<tr>
							<td>
							<span class="document_title"><i class="fa fa-file-text" aria-hidden="true"></i> 
							<?php esc_html_e('Lease Agreement','apartment_mgt');?>
							</span>
							</td>
							<td>
							
							<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$id_proof_2; ?>"><button  class="btn btn-default margin_top_5" type="button">
							<i class="fa fa-eye"></i> <?php esc_html_e('View Document','apartment_mgt');?></button></a>
							
							</td>
						</tr>
						<?php }
						$doc_data=get_user_meta( $member_id, 'document' , true );
						$data_new=json_decode($doc_data);
						
						if(!empty($data_new))
						{
							foreach($data_new as $data)
							{
								if(!empty($data->value))
								{
						?>
									<tr>

										<td>

										<span class="document_title"><i class="fa fa-file-text" aria-hidden="true"></i> 
										<?php if(!empty($data->title)){ echo esc_html($data->title); }else{ echo esc_html_e('No Title','apartment_mgt'); }?>

										</span>

										</td>

										<td>
										<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$data->value; ?>"><button  class="btn btn-default margin_top_5" type="button">

										<i class="fa fa-eye"></i> <?php esc_html_e('View Document','apartment_mgt');?></button></a>
									</td>

									</tr>

						<?php 
								}	

							}

						}

					if($id_proof_1 == '' && $id_proof_2 == '' && empty($doc_data))
					{ 
					?>

						<tr>

							<td><?php _e("No any Proof Documents yet.","apartment_mgt");?></td>

						</tr>

					<?php  

					} 

					?>
			    </table>
			</div>
			</div>
		</div>
	</div>	
		 
</div>
<!-- UNIT MEMBER LIST END-->
<?php } ?>
<!-- END PANEL BODY DIV -->