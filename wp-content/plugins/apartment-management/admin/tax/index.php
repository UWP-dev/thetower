<?php 
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'tax-list');
$obj_tax =new MJ_amgt_Tax;
?>
<div class="page-inner min_height_1088"><!-- INNER PAGE DIV -->
	<div class="page-title"><!-- PAGE TITLE -->
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
    </div>
<?php 
	if(isset($_POST['save_tax']))//SAVE TAX 		
	{	
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_tax_nonce' ))
		{	
			if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
			{				
				$result=$obj_tax->MJ_amgt_add_tax($_POST);		
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-tax&tab=tax-list&message=2');
				}
			}
			else
			{			
				$result=$obj_tax->MJ_amgt_add_tax($_POST);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-tax&tab=tax-list&message=1');
				}
			}
		}
	}
	
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')//DELETE TAX
	{
				
		$result=$obj_tax->MJ_amgt_delete_tax($_REQUEST['tax_id']);
		if($result)
		{
			wp_redirect ( admin_url().'admin.php?page=amgt-tax&tab=tax-list&message=3');
		}
	}

	if(isset($_REQUEST['delete_selected2']))
		{		
			if(isset($_REQUEST['selected_id']))
			{	
				foreach($_REQUEST['selected_id'] as $id)
				{
					$result=$obj_tax->MJ_amgt_delete_tax($id);
				  
				}
				if($result) 
				{
					wp_redirect ( admin_url() . 'admin.php?page=amgt-tax&tab=tax-list&message=3');
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
			<div id="message" class="updated below-h2 notice is-dismissible">
			<p>
				<?php esc_html_e('Tax inserted successfully','apartment_mgt'); ?>
			</p>
			</div>
		<?php 			
		}
		elseif($message == 2){ ?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php esc_html_e("Tax updated successfully.",'apartment_mgt');?></p>
			</div>
		<?php 			
		}
		elseif($message == 3) { ?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 	esc_html_e('Tax deleted successfully','apartment_mgt');?>
			</div></p>
		<?php				
		}
	}
	?>
	
	<div id="main-wrapper"><!--MAIN WRAPPER DIV-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!--PANEL WHITE -->
					<div class="panel-body"><!-- PANEL BODY -->
						<h2 class="nav-tab-wrapper"><!--NAV TAB WRAPPER -->
							<a href="?page=amgt-tax&tab=tax-list" 
							class="nav-tab <?php echo esc_html($active_tab) == 'tax-list' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Tax List', 'apartment_mgt'); ?></a>
							
							<?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
							{ ?>
							<a href="?page=amgt-tax&tab=add_tax&action=edit&tax_id=<?php echo $_REQUEST['tax_id'];?>" class="nav-tab <?php echo esc_html($active_tab) == 'add_tax' ? 'nav-tab-active' : ''; ?>">
							<?php esc_html_e('Edit Tax', 'apartment_mgt'); ?></a>  
							<?php 
							}
							else 
							{ ?>
								<a href="?page=amgt-tax&tab=add_tax" class="nav-tab <?php echo esc_html($active_tab) == 'add_tax' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Add Tax', 'apartment_mgt'); ?></a>
							<?php  }?>
						</h2><!--END NAV TAB WRAPPER -->
							 <?php 
					//TAX LIST TAB
					if($active_tab == 'tax-list')
						{ ?>	
							<script type="text/javascript">
							$(document).ready(function() {
								//TAX LIST
								"use strict";
								jQuery('#tax_list').DataTable({
									"responsive":true,
									"order": [[ 1, "desc" ]],
									"aoColumns":[
										{"bSortable": false},
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
							<form name="member_form" action="" method="post"><!--MEMBER FORM -->
							
								<div class="panel-body"><!--PANEL BODY -->
									<div class="table-responsive"><!--TABLE RESPONSIVE -->
										<table id="tax_list" class="display" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th><input type="checkbox" id="select_all"></th>
													<th><?php  esc_html_e('Tax Title', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Tax(%)', 'apartment_mgt' ) ;?></th>
													<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th></th>
													<th><?php  esc_html_e('Tax Title', 'apartment_mgt' ) ;?></th>
													<th><?php esc_html_e('Tax(%)', 'apartment_mgt' ) ;?></th>
													<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
												</tr>
											   
											</tfoot>
											<tbody>
											 <?php 
												$tax_data= $obj_tax->Amgt_get_all_tax();
												if(!empty($tax_data))
												   {
														foreach ($tax_data as $retrieved_data)
														{ ?>
															<tr>
																  <td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
																  <td class="service_name"><?php echo esc_html($retrieved_data->tax_title);?></td>
																  <td class="service_name"><?php echo esc_html($retrieved_data->tax);?></td>
																  <td class="action">
																	<a href="?page=amgt-tax&tab=add_tax&action=edit&tax_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
																	<a href="?page=amgt-tax&tab=tax-list&action=delete&tax_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
																	onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
																	<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
																   </td>
															   
															</tr>
														<?php } 
												
													}?>
										 
											</tbody>
										
										</table>
										<div class="print-button pull-left">
											<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
										</div>
								    </div><!--END TABLE RESPONSIVE -->
								</div>
							   
						    </form><!--MEMBER FORM END-->
							 <?php 
					    }
						if($active_tab == 'add_tax')
							{		
								require_once AMS_PLUGIN_DIR.'/admin/tax/add_tax.php';
							} ?>
					</div><!-- END PANEL BODY -->
									
				</div><!--END PANEL WHITE -->
			</div>
		</div>
	</div>
</div><!-- END INNER PAGE DIV -->