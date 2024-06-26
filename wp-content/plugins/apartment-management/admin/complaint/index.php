<?php
	$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'complaintlist');
	$obj_complaint=new MJ_amgt_Complaint;
?>
<!-- POP UP CODE -->
<div class="popup-bg">
    <div class="overlay-content">
      <div class="modal-content">
        <div class="category_list"></div>
	  </div>
    </div> 
</div>
<!-- End POP-UP Code -->
<!-- View Popup Code -->	
<div class="complaint-popup-bg">
     <div class="overlay-content">
       <div class="complaint_content"></div>    
     </div> 
</div>	
<!-- End POP-UP Code -->
<div class="page-inner min_height_1088">
	<div class="page-title">
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>
<?php 
	if(isset($_POST['save_complaint']))//SAVE_COMPLAINT	
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		$file_name="";
		if (wp_verify_nonce( $nonce, 'save_complaint_nonce' ) )
		{
			if($_FILES['complain_doc']['name'] != "" && $_FILES['complain_doc']['size'] > 0)	
			{
				if($_FILES['complain_doc']['size'] > 0)
				$file_name=MJ_amgt_amgt_load_documets($_FILES['complain_doc'],'complain_doc','complain_doc');
			}
			else
			{
				if(isset($_REQUEST['hidden_complain_doc']))
					$file_name=$_REQUEST['hidden_complain_doc'];
			}
			if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
			{
				$result=$obj_complaint->MJ_amgt_add_complaint($_POST,$file_name);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-complaint&tab=complaintlist&message=2');
				}
			}
			else
			{
				$result=$obj_complaint->MJ_amgt_add_complaint($_POST,$file_name);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-complaint&tab=complaintlist&message=1');
				}
			}
	    }
	}
	  
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')//DELETE_COMPLAINT
		{
			$result=$obj_complaint->MJ_amgt_delete_comlaint($_REQUEST['complaint_id']);
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=amgt-complaint&tab=complaintlist&message=3');
			}
		}

		if(isset($_REQUEST['delete_selected2']))
		{		
			if(isset($_REQUEST['selected_id']))
			{	
				foreach($_REQUEST['selected_id'] as $id)
				{
					$result=$obj_complaint->MJ_amgt_delete_comlaint($id);
				
				}
				if($result) 
				{
					wp_redirect ( admin_url() . 'admin.php?page=amgt-complaint&tab=complaintlist&message=3');
				}
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("'.esc_html__('Please select at least one record.','apartment_mgt').'")';
				echo '</script>';
			}
		
		}
		if(isset($_REQUEST['message']))//MESSAGES
	     {
			$message =$_REQUEST['message'];
			if($message == 1)
			{?>
					<div id="message" class="updated below-h2 notice is-dismissible">
					<p>
					<?php 
						esc_html_e('Complaint inserted successfully','apartment_mgt');
					?></p></div>
					<?php
				
			}
			elseif($message == 2)
			{?><div id="message" class="updated below-h2 notice is-dismissible"><p><?php
						esc_html_e("Complaint updated successfully.",'apartment_mgt');
						?></p>
						</div>
					<?php 
				
			}
			elseif($message == 3) 
			{?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
			<?php 
				esc_html_e('Complaint deleted successfully','apartment_mgt');
			?></div></p><?php
					
			}
	    }?>
	<div id="main-wrapper"><!--MAIN WRAPPER-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!--PANEL-WHITE-->
					<div class="panel-body"><!--PANEL BODY-->
					        <!--NAV-TAB-WRAPPER-->
							<h2 class="nav-tab-wrapper">
								<a href="?page=amgt-complaint&tab=complaintlist" class="nav-tab <?php echo esc_html($active_tab) == 'complaintlist' ? 'nav-tab-active' : ''; ?>">
								<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Complaint List', 'apartment_mgt'); ?></a>
								
								<?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
								{ ?>
								<a href="?page=amgt-complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo $_REQUEST['complaint_id'];?>" class="nav-tab <?php echo esc_html($active_tab) == 'addcomplaint' ? 'nav-tab-active' : ''; ?>">
								<?php esc_html_e('Edit Complaint', 'apartment_mgt'); ?></a>  
								<?php 
								}
								else 
								{ ?>
									<a href="?page=amgt-complaint&tab=addcomplaint" class="nav-tab <?php echo esc_html($active_tab) == 'addcomplaint' ? 'nav-tab-active' : ''; ?>">
								<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Add Complaint', 'apartment_mgt'); ?></a>
								<?php  }?>
							</h2><!--END NAV-TAB-WRAPPER-->
							 <?php 
							//COMPLAINLIST TAB
							if($active_tab == 'complaintlist')
							{ ?>
							<script type="text/javascript">
						    $(document).ready(function() {
								"use strict";
							jQuery('#complaint_list').DataTable({
								"responsive": true,
								"order": [[ 0, "asc" ]],
								"aoColumns":[
											  {"bSortable": false},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": true},
											  {"bSortable": false}],
											  language:<?php echo MJ_amgt_datatable_multi_language();?>
								});
						} );

							$(document).ready(function()
							{	
								"use strict";
								jQuery('#select_all').on('click', function(e)
								{
									if($(this).is(':checked',true))  
									{
										$(".sub_chk").prop('checked', true);  
									}  
									else  
									{  
										$(".sub_chk").prop('checked',false);  
									} 
								});
								$("body").on("change",".sub_chk",function(){
									if(false == $(this).prop("checked"))
									{ 
										$("#select_all").prop('checked', false); 
									}
									if ($('.sub_chk:checked').length == $('.sub_chk').length )
									{
										$("#select_all").prop('checked', true);
									}
								});
							});
						</script>
							<form name="activity_form" action="" method="post">
								<div class="panel-body"><!--PANEL BODY-->
									<div class="table-responsive"><!---TABLE-RESPONSIVE--->
									   <!------COMPLAINT_LIST TABLE-------->
									   <table id="complaint_list" class="display" cellspacing="0" width="100%">
										  <thead>
												<tr>
													<th><input type="checkbox" id="select_all"></th>
													<th><?php esc_html_e('Nature', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Title', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Created By', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Date', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Time', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Description', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Resolution', 'apartment_mgt' ) ;?></th>
													<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
										   </thead>
											<tfoot>
												<tr>
													<th></th>
													<th><?php esc_html_e('Nature', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Title', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Created By', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Date', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Time', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Description', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Resolution', 'apartment_mgt' ) ;?></th>
													<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
											</tfoot>
											 <tbody>
											  <?php 
											  $complaintsdata=$obj_complaint->MJ_amgt_get_all_complaints();
											  if(!empty($complaintsdata))
											   {
												 foreach ($complaintsdata as $retrieved_data){
												
													 ?>
													<tr>
														<td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
														<td class="nature"><a href="?page=amgt-complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo esc_attr($retrieved_data->id);?>">
														<?php 
														if($retrieved_data->complaint_nature == "complaint")
														{
															echo esc_html_e('Complaint','apartment_mgt' );
														}
														elseif($retrieved_data->complaint_nature == "suggestion")
														{
															echo esc_html_e('Suggestion','apartment_mgt');
														}
														elseif($retrieved_data->complaint_nature == "request")
														{
															echo esc_html_e('Request','apartment_mgt');
														}
														elseif($retrieved_data->complaint_nature == "Maintenance Request")
														{
															echo esc_html_e('Maintenance Request','apartment_mgt');
														}
														?>
														</a></td>
									                   	<td class="title"><?php echo esc_html(wp_trim_words( $retrieved_data->complain_title,5));?></td>				
														
														<td class="created_by"><?php $user=get_userdata($retrieved_data->created_by); 
														if(!empty($user->display_name))
														{
															echo esc_html(ucfirst($user->display_name));
														}
														else
														{
															echo "-";
														}
														
														?></td>
														<?php if($retrieved_data->complaint_nature == 'maintenance_request')
														{ 
													?>
															<td class="end_date"><?php if($retrieved_data->date!="0000-00-00" && "00/00/0000" && "00/00/0000"){ echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->date))); }else{ echo "-"; } ;?></td>
															<?php 	
													    } 
													else
													{
													?>
														<td class="end_date"><?php if($retrieved_data->complain_date!="0000-00-00" && "00/00/0000" && "00/00/0000"){ echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->complain_date))); }else{ echo "-"; } ;?></td>
													<?php
													}
													?>
													<td class="status"><?php echo ucfirst($retrieved_data->time);?></td>
														<?php
														if($retrieved_data->complaint_status == 'open')
														{
															$status=esc_html__('Open', 'apartment_mgt' );
														}
														else if($retrieved_data->complaint_status == 'close')
														{
															$status=esc_html__('Closed', 'apartment_mgt' );
														}
														else if($retrieved_data->complaint_status == 'on_hold')
														{
															$status=esc_html__('On Hold', 'apartment_mgt' );
														}
														elseif($retrieved_data->complaint_status == 'scheduled')
														{
															$status=esc_html__('Scheduled', 'apartment_mgt' );
														} 
														else
														{
															$status="-";
														}
														?>
														<td class="status"><?php echo $status?></td>
														<td class="description"><?php echo esc_html(wp_trim_words( $retrieved_data->complaint_description,5));?></td>
														<?php if(empty($retrieved_data->resolution))
														{ ?>
															<td class="resoltion"><?php echo "-";?></td>
														<?php } else{ ?>
														<td class="resoltion"><?php echo wp_trim_words( $retrieved_data->resolution,5);?></td> <?php } ?>
														<td class="action">
															<a href="#" class="btn btn-primary view-complaint" id="<?php echo esc_attr($retrieved_data->id);?>"> <?php esc_html_e('View','apartment_mgt');?></a>
															<a href=	"?page=amgt-complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
															<a href="?page=amgt-complaint&tab=Activitylist&action=delete&complaint_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
														   onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
														   <?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
														   <?php if($retrieved_data->complain_doc!='') { ?>
															<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$retrieved_data->complain_doc;?>" class="btn btn-default"> <i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
															<?php } ?>
														</td>
												   
													</tr>
												 <?php } 
												
												}?>
										 
											</tbody>
										 </table>
										 <div class="print-button pull-left">
											<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
										</div>
									</div><!---END TABLE-RESPONSIVE--->
								</div><!--END PANEL BODY-->
							</form>
                       <?php }
						if($active_tab == 'addcomplaint')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/complaint/add_complaint.php';
						 }
						 ?>
                    </div><!--END PANEL BODY-->
	            </div><!--END PANEL-WHITE-->
	        </div>
        </div>
    </div><!--END MAIN WRAPPER-->
</div>