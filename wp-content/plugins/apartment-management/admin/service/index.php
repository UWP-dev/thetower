<?php 
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'service-list');
$obj_service =new MJ_amgt_Service;
?>
<!-- POP UP CODE -->
<div class="popup-bg">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"> </div>
		</div>
    </div> 
</div>
<!-- END POP-UP CODE -->
<div class="page-inner min_height_1088">
	<div class="page-title">
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>
<?php 
	if(isset($_POST['save_service']))//SAVE SERVICE		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_service_nonce' ) )
		{		
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{				
			$result=$obj_service->MJ_amgt_add_service($_POST);		
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=amgt-service-mgt&tab=service-list&message=2');
			}
		}
		else
		{			
			$result=$obj_service->MJ_amgt_add_service($_POST);
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=amgt-service-mgt&tab=service-list&message=1');
			}
		}
	}
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')//DELETE SERVICE
	{
				
		$result=$obj_service->MJ_amgt_delete_service($_REQUEST['service_id']);
		if($result)
		{
			wp_redirect ( admin_url().'admin.php?page=amgt-service-mgt&tab=service-list&message=3');
		}
	}

	if(isset($_REQUEST['delete_selected2']))
		{		
			if(isset($_REQUEST['selected_id']))
			{	
				foreach($_REQUEST['selected_id'] as $id)
				{
					$result=$obj_service->MJ_amgt_delete_service($id);
				
				}
				if($result) 
				{
					wp_redirect ( admin_url() . 'admin.php?page=amgt-service-mgt&tab=service-list&message=3');
				}
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("'.esc_html__('Please select at least one record.','apartment_mgt').'")';
				echo '</script>';
			}
		
		}
	if(isset($_REQUEST['message']))//MESSAGE
	{
		$message =$_REQUEST['message'];
		if($message == 1)
		{ ?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php esc_html_e('Service inserted successfully','apartment_mgt'); ?>
			</p></div>
		<?php 			
		}
		elseif($message == 2){ ?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
			<?php esc_html_e("Service updated successfully.",'apartment_mgt');?></p></div>
		<?php 			
		}
		elseif($message == 3) { ?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 	esc_html_e('Service deleted successfully','apartment_mgt');?>
			</p></div>
		<?php				
		}
	}
	?>
	<div id="main-wrapper"><!-- MAIN WRAPPER -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!-- PANEL WHITE -->
					<div class="panel-body"><!--PANEL BODY-->
						<h2 class="nav-tab-wrapper"><!--NAV TAB WRAPPER-->
							<a href="?page=amgt-service-mgt&tab=service-list" 
							class="nav-tab <?php echo esc_html($active_tab) == 'service-list' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Service List', 'apartment_mgt'); ?></a>
							
							<?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
							{ ?>
							<a href="?page=amgt-service-mgt&tab=add_service&action=edit&service_id=<?php echo $_REQUEST['service_id'];?>" class="nav-tab <?php echo esc_html($active_tab) == 'add_service' ? 'nav-tab-active' : ''; ?>">
							<?php esc_html_e('Edit Service', 'apartment_mgt'); ?></a>  
							<?php 
							}
							else 
							{ ?>
								<a href="?page=amgt-service-mgt&tab=add_service" class="nav-tab <?php echo esc_html($active_tab) == 'add_service' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Add Service', 'apartment_mgt'); ?></a>
							<?php 
							}?>
						</h2><!--END NAV TAB WRAPPER-->
						<?php 
                        //SERVICE LIST TAB					
						if($active_tab == 'service-list')
						{ ?>	
						<script type="text/javascript">
						$(document).ready(function() {
							"use strict";
							jQuery('#service_list').DataTable({
								"responsive":true,
								"order": [[ 1, "asc" ]],
								"aoColumns":[
									{"bSortable": false},
									{"bSortable": false},
									{"bSortable": true},
									{"bSortable": true},
									{"bSortable": true},
									{"bSortable": true},
									{"bSortable": true},
									{"bSortable": false}],
									language:<?php echo MJ_amgt_datatable_multi_language();?>
								});
						});

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
							<form name="member_form" action="" method="post"><!--MEMBER FORM-->
								<div class="panel-body"><!--PANEL BODY-->
									<div class="table-responsive"><!---TABLE-RESPONSIVE--->
										<table id="service_list" class="display" cellspacing="0" width="100%">
										    <thead>
												<tr>
												  <th><input type="checkbox" id="select_all"></th>
												  <th><?php  esc_html_e('Service Name', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Service Provider', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Contact Number', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Mobile Number', 'apartment_mgt' ) ;?></th>
												  <th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
												  <th> <?php esc_html_e('Address', 'apartment_mgt' ) ;?></th>
												  <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
										    </thead>
											<tfoot>
												<tr>
												  <th></th>
												  <th><?php  esc_html_e('Service Name', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Service Provider', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Contact Number', 'apartment_mgt' ) ;?></th>
												   <th><?php esc_html_e('Mobile Number', 'apartment_mgt' ) ;?></th>
												  <th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
												  <th> <?php esc_html_e('Address', 'apartment_mgt' ) ;?></th>
												  <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
											</tfoot>
										<tbody>
										<?php 
										$service_data= $obj_service->MJ_amgt_get_all_service();
										if(!empty($service_data))
										{
											foreach ($service_data as $retrieved_data)
											{ ?>
											<tr>
												  <td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->service_id); ?>"></td>
												  <td class="service_name"><?php echo esc_html($retrieved_data->service_name);?></td>
												  <td class="service_name"><?php echo esc_html($retrieved_data->service_provider);?></td>
												  <td class="service_name"><?php echo esc_html($retrieved_data->contact_number);?></td>
												  <td class="service_name"><?php echo esc_html($retrieved_data->mobile_number);?></td>
												  <td class="service_name"><?php echo esc_html($retrieved_data->email);?></td>
												  <td class="service_name"><?php echo esc_html(wp_trim_words($retrieved_data->address,5));?></td>
												  <td class="action">
													<a href="?page=amgt-service-mgt&tab=add_service&action=edit&service_id=<?php echo esc_attr($retrieved_data->service_id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
													<a href="?page=amgt-service-mgt&tab=service-list&action=delete&service_id=<?php echo esc_attr($retrieved_data->service_id);?>" class="btn btn-danger" 
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
								</div><!---END TABLE-RESPONSIVE--->
								</div><!--END PANEL BODY-->
							   
						</form><!--END MEMBER FORM-->
							 <?php 
							 }
							//ADD SERVICE TAB
							if($active_tab == 'add_service')
							{		
								require_once AMS_PLUGIN_DIR.'/admin/service/add_service.php';
						} ?>
				</div>		
          </div><!-- END PANEL WHITE -->	
	  </div>
	</div>
</div><!-- END MAIN WRAPPER -->