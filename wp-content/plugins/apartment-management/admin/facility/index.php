<?php 
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'facility-list');
$obj_facility =new MJ_amgt_Facility;
?>
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
<div class="page-inner min_height_1088"><!-- INNER PAGE DIV -->
	<div class="page-title">
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" 
		class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>
<?php 
	if(isset($_POST['save_facility']))//SAVE FACILITY		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_facility_nonce' ) )
		{
			if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
			{				
				$result=$obj_facility->MJ_amgt_add_facility($_POST);
			
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-list&message=2');
				}
			}
			else
			{
				
				$result=$obj_facility->MJ_amgt_add_facility($_POST);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-list&message=1');
				}
			}
		}
	}
	if(isset($_POST['save_book_facility']))//SAVE BOOK FACILITY
	{
		$facility_record_id = $_POST['facility_booking_id'];
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_book_facility_nonce' ) )
		{
			$start_date=MJ_amgt_get_format_for_db($_POST['start_date']);
			if(isset($_POST['end_date']))
			{
				$end_date=MJ_amgt_get_format_for_db($_POST['end_date']);		
			}
			else
			{
				$end_date=$start_date;
			}			
		
		if(!empty($_POST['start_time']))
		{
			$start_hour=date("H", strtotime($_POST['start_time']));
			$start_minute=date("i", strtotime($_POST['start_time']));
			$end_hour=date("H", strtotime($_POST['end_time']));
			$end_minute=date("i", strtotime($_POST['end_time']));
		}
		

		if($start_date == $end_date )//----STARTDATE/ENDDATE---->
		{	
			if($_POST['period_type'] == 'hour_type')
			{	
				if($start_hour > $end_hour)
				{			
					echo '<script type="text/javascript">alert("End Time should be greater than Start Time");</script>';			
				}
				elseif($start_hour ==  $end_hour && $start_minute > $end_minute )
				{
					echo '<script type="text/javascript">alert("End Time should be greater than Start Time");</script>';		  
				}
				
				else // if period type == hour type //
				{
					
					$facility_id=$_POST['facility_id'];
					if($_POST['period_type'] == 'hour_type')
					{
						 $start_time=$_POST['start_time'];
						 $end_time=$_POST['end_time'];
						 global $wpdb;
						 $table_amgt_facility = $wpdb->prefix. 'amgt_facility_booking';
						 $facility_booking_data = $wpdb->get_results("SELECT * FROM $table_amgt_facility WHERE `start_date`= '$start_date' AND `start_time` <='$start_time' AND `end_time` >= '$end_time' AND facility_id=$facility_id AND period_type='hour_type'");
						 $facility_booking_id_by_time = MJ_amgt_facility_booking_edit_time_id($start_date,$start_time,$end_time,$facility_id);
					} 
					else
					{
						$facility_booking_data = MJ_amgt_facility_booking_add_date_type_data($start_date,$end_date,$facility_id);
						$facility_booking_data_id = MJ_amgt_facility_booking_edit_data_id($start_date,$end_date,$facility_id);
					}
				 
					if( isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
					{
						 if($facility_booking_id_by_time == $facility_record_id)
						 {	
							$result=$obj_facility->MJ_amgt_book_facility($_POST);
							if($result)
							{
								wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=5');
							}
						 }
						 else
						 { 
						 ?>
							<div id="message" class="updated below-h2 notice is-dismissible"><p> <?php
								 esc_html_e("Already booking this facility Between this time." ,'apartment_mgt');
								 ?></p>
							 </div>				
						 <?php 
						 }
					 }
					 else
					 {
						 if(empty($facility_booking_data))
						 {
							 $result=$obj_facility->MJ_amgt_book_facility($_POST);
							 if($result)
							 {
								 wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=4');
							 }
						 }
						 else
						 { 
						 ?>
							<div id="message" class="updated below-h2 notice is-dismissible"><p> <?php
								 esc_html_e("Already booking this facility Between this time." ,'apartment_mgt');
								 ?></p>
							 </div>				
						 <?php 
						 }
					 }
				}		
			}
			else
			{
				$facility_id=$_POST['facility_id'];
				$facility_booking_data = MJ_amgt_facility_booking_add_date_type_data($start_date,$end_date,$facility_id);
				$facility_booking_data_id = MJ_amgt_facility_booking_edit_data_id($start_date,$end_date,$facility_id);
			
				if( isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
				{
					 if($facility_booking_data_id == $facility_record_id)
					 {	
						$result=$obj_facility->MJ_amgt_book_facility($_POST);
						if($result)
						{
							wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=5');
						}
					 }
					 else
					 { 
					 ?>
						<div id="message" class="updated below-h2 notice is-dismissible"><p>
							 <?php
							 esc_html_e("Already booking this facility Between this date.",'apartment_mgt');
							 ?></p>
						 </div>				
					 <?php 
					 }
				 }
				 else
				 {
					 if(empty($facility_booking_data))
					 {
						 $result=$obj_facility->MJ_amgt_book_facility($_POST);
						 if($result)
						 {
							 wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=4');
						 }
					 }
					 else
					 { 
					 ?>
						<div id="message" class="updated below-h2 notice is-dismissible"><p> <?php
							 esc_html_e("Already booking this facility Between this date." ,'apartment_mgt');
							 ?></p>
						 </div>				
					 <?php 
					 }
				 }
			}
		}
		elseif($start_date > $end_date )
		{
			
			echo '<script type="text/javascript">alert("End Date should be greater than Start Date");</script>';
		}		
		else// if period type == date_type //
		{
			
			$facility_id=$_POST['facility_id'];
			if($_POST['period_type'] == 'hour_type')
			{
				 $start_time=$_POST['start_time'];
				 $end_time=$_POST['end_time'];
				 global $wpdb;
				 $table_amgt_facility = $wpdb->prefix. 'amgt_facility_booking';
				 $facility_booking_data = $wpdb->get_results("SELECT * FROM $table_amgt_facility WHERE `start_date`= '$start_date' AND `start_time` <='$start_time' AND `end_time` >= '$end_time' AND facility_id=$facility_id AND period_type='hour_type'");
			} 
			else
			{ 
				 $facility_booking_data = MJ_amgt_facility_booking_add_date_type_data($start_date,$end_date,$facility_id);
				 $facility_booking_data_id = MJ_amgt_facility_booking_edit_data_id($start_date,$end_date,$facility_id);
			}

               if( isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
			   {
					if($facility_booking_data_id == $facility_record_id)
					{	
						$result=$obj_facility->MJ_amgt_book_facility($_POST);
						if($result)
						{
							wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=5');
						}
					}
					else
					{ 
					?>
					   <div id="message" class="updated below-h2 notice is-dismissible"><p> <?php
							esc_html_e("Already booking this facility Between this date." ,'apartment_mgt');
							?></p>
						</div>				
					<?php 
					}
			    }
				else
				{
					if(empty($facility_booking_data))
					{
						$result=$obj_facility->MJ_amgt_book_facility($_POST);
						if($result)
						{
							wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=4');
						}
				    }
					else
					{ 
					?>
					   <div id="message" class="updated below-h2 notice is-dismissible"><p> <?php
							esc_html_e("Already booking this facility Between this date." ,'apartment_mgt');
							?></p>
						</div>				
					<?php 
					}
			    }
        }	
	  }
	}
	//------------------- BOOKING Approved --------------------//
	if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'booking_approved')
	{
		global $wpdb;
		$table_amgt_facility = $wpdb->prefix. 'amgt_facility_booking';
		$facility_booking_id = $_REQUEST['facility_booking_id'];
		$visitor_request_data = $obj_facility->MJ_amgt_get_single_boooked_facility($facility_booking_id);
		$whereid['id']=$facility_booking_id;
		$request_data['status']='1';
		$result=$wpdb->update( $table_amgt_facility, $request_data,$whereid );
		$user_info = get_userdata($visitor_request_data->book_on_behalf_of);
		//---------------- SEND  SMS ------------------//
		include_once(ABSPATH.'wp-admin/includes/plugin.php');
		if(is_plugin_active('sms-pack/sms-pack.php'))
		{
			if(!empty(get_user_meta($visitor_request_data->book_on_behalf_of, 'phonecode',true))){ $phone_code=get_user_meta($visitor_request_data->book_on_behalf_of, 'phonecode',true); }else{ $phone_code='+'.MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' )); }
							
			$user_number[] = $phone_code.get_user_meta($visitor_request_data->book_on_behalf_of, 'mobile',true);
			$apartmentname=get_option('amgt_system_name');
			$message_content ="Your facility booking request has been approved From $apartmentname .";
			
			$current_sms_service 	= get_option( 'smgt_sms_service');
			$args = array();
			$args['mobile']=$user_number;
			$args['message_from']="facility Approved";
			$args['message']=$message_content;					
			if($current_sms_service=='telerivet' || $current_sms_service ="MSG91" || $current_sms_service=='bulksmsgateway.in' || $current_sms_service=='textlocal.in' || $current_sms_service=='bulksmsnigeria' || $current_sms_service=='africastalking' || $current_sms_service == 'clickatell')
			{				
				$send = send_sms($args);							
			}
		}
		
		$to = $user_info->user_email;
		
		$admin_info = get_userdata(get_current_user_id());
		$apartmentname=get_option('amgt_system_name');
		
	    $subject =get_option('wp_amgt_approved_facility_subject');
		$subject_search=array('{{admin_name}}','{{apartment_name}}');
		$subject_replace=array($admin_info->display_name,$apartmentname);
		$subject_replacement=str_replace($subject_search,$subject_replace,$subject);
		
		$message_content=get_option('wp_amgt_approved_facility_email_template');
		$search=array('{{member_name}}','{{admin_name}}','{{apartment_name}}');
		$replace = array($user_info->display_name,$admin_info->display_name,$apartmentname);
		$message_content_replacement = str_replace($search, $replace, $message_content);
		MJ_amgt_SendEmailNotification($to,$subject_replacement,$message_content_replacement);  
		
		wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=6'); 
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')//DELETE FACILITY
		{
			if(isset($_REQUEST['facility_id']))
			{
				$result=$obj_facility->MJ_amgt_delete_facility($_REQUEST['facility_id']);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-list&message=3');
				}
			}
			if(isset($_REQUEST['facility_booking_id']))
			{
				$result=$obj_facility->MJ_amgt_delete_booked_facility($_REQUEST['facility_booking_id']);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=3');
				}
			}
		}

		if(isset($_REQUEST['delete_selected2']))
		{		
			if(!empty($_REQUEST['selected_id']))
			{	
				foreach($_REQUEST['selected_id'] as $id)
				{
					$result=$obj_facility->MJ_amgt_delete_facility($id);
				
				}
				if($result) 
				{
					wp_redirect ( admin_url() . 'admin.php?page=amgt-facility-mgt&tab=facility-list&message=3');
				}
			}
			if(!empty($_REQUEST['facility_booking_id']))
			{	
				foreach($_REQUEST['facility_booking_id'] as $id)
				{
					$result=$obj_facility->MJ_amgt_delete_booked_facility($id);
				
				}
				if($result) 
				{
					wp_redirect ( admin_url() . 'admin.php?page=amgt-facility-mgt&tab=facility-booking-list&message=3');
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
						esc_html_e('Facility inserted successfully','apartment_mgt');
					?></p></div>
					<?php 
				
			}
			elseif($message == 2)
			{?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
			<?php
						esc_html_e("Facility updated successfully.",'apartment_mgt');
			?></p></div>
					<?php 
				
			}
			elseif($message == 3) 
			{?>
				<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 
					esc_html_e('Facility deleted successfully','apartment_mgt');
				?></div></p><?php
					
			}
			elseif($message == 4) 
			{?>
				<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 
					esc_html_e('Facility Booking successfully','apartment_mgt');
				?></div></p><?php
					
			}
			elseif($message == 5) 
			{?>
				<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 
					esc_html_e('Facility Booking Updated successfully','apartment_mgt');
				?></div></p><?php
					
			}
			elseif($message == 6) 
			{?>
				<div id="message" class="updated below-h2 notice is-dismissible"><p>
				<?php 
					esc_html_e('Facility Booking Approved successfully','apartment_mgt');
				?></div></p><?php
					
			}
	    }
	?>
	<div id="main-wrapper"><!--MAIN WRAPPER-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!--PANEL-WHITE-->
					<div class="panel-body"><!--PANEL BODY-->
					    <!--NAV TAB WRAPPER---->
						<h2 class="nav-tab-wrapper">
						
							<a href="?page=amgt-facility-mgt&tab=facility-list" 
							class="nav-tab <?php echo esc_html($active_tab) == 'facility-list' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Facility List', 'apartment_mgt'); ?></a>
							
							<?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' && isset($_REQUEST['facility_id']))
							{ ?>
							<a href="?page=amgt-facility-mgt&tab=add_facility&action=edit&facility_id=<?php echo $_REQUEST['facility_id'];?>" 
							class="nav-tab <?php echo esc_html($active_tab) == 'add_facility' ? 'nav-tab-active' : ''; ?>">
							<?php esc_html_e('Edit Facility', 'apartment_mgt'); ?></a>  
							<?php 
							}
							else 
							{ ?>
								<a href="?page=amgt-facility-mgt&tab=add_facility" class="nav-tab <?php echo esc_html($active_tab) == 'add_facility' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Add Facility', 'apartment_mgt'); ?></a>
							<?php  }?>
							<a href="?page=amgt-facility-mgt&tab=facility-booking-list" 
							class="nav-tab <?php echo esc_html($active_tab) == 'facility-booking-list' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Booking  Facility  List', 'apartment_mgt'); ?></a>
							 <?php  if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit' &&  $_REQUEST['tab'] == 'booking-facility')
							{ ?>
								<a href="?page=amgt-facility-mgt&tab=booking-facility&action=edit&facility_booking_id=<?php echo $_REQUEST['facility_booking_id'];?>" 
							class="nav-tab <?php echo esc_html($active_tab) == 'booking-facility' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Edit Booked Facility', 'apartment_mgt'); ?></a>
							<?php }	
							else{ ?>
								<a href="?page=amgt-facility-mgt&tab=booking-facility" 
							class="nav-tab <?php echo esc_html($active_tab) == 'booking-facility' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.esc_html__('Book Facility', 'apartment_mgt'); ?></a>
								
							<?php }
								?>
						</h2>
						 <!--END NAV TAB WRAPPER---->
						<?php
                        // FACILITY-LIST						
						//Report 1 
						if($active_tab == 'facility-list')
						{ ?>	
							<script type="text/javascript">
							$(document).ready(function() 
							{
							"use strict";
							jQuery('#service_list').DataTable({
								"responsive":true,
								"order": [[ 2, "desc" ]],
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
						<form name="member_form" action="" method="post">
							<div class="panel-body"><!--PANEL BODY-->
								<div class="table-responsive"><!---TABLE-RESPONSIVE--->
								    <!---SERVICE LIST TABLE--->
									<table id="service_list" class="display" cellspacing="0" width="100%">
										<thead>
											<tr>
												  <th><input type="checkbox" id="select_all"></th>
												  <th><?php  esc_html_e('Facility Name', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Facility Charge', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('charge Per', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Is Multiple Days', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
												<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th></th>
												  <th><?php  esc_html_e('Facility Name', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Facility Charge', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('charge Per', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Is Multiple Days', 'apartment_mgt' ) ;?></th>
												  <th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
												 <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
											</tr>
										</tfoot>
										<tbody>
											<?php 
											$facility_data= $obj_facility->MJ_amgt_get_all_facility();
											if(!empty($facility_data))
											{
												foreach ($facility_data as $retrieved_data)
												{ ?>
												<tr>
														<td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->facility_id); ?>"></td>
														<td class="service_name"><?php echo esc_html($retrieved_data->facility_name);?></td>
														<td class="service_name"><?php echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' ))); echo esc_html($retrieved_data->facility_charge);?></td>
														<td class="service_name">
															<?php 
															if($retrieved_data->charge_per == 'hour')
															{
															 esc_html_e('Hour','apartment_mgt');
															}
															else
															{
															esc_html_e('Date','apartment_mgt');
															}?>
														  </td>
														<td class="service_name"><?php 
															  if($retrieved_data->allow_booking_multiple_base)
															  {
																esc_html_e('Yes','apartment_mgt');
															  }
															  else
																{
																	esc_html_e('No','apartment_mgt');
																}
																?>
														</td>
													 
													 <td class="status"><?php $statusdata=MJ_amgt_check_facility_availability($retrieved_data->facility_id);
													 if(!empty($statusdata))
													 {
														 esc_html_e('Booked','apartment_mgt');
													 }
													else
													{
														esc_html_e('Available','apartment_mgt');
													}													
													 ?>
													</td> 
													<td class="action">
														<a href="?page=amgt-facility-mgt&tab=add_facility&action=edit&facility_id=<?php echo esc_attr($retrieved_data->facility_id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
														<a href="?page=amgt-facility-mgt&tab=facility-list&action=delete&facility_id=<?php echo esc_attr($retrieved_data->facility_id);?>" class="btn btn-danger" 
														onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
														<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
													</td>
												</tr>
												<?php } 
											}?>
										</tbody>
									</table> <!---END SERVICE LIST TABLE--->
									<div class="print-button pull-left">
										<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
									</div>
							    </div><!---END TABLE-RESPONSIVE--->
							</div>
						   
					    </form>
						 <?php 
						}
						if($active_tab == 'add_facility')
						{	
							require_once AMS_PLUGIN_DIR.'/admin/facility/add_facility.php';
						}
               					
						if($active_tab == 'facility-booking-list')
						{	
							require_once AMS_PLUGIN_DIR.'/admin/facility/facility-booking-list.php';
						}
			
						if($active_tab == 'booking-facility')
						{	
							require_once AMS_PLUGIN_DIR.'/admin/facility/booking-facility.php';
						}?>
					</div><!--END PANEL BODY-->
	            </div><!--END PANEL-WHITE-->
	        </div>
        </div>
    </div><!--END MAIN WRAPPER-->
</div><!-- INNER PAGE DIV end -->