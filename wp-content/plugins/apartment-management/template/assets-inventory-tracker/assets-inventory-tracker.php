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
$obj_assets=new MJ_amgt_AssetsInventory;
$obj_facility =new MJ_amgt_Facility; 
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'assets_list');
if(isset($_POST['save_assets']))//SAVE ASSETS		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_assets_nonce' ) )
		{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
			$result=$obj_assets->MJ_amgt_add_assets($_POST);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=assets_list&message=2');
			}
		}
		else
		{
			$result=$obj_assets->MJ_amgt_add_assets($_POST);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=assets_list&message=1');
			}
		}
	}
	}
	if(isset($_POST['save_inventory']))	//SAVE_INVENTORY	
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_inventory_nonce' ) )
		{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
			$result=$obj_assets->MJ_amgt_add_inventory($_POST);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=inventory_list&message=5');
			}
		}
		else
		{
			$result=$obj_assets->MJ_amgt_add_inventory($_POST);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=inventory_list&message=4');
			}
		}
		}
    }
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')//DELETE ASSETS
	{
		if(isset($_REQUEST['assets_id'])){
			$result=$obj_assets->MJ_amgt_delete_assets($_REQUEST['assets_id']);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=assets_list&message=3');
			}
		}
		if(isset($_REQUEST['inventory_id'])){
			$result=$obj_assets->MJ_amgt_delete_inventory($_REQUEST['inventory_id']);
			if($result)
			{
				wp_redirect ( home_url().'?apartment-dashboard=user&page=assets-inventory-tracker&tab=inventory_list&message=3');
			}
		}
		
	}	
		
	if(isset($_REQUEST['message']))
	{
		$message =$_REQUEST['message'];
		if($message == 1)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
					esc_html_e('Asset inserted successfully','apartment_mgt');
					?>
					<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
		    }
			elseif($message == 2)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
					_e("Asset updated successfully.",'apartment_mgt');
					?>
					<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
					<?php 
			}
			elseif($message == 3) 
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
					esc_html_e('Record deleted successfully','apartment_mgt');
					?>
					<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
			}
			if($message == 4)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					
					<?php
					esc_html_e('Inventory inserted successfully','apartment_mgt');
					?>
					<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
		    }
			elseif($message == 5)
			{?>
				<div id="message_template" class="alert_msg alert alert-success alert-dismissible" role="alert">
					<?php
					_e("Inventory updated successfully.",'apartment_mgt');
					?>
					<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php 
			}
	}
	?>
<!-- POP UP CODE -->
<div class="popup-bg">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"></div>
		</div>
    </div> 
</div>
<!-- END POP-UP CODE -->
<div class="panel-body panel-white"><!--  PANEL BODY DIV   --> 
	<ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
			<li class="<?php if($active_tab=='assets_list'){?>active<?php }?>">
				<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=assets_list" class="nav-link px-3 tab <?php echo esc_html($active_tab) == 'assets_list' ? 'active' : ''; ?>">
				 <i class="fa fa-align-justify"></i> <?php esc_html_e('Asset List', 'apartment_mgt'); ?></a>
			  </a>
		  </li>
		
		   <li class="<?php if($active_tab=='add_assets'){?>active<?php }?>">
			  <?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' && isset($_REQUEST['assets_id']))
				{ ?>
				<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_assets&action=edit&assets_id=<?php echo $_REQUEST['assets_id'];?>" class="nav-link px-3 nav-tab <?php echo esc_html($active_tab) == 'visitor-checkin' ? 'nav-tab-active' : ''; ?>">
				 <i class="fa fa"></i> <?php esc_html_e('Edit Asset', 'apartment_mgt'); ?></a>
				 <?php }
				else
				{ 
					if($user_access['add']=='1')
					{?>
						<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_assets" class="nav-link px-3 tab <?php echo esc_html($active_tab) 	== 'add_assets' ? 'active' : ''; ?>">
						<i class="fa fa-plus-circle"></i> <?php esc_html_e('Add Asset', 'apartment_mgt'); ?></a>
				<?php
					}
				}
				?>
			</li>
		<li class="<?php if($active_tab=='inventory_list'){?>active<?php }?>">
				<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=inventory_list" class="nav-link px-3 tab margin_top_10_res <?php echo esc_html($active_tab) == 'inventory_list' ? 'active' : ''; ?>">
				 <i class="fa fa-align-justify"></i> <?php esc_html_e('Inventory List', 'apartment_mgt'); ?></a>
			  </a>
		  </li>
		   <li class="<?php if($active_tab=='add_inventory'){?>active<?php }?>">
			  <?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' && isset($_REQUEST['inventory_id']))
				{ ?>
				<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_inventory&action=edit&inventory_id=<?php echo $_REQUEST['event_id'];?>" class="nav-link px-3 nav-tab margin_top_10_res <?php echo esc_html($active_tab) == 'add_inventory' ? 'nav-tab-active' : ''; ?>">
				 <i class="fa fa"></i> <?php esc_html_e('Edit Inventory', 'apartment_mgt'); ?></a>
				 <?php }
				else
				{ 
					if($user_access['add']=='1')
					{?>
						<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_inventory" class="nav-link px-3 tab margin_top_10_res <?php echo esc_html($active_tab) == 'add_inventory' ? 'active' : ''; ?>">
						<i class="fa fa-plus-circle"></i> <?php esc_html_e('Add Inventory', 'apartment_mgt'); ?></a>
		  <?php		}
				}?>
			</li>
	</ul>
	<div class="tab-content"><!--  TAB CONTENT DIV   -->
	<?php if($active_tab == 'assets_list')//ASSETS LIST TAB
	{ ?>
		<script type="text/javascript">
		$(document).ready(function() {
			"use strict";
			jQuery('#assets_list').DataTable({
				"responsive": true,
				"order": [[ 0, "asc" ]],
				"aoColumns":[
							  {"bSortable": true},
							  {"bSortable": true},
							  {"bSortable": true},
							  {"bSortable": true},
							  {"bSortable": true},
							  {"bSortable": true},
							  <?php if($obj_apartment->role=='staff_member'){?>
							  {"bSortable": false}<?php } ?>],
							  language:<?php echo MJ_amgt_datatable_multi_language();?>
				});
		} );
		</script>
    	<div class="panel-body"><!--PANEL BODY-->
        	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
				<table id="assets_list" class="display" cellspacing="0" width="100%"><!---ASSETS LIST--->
					 <thead>
						<tr>
							<th><?php esc_html_e('Asset No', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Facility Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Category', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Cost', 'apartment_mgt' ) ;?></th>
							<?php if($obj_apartment->role=='staff_member'){?>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
							<?php } ?>
						</tr>
				    </thead>
					<tfoot>
						<tr>
							 <th><?php esc_html_e('Asset No', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Facility Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Category', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Asset Cost', 'apartment_mgt' ) ;?></th>
							<?php if($obj_apartment->role=='staff_member'){?>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
							<?php } ?>
						</tr>
			        </tfoot>
					<tbody>
						<?php 
						$user_id=get_current_user_id();
						$own_data=$user_access['own_data'];
						if($own_data == '1')
						{ 
							$assetsdata=$obj_assets->MJ_amgt_get_all_assets_created_by($user_id);
						}
						else
						{
							$assetsdata=$obj_assets->MJ_amgt_get_all_assets();
						}
						if(!empty($assetsdata))
						{
							foreach ($assetsdata as $retrieved_data)
							{ ?>
								<tr>
								   
									<td class="name">
									<?php if($obj_apartment->role=='staff_member'){?>
									<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_assets&action=edit&assets_id=<?php echo esc_attr($retrieved_data->id);?>">
									<?php } 
										else
										{ ?> <a href="#">
										<?php } echo esc_html($retrieved_data->assets_no);?></a></td>
									<td class="facility_name"><?php echo esc_html($retrieved_data->location);?></td>
									<td class="assets_name"><?php echo esc_html($retrieved_data->assets_name);?></td>
									<td class="assets_cat"><?php echo esc_html(get_the_title($retrieved_data->assets_cat_id));?></td>
									<td class="assets_cat"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->purchage_date)));?></td>
									<td class="assets_cat"><?php echo esc_html($retrieved_data->assets_cost);?></td>
									<?php if($obj_apartment->role=='staff_member'){ ?>
									<td class="action">
									<?php
									if($user_access['edit']=='1')
									{  ?>
										<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=add_assets&action=edit&assets_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
										
									<?php
									}
									if($user_access['delete']=='1')
									{ ?>
										<a href="?apartment-dashboard=user&page=assets-inventory-tracker&tab=assets_list&action=delete&assets_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
										<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
									<?php 
									} ?>
									</td>
								
								   <?php } ?>
								</tr>
							<?php 
							} 
						}?>
					</tbody>
			    </table><!---END ASSETS LIST--->
            </div><!---END TABLE-RESPONSIVE--->
        </div><!--END PANEL BODY-->
	<?php } ?>
	   <?php 
			if($active_tab == 'add_assets')
			{ 
				require_once AMS_PLUGIN_DIR.'/template/assets-inventory-tracker/add_asset.php' ;
		    }
	        if($active_tab == 'inventory_list')
			{ 
				require_once AMS_PLUGIN_DIR.'/template/assets-inventory-tracker/inventory_list.php' ;
		    }
			if($active_tab == 'add_inventory')
			{ 
				require_once AMS_PLUGIN_DIR.'/template/assets-inventory-tracker/add_inventory.php' ;
		    }
		?> 
	</div> <!--  END TAB CONTENT DIV   -->
</div><!--  END PANEL BODY DIV   -->
<?php ?>