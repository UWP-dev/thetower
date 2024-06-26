<!-- COMPLAIN VIEW POPUP CODE -->
<?php error_reporting(0); ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->
<div class="complaint-popup-bg">
     <div class="overlay-content">
       <div class="complaint_content"></div>    
     </div> 
</div>	
<style type="text/css">
	.fc-view-container
	{
		width: 100% !important;
    	height: auto !important;
    	overflow: hidden !important;
	}
</style>
 <!--END POP-UP CODE -->
 <!-- CLASS BOOK IN CALANDER POPUP HTML CODE -->
<div id="eventContent" class="modal-body" style="display:none;"><!--MODAL BODY DIV START-->
	<style>
	   .ui-dialog .ui-dialog-titlebar-close
	   {
		  margin: -15px -4px 0px 0px !important;
	   }

	</style>
			<p><b><?php esc_html_e('Event Title:','apartment_mgt');?></b> <span id="event_title"></span></p><br>
			<p><b><?php esc_html_e('Start Date:','apartment_mgt');?> </b> <span id="startdate"></span></p><br>
			<p><b><?php esc_html_e('End Date:','apartment_mgt');?></b> <span id="enddate"></span></p><br>
			<p><b><?php esc_html_e('Start Time:','apartment_mgt');?></b> <span id="starttime"></span></p><br>
			<p><b><?php esc_html_e('End Time:','apartment_mgt');?></b> <span id="endtime"></span></p><br>
			<p><b><?php esc_html_e('Description:','apartment_mgt');?></b> <span id="description"></span></p><br>
			<p><b><?php esc_html_e('Documents:','apartment_mgt');?></b> <span id="document"></span></p><br>
			 
</div><!--MODAL BODY DIV END-->
<!-- END CLASS BOOK IN CALANDER POPUP HTML CODE -->
<?php 
$obj_units=new MJ_amgt_ResidentialUnit;
$obj_member=new MJ_amgt_Member;
$obj_notice=new MJ_amgt_NoticeEvents;
$eventdata=$obj_notice->MJ_amgt_get_all_events();
$noticedata=$obj_notice->MJ_amgt_get_notice_list_ondashboard();
$obj_service =new MJ_amgt_Service;
$obj_complaint=new MJ_amgt_Complaint;
$obj_gate=new MJ_amgt_gatekeeper;
$gatedata=$obj_gate->Amgt_get_all_gates();
$obj_account =new MJ_amgt_Accounts;

$cal_array=array();
if(!empty($eventdata))
{
	foreach ( $eventdata as $retrieved_data ) 
	{		
		$start=date('Y-m-d',strtotime($retrieved_data->start_date ))." ".date("H:i", strtotime($retrieved_data->start_time));
		$end=date('Y-m-d',strtotime($retrieved_data->end_date ))." ".date("H:i", strtotime($retrieved_data->end_time));
		if(!empty($retrieved_data->event_doc))
		{
			$document='<a target="blank" href="'.content_url().'/uploads/apartment_assets/'.$retrieved_data->event_doc.'" class="btn btn-default"><i class="fa fa-eye"></i> View Document</a>';
		}
		else
		{
			$document='No Document';
		}
		$event_title = $retrieved_data->event_title;
		$start_date = date(MJ_amgt_date_formate(),strtotime($retrieved_data->start_date));
		$end_date = date(MJ_amgt_date_formate(),strtotime($retrieved_data->end_date));
		$start_time = $retrieved_data->start_time;
		$end_time = $retrieved_data->end_time;
		$event_comment = $retrieved_data->description;
		$cal_array [] = array (
				'type' =>  'eventdata',
				'event_name' => "event",
				'title' => $retrieved_data->event_title,
				'event_title' => $event_title,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'start_time' => $start_time,
				'end_time' => $end_time,
				'event_comment' => $event_comment,
				'description' => $retrieved_data->description,
				'document' =>$document,
				'start' =>$start,
				'end' =>$end,
				'starttime' =>$retrieved_data->start_time,
				'endtime' =>$retrieved_data->end_time,
				'backgroundColor' => '#008000'
		);
	}
}

if(!empty($noticedata))
{
	foreach ( $noticedata as $retrieved_data ) 
	{		

		$notice_title = $retrieved_data->notice_title;
		$valid_date = date(MJ_amgt_date_formate(),strtotime($retrieved_data->valid_date));
		$valid_date = date(MJ_amgt_date_formate(),strtotime($retrieved_data->valid_date));
		$notice_type = $retrieved_data->notice_type;
		$notice_comment = $retrieved_data->description;
		$notice_status = $retrieved_data->status;
		$cal_array [] = array (
				'title' => $retrieved_data->notice_title,
				'description'=> 'notice',
				'start' =>$retrieved_data->created_date,
				'end' =>$retrieved_data->valid_date,
				'notice_title' => $notice_title,
				'valid_date' => $valid_date,
				'notice_type' => $notice_type,
				'notice_status' => $notice_status,
				'notice_comment' => $notice_comment,
				'backgroundColor' => '#22BAA0'
		);
	}
}	
?>
<style>
	.ui-dialog-titlebar-close
	{
		font-size: 13px !important;
		border: 1px solid transparent !important;
		border-radius: 0 !important;
		outline: 0!important;
		background-color: #fff !important;
		background-image: url("<?php echo AMS_PLUGIN_URL."/assets/images/Close.png"?>");
		background-repeat: no-repeat;
		float: right;
		color: #fff !important;
		width: 10% !important;
		height: 30px !important;
	}
	.ui-widget-header {
		border: 0px solid #aaaaaa !important;
		background: unset !important;
		font-size: 22px !important;
		color: #333333 !important;
		font-weight: 500 !important;
		font-style: normal!important;
		font-family: Poppins!important;
	}
	.ui-dialog {
		background: #ffffff none repeat scroll 0 0;
		border-radius: 4px;
		box-shadow: 0 0 5px rgb(0 0 0 / 90%);
		cursor: default;
	}
	@media (max-width: 768px)
	{
		.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-draggable.ui-resizable
		{
			width: 332px !important;
			left: -131px !important;
			top: 2878.5px !important;
		}
	}
</style>
<!--------------- NOTICE CALENDER POPUP ---------------->
<div id="event_booked_popup" class="modal-body " style="display:none;"><!--MODAL BODY DIV START-->
	<style>
	   .ui-dialog .ui-dialog-titlebar-close
	   {
			margin: -10px 0 0 0 !important;
	   }

	</style>
	<div class="penal-body">
		<table id="examlist" class="table table-striped" cellspacing="0" width="100%" align="center">
			<tbody>
				<tr>
					<td class="popup_font"><?php esc_html_e('Notice Title:', 'apartment_mgt' ) ;?></td>
					<td id="notice_title"></td>
				</tr>
				<tr>
					<td class="popup_font"><?php esc_html_e('Valid Date:', 'apartment_mgt' ) ;?></td>
					<td id="valid_date"> </td>
				</tr>
				<tr>
					<td class="popup_font"><?php esc_html_e('Notice Type:', 'apartment_mgt' ) ;?></td>
					<td id="notice_type"></td>
				</tr>	
				<tr>
					<td class="popup_font"><?php esc_html_e('Status:', 'apartment_mgt' ) ;?></td>
					<td id="notice_status_calendar"></td>
				</tr>				
				<tr>
					<td class="popup_font"><?php esc_html_e('Description:', 'apartment_mgt' ) ;?></td>
					<td id="notice_comment"></td>
				</tr>					
			</tbody>
		</table>
		
	</div>
</div>

<!--------------- EVENT CALENDER POPUP ---------------->
<div id="event_data_popup" class="modal-body " style="display:none;"><!--MODAL BODY DIV START-->
	<style>
	   .ui-dialog .ui-dialog-titlebar-close
	   {
			margin: -10px 0 0 0 !important;
	   }

	</style>
	<div class="penal-body">
		<table id="examlist" class="table table-striped" cellspacing="0" width="100%" align="center">
			<tbody>
				<tr>
					<td class="popup_font"><?php esc_html_e('Event Title:', 'apartment_mgt' ) ;?></td>
					<td id="event_title"></td>
				</tr>
				<tr>
					<td class="popup_font"><?php esc_html_e('Start Date:', 'apartment_mgt' ) ;?></td>
					<td id="start_date"></td>
				</tr>
				<tr>
					<td class="popup_font"><?php esc_html_e('End Date:', 'apartment_mgt' ) ;?></td>
					<td id="end_date"></td>
				</tr>			
				<tr>
					<td class="popup_font"><?php esc_html_e('Start Time:', 'apartment_mgt' ) ;?></td>
					<td id="start_time"></td>
				</tr>	
				<tr>
					<td class="popup_font"><?php esc_html_e('End Time:', 'apartment_mgt' ) ;?></td>
					<td id="end_time"></td>
				</tr>	
				<tr>
					<td class="popup_font"><?php esc_html_e('Description:', 'apartment_mgt' ) ;?></td>
					<td id="event_comment"></td>
				</tr>					
			</tbody>
		</table>
		
	</div>
</div>
<script>
	// "use strict";
var calendar_laungage ="<?php echo MJ_cmgt_calander_laungage();?>";
var $ = jQuery.noConflict();
document.addEventListener('DOMContentLoaded', function() 
{
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, 
	{
		initialView: 'dayGridMonth',
		locale: calendar_laungage,
		dayMaxEventRows: 1,
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
		},
			editable: false,
			slotEventOverlap: true,
			eventTimeFormat: { // like '14:30:00'
				hour: 'numeric',
				minute: '2-digit',
				meridiem: 'short'
			},
			events: <?php echo json_encode($cal_array); ?>,
			forceEventDuration : true,
			eventClick:  function(event, jsEvent, view) 
			{
				//------------- FOR NOTICE --------------//
				if(event.event._def.extendedProps.description=='notice')
				{
					$("#event_booked_popup #notice_title").html(event.event._def.extendedProps.notice_title);
					$("#event_booked_popup #valid_date").html(event.event._def.extendedProps.valid_date);
					$("#event_booked_popup #notice_comment").html(event.event._def.extendedProps.notice_comment);	
					$("#event_booked_popup #notice_type").html(event.event._def.extendedProps.notice_type);				
					$("#event_booked_popup #notice_status_calendar").html(event.event._def.extendedProps.notice_status);					
					
					$( "#event_booked_popup" ).removeClass( "display_none" );
					$("#event_booked_popup").dialog({ modal: true, title: "Notice Details",width:550, height:400 });
				}
				//------------- FOR EVENT --------------//
				if(event.event._def.extendedProps.event_name=='event')
				{
					$("#event_data_popup #event_title").html(event.event._def.extendedProps.event_title);
					$("#event_data_popup #start_date").html(event.event._def.extendedProps.start_date);
					$("#event_data_popup #end_date").html(event.event._def.extendedProps.end_date);	
					$("#event_data_popup #start_time").html(event.event._def.extendedProps.start_time);
					$("#event_data_popup #end_time").html(event.event._def.extendedProps.end_time);	
					$("#event_data_popup #event_comment").html(event.event._def.extendedProps.event_comment);					
					
					$( "#event_data_popup" ).removeClass( "display_none" );
					$("#event_data_popup").dialog({ modal: true, title: "Event Details",width:550, height:500 });
				}
			},

	});

    calendar.render();
});
</script>
<?php
// var_dump($calendar);
// die;
?>
<div class="page-inner min_height_1088"> <!--- INNER PAGE DIV START  ---->
	<div class="page-title">
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>
	<div id="main-wrapper"> <!--MAIN WRAPPER-->
		
		<div class="row dashboard_top_border">
			<div class="notice-event col-md-6 no-paddingR">
				
				
				<div class="panel panel-white event operation dasboard_notice">
					<div class="panel-heading ">
					<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Notice-And-Event.png"?>">
					<h3 class="panel-title notice_event_flot"><?php esc_html_e('Notice','apartment_mgt');?><span class="float_right" ><a href="<?php echo admin_url().'admin.php?page=amgt-notice-event';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
							<?php		
							if(!empty($noticedata)){
							
							foreach ($noticedata as $retrieved_data){
							?>			
									<div class="calendar-event view-notice" id="<?php echo esc_attr($retrieved_data->id);?>"> 
									
									<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details" >  <?php esc_html_e('Notice Title','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->notice_title); ?>
										</p>
									<p class="remainder_date_pr"><?php  echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->valid_date))); ?></p>
									
									<p class="remainder_title_pr  viewpriscription" id="22" data-toggle="modal" data-target="#myModal1">
									<?php esc_html_e('Description','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->description); ?>
									</p>
									
									</div>	
							<?php }
							} 
							else 
							{ ?>
							<div class="calendar-event"> 
									
									<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details" >  <?php esc_html_e('No Notice Found','apartment_mgt');?>
										</p>
									
									
									</div>	
							<?php } ?>												
							</div>                        
					</div>
				</div>
				
				<!-- <div class="panel panel-white Appoinment dasboard_complain">
					<div class="panel-heading">
						<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Complaint.png"?>">
						<h3 class="panel-title notice_event_flot"><?php esc_html_e('Complaint','apartment_mgt');?><span class="float_right" ><a href="<?php echo admin_url().'admin.php?page=amgt-complaint';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
							<?php		
							// $complaintsdata=$obj_complaint->MJ_amgt_get_all_dashboard_complaints();
							// if(!empty($complaintsdata))
							// {
							// foreach ($complaintsdata as $retrieved_data){
							// $user=get_userdata($retrieved_data->created_by);
							?>				
									<div class="calendar-event view-complaint" id="<?php echo esc_attr($retrieved_data->id);?>"> 
									
									<p class="remainder_title_pr Bold viewpriscription show_task_event" model="Prescription Details" >  <?php esc_html_e('Complaint Title','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->complain_title); ?>
									
									<p class="remainder_date_pr"><?php if($retrieved_data->complain_date!="0000-00-00" && "00/00/0000" && "00/00/0000"){ echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->complain_date))); }else{ echo "-"; } ;?></p>
									
									<p class="remainder_title_pr  viewpriscription" id="22" data-toggle="modal" data-target="#myModal1">
									<?php esc_html_e('Description','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->complaint_description); ?>
									</p>
									
									
									</div>	
							<?php
							//  } }
							// else 
							// { 
								?>
							<div class="calendar-event"> 
									
									<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details" >  <?php esc_html_e('No Complaints Found','apartment_mgt');?>
										</p>
									
									
									</div>	
							<?php //} ?>							
							</div>    				
					</div>
				</div> -->
			   <div class="panel panel-white">
				   <div class="panel-heading margin_bottom_15">
						<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/calender.png"?>">
						<h3 class="panel-title notice_event_flot"><?php esc_html_e('Calendar','apartment_mgt');?></h3>			
					</div>
					<div class="panel-body dasboard_calander">
						<div id="calendar"></div>
					</div>
				</div>
		 </div>
				 
		<div class="col-md-6">
				<!-- <div class="panel panel-white event priscription dashboard_bulding_list_scroll"> -->
					<!-- <div class="panel-heading ">
									
						<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Assets--Inventory-Tracker.png"?>">
						<h3 class="panel-title notice_event_flot"><?php esc_html_e('Compounds Units','apartment_mgt');?><span class="float_right" ><a href="<?php echo admin_url().'admin.php?page=amgt-residential_unit';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>				
					</div> -->
					
					<!-- <div class="panel-body">
						<table class="table table-borderless">
							<?php
							$get_members = array('role' => 'member');
							$membersdata=get_users($get_members);
							
							$residentialdata=$obj_units->MJ_amgt_get_all_residentials_dashboard();
							if(!empty($residentialdata))
							{
								?>
									<thead>
									<tr>
										<th scope="col compound_unit_dash"><?php esc_html_e('Unit Name','apartment_mgt');?></th>
										<th scope="col compound_unit_dash"><?php esc_html_e('Unit Category','apartment_mgt');?></th>
										<th scope="col compound_unit_dash"><?php esc_html_e('Compound Name','apartment_mgt');?></th>
									</tr>
									</thead>
									<tbody>
										<?php 
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
														<td class="border_bottom_1_dash"><?php echo esc_html($unit->entry);?></td>
														<td class="unit border_bottom_1_dash"><?php $unit_cat=get_post($retrieved_data->unit_cat_id); echo esc_html($unit_cat->post_title);?></td>
														<td class="building_id border_bottom_1_dash"><span class="btn btn-success btn-xs"><?php $building = get_post($retrieved_data->building_id); echo esc_html($building->post_title);?></span></td>
														</tr>
											<?php 		
											} 
										} 
									?>
									</tbody>
									<?php
							}
							else 
							{ 
								?>
								<div class="calendar-event"> 	
									<p class="remainder_title_pr Bold" id="" model="Prescription Details" >  <?php esc_html_e('No Compound Units Found','apartment_mgt');?>
									</p>					
								</div>	
								<?php 
							} ?>
						</table>               
					</div> -->
				<!-- </div> -->
			
				<div class="panel panel-white Appoinment dasboard_services">
					<div class="panel-heading">
					<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/services.png"?>">
					<h3 class="panel-title notice_event_flot"><?php esc_html_e('Service','apartment_mgt');?><span class="float_right" ><a href="<?php echo admin_url().'admin.php?page=amgt-service-mgt';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
									<?php		
							           $service_data= $obj_service->MJ_amgt_get_all_dashboard_service();
										if(!empty($service_data))
										{
											foreach ($service_data as $retrieved_data)
									{ ?>			
									<div class="calendar-event view-service" id="<?php echo esc_attr($retrieved_data->service_id);?>"> 
									<p class="remainder_title_pr Bold"  model="Prescription Details" >  <?php esc_html_e('Service Name','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->service_name); ?>
									
									<p class="remainder_date_pr"><?php if($retrieved_data->created_date!="0000-00-00" && "00/00/0000" && "00/00/0000"){ echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->created_date))); }else{ echo "-"; } ;?></p>
									
									<p class="remainder_title_pr  viewpriscription" id="22" data-toggle="modal" data-target="#myModal1">
									<?php esc_html_e('Service Provider','apartment_mgt');?> : 
									<?php echo esc_html($retrieved_data->service_provider); ?>
									</p>
									
									</div>	
									<?php } } 
									else 
											{ ?>
												<div class="calendar-event"> 	
													<p class="remainder_title_pr Bold" model="Prescription Details" >  <?php esc_html_e('No Services Found','apartment_mgt');?>
													</p>					
												</div>	
									     <?php } ?>
													
							</div>    				
					</div>
				</div>
				
			   <!-- <div class="panel panel-white event assignbed dashboard_gatekeeper_list_scroll">
					<div class="panel-heading">
						<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Gatekeeper.png"?>">
						<h3 class="panel-title notice_event_flot"><?php esc_html_e('Security','apartment_mgt');?></h3>						
					</div>
					<div class="panel-body">
						<div class="events">
							<?php 
							// $get_members = array('role' => 'gatekeeper');
							// $membersdata=get_users($get_members);
							// if(!empty($membersdata))
							// {
								foreach ($membersdata as $retrieved_data)
								{		
									global $wpdb;
									$table_amgt_gates = $wpdb->prefix. 'amgt_gates';
									$gatedata = $wpdb->get_row("SELECT gate_name FROM $table_amgt_gates where id=".$retrieved_data->aasigned_gate );	
								
									?>

									<div class="calendar-event"> 
										<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details" >  <?php esc_html_e('Security Name','apartment_mgt');?> : 
										<?php echo esc_html($retrieved_data->display_name); ?>
							
										<p class="remainder_date_pr"><?php 
											if(!empty($gatedata->gate_name))
											{
												echo esc_html($gatedata->gate_name); 
											}
											else
											{
												echo "-";
											}
							
											?>
							
									</div>	
									<?php 
								} 
							// }
							// else 
							// { ?>
								<div class="calendar-event"> 	
									<p class="remainder_title_pr Bold viewpriscription" model="Prescription Details" >  <?php esc_html_e('No Security Found','apartment_mgt');?>
									</p>					
								</div>	
								<?php 
							// } ?>									
						</div>                       
					</div>
			   </div> -->
				   
			   <div class="panel panel-white event assignbed dasboard_invoice">
					<div class="panel-heading">
					<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/document.png"?>">
					<h3 class="panel-title notice_event_flot"><?php esc_html_e('Invoice','apartment_mgt');?><span class="float_right" ><a href="<?php echo admin_url().'admin.php?page=amgt-accounts';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>						
					</div>
					<div class="panel-body">
						<div class="events overflow_auto_res">
							      <table class="table table-borderless">
									  <thead>
										<tr>
										  <th scope="col compound_unit_dash"><?php esc_html_e('Invoice No','apartment_mgt');?></th>
										  <th scope="col compound_unit_dash"><?php esc_html_e('Member Name','apartment_mgt');?></th>
										  <th scope="col compound_unit_dash"><?php esc_html_e('Total Amount','apartment_mgt');?></th>
										  <th scope="col compound_unit_dash"><?php esc_html_e('Payment Status','apartment_mgt');?></th>
										  
										</tr>
									  </thead>
									  <tbody>
									  <?php 
											 $invoice_data= $obj_account->MJ_amgt_get_all_invoice_dashboard();
											 $obj_amgttax=new MJ_amgt_Tax();
											 
											if(!empty($invoice_data))
											{
												foreach ($invoice_data as $retrieved_data)
												{ 
													$member_id=$retrieved_data->member_id;
													$chargedata=MJ_amgt_get_invoice_charges_calculate_by($retrieved_data->charges_id);
													if(empty($retrieved_data->invoice_no))
													{
														$invoice_no='-';
														$charge_cal_by='Fix Charges';
														$charge_type=get_the_title($retrieved_data->charges_type_id);
													}
													else
													{
														$invoice_no=$retrieved_data->invoice_no;
														if($chargedata->charges_calculate_by=='fix_charge')
														{
															$charge_cal_by='Fix Charges';
														}
														else
														{
															$charge_cal_by='Measurement Charge';
														}
														if($retrieved_data->charges_type_id=='0')
														{
															$charge_type='Maintenance Charges';
														}
														else
														{
															$charge_type=get_the_title($retrieved_data->charges_type_id);
														}	
													}	
													$userdata=get_userdata($member_id);
													
													?>
													
													<tr>
													  <td class="border_bottom_1_dash"><?php echo esc_html(get_option('invoice_prefix').''.$invoice_no);?></td>
													  <td class="border_bottom_1_dash"><?php echo esc_html($userdata->display_name);?></td>
													  <?php
													
														if(empty($retrieved_data->invoice_no))
														{
															$invoice_no='-';
															$charge_cal_by='Fix Charges';
															$entry=json_decode($retrieved_data->charges_payment);
															$entry_amount='0';
															foreach($entry as $entry_data)
															{
																$entry_amount+=$entry_data->amount;
															}
															$discount_amount=$retrieved_data->discount_amount;
															$after_discount_amount=$entry_amount-$discount_amount;
															$total_amount=$after_discount_amount;
															$due_amount='0';
															$paid_amount=$after_discount_amount;
															$payment_status=$retrieved_data->payment_status;
														}
														else
														{													  
															$invoice_length=strlen($retrieved_data->invoice_no);
															if($invoice_length == '9')
															{
																$total_amount=$retrieved_data->invoice_amount;
																$due_amount=$retrieved_data->invoice_amount - $retrieved_data->paid_amount;
																if($retrieved_data->payment_status=='Unpaid')
																{
																	$payment_status= esc_html__('Unpaid','apartment_mgt');
																}
																elseif($retrieved_data->payment_status=='Paid' || $retrieved_data->	payment_status=='Fully Paid')
																{																
																	$payment_status= esc_html__('Fully Paid','apartment_mgt');
																}
																elseif($retrieved_data->payment_status=='Partially Paid')
																{
																	$payment_status= esc_html__('Partially Paid','apartment_mgt');
																}			
															}													    
															else
															{
																$total_amount=$retrieved_data->total_amount;
																$due_amount=$retrieved_data->due_amount;
																if($retrieved_data->payment_status=='Unpaid')
																{
																	$payment_status= esc_html__('Unpaid','apartment_mgt');
																}
																elseif($retrieved_data->payment_status=='Paid' || $retrieved_data->	payment_status=='Fully Paid')
																{																
																	$payment_status= esc_html__('Fully Paid','apartment_mgt');
																}
																elseif($retrieved_data->payment_status=='Partially Paid')
																{
																	$payment_status= esc_html__('Partially Paid','apartment_mgt');
																}
															}
															$paid_amount=$retrieved_data->paid_amount;
														}
												        ?>
													  <td class="building_id border_bottom_1_dash"><?php   echo MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )); echo esc_html($total_amount);?></td>
													  <td class="building_id border_bottom_1_dash"><span class="btn btn-success btn-xs"><?php _e("$payment_status","apartment_mgt");?></span></td>
													  
													</tr>
											<?php } }
											else 
											{ ?>
												<div class="calendar-event"> 	
														
                                                      <tr>
													  <td  colspan="4" class="border_bottom_1_dash text_align_center"><?php esc_html_e('No Invoice Found','apartment_mgt');?></td>
													  
													</tr>													
												</div>	
									     <?php } ?>		
										
									  </tbody>
								</table>
															
						</div>                      
					</div>
			   </div>
		</div>
      </div>
	</div>
</div>
<?php ?>