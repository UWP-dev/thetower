<script type="text/javascript">
jQuery('#birth_date').datepicker({
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
</script>
<script type="text/javascript">
$(document).ready(function() {
"use strict";
//MEMBER FORM
 $('#member_form').on('submit', function(e) {
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
					  $('.upload_user_avatar_preview').html('<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">');
					  $('.amgt_user_avatar_url').val('');
					  $('.unnit_measurement').val('');	
			           $('.unnit_chanrges').val('');
					  $('.modal').modal('hide');
					  window.location = "?apartment-dashboard=user&page=member&message=1";
					}
					
				},
				error: function(data){

				}
			})
	}
	});
	$("body").on("click",'.remove_unused_model',function()
	{
		
		$(".modal-backdrop").addClass("background_color_black");
	});
   //add_bulding_form Ajax
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
						$('#myModal_add_building').modal('hide');
					 } 
				},
				error: function(data){
				}
			
		    })
		}
	}); 
	
		$('.myModal_add_building_model').on('click', function(e)
		{ 
			$('#myModal_add_member').hide();
		});
		$('.show_member_form').on('click', function(e)
		{ 
			$('#myModal_add_member').show();
		});
	} );
</script>
<?php

$curr_user_id=get_current_user_id();
$obj_apartment=new MJ_amgt_Apartment_management($curr_user_id);
$obj_units=new MJ_amgt_ResidentialUnit;
$obj_doc = new MJ_amgt_Document;
// add model member //

if(isset($_POST['save_member']))		
{
	$nonce = sanitize_text_field($_POST['_wpnonce']);
	if (wp_verify_nonce( $nonce, 'save_member_nonce' ) )
	{
		$upload_docs_array=array(); 
		$document_title=array(); 
		
		if($_FILES['id_proof_1']['name'] != "" && $_FILES['id_proof_1']['size'] > 0)
		{
			$id_proof_1=MJ_amgt_load_documets($_FILES['id_proof_1'],$_FILES['id_proof_1'],'id_proof_1');
		}
		else
		{
			$id_proof_1=$_REQUEST['hidden_id_proof_1'];
		} 
		
		if($_FILES['id_proof_2']['name'] != "" && $_FILES['id_proof_2']['size'] > 0)
		{
			$id_proof_2=MJ_amgt_load_documets($_FILES['id_proof_2'],$_FILES['id_proof_2'],'id_proof_2');
		}
		else
		{
			$id_proof_2=$_REQUEST['hidden_id_proof_2'];
		} 
		
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
	{
		$document_title=$_POST['doc_title'];
		if(!empty($_FILES['upload_file']['name']))//UPLOAD FILE

		{

			$count_array=count($_FILES['upload_file']['name']);

			for($a=0;$a<$count_array;$a++)

			{	

				foreach($_FILES['upload_file'] as $image_key=>$image_val)

				{	

					$document_array[$a]=array(

					'name'=>$_FILES['upload_file']['name'][$a],

					'type'=>$_FILES['upload_file']['type'][$a],

					'tmp_name'=>$_FILES['upload_file']['tmp_name'][$a],

					'error'=>$_FILES['upload_file']['error'][$a],

					'size'=>$_FILES['upload_file']['size'][$a]

					);	

				}

			}	

			foreach($document_array as $key=>$value)
			{	

				$get_file_name=$document_array[$key]['name'];	

				$upload_docs_array[]=MJ_amgt_load_documets($value,$value,$get_file_name);

			} 

		}
		else
		{
			
			$upload_docs_array=$_REQUEST['hidden_upload_file'];

		} 
		
		 $imagurl=$_POST['upload_user_avatar_image'];
		  $ext=MJ_amgt_check_valid_extension($imagurl);
			if(!$ext == 0)
			{
				 $result=$obj_member->MJ_amgt_add_member($_POST);
				 $obj_member->MJ_amgt_update_upload_documents($id_proof_1,$id_proof_2,$document_title,$upload_docs_array,$result);
					if($result)
					{
						wp_redirect ( admin_url().'?apartment-dashboard=user&page=resident_unit&tab=unitlist&message=2');
					}
		   }
			else
				{ ?>
				<div id="message" class="updated below-h2 notice is-dismissible">
					<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
				</div>
		   <?php }
	}
	else
	{
		if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] ))
		{
			$document_title=$_POST['doc_title'];
			if(!empty($_FILES['upload_file']['name']))//UPLOAD FILE
			{

				$count_array=count($_FILES['upload_file']['name']);

				for($a=0;$a<$count_array;$a++)
				{	
					foreach($_FILES['upload_file'] as $image_key=>$image_val)
					{	

						$document_array[$a]=array(

						'name'=>$_FILES['upload_file']['name'][$a],

						'type'=>$_FILES['upload_file']['type'][$a],

						'tmp_name'=>$_FILES['upload_file']['tmp_name'][$a],

						'error'=>$_FILES['upload_file']['error'][$a],

						'size'=>$_FILES['upload_file']['size'][$a]

						);	

					}

				}	

				foreach($document_array as $key=>$value)
				{	

					$get_file_name=$document_array[$key]['name'];	

					$upload_docs_array[]=MJ_amgt_load_documets($value,$value,$get_file_name);	

				} 

			}

			$imagurl=$_POST['amgt_user_avatar'];
			$ext=MJ_amgt_check_valid_extension($imagurl);
			if(!$ext == 0)
			 {
			  $result=$obj_member->MJ_amgt_add_member($_POST);
			  $obj_member->MJ_amgt_upload_documents($id_proof_1,$id_proof_2,$document_title,$upload_docs_array,$result);	
			  if($result)
			   {
				 wp_redirect ( admin_url().'?apartment-dashboard=user&page=resident_unit&tab=unitlist&message=1');
				}
			 }
			 
			 else{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
			<?php }
		}
		else
		{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
					   <p><p><?php esc_html_e('Username Or Emailid Already Exist.','apartment_mgt');?></p></p>
					</div>
	  <?php }
	}
 }
}


//-------- CHECK BROWSER JAVA SCRIPT ----------//
MJ_amgt_browser_javascript_check(); 
//--------------- ACCESS WISE ROLE -----------//
$user_access=MJ_amgt_get_userrole_wise_access_right_array();
if (isset ( $_REQUEST ['page'] ))
{	
	if($user_access['view']=='0')
	{	
		MJ_amgt_access_right_page_not_access_message();
		die;
	}
	if(!empty($_REQUEST['action']))
	{
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='edit'))
		{
			if($user_access['edit']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die;
			}			
		}
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='delete'))
		{
			if($user_access['delete']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die;
			}	
		}
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='insert'))
		{
			if($user_access['add']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die();
			}	
		} 
	}
}


$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'unitlist');
	//-------------------- SAVE RESIDENTAL UNIT ------------------//
		if(isset($_POST['save_residential_unit']))		
		{
			$nonce = sanitize_text_field($_POST['_wpnonce']);
			if (wp_verify_nonce( $nonce, 'save_residential_unit_nonce' ) )
			{
				if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
				{
						$result=$obj_units->MJ_amgt_add_residential_unit($_POST);
						if($result)
						{
							wp_redirect ( home_url().'?apartment-dashboard=user&page=resident_unit&message=2');
						}
				}
				else
				{
					$result=$obj_units->MJ_amgt_add_residential_unit($_POST);
					if($result)
					{
						wp_redirect ( home_url().'?apartment-dashboard=user&page=resident_unit&message=1');
					}
				}
			}
		}
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
		{
			$result=$obj_units->MJ_amgt_delete_unit($_REQUEST['unit_id'],$_REQUEST['index']);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=resident_unit&tab=unitlist&message=3');
			}
        }
		if(isset($_REQUEST['message']))
		{
			$message =$_REQUEST['message'];
			if($message == 1)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
						esc_html_e('Residential Unit inserted successfully','apartment_mgt');
					?>
					<button type="button" class="close btn-close p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php 
			}
			elseif($message == 2)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
						_e("Residential Unit updated successfully.",'apartment_mgt');
					?>
					<button type="button" class="close btn-close p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php 
			}
			elseif($message == 3) 
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
						esc_html_e('Residential Unit deleted successfully','apartment_mgt');
					?>
					<button type="button" class="close btn-close p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
			}
	    }?>
		<!-- POP UP CODE -->
		<div class="popup-bg">
			<div class="overlay-content">
				<div class="modal-content">
					<div class="category_list">
					</div>
				</div>
			</div> 
			
		</div>
        <!-- END POP-UP CODE -->
    <div class="panel-body panel-white"><!-- PANEL WHITE DIV -->
		<ul class="nav nav-tabs panel_tabs" role="tablist"> <!-- END POP-UP CODE -->
			<li class="<?php if($active_tab=='unitlist'){?>active<?php }?>">
			       <?php $unit_type=get_option( 'amgt_apartment_type' );?>
					<a href="?apartment-dashboard=user&page=resident_unit&tab=unitlist" class="nav-link px-3 tab <?php echo esc_html($active_tab) == 'unitlist' ? 'active' : ''; ?>">
					 <i class="fa fa-align-justify"></i> <?php esc_html_e(''.$unit_type.' Unit List', 'apartment_mgt'); ?></a>
				    </a>
			</li>
		   <li class="<?php if($active_tab=='addunit'){?>active<?php }?>">
			  <?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' && isset($_REQUEST['unit_id']))
				{?>
				<a href="?apartment-dashboard=user&page=resident_unit&tab=addunit&&action=edit&unit_name=<?php echo $_REQUEST['unit_name'];?>&unit_id=<?php echo $_REQUEST['unit_id'];?>&index=<?php echo $_REQUEST['index']; ?>" class=" nav-tab nav-link px-3 margin_top_10_res <?php echo esc_html($active_tab) == 'addunit' ? 'nav-tab-active' : ''; ?>">
					<i class="fa fa"></i> <?php 
					if($unit_type == 'Residential')
					{	
						echo esc_html__('Edit Residential Unit', 'apartment_mgt');
					}
					else
					{
						echo esc_html__('Edit Commercial Unit', 'apartment_mgt');
					}
					?>
				</a>
				 <?php 
				}
				else
				{
					if($user_access['add']=='1')
					{?>
					<a href="?apartment-dashboard=user&page=resident_unit&tab=addunit" class="tab nav-link px-3 margin_top_10_res <?php echo esc_html($active_tab) == 'addunit' ? 'active' : ''; ?>">
					<i class="fa fa-plus-circle"></i> <?php esc_html_e('Add '.$unit_type.' Unit', 'apartment_mgt'); ?></a>
			<?php 	} 
				}
				?>
		  
		   </li>
	  
		</ul>
		<div class="tab-content">
			<?php if($active_tab == 'unitlist')
			{ ?>
			<script type="text/javascript">
			jQuery(document).ready(function() {
				"use strict";
				jQuery('#unit_list').DataTable({
					"responsive": true,
					"order": [[ 0, "asc" ]],
					"aoColumns":[	
								  {"bSortable": true},
								  {"bSortable": true},
								  {"bSortable": true},
								  {"bSortable": false}],
								  language:<?php echo MJ_amgt_datatable_multi_language();?>
					});
			} );

			$('.myModal_add_building_model').on('click', function(e)
			{ 
				$('#myModal_add_member').hide();
			});
			$('.show_member_form').on('click', function(e)
			{ 
				$('#myModal_add_member').show();
			});
			</script>
    	    <div class="panel-body">
				<div class="table-responsive">
					<table id="unit_list" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><?php esc_html_e('Unit Name', 'apartment_mgt' ) ;?></th>
								<th><?php esc_html_e('Building Name', 'apartment_mgt' ) ;?></th>
								<th><?php esc_html_e('Unit Category', 'apartment_mgt' ) ;?></th>
								<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
							  <th><?php esc_html_e('Unit Name', 'apartment_mgt' ) ;?></th>
							  <th><?php esc_html_e('Building Name', 'apartment_mgt' ) ;?></th>
							  <th><?php esc_html_e('Unit Category', 'apartment_mgt' ) ;?></th>
							  <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
							</tr>
						</tfoot>
						<tbody>
						<?php 
							$user_id=get_current_user_id();
							//--- RESIDENT DATA FOR MEMBER  ------//
							if($obj_apartment->role=='member')
							{
								
								$own_data=$user_access['own_data'];
								
								if($own_data == '1')
								{
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials_own($user_id);
									
								}
								else
								{
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials_own($user_id);
									
								}
							} 
							//--- RESIDENT DATA FOR STAFF MEMBER  ------//
							elseif($obj_apartment->role=='staff_member')
							{
								$own_data=$user_access['own_data'];
								if($own_data == '0')
								{ 
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials_created_by($user_id);
									
								}
								else
								{
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials();
								}
							}
							//--- RESIDENT DATA FOR ACCOUNTANT  ------//
							elseif($obj_apartment->role=='accountant')
							{
								$own_data=$user_access['own_data'];
								if($own_data == '1')
								{ 
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials_created_by($user_id);
								}
								else
								{
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials();
								}
							}
							//--- RESIDENT DATA FOR GATEKEEPER  ------//
							else
							{
								$own_data=$user_access['own_data'];
								if($own_data == '1')
								{ 
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials_created_by($user_id);
								}
								else
								{
									$residentialdata=$obj_units->MJ_amgt_get_all_residentials();
								}
							}
							if(!empty($residentialdata))
							{
								foreach ($residentialdata as $retrieved_data)
								{ 
									$units_data=array();
									$units_data=json_decode($retrieved_data->units);
									$i = 0;
									foreach($units_data as $unit)
									{

										
										$user_query = new WP_User_Query(
											array(
												'meta_key'	  =>	'unit_name',
												'meta_value'	=>	$unit->entry,
											)
										);
										$allmembers = $user_query->get_results();

										?>
										<tr>
											<?php
											if($obj_apartment->role=='member')
											{
												$own_data=$user_access['own_data'];
												if($own_data == '0')
												{
													$unit_name=get_user_meta($user_id,'unit_name',true);
													$building_id=get_user_meta($user_id,'building_id',true);
													if($unit->entry == $unit_name && $retrieved_data->building_id == $building_id)
													{ 
												?>
														<td class="unitname"><?php echo esc_html($unit_name); ?></td>
														<td class="building">
														<?php  
														$building = get_post($retrieved_data->building_id); echo esc_html($building->post_title);?></a></td>
														<td class="unit"><?php $unit_cat=get_post($retrieved_data->unit_cat_id); echo esc_html($unit_cat->post_title);?></td>
														<td class="action">
															<a href="#" class="btn btn-default view-member" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>" >
															<i class="fa fa-eye"></i> <?php esc_html_e('View Member', 'apartment_mgt' ) ;?> </a>
															
															<a href="#" class="btn btn-default view-member-history" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>" ><i class="fa fa-eye"></i> <?php esc_html_e('View Member History', 'apartment_mgt' ) ;?> </a>
															<?php
															$document=$obj_doc->MJ_amgt_get_member_document($user_id);
															if(!empty($document))
															{
															?>
																 <a href="#" class="btn btn-default view-unit-document" building_id="<?php echo esc_attr($retrieved_data->building_id);?>" unit_name="<?php echo esc_attr($unit->entry);?>">
																<i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
															<?php
															}
															$role = MJ_amgt_get_user_role(get_current_user_id());
															if($role=='staff_member')
															{
															?>
															<a href="#" class="btn btn-default view-unit-document" unit_name="<?php echo esc_attr($unit->entry);?>">
															 <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
															<?php
															}
															if($user_access['edit']=='1')
															{
															?>
																<a href="?apartment-dashboard=user&page=resident_unit&tab=addunit&action=edit&unit_name=<?php echo esc_attr($unit->entry);?>&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo $i; ?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
															<?php
															}
															if($user_access['delete']=='1')
															{
															?>
																<a href="?apartment-dashboard=user&page=resident_unit&tab=Activitylist&action=delete&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo esc_attr($i); ?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
																<?php esc_html_e('Delete', 'apartment_mgt' ) ;?>
																</a>
															<?php
															}
															?>
														</td>
													<?php
													}
												}
												else
												{ ?>
													<td class="unitname"><?php echo esc_html($unit->entry); ?></td>
													<td class="building">
													<?php  
													$building = get_post($retrieved_data->building_id); echo esc_html($building->post_title);?></a></td>
													<td class="unit"><?php $unit_cat=get_post($retrieved_data->unit_cat_id); echo esc_html($unit_cat->post_title);?></td>
													<td class="action">
														<a href="#" class="btn btn-default view-member" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>" >
														<i class="fa fa-eye"></i> <?php esc_html_e('View Member', 'apartment_mgt' ) ;?> </a>
														
														<a href="#" class="btn btn-default view-member-history" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>" ><i class="fa fa-eye"></i> <?php esc_html_e('View Member History', 'apartment_mgt' ) ;?> </a>
														<?php
														
														$document=$obj_doc->MJ_amgt_get_member_document($user_id);
														if(!empty($document))
														{
														?>
															 <a href="#" class="btn btn-default view-unit-document" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>">
															<i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
														<?php
														}  
														$role = MJ_amgt_get_user_role(get_current_user_id());
														if($role=='staff_member')
														{
														?>
														<a href="#" class="btn btn-default view-unit-document" building_id="<?php echo esc_attr($retrieved_data->building_id);?>" unit_name="<?php echo esc_attr($unit->entry);?>">
														 <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
														<?php
														}
														if($user_access['edit']=='1')
														{
														?>
															<a href="?apartment-dashboard=user&page=resident_unit&tab=addunit&action=edit&unit_name=<?php echo esc_attr($unit->entry);?>&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo $i; ?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
														<?php
														}
														if($user_access['delete']=='1')
														{
														?>
															<a href="?apartment-dashboard=user&page=resident_unit&tab=Activitylist&action=delete&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo esc_attr($i); ?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
															<?php esc_html_e('Delete', 'apartment_mgt' ) ;?>
															</a>
														<?php
														}
														?>
													</td>
												<?php
												}
											}
											else
											{ ?>
												<td class="unitname"><?php echo esc_html($unit->entry); ?></td>
												<td class="building">
												<?php  
												$building = get_post($retrieved_data->building_id); echo esc_html($building->post_title);?></a></td>
												<td class="unit"><?php $unit_cat=get_post($retrieved_data->unit_cat_id); echo esc_html($unit_cat->post_title);?></td>
												<td class="action">
												<?php if(!empty($allmembers))
												{?>
												
													<a href="#" class="btn btn-default view-member" building_id="<?php echo esc_attr($retrieved_data->building_id);?>" unit_name="<?php echo esc_attr($unit->entry);?>" >
													<i class="fa fa-eye"></i> <?php esc_html_e('View Member', 'apartment_mgt' ) ;?> </a>
																	
												<?php } else {?>
													<button type="button" class="btn btn-default margin_top_min_5" data-bs-toggle="modal" data-bs-target="#myModal_add_member"><i class="fa fa-plus-circle"></i> <?php esc_html_e('Add Member', 'apartment_mgt' ) ;?></button>
													 <?php } ?>
																	
																			
												<a href="#" class="btn btn-default view-member-history" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>" >
												<i class="fa fa-eye"></i> <?php esc_html_e('View Member History', 'apartment_mgt' ) ;?> </a>
													<?php
													
													$document=$obj_doc->MJ_amgt_get_member_document($user_id);
													if(!empty($document))
													{
													?>
														<a href="#" class="btn btn-default view-unit-document" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>">
														<i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
													<?php
													}  
													$role = MJ_amgt_get_user_role(get_current_user_id());
													if($role=='staff_member')
													{
													?>
													<a href="#" class="btn btn-default view-unit-document" building_id="<?php echo esc_attr($retrieved_data->building_id);?>"  unit_name="<?php echo esc_attr($unit->entry);?>">
													 <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
													<?php
													}
													if($user_access['edit']=='1')
													{
													?>
														<a href="?apartment-dashboard=user&page=resident_unit&tab=addunit&action=edit&unit_name=<?php echo esc_attr($unit->entry);?>&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo $i; ?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
													<?php
													}
													if($user_access['delete']=='1')
													{
													?>
														<a href="?apartment-dashboard=user&page=resident_unit&tab=Activitylist&action=delete&unit_id=<?php echo esc_attr($retrieved_data->id);?>&index=<?php echo esc_attr($i); ?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
														<?php esc_html_e('Delete', 'apartment_mgt' ) ;?>
														</a>
													<?php
													}
													?>
												</td>
											<?php
											}?>	
										</tr>
									 <?php 
										 
									}
								} 
							}
							?>
						</tbody>
					</table>
				</div>
            </div>
		     <?php 
			} 
			if($active_tab == 'addunit')
			{ 
			  require_once AMS_PLUGIN_DIR.'/template/resident_unit/add_unit.php' ;
			}
			?>
	</div>
</div><!-- END PANEL BODY DIV -->

<!--ADD MEMBER FORM POPUP -->
<script type="text/javascript">
	function member_imgefileCheck(obj)
	{
		"use strict";
		var fileExtension = ['jpg','jpeg','png'];
		if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
		{
			alert('Only jpg,jpeg,png File allowed');
			$(obj).val('');
		}	
	}
	function fileCheck(obj)
	{
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
	"use strict";
	$('#member_form').validationEngine();
	jQuery('#birth_date').datepicker({
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
	 	autoclose: true,
		 maxDate : 0,
	}); 
}); 
</script>
<!-- model add-member pop-up  -->

<div class="modal fade show" id="myModal_add_member" tabindex="-1" aria-labelledby="myModal_add_member" role="dialog"  aria-modal="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"><!--MODAL CONTENT -->
        <div class="modal-header"><!--MODAL HEADER-->
          <h3 class="modal-title"><?php esc_html_e('Add Member','apartment_mgt');?></h3>
		 <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"><!--MODAL BODY -->
         <?php $role='member';?>
		 <!--MEMBER FORM-->
		<form name="member_form" action="<?php echo admin_url('admin-ajax.php'); ?>"  method="post" class="form-horizontal" id="member_form" enctype="multipart/form-data">
	    <input type="hidden" name="action" value="MJ_amgt_add_member_popup">
		<input type="hidden" name="role" value="<?php echo esc_attr($role);?>"  />	
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<select class="form-select validate[required] popup_member_building_category" name="building_id" >
					<option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
					<?php 
					
					$edit=0;
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
					<button type="button" class="btn btn-default myModal_add_building_model" data-bs-toggle="modal" data-bs-target="#myModal_add_building"> <?php esc_html_e('Add Building','apartment_mgt');?></button>				
				</div>
			</div>
		</div>		
		<div id="hello"></div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">			
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
		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Unit','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
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
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="first_name"><?php esc_html_e('First Name','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<input id="first_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text" value="<?php if($edit){ echo esc_attr($result->first_name);}elseif(isset($_POST['first_name'])) echo esc_attr($_POST['first_name']);?>" name="first_name">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="middle_name"><?php esc_html_e('Middle Name','apartment_mgt');?></label>
				<div class="col-sm-8">
					<input id="middle_name" class="form-control validate[custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->middle_name);}elseif(isset($_POST['middle_name'])) echo esc_attr($_POST['middle_name']);?>" name="middle_name">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="last_name"><?php esc_html_e('Last Name','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<input id="last_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->last_name);}elseif(isset($_POST['last_name'])) echo esc_attr($_POST['last_name']);?>" name="last_name">
				</div>
			</div>
		</div>
		
		<!-- <div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="gender"><?php// esc_html_e('Gender','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
				<?php //$genderval = "male"; if($edit){ $genderval=$result->gender; }elseif(isset($_POST['gender'])) {$genderval=$_POST['gender'];}?>
					<label class="radio-inline">
					 <input type="radio" value="male" class="tog validate[required]" name="gender"  <?php  //checked( 'male', $genderval);  ?>/><?php// esc_html_e('Male','apartment_mgt');?>
				</label>
					<label class="radio-inline">
					  <input type="radio" value="female" class="tog validate[required]" name="gender"  <?php // checked( 'female', $genderval);  ?>/><?php //esc_html_e('Female','apartment_mgt');?> 
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="birth_date"><?php //esc_html_e('Date of birth','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
					<input id="birth_date" class="form-control validate[required] birth_date" type="text" autocomplete="off"  name="birth_date" 
					value="<?php //if($edit){ echo esc_attr(date(MJ_amgt_date_formate(),strtotime($result->birth_date)));}elseif(isset($_POST['birth_date'])) echo esc_attr($_POST['birth_date']);?>">
				</div>
			</div>
		</div> -->
		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Member Type','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
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
						<div class="col-sm-8">
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
						<div class="col-sm-8">
							<input id="occupied_date" class="form-control" type="text" autocomplete="off" name="occupied_date" 
							value="<?php if($edit){ echo esc_attr(date(MJ_amgt_date_formate(),strtotime($result->occupied_date)));}elseif(isset($_POST['occupied_date'])) echo esc_attr($_POST['occupied_date']);?>">
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
					<div class="col-sm-8">
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
					<div class="col-sm-8">
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
				<div class="col-sm-8">
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
				<div class="col-sm-8">
					<input id="occupied_date" class="form-control" type="text"  autocomplete="off" name="occupied_date" 
					value="<?php if($edit){ echo esc_attr(date(MJ_amgt_date_formate(),strtotime($result->occupied_date)));}elseif(isset($_POST['occupied_date'])) echo esc_attr($_POST['occupied_date']);?>">
				</div>
			</div>
		</div>
		</div>
		<?php
		}
		?>
	<div class="form-group">
				<div class="mb-3 row">	
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="committee_member"><?php esc_html_e('Commitee Member','apartment_mgt');?></label>
					<div class="checkbox_checked col-sm-1">
						<div class="col-sm-1">
						<input id="committee_member" class="form-check-input text-input" type="checkbox" <?php if($edit==1 && $result->committee_member=='yes'){ echo "checked";}?> name="committee_member"	value="yes"></div>	
					</div>	
					<?php if($edit==1 && $result->committee_member=='yes'){ ?>
					<div class="col-sm-9 margin_top_10_res" id="designaion_area">
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
					<div class="col-sm-3"><button id="addremove" model="designation_cat"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
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
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="address"><?php esc_html_e('Correspondence Address','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-8">
							<input id="address" class="form-control validate[required]" maxlength="150" type="text"  name="address" 
							value="<?php //if($edit){ echo esc_attr($result->address);}elseif(isset($_POST['address'])) echo esc_attr($_POST['address']);?>">
						</div>
					</div>
				</div> -->
							<!--ADDRESS INFORMATION---->
		            <!-- <div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="city_name"><?php //esc_html_e('City','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input id="city_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  name="city_name" 
								value="<?php// if($edit){ echo esc_attr($result->city_name);}elseif(isset($_POST['city_name'])) echo $_POST['city_name'];?>">
							</div>
							<label class="col-sm-2 control-label"><?php //esc_html_e('State','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetter_specialcharacter]]" type="text" maxlength="50" name="state_name" 
								value="<?php //if($edit){ echo esc_attr($result->state_name);}elseif(isset($_POST['state_name'])) echo $_POST['state_name'];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php //esc_html_e('Country','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetter_specialcharacter]]" type="text" maxlength="50" name="country_name" 
								value="<?php// if($edit){ echo esc_attr($result->country_name);}elseif(isset($_POST['country_name'])) echo $_POST['country_name'];?>">
							</div>
							<label class="col-sm-2 control-label"><?php// esc_html_e('Zip Code','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-3">
								<input class="form-control validate[required,custom[onlyLetterNumber]]" maxlength="10" type="text"  name="zipcode" 
								value="<?php// if($edit){ echo esc_attr($result->zipcode);}elseif(isset($_POST['zipcode'])) echo $_POST['zipcode'];?>">
							</div>
						</div>
					</div> -->
					<!--END ADDRESS INFORMATION---->
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label " for="email"><?php esc_html_e('Email','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-8">
								<input id="email" class="form-control validate[required,custom[email]] text-input" maxlength="50" type="text"  name="email" 
								value="<?php if($edit){ echo esc_attr($result->user_email);}elseif(isset($_POST['email'])) echo $_POST['email'];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="mobile"><?php esc_html_e('Mobile Number','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-1">
							
							<input type="text" readonly value="+<?php echo MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' ));?>"  class="form-control" name="phonecode">
							</div>
							<div class="col-sm-7">
								<input id="mobile" class="form-control validate[required,custom[phone]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;"  name="mobile" value="<?php if($edit){ echo esc_attr($result->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
							</div>
						</div>
					</div>
					<!--LOGIN INFORMATION---->
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="username"><?php esc_html_e('User Name','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-8">
								<input id="username" class="form-control validate[required]" type="text" maxlength="30"  name="username" 
								value="<?php if($edit){ echo esc_attr($result->user_login);}elseif(isset($_POST['username'])) echo esc_attr($_POST['username']);?>" <?php if($edit) echo "readonly";?>>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="password"><?php esc_html_e('Password','apartment_mgt');?><?php if(!$edit) {?><span class="require-field">*</span><?php }?></label>
							<div class="col-sm-8">
								<input id="password" class="form-control <?php if(!$edit) echo 'validate[required]';?>" type="password"  name="password" minlength="8" maxlength="12" value="">
							</div>
						</div>
					</div>	
					
                    <!--MEMBER IMAGE---->					
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Member Image','apartment_mgt');?></label>
							<div class="col-sm-2">
								<input type="text" id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
								value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['amgt_user_avatar'])) echo $_POST['amgt_user_avatar']; ?>" readonly />
								
							</div>	
							<div class="col-sm-3 margin_top_10_res">
									 <input id="upload_user_avatar" class="image-preview-show" name="upload_user_avatar_image"  onchange="member_imgefileCheck(this);" type="file" />
								</div>
							<div class="clearfix"></div>
							
							<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<div id="upload_user_avatar_preview" >
									<?php 
									if($edit) 
										{
										$upload_image = $result->amgt_user_avatar;
										if($upload_image == "")
										{?>
										<img class="user_image" alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
										<?php }
										else {
											?>
										<img class="user_image" src="<?php if($edit)echo esc_url( $result->amgt_user_avatar ); ?>" />
										<?php 
										}
										}
										else {
											?>
											<img class="user_image" alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
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
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Member ID Proof-1','apartment_mgt');?></label>
							<div class="col-sm-4">
								<input type="hidden" name="hidden_id_proof_1" value="<?php if($edit){ echo $result->id_proof_1;}elseif(isset($_POST['id_proof_1'])) echo $_POST['id_proof_1'];?>">
								<input onchange="fileCheck(this);" name="id_proof_1"  value="" type="file"/>
							</div>
							<div class="col-sm-2">
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
							<div class="col-sm-4">
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
							<div class="col-sm-4">
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
							<div class="col-sm-4">
								<input  onchange="fileCheck(this);" name="id_proof_2"  type="file"/>
							</div>
						</div>
					</div>
					<?php
					}	
					?>		
					<div class="add_member_btn offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add Member','apartment_mgt');}?>" name="save_member" class="btn btn-success"/>
					</div>		
					</form>		
					</div>
					<!--END MODAL BODY -->

					<div class="modal-footer"><!--MODAL FOOTER -->
					  <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php esc_html_e('Close','apartment_mgt');?></button>
					</div>
				  </div>
				</div>
			  </div> 
 
  
  
  <div class="modal fade show overflow_scroll" id="myModal_add_building" tabindex="-1" aria-labelledby="myModal_add_building" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><?php esc_html_e('Add Building','apartment_mgt');?></h3>
		  <button type="button" class="close btn-close show_member_form" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <script type="text/javascript">
		$(document).ready(function() {
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
		<form name="unit_form"  method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" class="form-horizontal" id="unit_form">
		<input id="" type="hidden" name="action" value="MJ_amgt_add_unit_popup">
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
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
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-sm-8">
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
				<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="unit_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
			</div>
		</div>
		<?php 
			   if(isset($_POST['unit_names'])){
					$all_data=$obj_units->MJ_amgt_get_entry_records($_POST);
					$all_entry=json_decode($all_data);
				}
			   ?>
				<div id="unit_name_entry">
						<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_entry"><?php esc_html_e('Unit Name','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-2">
								<input class="form-control validate[required] text-input onlyletter_number_space_validation unit_name" type="text" value="" name="unit_names[]" placeholder="<?php esc_html_e('Unit Name','apartment_mgt');?>">
							</div>
							<?php $unit_measerment_type=get_option( 'amgt_unit_measerment_type' );?>
							<label class="col-sm-3 control-label" for="unit_entry"><?php esc_html_e('Unit Size','apartment_mgt');?>(<?php 
							
							if($unit_measerment_type =='square_meter')
							{
								echo esc_html_e('square meter','apartment_mgt');
							}
							else
							{
								echo esc_attr($unit_measerment_type);
							}
							?>)</label> 
							<div class="col-sm-2">
								<input  class="form-control text-input" type="number" onKeyPress="if(this.value.length==6) return false;"  min="0" value="" name="unit_size[]" placeholder="<?php esc_html_e('Unit Size','apartment_mgt');?>">
							</div>
							<div class="col-sm-2">
							<button type="button" class="btn btn-danger" onclick="deleteParentElement(this)">
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