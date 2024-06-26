<?php 	
$result=get_option('amgt_access_right_staff_member');
if(isset($_POST['save_access_right']))
{
	$role_access_right = array();
	$result=get_option('amgt_access_right_staff_member');

	$role_access_right['staff_member'] = [
									"resident_unit"=>["menu_icone"=>plugins_url( 'apartment-management/assets/images/icon/resident-unit.png' ),
												'menu_title'=>'Resident Unit',
											   "page_link"=>'resident_unit',
											   "own_data" =>isset($_REQUEST['resident_unit_own_data'])?$_REQUEST['resident_unit_own_data']:0,
											   "add" =>isset($_REQUEST['resident_unit_add'])?$_REQUEST['resident_unit_add']:0,
												"edit"=>isset($_REQUEST['resident_unit_edit'])?$_REQUEST['resident_unit_edit']:0,
												"view"=>isset($_REQUEST['resident_unit_view'])?$_REQUEST['resident_unit_view']:0,
												"delete"=>isset($_REQUEST['resident_unit_delete'])?$_REQUEST['resident_unit_delete']:0
												],
														
								   "member"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/member.png' ),
												'menu_title'=>'All User',
											  "page_link"=>'member',
											 "own_data" => isset($_REQUEST['member_own_data'])?$_REQUEST['member_own_data']:0,
											 "add" => isset($_REQUEST['member_add'])?$_REQUEST['member_add']:0,
											 "edit"=>isset($_REQUEST['member_edit'])?$_REQUEST['member_edit']:0,
											 "view"=>isset($_REQUEST['member_view'])?$_REQUEST['member_view']:0,
											 "delete"=>isset($_REQUEST['member_delete'])?$_REQUEST['member_delete']:0
								  ],
											  
									"committee-member"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Committee-Member.png' ),			'menu_title'=>'Committee Member',
											"page_link"=>'committee-member',
											 "own_data" => isset($_REQUEST['committee-member_own_data'])?$_REQUEST['committee-member_own_data']:0,
											 "add" => isset($_REQUEST['committee-member_add'])?$_REQUEST['committee-member_add']:0,
											"edit"=>isset($_REQUEST['committee-member_edit'])?$_REQUEST['committee-member_edit']:0,
											"view"=>isset($_REQUEST['committee-member_view'])?$_REQUEST['committee-member_view']:0,
											"delete"=>isset($_REQUEST['committee-member_delete'])?$_REQUEST['committee-member_delete']:0
								  ],
											  
									  "accountant"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Accountant.png' ),
												'menu_title'=>'Accountant',
												"page_link"=>'accountant',
												"own_data" => isset($_REQUEST['accountant_own_data'])?$_REQUEST['accountant_own_data']:0,
												 "add" => isset($_REQUEST['accountant_add'])?$_REQUEST['accountant_add']:0,
												 "edit"=>isset($_REQUEST['accountant_edit'])?$_REQUEST['accountant_edit']:0,
												"view"=>isset($_REQUEST['accountant_view'])?$_REQUEST['accountant_view']:0,
												"delete"=>isset($_REQUEST['accountant_delete'])?$_REQUEST['accountant_delete']:0
									  ],
									  
									  "staff-members"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Staff-Management.png' ),			'menu_title'=>'Staff Management',
												 "page_link"=>'staff-members',
												 "own_data" => isset($_REQUEST['staff-members_own_data'])?$_REQUEST['staff-members_own_data']:0,
												 "add" => isset($_REQUEST['staff-members_add'])?$_REQUEST['staff-members_add']:0,
												"edit"=>isset($_REQUEST['staff-members_edit'])?$_REQUEST['staff-members_edit']:0,
												"view"=>isset($_REQUEST['staff-members_view'])?$_REQUEST['staff-members_view']:0,
												"delete"=>isset($_REQUEST['staff-members_delete'])?$_REQUEST['staff-members_delete']:0
									  ],
									  "gatekeeper"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Gatekeeper.png' ),
												'menu_title'=>'Gatekeeper',
												  "page_link"=>'gatekeeper',
												 "own_data" => isset($_REQUEST['gatekeeper_own_data'])?$_REQUEST['gatekeeper_own_data']:0,
												 "add" => isset($_REQUEST['gatekeeper_add'])?$_REQUEST['gatekeeper_add']:0,
												"edit"=>isset($_REQUEST['gatekeeper_edit'])?$_REQUEST['gatekeeper_edit']:0,
												"view"=>isset($_REQUEST['gatekeeper_view'])?$_REQUEST['gatekeeper_view']:0,
												"delete"=>isset($_REQUEST['gatekeeper_delete'])?$_REQUEST['gatekeeper_delete']:0
									  ],
									  
										"visitor-manage"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Visitor-Manage.png' ),			'menu_title'=>'Visitor Management',
												 "page_link"=>'visitor-manage',
												 "own_data" => isset($_REQUEST['visitor-manage_own_data'])?$_REQUEST['visitor-manage_own_data']:0,
												 "add" => isset($_REQUEST['visitor-manage_add'])?$_REQUEST['visitor-manage_add']:0,
												"edit"=>isset($_REQUEST['visitor-manage_edit'])?$_REQUEST['visitor-manage_edit']:0,
												"view"=>isset($_REQUEST['visitor-manage_view'])?$_REQUEST['visitor-manage_view']:0,
												"delete"=>isset($_REQUEST['visitor-manage_delete'])?$_REQUEST['visitor-manage_delete']:0
									  ],
									  
									  
										"notice-event"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Notice-And-Event.png' ),			'menu_title'=>'Notice And Event',
												 "page_link"=>'notice-event',
												 "own_data" => isset($_REQUEST['notice-event_own_data'])?$_REQUEST['notice-event_own_data']:0,
												 "add" => isset($_REQUEST['notice-event_add'])?$_REQUEST['notice-event_add']:0,
												"edit"=>isset($_REQUEST['notice-event_edit'])?$_REQUEST['notice-event_edit']:0,
												"view"=>isset($_REQUEST['notice-event_view'])?$_REQUEST['notice-event_view']:0,
												"delete"=>isset($_REQUEST['notice-event_delete'])?$_REQUEST['notice-event_delete']:0
									  ],
										"complaint"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Complaint.png' ),
												'menu_title'=>'Complaint',
												 "page_link"=>'complaint',
												 "own_data" => isset($_REQUEST['complaint_own_data'])?$_REQUEST['complaint_own_data']:0,
												 "add" => isset($_REQUEST['complaint_add'])?$_REQUEST['complaint_add']:0,
												"edit"=>isset($_REQUEST['complaint_edit'])?$_REQUEST['complaint_edit']:0,
												"view"=>isset($_REQUEST['complaint_view'])?$_REQUEST['complaint_view']:0,
												"delete"=>isset($_REQUEST['complaint_delete'])?$_REQUEST['complaint_delete']:0
									  ],
										"parking-manager"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Parking-Manager.png' ),			'menu_title'=>'Parking Manager',
												  "page_link"=>'parking-manager',
												 "own_data" => isset($_REQUEST['parking-manager_own_data'])?$_REQUEST['parking-manager_own_data']:0,
												 "add" => isset($_REQUEST['parking-manager_add'])?$_REQUEST['parking-manager_add']:0,
												"edit"=>isset($_REQUEST['parking-manager_edit'])?$_REQUEST['parking-manager_edit']:0,
												"view"=>isset($_REQUEST['parking-manager_view'])?$_REQUEST['parking-manager_view']:0,
												"delete"=>isset($_REQUEST['parking-manager_delete'])?$_REQUEST['parking-manager_delete']:0
									  ],
									  
									  "services"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/services.png' ),
												'menu_title'=>'Services',
												 "page_link"=>'services',
												 "own_data" => isset($_REQUEST['services_own_data'])?$_REQUEST['services_own_data']:0,
												 "add" => isset($_REQUEST['services_add'])?$_REQUEST['services_add']:0,
												"edit"=>isset($_REQUEST['services_edit'])?$_REQUEST['services_edit']:0,
												"view"=>isset($_REQUEST['services_view'])?$_REQUEST['services_view']:0,
												"delete"=>isset($_REQUEST['services_delete'])?$_REQUEST['services_delete']:0
									  ],
									  
									  "facility"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Facility.png' ),
												'menu_title'=>'Facility',
												 "page_link"=>'facility',
												 "own_data" => isset($_REQUEST['facility_own_data'])?$_REQUEST['facility_own_data']:0,
												 "add" => isset($_REQUEST['facility_add'])?$_REQUEST['facility_add']:0,
												"edit"=>isset($_REQUEST['facility_edit'])?$_REQUEST['facility_edit']:0,
												"view"=>isset($_REQUEST['facility_view'])?$_REQUEST['facility_view']:0,
												"delete"=>isset($_REQUEST['facility_delete'])?$_REQUEST['facility_delete']:0
									  ],
									  "accounts"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Accounts.png' ),
												'menu_title'=>'Accounts',
											   "page_link"=>'accounts',
												 "own_data" => isset($_REQUEST['accounts_own_data'])?$_REQUEST['accounts_own_data']:0,
												 "add" => isset($_REQUEST['accounts_add'])?$_REQUEST['accounts_add']:0,
												"edit"=>isset($_REQUEST['accounts_edit'])?$_REQUEST['accounts_edit']:0,
												"view"=>isset($_REQUEST['accounts_view'])?$_REQUEST['accounts_view']:0,
												"delete"=>isset($_REQUEST['accounts_delete'])?$_REQUEST['accounts_delete']:0
									  ],
									  "documents"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/document.png' ),
												'menu_title'=>'Documents',
												  "page_link"=>'documents',
												 "own_data" => isset($_REQUEST['documents_own_data'])?$_REQUEST['documents_own_data']:0,
												 "add" => isset($_REQUEST['documents_add'])?$_REQUEST['documents_add']:0,
												"edit"=>isset($_REQUEST['documents_edit'])?$_REQUEST['documents_edit']:0,
												"view"=>isset($_REQUEST['documents_view'])?$_REQUEST['documents_view']:0,
												"delete"=>isset($_REQUEST['documents_delete'])?$_REQUEST['documents_delete']:0
									  ],
									  "assets-inventory-tracker"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Assets--Inventory-Tracker.png' ),
												'menu_title'=>'Assets / Inventory Tracker',
												 "page_link"=>'assets-inventory-tracker',
												 "own_data" => isset($_REQUEST['assets-inventory-tracker_own_data'])?$_REQUEST['assets-inventory-tracker_own_data']:0,
												 "add" => isset($_REQUEST['assets-inventory-tracker_add'])?$_REQUEST['assets-inventory-tracker_add']:0,
												"edit"=>isset($_REQUEST['assets-inventory-tracker_edit'])?$_REQUEST['assets-inventory-tracker_edit']:0,
												"view"=>isset($_REQUEST['assets-inventory-tracker_view'])?$_REQUEST['assets-inventory-tracker_view']:0,
												"delete"=>isset($_REQUEST['assets-inventory-tracker_delete'])?$_REQUEST['assets-inventory-tracker_delete']:0
									  ],
									  
									  "message"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/message.png'),
												"menu_title"=>'Message',
												"page_link"=>'message',
												 "own_data" => isset($_REQUEST['message_own_data'])?$_REQUEST['message_own_data']:1,
												 "add" => isset($_REQUEST['message_add'])?$_REQUEST['message_add']:0,
												"edit"=>isset($_REQUEST['message_edit'])?$_REQUEST['message_edit']:0,
												"view"=>isset($_REQUEST['message_view'])?$_REQUEST['message_view']:0,
												"delete"=>isset($_REQUEST['message_delete'])?$_REQUEST['message_delete']:0
									  ],

									  "report"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Report.png'),
										   "menu_title"=>'Report',
										   "page_link"=>'report',
										   "own_data" => isset($_REQUEST['report_own_data'])?$_REQUEST['report_own_data']:0,
											 "add" => isset($_REQUEST['report_add'])?$_REQUEST['report_add']:0,
											"edit"=>isset($_REQUEST['report_edit'])?$_REQUEST['report_edit']:0,
											"view"=>isset($_REQUEST['report_view'])?$_REQUEST['report_view']:0,
											"delete"=>isset($_REQUEST['report_delete'])?$_REQUEST['report_delete']:0
								  	],
									  
									   "profile"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/account.png' ),
											'menu_title'=>'Profile',
											   "page_link"=>'profile',
												 "own_data" => isset($_REQUEST['profile_own_data'])?$_REQUEST['profile_own_data']:1,
												 "add" => isset($_REQUEST['profile_add'])?$_REQUEST['profile_add']:0,
												"edit"=>isset($_REQUEST['profile_edit'])?$_REQUEST['profile_edit']:0,
												"view"=>isset($_REQUEST['profile_view'])?$_REQUEST['profile_view']:0,
												"delete"=>isset($_REQUEST['profile_delete'])?$_REQUEST['profile_delete']:0
									  ],
									  
									   "faq"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/faq.png' ),
												'menu_title'=>'FAQ',
												"page_link"=>'faq',
												 "own_data" => isset($_REQUEST['faq_own_data'])?$_REQUEST['faq_own_data']:0,
												 "add" => isset($_REQUEST['faq_add'])?$_REQUEST['faq_add']:0,
												"edit"=>isset($_REQUEST['faq_edit'])?$_REQUEST['faq_edit']:0,
												"view"=>isset($_REQUEST['faq_view'])?$_REQUEST['faq_view']:0,
												"delete"=>isset($_REQUEST['faq_delete'])?$_REQUEST['faq_delete']:0
									  ],
									  
									   "society_rules"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/Society-Rules.png' ),
												'menu_title'=>'Rules',
												 "page_link"=>'society_rules',
												 "own_data" => isset($_REQUEST['society_rules_own_data'])?$_REQUEST['society_rules_own_data']:0,
												 "add" => isset($_REQUEST['society_rules_add'])?$_REQUEST['society_rules_add']:0,
												"edit"=>isset($_REQUEST['society_rules_edit'])?$_REQUEST['society_rules_edit']:0,
												"view"=>isset($_REQUEST['society_rules_view'])?$_REQUEST['society_rules_view']:0,
												"delete"=>isset($_REQUEST['society_rules_delete'])?$_REQUEST['society_rules_delete']:0
									  ],
									  "gallery"=>['menu_icone'=>plugins_url( 'apartment-management/assets/images/icon/gallery.png' ),
												'menu_title'=>'Gallery',
												 "page_link"=>'gallery',
												 "own_data" => isset($_REQUEST['gallery_own_data'])?$_REQUEST['gallery_own_data']:0,
												 "add" => isset($_REQUEST['gallery_add'])?$_REQUEST['gallery_add']:0,
												"edit"=>isset($_REQUEST['gallery_edit'])?$_REQUEST['gallery_edit']:0,
												"view"=>isset($_REQUEST['gallery_view'])?$_REQUEST['gallery_view']:0,
												"delete"=>isset($_REQUEST['gallery_delete'])?$_REQUEST['gallery_delete']:0
									  ]
									];

	$result=update_option( 'amgt_access_right_staff_member',$role_access_right);
	wp_redirect ( admin_url() . 'admin.php?page=amgt-access_right&tab=Staff_Member&message=1');
}
$access_right=get_option('amgt_access_right_staff_member');
?>	
<div class="panel panel-white"><!--- PANEL WHITE DIV START -->
		<h2>
			<?php esc_html_e('Staff Member Access Right', 'apartment_mgt'); ?>
		</h2>			
		<div class="panel-body"> <!--- PANEL BODY DIV START -->
			<form name="student_form" action="" method="post" class="form-horizontal" id="access_right_form">	
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min"><?php esc_html_e('Menu','apartment_mgt');?></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min"><?php esc_html_e('OwnData','apartment_mgt');?></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_18_res"><?php esc_html_e('View','apartment_mgt');?></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><?php esc_html_e('Add','apartment_mgt');?></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15"><?php esc_html_e('Edit','apartment_mgt');?></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15"><?php esc_html_e('Delete','apartment_mgt');?></div>
				</div>
				<div class="access_right_menucroll row border_bottom_0">
					<!-- Resident Unit module code  -->
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label menu_left_6">
								<?php esc_html_e('Resident Unit','apartment_mgt');?>
							</span>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['resident_unit']['own_data'],1);?> value="1" name="resident_unit_own_data">	              
								</label> 
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['resident_unit']['view'],1);?> value="1" name="resident_unit_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['resident_unit']['add'],1);?> value="1" name="resident_unit_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['resident_unit']['edit'],1);?> value="1" name="resident_unit_edit" >	              
								</label>
							</div>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_15_min margin_left_20_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['resident_unit']['delete'],1);?> value="1" name="resident_unit_delete" >	              
								</label>
							</div>
						</div>								
					</div>							
					<!-- Resident Unit module code end -->
					
					<!-- Member module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Member','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['member']['own_data'],1);?> value="1" name="member_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['member']['view'],1);?> value="1" name="member_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['member']['add'],1);?> value="1" name="member_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['member']['edit'],1);?> value="1" name="member_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['member']['delete'],1);?> value="1" name="member_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Member module code  -->
					
					<!-- committee-member module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Committee Member','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['committee-member']['own_data'],1);?> value="1" name="committee-member_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['committee-member']['view'],1);?> value="1" name="committee-member_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['committee-member']['add'],1);?> value="1" name="committee-member_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['committee-member']['edit'],1);?> value="1" name="committee-member_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['committee-member']['delete'],1);?> value="1" name="committee-member_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- committee-member module code  -->
					<!-- accountant module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Accountant','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accountant']['own_data'],1);?> value="1" name="accountant_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accountant']['view'],1);?> value="1" name="accountant_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accountant']['add'],1);?> value="1" name="accountant_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accountant']['edit'],1);?> value="1" name="accountant_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accountant']['delete'],1);?> value="1" name="accountant_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- accountant module code  -->
					<!-- Staff Management module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Staff Management','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['staff-members']['own_data'],1);?> value="1" name="staff-members_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['staff-members']['view'],1);?> value="1" name="staff-members_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['staff-members']['add'],1);?> value="1" name="staff-members_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['staff-members']['edit'],1);?> value="1" name="staff-members_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['staff-members']['delete'],1);?> value="1" name="staff-members_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Staff Management module code  -->
					<!-- Gatekeeper module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Gatekeeper','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gatekeeper']['own_data'],1);?> value="1" name="gatekeeper_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gatekeeper']['view'],1);?> value="1" name="gatekeeper_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gatekeeper']['add'],1);?> value="1" name="gatekeeper_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gatekeeper']['edit'],1);?> value="1" name="gatekeeper_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gatekeeper']['delete'],1);?> value="1" name="gatekeeper_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Gatekeeper module code  -->
					<!-- Visitor Management module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Visitor Management','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['visitor-manage']['own_data'],1);?> value="1" name="visitor-manage_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['visitor-manage']['view'],1);?> value="1" name="visitor-manage_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['visitor-manage']['add'],1);?> value="1" name="visitor-manage_add">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['visitor-manage']['edit'],1);?> value="1" name="visitor-manage_edit">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['visitor-manage']['delete'],1);?> value="1" name="visitor-manage_delete">	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Visitor Management module code  -->
					<!-- Notice And Event module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Notice And Event','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['notice-event']['own_data'],1);?> value="1" name="notice-event_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['notice-event']['view'],1);?> value="1" name="notice-event_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['notice-event']['add'],1);?> value="1" name="notice-event_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['notice-event']['edit'],1);?> value="1" name="notice-event_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['notice-event']['delete'],1);?> value="1" name="notice-event_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Notice And Event module code  -->
					<!-- Complain module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Complaint','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['complaint']['own_data'],1);?> value="1" name="complaint_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['complaint']['view'],1);?> value="1" name="complaint_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['complaint']['add'],1);?> value="1" name="complaint_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['complaint']['edit'],1);?> value="1" name="complaint_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['complaint']['delete'],1);?> value="1" name="complaint_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Complain module code  -->
					<!-- Parking Manager module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Parking Manager','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['parking-manager']['own_data'],1);?> value="1" name="parking-manager_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['parking-manager']['view'],1);?> value="1" name="parking-manager_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['parking-manager']['add'],1);?> value="1" name="parking-manager_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['parking-manager']['edit'],1);?> value="1" name="parking-manager_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['parking-manager']['delete'],1);?> value="1" name="parking-manager_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Parking Manager module code  -->
					<!-- Services module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Services','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['services']['own_data'],1);?> value="1" name="services_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['services']['view'],1);?> value="1" name="services_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['services']['add'],1);?> value="1" name="services_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['services']['edit'],1);?> value="1" name="services_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['services']['delete'],1);?> value="1" name="services_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Services module code  -->
					<!-- Facility module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Facility','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['facility']['own_data'],1);?> value="1" name="facility_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['facility']['view'],1);?> value="1" name="facility_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['facility']['add'],1);?> value="1" name="facility_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['facility']['edit'],1);?> value="1" name="facility_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['facility']['delete'],1);?> value="1" name="facility_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Facility module code  -->
					<!-- Accounts module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Accounts','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accounts']['own_data'],1);?> value="1" name="accounts_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accounts']['view'],1);?> value="1" name="accounts_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accounts']['add'],1);?> value="1" name="accounts_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accounts']['edit'],1);?> value="1" name="accounts_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['accounts']['delete'],1);?> value="1" name="accounts_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Accounts module code  -->
					<!-- Documents module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Documents','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['documents']['own_data'],1);?> value="1" name="documents_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['documents']['view'],1);?> value="1" name="documents_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['documents']['add'],1);?> value="1" name="documents_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['documents']['edit'],1);?> value="1" name="documents_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['documents']['delete'],1);?> value="1" name="documents_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Documents module code  -->
					<!-- Assets / Inventory Tracker module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Assets / Inventory Tracker','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['assets-inventory-tracker']['own_data'],1);?> value="1" name="assets-inventory-tracker_own_data">	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['assets-inventory-tracker']['view'],1);?> value="1" name="assets-inventory-tracker_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['assets-inventory-tracker']['add'],1);?> value="1" name="assets-inventory-tracker_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['assets-inventory-tracker']['edit'],1);?> value="1" name="assets-inventory-tracker_edit" >	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['assets-inventory-tracker']['delete'],1);?> value="1" name="assets-inventory-tracker_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Assets / Inventory Tracker module code  -->
					<!-- Message module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Message','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['message']['own_data'],1);?> value="1" name="message_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['message']['view'],1);?> value="1" name="message_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['message']['add'],1);?> value="1" name="message_add" >	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['message']['edit'],1);?> value="1" name="message_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['message']['delete'],1);?> value="1" name="message_delete" >	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Message module code  -->
					<!-- Profile module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Profile','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['profile']['own_data'],1);?> value="1" name="profile_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['profile']['view'],1);?> value="1" name="profile_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['profile']['add'],1);?> value="1" name="profile_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['profile']['edit'],1);?> value="1" name="profile_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['profile']['delete'],1);?> value="1" name="profile_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Profile module code  -->
					<!-- FAQ module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('FAQ','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['faq']['own_data'],1);?> value="1" name="faq_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['faq']['view'],1);?> value="1" name="faq_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['faq']['add'],1);?> value="1" name="faq_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['faq']['edit'],1);?> value="1" name="faq_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['faq']['delete'],1);?> value="1" name="faq_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- FAQ module code  -->
					<!-- Rules module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Rules','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['society_rules']['own_data'],1);?> value="1" name="society_rules_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['society_rules']['view'],1);?> value="1" name="society_rules_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['society_rules']['add'],1);?> value="1" name="society_rules_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['society_rules']['edit'],1);?> value="1" name="society_rules_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['society_rules']['delete'],1);?> value="1" name="society_rules_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Rules module code  -->
					<!-- Gallery module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Gallery','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gallery']['own_data'],1);?> value="1" name="gallery_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gallery']['view'],1);?> value="1" name="gallery_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gallery']['add'],1);?> value="1" name="gallery_add" disabled>	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gallery']['edit'],1);?> value="1" name="gallery_edit" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['gallery']['delete'],1);?> value="1" name="gallery_delete" disabled>	              
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Gallery module code  -->
					<!-- Report module code  -->							
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_min_5_res">
							<span class="menu-label">
								<?php esc_html_e('Report','apartment_mgt');?>
							</span>
						</div>
						
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_20_res">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['report']['own_data'],1);?> value="1" name="report_own_data" disabled>	              
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 menu_left_15">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['report']['view'],1);?> value="1" name="report_view">	              
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['report']['add'],1);?> value="1" name="report_add" disabled>
								</label>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_10_min">
							<div class="checkbox">
								<label>
									<input type="checkbox" <?php echo checked($access_right['staff_member']['report']['edit'],1);?> value="1" name="report_edit" disabled>
								</label>
							</div>
						</div>								
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 margin_left_5_res">
							<div class="checkbox">
									<input type="checkbox" <?php echo checked($access_right['staff_member']['report']['delete'],1);?> value="1" name="report_delete" disabled>
								<label>
								</label>
							</div>
						</div>								
					</div>							
					<!-- Report module code  -->
				 				
				</div>						
				<div class="col-sm-8 row_bottom mt-2">	
					<input type="submit" value="<?php esc_html_e('Save', 'apartment_mgt' ); ?>" name="save_access_right" class="btn btn-success"/>
				</div>					
			</form>
		</div><!---END PANEL BODY DIV -->
</div> <!--- END PANEL WHITE DIV -->   