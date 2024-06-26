<?php
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
				die;
			}	
		} 
	}
}
$curr_user_id=get_current_user_id();
$obj_apartment=new MJ_amgt_Apartment_management($curr_user_id);
$obj_complaint=new MJ_amgt_Complaint;
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'complaintlist');//COMPLAINLIST
//----------------- SAVE COMPLIANT ---------------------//
if(isset($_POST['save_complaint']))		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
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
					wp_redirect ( home_url().'?apartment-dashboard=user&page=complaint&tab=complaintlist&message=2');
				}
			}
			else
			{
				
				$result=$obj_complaint->MJ_amgt_add_complaint($_POST,$file_name);
				if($result)
				{
					wp_redirect ( home_url().'?apartment-dashboard=user&page=complaint&tab=complaintlist&message=1');
				}
			}
		}
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
	{
		$result=$obj_complaint->MJ_amgt_delete_comlaint($_REQUEST['complaint_id']);
		if($result)
		{
			wp_redirect ( home_url().'?apartment-dashboard=user&page=complaint&tab=complaintlist&message=3');
		}
	}

    if(isset($_REQUEST['message']))//MESSAGES
	{
		$message =$_REQUEST['message'];
		if($message == 1)
		{?>
			<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
				<?php
				esc_html_e('Complaint inserted successfully','apartment_mgt');
				?>
				<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php 
		}
		elseif($message == 2)
		{?>
			<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
				<?php
				_e("Complaint updated successfully.",'apartment_mgt');
				?>
				<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php 
		}
		elseif($message == 3) 
		{?>
			<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
				<?php
				esc_html_e('Complaint deleted successfully','apartment_mgt');
				?>
				<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php
		}
	}
	?>

<!-- VIEW POPUP CODE -->	
<div class="popup-bg z_index_100000">
    <div class="overlay-content">
      <div class="modal-content">
        <div class="category_list"></div>
	  </div>
    </div> 
</div>
<!-- END POP-UP CODE -->
<div class="panel-body panel-white"><!-- PANEL BODY DIV -->
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--TABLIST -->
	  	<li class="<?php if($active_tab=='complaintlist'){?>active<?php }?>">
			<a href="?apartment-dashboard=user&page=complaint&tab=complaintlist" class="nav-link px-3 tab <?php echo esc_html($active_tab) == 'complaintlist' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php esc_html_e('Complaint List', 'apartment_mgt'); ?></a>
          </a>
        </li>
       <li class="<?php if($active_tab=='addcomplaint'){?>active<?php }?>">
		  <?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' && isset($_REQUEST['complaint_id']))
			{ ?>
			<a href="?apartment-dashboard=user&page=complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo $_REQUEST['complaint_id'];?>" class="nav-link px-3 nav-tab <?php echo esc_html($active_tab) == 'addcomplaint' ? 'nav-tab-active' : ''; ?>">
             <i class="fa fa"></i> <?php esc_html_e('Edit Complaint', 'apartment_mgt'); ?></a>
			 <?php }
			else
			{
				if($user_access['add']=='1')
				{ ?>
					<a href="?apartment-dashboard=user&page=complaint&tab=addcomplaint" class="nav-link px-3 tab margin_top_10_res <?php echo esc_html($active_tab) == 'addcomplaint' ? 'active' : ''; ?>">
					<i class="fa fa-plus-circle"></i> <?php esc_html_e('Add Complaint', 'apartment_mgt'); ?></a>
	  <?php 	} 
			}?>
	    </li>
	 
    </ul>
	<div class="tab-content"><!-- TAB CONTENT-->
	<?php if($active_tab == 'complaintlist')
	{ ?>
		<script type="text/javascript">
		$(document).ready(function() {
			"use strict";
			jQuery('#complaint_list').DataTable({
				"responsive": true,
				"order": [[ 0, "asc" ]],
				"aoColumns":[
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
		</script>
    	<div class="panel-body"><!--PANEL BODY-->
        	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
			    <table id="complaint_list" class="display" cellspacing="0" width="100%">
				    <thead>
						<tr>
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
						$user_id=get_current_user_id();
						//--- Complain DATA FOR MEMBER  ------//
						if($obj_apartment->role=='member')
						{
							$own_data=$user_access['own_data'];
							if($own_data == '1')
							{
								$complaintsdata=$obj_complaint->MJ_amgt_get_own_created_complaints($user_id);
							}
							else
							{
								$complaintsdata=$obj_complaint->MJ_amgt_get_all_complaints();
							}
						} 
						//--- Complain DATA FOR STAFF MEMBER  ------//
						elseif($obj_apartment->role=='staff_member')
						{
							$own_data=$user_access['own_data'];
							if($own_data == '1')
							{  
								$complaintsdata=$obj_complaint->MJ_amgt_get_own_created_complaints($user_id);
							}
							else
							{
								$complaintsdata=$obj_complaint->MJ_amgt_get_all_complaints();
							}
						}
						//--- Complain DATA FOR ACCOUNTANT  ------//
						elseif($obj_apartment->role=='accountant')
						{
							$own_data=$user_access['own_data'];
							if($own_data == '1')
							{ 
								$complaintsdata=$obj_complaint->MJ_amgt_get_own_created_complaints($user_id);
							}
							else
							{
								$complaintsdata=$obj_complaint->MJ_amgt_get_all_complaints();
							}
						}
						//--- Complain DATA FOR GATEKEEPER  ------//
						else
						{
							$own_data=$user_access['own_data'];
							if($own_data == '1')
							{ 
								$complaintsdata=$obj_complaint->MJ_amgt_get_own_created_complaints($user_id);
							}
							else
							{
								$complaintsdata=$obj_complaint->MJ_amgt_get_all_complaints();
							}
						}
						
						if(!empty($complaintsdata))
						{
							foreach ($complaintsdata as $retrieved_data)
							{ ?>
								<tr>
									<td class="nature"> <?php if($obj_apartment->role=='staff_member'){?>
									<a href="?apartment-dashboard=user&page=complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo esc_attr($retrieved_data->id);?>">
									<?php }
										else
										{ ?>
										<a href="#">
									<?php } 
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
									
									?></a></td>
									<td class="title"><?php echo esc_html(wp_trim_words( $retrieved_data->complain_title,5));?></td>		
									<td class="created_by"><?php $user=get_userdata($retrieved_data->created_by); echo esc_html(ucfirst($user->display_name));?></td>
									
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
										<td class="status"><?php echo esc_html(ucfirst($retrieved_data->time));?></td>
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
									    <td class="status"><?php echo $status; ?></td>
									     <td class="description"><?php echo esc_html(wp_trim_words( $retrieved_data->complaint_description,5));?></td>
									        <?php if(empty($retrieved_data->resolution))
											{ ?>
												<td class="resoltion"><?php echo "-";?></td>
											<?php
											} else
											{
											?>
											<td class="resoltion"><?php echo esc_html(wp_trim_words( $retrieved_data->resolution,5));?></td> <?php 
											} ?>
									<td class="action">
										<a href="#" class="btn btn-primary view-complaint" id="<?php echo $retrieved_data->id;?>"> <?php esc_html_e('View','apartment_mgt');?></a>
									<?php
									if($user_access['edit']=='1')
									{  ?>
										<a href="?apartment-dashboard=user&page=complaint&tab=addcomplaint&action=edit&complaint_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
									<?php
									}
									if($user_access['delete']=='1')
									{
									?>
										<a href="?apartment-dashboard=user&page=complaint&tab=Activitylist&action=delete&complaint_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
										<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
									<?php
									}
									?>
									 <?php if($retrieved_data->complain_doc!='') { ?>
										<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$retrieved_data->complain_doc;?>" class="btn btn-default"> <i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> </a>
										<?php } ?>
									</td>
								</tr>
								<?php 
							} 
							
						}?>
					</tbody>
			    </table>
            </div><!---END TABLE-RESPONSIVE--->
        </div><!--END PANEL BODY-->
		<?php 
	} ?>
        <?php 
			if($active_tab == 'addcomplaint')
			{ 
				require_once AMS_PLUGIN_DIR.'/template/complaint/add_complain.php' ;
		    }
		?> 
	</div>
</div><!-- END PANEL BODY DIV -->
<?php ?>