<?php
add_action( 'admin_menu', 'apartment_system_menu' );
function apartment_system_menu()
{
	if (function_exists('amgt_setup'))  
	{
		add_menu_page(esc_html__('Apartment Management','apartment_mgt'), esc_html__('Apartment Management','apartment_mgt'),'manage_options','amgt-apartment_system','apartment_system_dashboard',plugins_url('apartment-management/assets/images/apartment-management-3.png' )); 
		if($_SESSION['amgt_verify'] == '')
		{
			add_submenu_page('amgt-apartment_system','Licence Settings',esc_html__('Licence Settings', 'apartment_mgt' ),'manage_options','amgt-amgt_setup','amgt_options_page');
		}
		add_submenu_page('amgt-apartment_system', esc_html__('Dashboard', 'apartment_mgt' ), esc_html__('Dashboard', 'apartment_mgt' ), 'administrator', 'amgt-apartment_system', 'apartment_system_dashboard');
		$unit_type=get_option( 'amgt_apartment_type' );
		
		if($unit_type == 'Residential')
		{	

			add_submenu_page('amgt-apartment_system', esc_html__('Residential Unit ', 'apartment_mgt'), esc_html__('Residential Unit ', 'apartment_mgt'), 'administrator', 'amgt-residential_unit', 'MJ_amgt_residential_unit');
		}
		else
		{
			
			add_submenu_page('amgt-apartment_system', esc_html__('Residential Unit ', 'apartment_mgt'), esc_html__('Commercial Unit ', 'apartment_mgt'), 'administrator', 'amgt-residential_unit', 'MJ_amgt_residential_unit');
		}
								
		add_submenu_page('amgt-apartment_system', esc_html__('All Users', 'apartment_mgt' ), esc_html__('All Users', 'apartment_mgt' ), 'administrator', 'amgt-member', 'MJ_amgt_member');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Committee Members', 'apartment_mgt' ), esc_html__('Committee Members', 'apartment_mgt' ), 'administrator', 'amgt-committee-member', 'MJ_amgt_committee_member');
			
		add_submenu_page('amgt-apartment_system', esc_html__('Visitor Management', 'apartment_mgt' ), esc_html__('Visitor Management', 'apartment_mgt' ), 'administrator', 'amgt-visiter-manage', 'MJ_amgt_visiter_manage');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Notice And Event', 'apartment_mgt' ), esc_html__('Notice And Event', 'apartment_mgt' ), 'administrator', 'amgt-notice-event', 'MJ_amgt_notice_event');
		
		add_submenu_page('amgt-apartment_system',esc_html__('Complaint', 'apartment_mgt' ), esc_html__('Complaint', 'apartment_mgt' ), 'administrator', 'amgt-complaint', 'MJ_amgt_complaint');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Parking Manager', 'apartment_mgt' ), esc_html__('Parking Manager', 'apartment_mgt' ), 'administrator', 'amgt-parking-mgt', 'MJ_amgt_parking_mgt');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Services', 'apartment_mgt' ), esc_html__('Services', 'apartment_mgt' ), 'administrator', 'amgt-service-mgt', 'MJ_amgt_service_mgt');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Facility', 'apartment_mgt' ), esc_html__('Facility', 'apartment_mgt' ), 'administrator', 'amgt-facility-mgt', 'MJ_amgt_facility_mgt');
			
		add_submenu_page('amgt-apartment_system', esc_html__('Tax', 'apartment_mgt' ), esc_html__('Tax', 'apartment_mgt' ), 'administrator', 'amgt-tax', 'MJ_amgt_tax');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Accounts', 'apartment_mgt' ) , esc_html__('Accounts', 'apartment_mgt' ), 'administrator', 'amgt-accounts', 'MJ_amgt_accounts');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Documents', 'apartment_mgt' ), esc_html__('Documents', 'apartment_mgt' ), 'administrator', 'amgt-legal-documents', 'MJ_amgt_legal_documents');
		
		add_submenu_page('amgt-apartment_system',  esc_html__('Asset/ Inventory Tracker', 'apartment_mgt' ), esc_html__('Asset/ Inventory Tracker', 'apartment_mgt' ), 'administrator', 'amgt-assets-inventory', 'MJ_amgt_assets_inventory');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Mail Templates', 'apartment_mgt' ), esc_html__('Mail Templates', 'apartment_mgt' ), 'administrator', 'amgt-notification-templates', 'MJ_amgt_notification_templates');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Message', 'apartment_mgt' ), esc_html__('Message', 'apartment_mgt' ), 'administrator', 'amgt-message', 'MJ_amgt_message');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Report', 'apartment_mgt' ), esc_html__('Report', 'apartment_mgt' ), 'administrator', 'amgt-report', 'MJ_amgt_report');
		
		add_submenu_page('amgt-apartment_system', esc_html__('General Setting', 'apartment_mgt' ), esc_html__('General Setting', 'apartment_mgt' ), 'administrator', 'amgt-general_settings', 'MJ_amgt_general_settings_page');
		
		add_submenu_page('amgt-apartment_system', esc_html__('Access Right', 'apartment_mgt' ), esc_html__('Access Right', 'apartment_mgt' ), 'administrator', 'amgt-access_right', 'MJ_amgt_access_right');
	}  
	else
	{ 		      
		die;
	}
}
function amgt_options_page()
//PAGE SET UP FORM INDEX.PHP
{
	require_once AMS_PLUGIN_DIR. '/admin/setupform/index.php';
}
//PAGE DASBOARD.PHP
function apartment_system_dashboard()
{
	require_once AMS_PLUGIN_DIR. '/admin/dasboard.php';
}
//PAGE MEMBER INDEX.PHP
function MJ_amgt_member()
{
	require_once AMS_PLUGIN_DIR. '/admin/member/index.php';
}
//PAGE COMMITTEE-MEMBER INDEX.PHP
function MJ_amgt_committee_member()
{
	require_once AMS_PLUGIN_DIR. '/admin/committee-member/index.php';
}
//PAGE STAFF-MEMBER/INDEX.PHP
function MJ_amgt_staff_member()
{
	require_once AMS_PLUGIN_DIR. '/admin/staff-member/index.php';
}
// PAGE ACCOUNTANT INDEX.PHP
function MJ_amgt_accountant()
{
	require_once AMS_PLUGIN_DIR. '/admin/accountant/index.php';
}
//PAGE GATEKEEPER INDEX.PHP
function MJ_amgt_gatekeeper()
{
	require_once AMS_PLUGIN_DIR. '/admin/gatekeeper/index.php';
}
//VISITOR-MANAGE INDEX.PHP
function MJ_amgt_visiter_manage()
{
	require_once AMS_PLUGIN_DIR. '/admin/visitor-manage/index.php';
}
//RESIDENTIAL INDEX.PHP
function MJ_amgt_residential_unit()
{
	require_once AMS_PLUGIN_DIR. '/admin/residential-unit/index.php';
}
//COMPLAINT INDEX.PHP
function MJ_amgt_complaint()
{
	require_once AMS_PLUGIN_DIR. '/admin/complaint/index.php';
}
function MJ_amgt_notice_event()
{
	require_once AMS_PLUGIN_DIR. '/admin/notice-events/index.php';
}
function MJ_amgt_parking_mgt()
{
	require_once AMS_PLUGIN_DIR. '/admin/parking/index.php';
}
function MJ_amgt_service_mgt()
{
	require_once AMS_PLUGIN_DIR. '/admin/service/index.php';
}
function MJ_amgt_tax()
{
	require_once AMS_PLUGIN_DIR. '/admin/tax/index.php';
}
function MJ_amgt_facility_mgt()
{
	require_once AMS_PLUGIN_DIR. '/admin/facility/index.php';
}
function MJ_amgt_accounts()
{
	require_once AMS_PLUGIN_DIR. '/admin/accounts/index.php';
}
function MJ_amgt_legal_documents()
{
	require_once AMS_PLUGIN_DIR. '/admin/ducuments/index.php';
}

function MJ_amgt_assets_inventory()
{
	require_once AMS_PLUGIN_DIR. '/admin/assets-inventory/index.php';
}
function MJ_amgt_message()
{
	require_once AMS_PLUGIN_DIR. '/admin/message/index.php';
}
function MJ_amgt_report()
{
	require_once AMS_PLUGIN_DIR. '/admin/report/index.php';
}

function MJ_amgt_general_settings_page()
{
	require_once AMS_PLUGIN_DIR. '/admin/general-settings.php';
}
function MJ_amgt_access_right()
{
	require_once AMS_PLUGIN_DIR. '/admin/access_right/index.php';
}
function MJ_amgt_notification_templates()
{
	require_once AMS_PLUGIN_DIR. '/admin/notification-templates/index.php';
}
function MJ_amgt_maintenance_settings()
{
	require_once AMS_PLUGIN_DIR. '/admin/maintenance_settings/index.php';
}
?>