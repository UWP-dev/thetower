<!DOCTYPE html>

<?php

//-------------- Paytm Success -----------------//

if(isset($_REQUEST['STATUS']) && $_REQUEST['STATUS'] == 'TXN_SUCCESS')

{

	$paymentdata['invoice_id']=$_REQUEST['MERC_UNQ_REF'];

	$paymentdata['amount']=$_REQUEST['TXNAMOUNT'];

	$paymentdata['payment_method']='Paytm';	

	$paymentdata['member_id']=$_REQUEST['member_id'];

	$paymentdata['created_by']=$_REQUEST['member_id'];

	 

	$obj_account =new MJ_amgt_Accounts;

	$result = $obj_account->MJ_amgt_add_own_payment($paymentdata);	

	

	if($result)

	{ 

		wp_redirect ( home_url() . '?apartment-dashboard=user&page=accounts&tab=invoice-list&action=success');

		exit;

	}		

}

//------------------PAYPAL SUCCESS -------------------//

if(isset($_POST['payer_status']) && $_POST['payer_status'] == 'VERIFIED' && (isset($_POST['payment_status'])) && $_POST['payment_status']=='Completed' && isset($_REQUEST['action']) && $_REQUEST['action']=='success' )

{

		

	$custom_array = explode("_",$_POST['custom']);

	$paymentdata['invoice_id']=$custom_array[1];



	$paymentdata['amount']=$_POST['mc_gross_1'];

	$paymentdata['payment_method']='paypal';	

	$paymentdata['member_id']=$custom_array[0];



	$paymentdata['created_by']=$custom_array[0];

	$obj_account =new MJ_amgt_Accounts;

	$result = $obj_account->MJ_amgt_add_own_payment($paymentdata);	

	

	if($result)

	{ 

		wp_redirect ( home_url() . '?apartment-dashboard=user&page=accounts&tab=invoice-list&action=success');

		exit;

	}		

}

?>

<!-- COMPLAIN VIEW POPUP CODE -->	

<div class="complaint-popup-bg">

     <div class="overlay-content">

       <div class="complaint_content"></div>    

     </div> 

</div>



 <!-- CLASS BOOK IN CALANDER POPUP HTML CODE -->

<div id="eventContent" class="modal-body" style="display:none;"><!--MODAL BODY DIV START-->

	<style>

	   .ui-dialog .ui-dialog-titlebar-close

	   {

		  margin: -15px -4px 0px 0px !important;

	   }

	</style>

			<p><b><?php esc_html_e('Event Title','apartment_mgt');?></b> <span id="event_title"></span></p><br>

			<p><b><?php esc_html_e('Start Date','apartment_mgt');?> </b> <span id="startdate"></span></p><br>

			<p><b><?php esc_html_e('End Date','apartment_mgt');?></b> <span id="enddate"></span></p><br>

			<p><b><?php esc_html_e('Start Time','apartment_mgt');?></b> <span id="starttime"></span></p><br>

			<p><b><?php esc_html_e('End Time','apartment_mgt');?></b> <span id="endtime"></span></p><br>

			<p><b><?php esc_html_e('Description','apartment_mgt');?></b> <span id="description"></span></p><br>

			<p><b><?php esc_html_e('Documents','apartment_mgt');?></b> <span id="document"></span></p><br>

			 

</div><!--MODAL BODY DIV END-->

<?php //======Front end template=========

require_once(ABSPATH.'wp-admin/includes/user.php' );

if (! is_user_logged_in ())

{

	$page_id = get_option ( 'amgt_login_page' );

	wp_redirect ( home_url () . "?page_id=" . $page_id );

}

if (is_super_admin ())

{

	wp_redirect ( admin_url () . 'admin.php?page=amgt-apartment_system' );

}



$user = wp_get_current_user ();

$curr_user_id = get_current_user_id();

$role = MJ_amgt_get_user_role(get_current_user_id());



$obj_units=new MJ_amgt_ResidentialUnit;

$obj_notice=new MJ_amgt_NoticeEvents;

$obj_apartment=new MJ_amgt_Apartment_management(get_current_user_id());

$noticedata=$obj_notice->MJ_amgt_get_notice_list_ondashboard();

$eventdata=$obj_notice->MJ_amgt_get_all_events();

$obj_member=new MJ_amgt_Member;

$obj_service =new MJ_amgt_Service;

$obj_complaint=new MJ_amgt_Complaint;

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

		$valid_date = $retrieved_data->valid_date;

		$notice_type = $retrieved_data->notice_type;

		$notice_comment = $retrieved_data->description;



		$cal_array [] = array (

				'title' => $retrieved_data->notice_title,

				'description'=> 'notice',

				'start' =>$retrieved_data->created_date,

				'end' =>$retrieved_data->valid_date,

				'notice_title' => $notice_title,

				'valid_date' => $valid_date,

				'notice_type' => $notice_type,

				'notice_comment' => $notice_comment,

				'backgroundColor' => '#22BAA0'

		);

	}

}

?>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/datatable/dataTables.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/datatable/dataTables.editor.min.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/datatable/dataTables.tableTools.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/datatable/dataTables.responsive.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/jquery-ui.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/font-awesome-dafault.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/popup.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/style.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/custom.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/fullcalendar.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/time.css'; ?>"> 

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/bootstrap/bootstrap-multiselect.min.css'; ?>">	

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/white.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/jquery-fancybox.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/bootstrap/bootstrap.min.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/apartment.css'; ?>">

<?php  if (is_rtl())

	{?>

	<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/bootstrap/bootstrap.rtl.min.css'; ?>">

	<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/bootstrap/custom-rtl.css'; ?>">

<?php

} ?>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery-timeago.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/bootstrap/bootstrap-multiselect.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery-fancybox.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery-fancybox-media.js'; ?>"></script>

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/lib/validationEngine/css/validationEngine-jquery.css'; ?>">

<link rel="stylesheet"	href="<?php echo AMS_PLUGIN_URL.'/assets/css/apart-responsive.css'; ?>">

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery-3-6-0.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/jquery-ui.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/moment.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/popup.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/image-upload.js'; ?>"></script>


<script id="amgt-popup-front">



	var amgt = {"ajax":"<?php echo admin_url('admin-ajax.php'); ?>"};

	var language_translate = 

	{

		"no_record_found":"<?php esc_html_e('No Records Found !','apartment_mgt');?>",

		"select_unit_name":"<?php esc_html_e('Select Unit Name','apartment_mgt');?>",

		"category_alert":"<?php esc_html_e('You must fill out the field','apartment_mgt');?>",

		"Select_Member":"<?php esc_html_e('Select Member','apartment_mgt');?>",

		"count_facility_popup":"<?php esc_html_e('End Time should be greater than Start Time','apartment_mgt');?>",

		"enter_category_alert":"<?php esc_html_e('Please enter Category Name.','apartment_mgt');?>",

		"discount_amount__alert":"<?php esc_html_e('discount amount can not greater than total amount','apartment_mgt');?>",

		"add_remove":"<?php esc_html_e('Are you sure want to delete this record?','apartment_mgt');?>"

	};



</script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/fullcalendar.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/datatable/jquery-dataTables.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/datatable/dataTables-tableTools.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/datatable/dataTables-editor.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/datatable/dataTables-responsive.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/bootstrap/bootstrap.bundle.min.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/time.js'; ?>"></script>

<?php

	$lancode=get_locale();

	$code=substr($lancode,0,2);

?>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/assets/js/calendar-lang/'.$code.'.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/lib/validationEngine/js/languages/jquery.validationEngine-'.$code.'.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/lib/validationEngine/js/jquery-validationEngine.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo AMS_PLUGIN_URL.'/lib/select2-3.5.3/select2-default.js'; ?>"></script>



<!-- calender script -->

<style>

	.ui-dialog-titlebar-close

	{

		font-size: 13px !important;

		border: 1px solid transparent !important;

		border-radius: 0 !important;

		outline: 0!important;

		background-color: #fff !important;

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

					<td id="notice_title"><?php echo esc_html($noticedata->notice_title);?></td>

				</tr>

				<tr>

					<td class="popup_font"><?php esc_html_e('Valid Date:', 'apartment_mgt' ) ;?></td>

					<td id="valid_date"> <?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($noticedata->valid_date)));?></td>

				</tr>

				<tr>

					<td class="popup_font"><?php esc_html_e('Notice Type:', 'apartment_mgt' ) ;?></td>

					<td id="notice_type"><?php 

					if($noticedata->notice_type=='Announcement')

					{

						echo esc_html_e('Announcement','apartment_mgt' ) ;

					}

					elseif($noticedata->notice_type=='Proposal')

					{

						echo esc_html_e('Proposal','apartment_mgt' ) ;

					}

					

					?></td>

				</tr>			

				<tr>

					<td class="popup_font"><?php esc_html_e('Description:', 'apartment_mgt' ) ;?></td>

					<td id="notice_comment"><?php echo esc_html(wp_trim_words( $noticedata->description));?></td>

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

					<td id="start_date_new"></td>

				</tr>

				<tr>

					<td class="popup_font"><?php esc_html_e('End Date:', 'apartment_mgt' ) ;?></td>

					<td id="end_date_new"></td>

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

	$ = jQuery.noConflict();

	var calendar_laungage ="<?php echo MJ_cmgt_calander_laungage();?>";

	document.addEventListener('DOMContentLoaded', function() {

	var calendarEl = document.getElementById('calendar');

	var calendar = new FullCalendar.Calendar(calendarEl, {

		dayMaxEventRows: 1,

		initialView: 'dayGridMonth',

		locale: calendar_laungage,

		headerToolbar: {

			left: 'prev,next today',

			center: 'title',

			right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'

		},



		events: <?php echo json_encode($cal_array);?>,

		eventClick:  function(event, jsEvent, view) 

		{

			//------------- FOR NOTICE --------------//

			if(event.event._def.extendedProps.description=='notice')

			{

				$("#event_booked_popup #notice_title").html(event.event._def.extendedProps.notice_title);

				$("#event_booked_popup #valid_date").html(event.event._def.extendedProps.valid_date);

				$("#event_booked_popup #notice_comment").html(event.event._def.extendedProps.notice_comment);	

				$("#event_booked_popup #notice_type").html(event.event._def.extendedProps.notice_type);					

				

				$( "#event_booked_popup" ).removeClass( "display_none" );

				$("#event_booked_popup").dialog({ modal: true, title: "Notice Details",width:550, height:400 });

			}

			//------------- FOR EVENT --------------//

			if(event.event._def.extendedProps.event_name=='event')

			{

				$("#event_data_popup #event_title").html(event.event._def.extendedProps.event_title);

				$("#event_data_popup #start_date_new").html(event.event._def.extendedProps.start_date);

				$("#event_data_popup #end_date_new").html(event.event._def.extendedProps.end_date);	

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

</head>

<body class="apart-management-content"><!---APART-MANAGEMENT-CONTENT---->

	<div class="container-fluid mainpage">

        <div class="navbar float-start w-100 h-100 padding_top_front_end_header"><!---NAVBAR---->

		   <div class="col-md-8 col-sm-8 col-xs-6">

				<h3 class="logo-image"><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" />

				<span class="system-name"><?php echo esc_html(get_option( 'amgt_system_name' ));?> </span>

				</h3>

			</div>

			<ul class="nav navbar-right col-md-4 col-sm-4 col-xs-6">

					

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown ms-auto">

						<a id="dropdownMenufront" data-toggle="dropdown" class="btn btn-default dropdown-toggle border-0" data-bs-toggle="dropdown" aria-expanded="false">

								<?php

								$userimage = get_user_meta( $user->ID,'amgt_user_avatar',true );	

								if (empty ( $userimage )){

									echo '<img src='.esc_url(get_option( 'amgt_system_logo' )).' height="40px" width="40px" class="img-circle" />';

								}

								else	

									echo '<img src=' . esc_url($userimage) . ' height="40px" width="40px" class="img-circle"/>';

								?>

									<span>	<?php echo esc_html($user->display_name);?> </span> <b class="caret"></b>

						</a>

						<ul class="dropdown-menu extended logout" aria-labelledby="dropdownMenufront">

							<li>

								 <a class="dropdown-item" href="?apartment-dashboard=user&page=profile"><i class="fa fa-user"></i>

										<?php esc_html_e('My Profile','apartment_mgt');?>

								</a>

							</li>

							<li>

								<a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>"><i

										class="fa fa-sign-out m-r-xs"></i><?php esc_html_e('Log Out','apartment_mgt');?>

								</a>

						   </li>

						</ul>

					</li>

			</ul>

	    </div>

	</div>

    <div class="container-fluid"><!---CONTAINER-FLUID--->

	    <div class="row responsive_add_main_front_end">

		    <div class="col-sm-2 col-md-2 col-12 nopadding apartment_left nav-side-menu">	<!--  Left Side -->

		        <div class="brand"><?php esc_html_e('Menu',''); ?>    

					<a class="float-end" data-bs-toggle="collapse" href="#menu-content" role="button" aria-expanded="false" aria-controls="menu-content">

					<i data-target="#menu-content" class="fa fa-bars fa-2x toggle-btn"></i>

					</i>

					</a>

		        </div>

				 <?php

					$role = MJ_amgt_get_user_role(get_current_user_id());

					if($role=='member')

					{

						$menu = get_option( 'amgt_access_right_member');

					}

					elseif($role=='staff_member')

					{

						$menu = get_option( 'amgt_access_right_staff_member');

					}

					elseif($role=='accountant')

					{

						$menu = get_option( 'amgt_access_right_accountant');

					}

					elseif($role=='gatekeeper')

					{

						$menu = get_option( 'amgt_access_right_gatekeeper');

					}

				

					$class = 'class = "nav-item"';

					if (! isset ( $_REQUEST ['page'] ))	

						$class = 'class = "active nav-item"';

						 	?>

				   <ul class="menu-sec navbar-nav nav nav-pills nav-stacked out collapse navbar-collapse responsive_nav_bar_frontend" id="menu-content">

								<li class="nav-item"><a class="nav-link px-3" href="<?php echo site_url();?>"><span class="icone"><img src="<?php echo plugins_url( 'apartment-management/assets/images/icon/home.png' )?>"/></span><span class="title"><?php esc_html_e('Home','apartment_mgt');?></span></a></li>

								<!-- <li class="nav-item"><a class="nav-link px-3" href="?apartment-dashboard=user&page=forms"><span class="icone"><img src="<?php echo plugins_url( 'apartment-management/assets/images/icon/home.png' )?>"/></span><span class="title"><?php esc_html_e('Forms','apartment_mgt');?></span></a></li> -->

								<li <?php echo esc_attr($class);?>><a class="nav-link px-3" href="?apartment-dashboard=user"><span class="icone"><img src="<?php echo plugins_url('apartment-management/assets/images/icon/dashboard.png' )?>"/></span><span

										class="title"><?php esc_html_e('Dashboard','apartment_mgt');?></span></a></li>

											<?php

											$access_page_view_array=array();	

												foreach ($menu as $key1=>$value1) 

												{

													foreach ( $value1 as $key=>$value ) 

													{

														if($value['view']=='1')

														{

															$access_page_view_array[]=$value ['page_link'];

															 

															if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $value ['page_link'])

																$class = 'class = "active nav-item"';

															else

																$class = "";

																echo '<li ' . $class . '><a class="nav-link px-3" href="?apartment-dashboard=user&page=' . $value ['page_link'] . '" ><span class="icone"> <img src="' .$value ['menu_icone'].'" /></span><span class="title">'.MJ_amgt_change_menutitle($key).'</span></a></li>'; 	

														} 

													}

												}

											?>

					</ul>

		    </div>

			<div class="col-sm-10 col-md-10 col-12 page-inner innerpage_div">

				<div class="right_side <?php if(isset($_REQUEST['page']))echo esc_attr($_REQUEST['page']);?>">

					<?php 

					if (isset ( $_REQUEST ['page'] )) 

					{

						if(in_array($_REQUEST ['page'],$access_page_view_array))

						{	

							require_once AMS_PLUGIN_DIR . '/template/'.$_REQUEST['page']. '/' . $_REQUEST['page'] . '.php';

							return false;

						} 

						else

						{
                  
print_r($access_page_view_array);
							?><h2><?php print "404 ! Page did not found."; die;?></h2><?php

						}

					}

					

						?>

						

		<!---start new dashboard------>

			<div class="row">

		  

				<div class="row dashboard_top_border">

					<div class="notice-event col-sm-6 no-paddingR">

						<?php  

						$page='notice-event';

						$notice_event=MJ_amgt_page_access_rolewise_accessright_dashboard($page);

						if($notice_event==1)

						{

						?>

							<div class="panel panel-white event operation dasboard_notice">

								<div class="panel-heading ">

								<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Notice-And-Event.png"?>">

								<h3 class="panel-title notice_event_flot"><?php esc_html_e('Notice','apartment_mgt');?><span class="float_right" ><a href="<?php echo home_url().'?apartment-dashboard=user&page=notice-event';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>						

								</div>

								<div class="panel-body">

									<div class="events">

										<?php

										$user_notice_access=MJ_amgt_get_userrole_wise_filter_access_right_array('notice-event');	

										$obj_notice=new MJ_amgt_NoticeEvents;

											$user_id=get_current_user_id();

											//--- NOTICE DATA FOR MEMBER  ------//

											if($obj_apartment->role=='member')

											{

												$own_data=$user_notice_access['own_data'];

												if($own_data == '1')

												{

													$noticedata=$obj_notice->MJ_amgt_get_own_notice_dashboard($user_id);

												}

												else

												{

													$noticedata=$obj_notice->MJ_amgt_get_all_notice_dashboard();

												}

											} 

											//--- NOTICE DATA FOR STAFF MEMBER  ------//

											elseif($obj_apartment->role=='staff_member')

											{

												$own_data=$user_notice_access['own_data'];

												if($own_data == '1')

												{  

													$noticedata=$obj_notice->MJ_amgt_get_own_notice_dashboard($user_id);

												}

												else

												{

													$noticedata=$obj_notice->MJ_amgt_get_all_notice_dashboard();

												}

											}

											//--- NOTICE DATA FOR ACCOUNTANT  ------//

											elseif($obj_apartment->role=='accountant')

											{

												$own_data=$user_notice_access['own_data'];

												if($own_data == '1')

												{ 

													$noticedata=$obj_notice->MJ_amgt_get_own_notice_dashboard($user_id);

												}

												else

												{

													$noticedata=$obj_notice->MJ_amgt_get_all_notice_dashboard();

												}

											}

											//--- NOTICE DATA FOR GATEKEEPER  ------//

											else

											{

												$own_data=$user_notice_access['own_data'];

												if($own_data == '1')

												{ 

													$noticedata=$obj_notice->MJ_amgt_get_own_notice_dashboard($user_id);

												}

												else

												{

													$noticedata=$obj_notice->MJ_amgt_get_all_notice_dashboard();

												}

											}								

										//$noticedata=$obj_notice->MJ_amgt_get_notice_list_ondashboard();								

										if(!empty($noticedata))

										{

											foreach ($noticedata as $retrieved_data)

											{

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

											<?php 

											}

										} 

										else 

										{ ?>

											<div class="calendar-event"> 

												<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details"> <?php esc_html_e('No Notice Found','apartment_mgt');?>

												</p>

											</div>	

										<?php 

										} ?>		

									</div>                        

								</div>

							</div>

						<?php

						}

						?>

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

						

					<div class="col-sm-6">

					<?php

						$page='services';

						$services=MJ_amgt_page_access_rolewise_accessright_dashboard($page);

						if($services==1)

						{

						?>

						<div class="panel panel-white Appoinment dasboard_services">

							<div class="panel-heading">

							<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/services.png"?>">

							<h3 class="panel-title notice_event_flot"><?php esc_html_e('Service','apartment_mgt');?><span class="float_right" ><a href="<?php echo home_url().'?apartment-dashboard=user&page=services';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>					

							</div>

							<div class="panel-body">

								<div class="events">

									<?php	

										$user_id=get_current_user_id();

										$user_services_access=MJ_amgt_get_userrole_wise_filter_access_right_array('services');

										$obj_service =new MJ_amgt_Service;

										//--- SERVICES DATA FOR MEMBER  ------//

										if($obj_apartment->role=='member')

										{

											$own_data=$user_services_access['own_data'];

											if($own_data == '1')

											{

												$service_data= $obj_service->MJ_amgt_get_own_service_dashboard($user_id);

											}

											else

											{

												$service_data= $obj_service->MJ_amgt_get_all_dashboard_service();

											}

										} 

										//--- SERVICES DATA FOR STAFF MEMBER  ------//

										elseif($obj_apartment->role=='staff_member')

										{

											$own_data=$user_services_access['own_data'];

											if($own_data == '1')

											{  

												$service_data= $obj_service->MJ_amgt_get_own_service_dashboard($user_id);

											}

											else

											{

												$service_data= $obj_service->MJ_amgt_get_all_dashboard_service();

											}

										}

										//--- SERVICES DATA FOR ACCOUNTANT  ------//

										elseif($obj_apartment->role=='accountant')

										{

											$own_data=$user_services_access['own_data'];

											if($own_data == '1')

											{ 

												$service_data= $obj_service->MJ_amgt_get_own_service_dashboard($user_id);

											}

											else

											{

												$service_data= $obj_service->MJ_amgt_get_all_dashboard_service();

											}

										}

										//--- SERVICES DATA FOR GATEKEEPER  ------//

										else

										{

											$own_data=$user_services_access['own_data'];

											if($own_data == '1')

											{ 

												$service_data= $obj_service->MJ_amgt_get_own_service_dashboard($user_id);

											}

											else

											{

												$service_data= $obj_service->MJ_amgt_get_all_dashboard_service();

											}

										}							

									// $service_data= $obj_service->MJ_amgt_get_all_dashboard_service();

										if(!empty($service_data))

										{

											foreach ($service_data as $retrieved_data)

											{ ?>			

												<div class="calendar-event view-service" id="<?php echo esc_attr($retrieved_data->service_id);?>"> 

													<p class="remainder_title_pr Bold"  model="Prescription Details" >  <?php esc_html_e('Service Name','apartment_mgt');?> : 

													<?php echo esc_html($retrieved_data->service_name); ?></p>

													

													<p class="remainder_date_pr"><?php if($retrieved_data->created_date!="0000-00-00" && "00/00/0000" && "00/00/0000"){ echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->created_date))); }else{ echo "-"; } ;?></p>

													

													<p class="remainder_title_pr  viewpriscription" id="22" data-toggle="modal" data-target="#myModal1">

													<?php esc_html_e('Service Provider','apartment_mgt');?> : 

													<?php echo esc_html($retrieved_data->service_provider); ?>

													</p>

												</div>	

											<?php 

											} 

										} 

										else 

										{ ?>

											<div class="calendar-event"> 	

												<p class="remainder_title_pr Bold" model="Prescription Details" >  <?php esc_html_e('No Services Found','apartment_mgt');?>

												</p>					

											</div>	

									<?php 

										} ?>

								</div>    				

							</div>

						</div>

						<?php

						}

						$page='gatekeeper';

						$gatekeeper=MJ_amgt_page_access_rolewise_accessright_dashboard($page);

						if($gatekeeper==1)

						{

						?>

						<div class="panel panel-white event assignbed dashboard_gatekeeper_list_scroll">

							<div class="panel-heading">

								<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/Gatekeeper.png"?>">

								<h3 class="panel-title notice_event_flot"><?php esc_html_e('Gatekeeper ','apartment_mgt');?></h3>						

							</div>

							<div class="panel-body">

								<div class="events">

									<?php 

									$user_id=get_current_user_id();

									$user_gatekeeper_access=MJ_amgt_get_userrole_wise_filter_access_right_array('services');

									//--- MEMBER DATA FOR MEMBER  ------//

									if($obj_apartment->role=='member')

									{

										$own_data=$user_gatekeeper_access['own_data'];

										if($own_data == '1')

										{

											$get_members = array('role' => 'gatekeeper','meta_key'  => 'created_by','meta_value' =>$user_id);

											$membersdata=get_users($get_members);

										}

										else

										{

											$get_members = array('role' => 'gatekeeper');

											$membersdata=get_users($get_members);

										}

									} 

									//--- MEMBER DATA FOR STAFF MEMBER  ------//

									elseif($obj_apartment->role=='staff_member')

									{

										$own_data=$user_gatekeeper_access['own_data'];

										if($own_data == '1')

										{  

											$get_members = array('role' => 'gatekeeper','meta_key'  => 'created_by','meta_value' =>$user_id);

											$membersdata=get_users($get_members);

										}

										else

										{

											$get_members = array('role' => 'gatekeeper');

											$membersdata=get_users($get_members);

										}

									}

									//--- MEMBER DATA FOR ACCOUNTANT  ------//

									elseif($obj_apartment->role=='accountant')

									{

										$own_data=$user_gatekeeper_access['own_data'];

										if($own_data == '1')

										{ 

											$get_members = array('role' => 'gatekeeper','meta_key'  => 'created_by','meta_value' =>$user_id);

											$membersdata=get_users($get_members);

										}

										else

										{

											$get_members = array('role' => 'gatekeeper');

											$membersdata=get_users($get_members);

										}

									}

									//--- MEMBER DATA FOR GATEKEEPER  ------//

									else

									{

										$own_data=$user_gatekeeper_access['own_data'];

										if($own_data == '1')

										{ 

											$membersdata[]=get_userdata($user_id);

										}

										else

										{

											$get_members = array('role' => 'gatekeeper');

											$membersdata=get_users($get_members);

										}

									}

									if(!empty($membersdata))

									{

										foreach ($membersdata as $retrieved_data)

										{		

											global $wpdb;

											$table_amgt_gates = $wpdb->prefix. 'amgt_gates';

											$gatedata = $wpdb->get_row("SELECT gate_name FROM $table_amgt_gates where id=".$retrieved_data->aasigned_gate);

										?>

										

											<div class="calendar-event"> 

												<p class="remainder_title_pr Bold viewpriscription show_task_event" id="" model="Prescription Details" >  <?php esc_html_e('Gatekeeper Name','apartment_mgt');?> : 

												<?php echo esc_html($retrieved_data->display_name); ?></p>

												<p class="remainder_date_pr"><?php 

												if(!empty($gatedata->gate_name))

												{

													echo esc_html($gatedata->gate_name); 

												}

												else

												{

													echo "-"; 

												}

												

												?></p>

											</div>	

									<?php 

										} 

									}

									else 

									{ ?>

										<div class="calendar-event"> 	

											<p class="remainder_title_pr Bold viewpriscription" model="Prescription Details" >  <?php esc_html_e('No Gatekeeper Found','apartment_mgt');?>

											</p>					

										</div>	

								<?php 

									} ?>											

								</div>                       

							</div>

						</div>

						<?php

						}

						$page='accounts';

						$accounts=MJ_amgt_page_access_rolewise_accessright_dashboard($page);

						if($accounts==1)

						{

						?>



						<div class="panel panel-white event assignbed dasboard_invoice">

							<div class="panel-heading">

								<img class="dashboard_icons" src="<?php echo AMS_PLUGIN_URL."/assets/images/icon/document.png"?>">

								<h3 class="panel-title notice_event_flot"><?php esc_html_e('Invoice ','apartment_mgt');?><span class="float_right" ><a href="<?php echo home_url().'?apartment-dashboard=user&page=accounts';?>"><i class="fa fa-align-justify" aria-hidden="true"></i></a></span></h3>					

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

											$user_id=get_current_user_id();

											$user_accounts_access=MJ_amgt_get_userrole_wise_filter_access_right_array('accounts');

											//--- INVOICE DATA FOR MEMBER  ------//

											if($obj_apartment->role=='member')

											{

												$own_data=$user_accounts_access['own_data'];

												if($own_data == '1')

												{

													$invoice_data= $obj_account->MJ_amgt_get_member_all_invoice_dashboard();		

												}

												else

												{

													$invoice_data= $obj_account->MJ_amgt_get_all_invoice_dashboard();		

												}

											} 

											//--- INVOICE DATA FOR STAFF MEMBER  ------//

											elseif($obj_apartment->role=='staff_member')

											{

												$own_data=$user_accounts_access['own_data'];

												if($own_data == '1')

												{  

													$invoice_data= $obj_account->MJ_amgt_get_own_invoice_dashboard($user_id);	

												}

												else

												{

													$invoice_data= $obj_account->MJ_amgt_get_all_invoice_dashboard();	

												}

											}

											//--- INVOICE DATA FOR ACCOUNTANT  ------//

											elseif($obj_apartment->role=='accountant')

											{

												$own_data=$user_accounts_access['own_data'];

												if($own_data == '1')

												{ 

													$invoice_data= $obj_account->MJ_amgt_get_own_invoice_dashboard($user_id);	

												}

												else

												{

													$invoice_data= $obj_account->MJ_amgt_get_all_invoice_dashboard();	

												}

											}

											//--- INVOICE DATA FOR GATEKEEPER  ------//

											else

											{

												$own_data=$user_accounts_access['own_data'];

												if($own_data == '1')

												{ 

													$invoice_data= $obj_account->MJ_amgt_get_own_invoice_dashboard($user_id);	

												}

												else

												{

													$invoice_data= $obj_account->MJ_amgt_get_all_invoice_dashboard();	

												}

											}

											

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

														$total_amount=round($after_discount_amount);

														$due_amount='0';

														$paid_amount=round($after_discount_amount);

														$payment_status=$retrieved_data->payment_status;

													}

													else

													{													  

														$invoice_length=strlen($retrieved_data->invoice_no);

														if($invoice_length == '9')

														{

															$total_amount=round($retrieved_data->invoice_amount);

															$due_amount=round($retrieved_data->invoice_amount) - round($retrieved_data->paid_amount);

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

															$total_amount=round($retrieved_data->total_amount);

															$due_amount=round($retrieved_data->due_amount);

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

										<?php 

												} 

											}

											else 

											{ ?>

												<div class="calendar-event"> 	

														

													<tr>

													<td colspan="4" class="border_bottom_1_dash text_align_center"><?php esc_html_e('No Invoice Found','apartment_mgt');?></td>

													

													</tr>													

												</div>	

										<?php } ?>		

										</tbody>

									</table>							

								</div>                      

							</div>

						</div>

						<?php

						}

						?>

					</div>

				</div>

				</div>

			</div>

	    </div>

    </div>

</body>

</html>

<?php  
?>