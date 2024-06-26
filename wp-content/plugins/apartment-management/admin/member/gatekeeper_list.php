<?php 
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'gatekeeperlist');
?>
<!-- POP UP CODE -->
<div class="popup-bg z_index_100000">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"> </div>
		</div>
    </div>    
</div>
<!-- END POP-UP CODE -->

<script type="text/javascript">
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

<?php 
	//export Getekeeper in csv
	if(isset($_POST['export_csv']))
	{		
		$getekeeper_list = get_users(array('role'=>'gatekeeper'));
		// var_dump($getekeeper_list);
		// die;
		if(!empty($getekeeper_list))
		{
			$header = array();	
			$header[] = 'username';
			$header[] = 'email';
			$header[] = 'password';			
			$header[] = 'first_name';
			$header[] = 'middle_name';
			$header[] = 'last_name';			
			$header[] = 'gender';
			$header[] = 'birth_date';
			$header[] = 'display_name';
			$header[] = 'address';
			$header[] = 'city_name';
			$header[] = 'state_name';
			$header[] = 'country_name';
			$header[] = 'zipcode';
		
			
			
			$document_dir = WP_CONTENT_DIR;
			$document_dir .= '/uploads/export/';
			$document_path = $document_dir;
			if (!file_exists($document_path))
			{
				mkdir($document_path, 0777, true);		
			}
			
			$filename=$document_path.'export_getekeeper.csv';
			$fh = fopen($filename, 'w') or die("can't open file");
			fputcsv($fh, $header);
			foreach($getekeeper_list as $retrive_data)
			{
			
				$row = array();
				$user_info = get_userdata($retrive_data->ID);
			
				$row[] = $user_info->user_login;
				$row[] = $user_info->user_email;			
				$row[] = $user_info->user_pass;	
				
				$row[] =  get_user_meta($retrive_data->ID, 'first_name',true);
				
				$row[] =  get_user_meta($retrive_data->ID, 'middle_name',true);
				$row[] =  get_user_meta($retrive_data->ID, 'last_name',true);
				$row[] =  get_user_meta($retrive_data->ID, 'gender',true);
				$row[] =  get_user_meta($retrive_data->ID, 'birth_date',true);	
				$row[] = $user_info->display_name;
				// $row[] =  get_user_meta($retrive_data->ID, 'display_name',true);							
				$row[] =  get_user_meta($retrive_data->ID, 'address',true);				
				$row[] =  get_user_meta($retrive_data->ID, 'city_name',true);				
				$row[] =  get_user_meta($retrive_data->ID, 'state_name',true);				
				$row[] =  get_user_meta($retrive_data->ID, 'country_name',true);
				$row[] =$user_info->zipcode;				
						
				
				fputcsv($fh, $row);
				
			}
			fclose($fh);
	
			//download csv file.
			ob_clean();
			$file=$document_path.'export_getekeeper.csv';//file location
			
			$mime = 'text/plain';
			header('Content-Type:application/force-download');
			header('Pragma: public');       // required
			header('Expires: 0');           // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Content-Transfer-Encoding: binary');			
			header('Connection: close');
			readfile($file);		
			exit;				
		}
		else
		{
			?>
			<div class="alert_msg alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<?php esc_html_e('Records not found.','hospital_mgt');?>
			</div>
			<?php	
		}		
	}
?>
<!-- PAGE INNER DIV -->

<?php


if(isset($_REQUEST['delete_selected2']))
{		
	if(!empty($_REQUEST['selected_id']))
	{
		
		foreach($_REQUEST['selected_id'] as $id)
		{
			$result=$obj_member->MJ_amgt_delete_all_user($id);
		
		}
		if($result) 
		{
			wp_redirect ( admin_url() . 'admin.php?page=amgt-member&tab=gatekeeperlist&message=7');
		}
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("'.esc_html__('Please select at least one record.','apartment_mgt').'")';
		echo '</script>';
	}

}

?>

<?php 
			//gatekeeperlist TAB
			if($active_tab == 'gatekeeperlist')
			{ ?>	
			<script type="text/javascript">
				$(document).ready(function() 
				{
					"use strict";
					jQuery('#member_list').DataTable(
					{
						"responsive":true,
						// "order": [[ 1, "asc" ]],
						"aoColumns":[
									  {"bSortable": false},
									  {"bSortable": false},
									  {"bSortable": true},
									  {"bSortable": true},
									  {"bSortable": true},
									   {"bSortable": true},
									  {"bSortable": false}],
									  language:<?php echo MJ_amgt_datatable_multi_language();?>
					});
				} );
				</script>
					<form name="member_form" action="" method="post">
						<div class="panel-body"><!--PANEL BODY-->
						<input type="submit" value="<?php esc_html_e('Export CSV','apartment_mgt');?>" name="export_csv" class="btn btn-success margin_bottom_5px"/>
					 
							<div class="table-responsive"><!--TABLE RESPONSIVE-->
								<table id="member_list" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
										  <th><input type="checkbox" id="select_all"></th>
										  <th><?php  esc_html_e('Photo', 'apartment_mgt' ) ;?></th>
										  <th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
										  <th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
										  <th> <?php esc_html_e('Mobile', 'apartment_mgt' ) ;?></th>
										   <th><?php esc_html_e('Assigned Gate', 'apartment_mgt' ) ;?></th>
										  <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th> 
										</tr>
									</thead>
									<tfoot>
										<tr>
										    <th></th>
											<th><?php  esc_html_e('Photo', 'apartment_mgt' ) ;?></th>
											<th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
											<th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
											<th> <?php esc_html_e('Mobile', 'apartment_mgt' ) ;?></th>
											<th><?php esc_html_e('Assigned Gate', 'apartment_mgt' ) ;?></th>
											<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
										</tr>
									   
									</tfoot>
									<tbody>
										<?php 
										
										$get_gatekeeper = array('role' => 'gatekeeper','order' => 'DESC');								
										$membersdata =get_users($get_gatekeeper);
										
										if(!empty($membersdata))
										{
											foreach ($membersdata as $retrieved_data)
											{
												$building_name=get_the_title($retrieved_data->building_id);
												$role=MJ_amgt_get_user_role($retrieved_data->ID);
												if($role == 'member')
												{
													$page='member';
												}
												else if($role == 'staff_member')
												{
													$page='staff-Member';
												}
												else if($role == 'accountant')
												{
													$page='accountant';
												}
												
												else if($role == 'gatekeeper')
												{
													$page='gatekeeper';
												}
												?>
											<tr>
												<td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
												<td class="user_image"><?php $uid=$retrieved_data->ID;
															$userimage=get_user_meta($uid, 'amgt_user_avatar', true);
														if(empty($userimage))
														{
															echo '<img src='.esc_url(get_option( 'amgt_system_logo' )).' height="50px" width="50px" class="img-circle" />';
														}
														else
															echo '<img src='.esc_url($userimage).' height="50px" width="50px" class="img-circle"/>';
												?></td>
											   
												<td class="name"><?php echo esc_html($retrieved_data->display_name);?></td>
												<td class=""><?php echo esc_html($retrieved_data->user_email);?></td>
												<td class=""><?php echo esc_html($retrieved_data->mobile);?></td>
												<td class="gate"><?php 
												if(!empty($retrieved_data->aasigned_gate))
												{
													echo esc_html(MJ_amgt_get_gate_name($retrieved_data->aasigned_gate));
												}
												else
												{
													echo "-";
												}
												?></td>												 
												
												<td class="action">
												 <?php 
													   if( get_user_meta($retrieved_data->ID, 'amgt_hash', true))
														{ ?>
														<a  href="?page=amgt-member&action=active_member&member_id=<?php echo $retrieved_data->ID;?>" class="btn btn-default" > <?php esc_html_e('Active', 'apartment_mgt');?></a>
														<?php } ?>
												<a href="?page=amgt-member&tab=viewmember&action=view&member_id=<?php echo esc_attr($retrieved_data->ID);?>" class="btn btn-success"> <?php esc_html_e('View', 'apartment_mgt' ) ;?></a>
												<a href="?page=amgt-member&tab=adduser&action=edit&user_type=<?php echo $page; ?>&member_id=<?php echo esc_attr($retrieved_data->ID);?>"  class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
												<a href="?page=amgt-member&tab=gatekeeperlist&action=delete_gatekeeper&member_id=<?php echo esc_attr($retrieved_data->ID);?>" class="btn btn-danger" 
												onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
												<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
											   
												</td>
											   
											</tr>
											<?php
											} 
										}?>
									</tbody>
								</table>
								<div class="print-button pull-left">
									<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
								</div>
							</div>
						</div><!--END PANEL BODY-->
					</form>

			  <?php 
			}?>