<?php
//Member_Registration_Template
if(isset($_REQUEST['Member_Registration_Template'])){
	update_option('wp_amgt_Member_Registration',sanitize_text_field($_REQUEST['wp_amgt_Member_Registration']));
	update_option('wp_amgt_registration_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_registration_email_template']));	
} 
//Member_approve_email_template_save
 if(isset($_REQUEST['Member_approve_email_template_save'])){
	update_option('wp_amgt_Member_approve_subject',sanitize_text_field($_REQUEST['wp_amgt_Member_approve_subject']));
	update_option('wp_amgt_Member_approve_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_Member_approve_email_template']));	
}
//Member_Become_committee_email_template_save
if(isset($_REQUEST['Member_Become_committee_email_template_save'])){
	update_option('wp_amgt_Member_Become_committee_subject',sanitize_text_field($_REQUEST['wp_amgt_Member_Become_committee_subject']));
	update_option('wp_amgt_Member_Become_committee_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_Member_Become_committee_email_template']));	
} 
//Member_removed_committee_email_template_save
if(isset($_REQUEST['Member_removed_committee_email_template_save'])){
	update_option('wp_amgt_Member_removed_committee_subject',sanitize_text_field($_REQUEST['wp_amgt_Member_removed_committee_subject']));
	update_option('wp_amgt_Member_removed_committee_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_Member_removed_committee_email_template']));	
		
} 
//add_user_subject_email_template_save
if(isset($_REQUEST['add_user_subject_email_template_save'])){
	update_option('wp_amgt_add_user_subject',sanitize_text_field($_REQUEST['wp_amgt_add_user_subject']));
	update_option('wp_amgt_add_user_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_user_email_template']));	
		
}
// add_notice_email_template_save
if(isset($_REQUEST['add_notice_email_template_save'])){
	
	update_option('wp_amgt_add_notice_subject',sanitize_text_field($_REQUEST['wp_amgt_add_notice_subject']));
	update_option('wp_amgt_add_notice_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_notice_email_template']));	
	
}
// add_event_email_template_save
if(isset($_REQUEST['add_event_email_template_save'])){
	
	update_option('wp_amgt_add_event_subject',sanitize_text_field($_REQUEST['wp_amgt_add_event_subject']));
	update_option('wp_amgt_add_event_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_event_email_template']));	
	
} 
//add_complaint_email_template_save
if(isset($_REQUEST['add_complaint_email_template_save'])){
	
	update_option('wp_amgt_add_complaint_subject',sanitize_text_field($_REQUEST['add_complaint_subject']));
	update_option('wp_amgt_add_complaint_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_complaint_email_template']));	
	
}
// add_complaint_email_template_save
if(isset($_REQUEST['add_assign_sloat_email_template_save'])){
	
	update_option('wp_amgt_add_assign_sloat_subject',sanitize_text_field($_REQUEST['wp_amgt_add_assign_sloat_subject']));
	update_option('wp_amgt_add_assign_sloat_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_assign_sloat_email_template']));	
	
}
//book_facility_email_template_save
if(isset($_REQUEST['book_facility_email_template_save'])){
	
	update_option('wp_amgt_book_facility_subject',sanitize_text_field($_REQUEST['wp_amgt_book_facility_subject']));
	update_option('wp_amgt_book_facility_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_book_facility_email_template']));	
	
}
//book_facility_email_template_save_admin
if(isset($_REQUEST['book_facility_email_template_for_admin_save'])){
	
	update_option('wp_amgt_book_facility_subject_admin',sanitize_text_field($_REQUEST['wp_amgt_book_facility_subject_admin']));
	update_option('wp_amgt_book_facility_email_template_admin',sanitize_textarea_field($_REQUEST['wp_amgt_book_facility_email_template_admin']));	
	
}
//generate_invoice_email_template_save 
if(isset($_REQUEST['generate_invoice_email_template_save'])){
	
	update_option('wp_amgt_generate_invoice_subject',sanitize_text_field($_REQUEST['wp_amgt_generate_invoice_subject']));
	update_option('wp_amgt_generate_invoice_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_generate_invoice_email_template']));	
	
}
//paid_invoice_email_template_save 
if(isset($_REQUEST['paid_invoice_email_template_save'])){
	update_option('wp_amgt_paid_invoice_subject',sanitize_text_field($_REQUEST['wp_amgt_paid_invoice_subject']));
	update_option('wp_amgt_paid_invoice_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_paid_invoice_email_template']));	
}
//add_charges_email_template_save 
if(isset($_REQUEST['add_charges_email_template_save'])){
	update_option('wp_amgt_add_charges_subject',sanitize_text_field($_REQUEST['wp_amgt_add_charges_subject']));
	update_option('wp_amgt_add_charges_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_add_charges_email_template']));	
} 
//Message_Received_Template_save
if(isset($_REQUEST['Message_Received_Template_save'])){
	
	update_option('wp_amgt_Message_Received_subject',sanitize_text_field($_REQUEST['wp_amgt_Message_Received_subject']));
	update_option('wp_amgt_Message_Received_Template',sanitize_textarea_field($_REQUEST['wp_amgt_Message_Received_Template']));	
	
} 
//ADD COMPLAIN FOR ADMIN //
if(isset($_REQUEST['Complain_For_Admin_Template_save'])){
	update_option('wp_amgt_Admin_Complain',sanitize_text_field($_REQUEST['wp_amgt_Admin_Complain']));
	update_option('wp_amgt_admin_complain_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_admin_complain_email_template']));	
}
if(isset($_REQUEST['visitor_request_save'])){
	update_option('wp_amgt_visitor_request_subject',sanitize_text_field($_REQUEST['wp_amgt_visitor_request_subject']));
	update_option('wp_amgt_visitor_request_content',sanitize_textarea_field($_REQUEST['wp_amgt_visitor_request_content']));	
}

if(isset($_REQUEST['visitor_request_aproved_save'])){
	update_option('wp_amgt_visitor_request_aproved_subject',sanitize_text_field($_REQUEST['wp_amgt_visitor_request_aproved_subject']));
	update_option('wp_amgt_visitor_request_aproved_content',sanitize_textarea_field($_REQUEST['wp_amgt_visitor_request_aproved_content']));	
}
//approved_facility_email_template_save
if(isset($_REQUEST['approved_facility_email_template_save'])){
	
	update_option('wp_amgt_approved_facility_subject',sanitize_text_field($_REQUEST['wp_amgt_approved_facility_subject']));
	update_option('wp_amgt_approved_facility_email_template',sanitize_textarea_field($_REQUEST['wp_amgt_approved_facility_email_template']));	
}
?>
<div class="page-inner min_height_1088"><!-- PAGE INNER DIV -->
	<div class="page-title"> <!---PAGE TITLE------>	
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>
	<div id="main-wrapper"><!-- MAIN WRAPPER DIV -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!---PANEL WHITE----->	
					<div class="panel-body"><!---PANEL BODY------>	
						<div class="panel-group accordion" id="accordionExample">
							<!-----------Registration Email Template---------------->
							<div class="accordion-item panel panel-default">
									<div class="panel-heading">
									  <h4 class="accordion-header panel-title" id="headingOne"> <!--PANEL TITLE------>	
										<button class="accordion-button accordion-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<?php esc_html_e('Registration Email Template ','apartment_mgt'); ?>
									  </button>
									  </h4>
									</div>
									<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									  <div class="accordion-body panel-body">
										<form id="registration_email_template_form" class="form-horizontal" method="post" action="" name="parent_form">
											
											<div class="form-group">
												<div class="mb-3 row">	
													<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?><span class="require-field">*</span> </label>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<input class="form-control validate[required]" name="wp_amgt_Member_Registration" id="wp_amgt_Member_Registration" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Member_Registration'); ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="mb-3 row">	
													<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Registration Email Template','apartment_mgt'); ?><span class="require-field">*</span> </label>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<textarea name="wp_amgt_registration_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_registration_email_template'); ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="mb-3 row">	
													<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
														<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
														<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
														<label><strong>{{unit_name}} </strong> <?php esc_html_e('Unit Name','apartment_mgt'); ?></label><br>
														<label><strong>{{building_name}} </strong> <?php esc_html_e('Building Name','apartment_mgt'); ?></label><br>
														<label><strong>{{loginlink}} </strong> <?php esc_html_e('Login Link','apartment_mgt'); ?></label><br>
													</div>
												</div>
											</div>
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
												<input value="<?php esc_html_e('Save','apartment_mgt');?>"  name="Member_Registration_Template" class="btn btn-success" type="submit">
											</div>
										</form>
									  </div>
									</div>
							</div>
							<!-----------Member Approved by Admin Template----------------->
							<div class="accordion-item panel panel-default">
									<div class="panel-heading">
									  <h4 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											<?php esc_html_e('Member Approved by Admin Template ','apartment_mgt'); ?>
										  </button>
									  </h4>
									</div>
									<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
									  <div class="accordion-body panel-body">
										<form id="wp_amgt_registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
										
											<div class="form-group">
												<div class="mb-3 row">	
													<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<input class="form-control validate[required]" name="wp_amgt_Member_approve_subject" id="wp_amgt_Member_approve_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Member_approve_subject'); ?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="mb-3 row">	
													<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Member Approved by Admin Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
													<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<textarea name="wp_amgt_Member_approve_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_Member_approve_email_template'); ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="mb-3 row">	
													<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
														<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
														<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
														<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
														<label><strong>{{loginlink}} </strong> <?php esc_html_e('Login Page Link','apartment_mgt'); ?></label><br>
													</div>
												</div>
											</div>
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
												<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="Member_approve_email_template_save" class="btn btn-success" type="submit">
											</div>
										</form>
									  </div>
									</div>
							</div>
		  
						<!-----------Member become committee member--------------------->
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingthree">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtin" aria-expanded="false" aria-controls="collapseFourtin">
								<?php esc_html_e('Member Become from committee member','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseFourtin" class="accordion-collapse collapse" aria-labelledby="headingthree" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="wp_amgt_registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_Member_Become_committee_subject" id="wp_amgt_Member_Become_committee_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Member_Become_committee_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Member Become committee Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_Member_Become_committee_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_Member_Become_committee_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{loginlink}} </strong> <?php esc_html_e('Login Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="Member_Become_committee_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>
						<!-----------Member Removed from committee member--------------------->
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingfour">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									<?php esc_html_e('Member Removed from committee member','apartment_mgt'); ?>
									</button>
							  </h4>
							</div>
							<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingfour" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_Member_removed_committee_subject" id="wp_amgt_Member_removed_committee_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Member_removed_committee_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Member Removed from committee Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_Member_removed_committee_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_Member_removed_committee_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}}</strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}}</strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="Member_removed_committee_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>
						<!-----------ADD OTHER USER IN SYSTEM TEMPLATE--------------------->
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingfive">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
								<?php esc_html_e('Add Other User in system Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_user_subject" id="wp_amgt_add_user_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_user_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Other User in system Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-md-8">
												<textarea name="wp_amgt_add_user_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_user_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}}</strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}}</strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{rolename}}</strong> <?php esc_html_e('User Role','apartment_mgt'); ?></label><br>
												<label><strong>{{username}}</strong> <?php esc_html_e('Username','apartment_mgt'); ?></label><br>
												<label><strong>{{password}}</strong> <?php esc_html_e('Password','apartment_mgt'); ?></label><br>
												<label><strong>{{loginlink}}</strong> <?php esc_html_e('Login Page Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_user_subject_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>
						  
						<!-----------Add NOTICE TEMPLATE--------------------->
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingsix">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
									<?php esc_html_e('Add Notice Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingsix" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_notice_subject" id="wp_amgt_add_notice_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_notice_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Notice Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_add_notice_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_notice_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{notice_title}} </strong> <?php esc_html_e('Notice Title','apartment_mgt'); ?></label><br>
												<label><strong>{{notice_type}} </strong> <?php esc_html_e('Notice Type','apartment_mgt'); ?></label><br>
												<label><strong>{{notice_valid_date}} </strong> <?php esc_html_e('Notice Valid Date','apartment_mgt'); ?></label><br>
												<label><strong>{{notice_content}} </strong> <?php esc_html_e('Notice Content','apartment_mgt'); ?></label><br>
												<label><strong>{{Notice_Link}} </strong> <?php esc_html_e('Notice Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_notice_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						  
						<!-----------Add EVENT TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingseven">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
										<?php esc_html_e('Add Event Template','apartment_mgt'); ?>
									</button>
							  </h4>
							</div>
							<div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingseven" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_event_subject" id="add_notice_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_event_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Event Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-md-8">
												<textarea name="wp_amgt_add_event_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_event_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{event_title}} </strong> <?php esc_html_e('Event Title','apartment_mgt'); ?></label><br>
												<label><strong>{{event_start_date}} </strong> <?php esc_html_e('Event Start Date','apartment_mgt'); ?></label><br>
												<label><strong>{{event_end_date}} </strong> <?php esc_html_e('Event End Date','apartment_mgt'); ?></label><br>
												<label><strong>{{event_start_time}} </strong> <?php esc_html_e('Event Start Time','apartment_mgt'); ?></label><br>
												<label><strong>{{event_end_time}} </strong> <?php esc_html_e('Event End Time','apartment_mgt'); ?></label><br>
												<label><strong>{{event_description}} </strong> <?php esc_html_e('Event Description','apartment_mgt'); ?></label><br>
												<label><strong>{{Event_Link}} </strong> <?php esc_html_e('Event Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_event_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						  
						<!-----------Add COMPLAINT TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingeight">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
									<?php esc_html_e('Add Complaint Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingeight" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_complaint_subject" id="wp_amgt_add_complaint_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_complaint_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Complaint Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_add_complaint_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_complaint_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{nature}} </strong> <?php esc_html_e('Complaint Nature','apartment_mgt'); ?></label><br>
												<label><strong>{{noticetype}} </strong> <?php esc_html_e('Notice Type','apartment_mgt'); ?></label><br>
												<label><strong>{{noticecategory}} </strong> <?php esc_html_e('Notice Category','apartment_mgt'); ?></label><br>
												<label><strong>{{complaintstatus}} </strong> <?php esc_html_e('Complaint Status','apartment_mgt'); ?></label><br>
												<label><strong>{{description}} </strong> <?php esc_html_e('Complaint Description','apartment_mgt'); ?></label><br>
												<label><strong>{{apartmentnumber}} </strong> <?php esc_html_e('Apartment Number','apartment_mgt'); ?></label><br>
												<label><strong>{{complainfrom}} </strong> <?php esc_html_e('Complaint From','apartment_mgt'); ?></label><br>
												<label><strong>{{Complain_Link}} </strong> <?php esc_html_e('Complaint Link','apartment_mgt'); ?></label><br>
												</div>
											</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_complaint_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						
						
						<!-----------Add COMPLAINT FOR ADMIN  TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingnine">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefourteen" aria-expanded="false" aria-controls="collapsefourteen">
									<?php esc_html_e('Add Complaint For Admin','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsefourteen" class="accordion-collapse collapse" aria-labelledby="headingnine" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_Admin_Complain" id="wp_amgt_Admin_Complain" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Admin_Complain'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Complain For Admin Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_admin_complain_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_admin_complain_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{admin_name}} </strong> <?php esc_html_e('Name of admin','apartment_mgt'); ?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{nature}} </strong> <?php esc_html_e('Complaint Nature','apartment_mgt'); ?></label><br>
												<label><strong>{{noticetype}} </strong> <?php esc_html_e('Notice Type','apartment_mgt'); ?></label><br>
												<label><strong>{{noticecategory}} </strong> <?php esc_html_e('Notice Category','apartment_mgt'); ?></label><br>
												<label><strong>{{complaintstatus}} </strong> <?php esc_html_e('Complaint Status','apartment_mgt'); ?></label><br>
												<label><strong>{{description}} </strong> <?php esc_html_e('Complaint Description','apartment_mgt'); ?></label><br>
												<label><strong>{{apartmentnumber}} </strong> <?php esc_html_e('Apartment Number','apartment_mgt'); ?></label><br>
												<label><strong>{{complainfrom}} </strong> <?php esc_html_e('Complaint From','apartment_mgt'); ?></label><br>
												<label><strong>{{complainto}} </strong> <?php esc_html_e('Complaint From','apartment_mgt'); ?></label><br>
												<label><strong>{{Complain_Link}} </strong> <?php esc_html_e('Complaint Link','apartment_mgt'); ?></label><br>
												</div>
											</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="Complain_For_Admin_Template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						  
						<!-----------Add ASSIGN SLOAT TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingten">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
									<?php esc_html_e('Assign Parking Slot Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingten" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_assign_sloat_subject" id="wp_amgt_add_assign_sloat_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_assign_sloat_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Assign Slot Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_add_assign_sloat_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_assign_sloat_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{slotname}} </strong> <?php esc_html_e('Slot Name','apartment_mgt'); ?></label><br>
												<label><strong>{{startdate}} </strong> <?php esc_html_e('Start Date','apartment_mgt'); ?></label><br>
												<label><strong>{{enddate}} </strong> <?php esc_html_e('End Date','apartment_mgt'); ?></label><br>
												<label><strong>{{vehiclenumber}} </strong> <?php esc_html_e('Vehicle Number','apartment_mgt'); ?></label><br>
												<label><strong>{{vehiclemodel}} </strong> <?php esc_html_e('Vehicle Model','apartment_mgt'); ?></label><br>
												<label><strong>{{vehicletype}} </strong> <?php esc_html_e('Vehicle Type','apartment_mgt'); ?></label><br>
												<label><strong>{{RFID}} </strong> <?php esc_html_e('RFID','apartment_mgt'); ?></label><br>
												<label><strong>{{Sloat_Link}} </strong> <?php esc_html_e('Asign Slot Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_assign_sloat_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						  
						<!-----------Book Facility TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingeleven">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
									<?php esc_html_e('Facility Booking Template For Member','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsenine" class="accordion-collapse collapse" aria-labelledby="headingeleven" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_book_facility_subject" id="wp_amgt_book_facility_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_book_facility_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Facility Booking Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_book_facility_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_book_facility_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_name}} </strong> <?php esc_html_e('Facility Name','apartment_mgt'); ?></label><br>
												<label><strong>{{booked_user_name}} </strong> <?php esc_html_e('Booked User Name','apartment_mgt'); ?></label><br>
												<label><strong>{{activity_name}} </strong> <?php esc_html_e('Activity Name','apartment_mgt'); ?></label><br>
												<label><strong>{{from_date}} </strong> <?php esc_html_e('Booking For From Date','apartment_mgt'); ?></label><br>
												<label><strong>{{to_date}} </strong> <?php esc_html_e('Booking For To Date','apartment_mgt'); ?></label><br>
												<label><strong>{{from_time}} </strong> <?php esc_html_e('Booking For From Time','apartment_mgt'); ?></label><br>
												<label><strong>{{to_time}} </strong> <?php esc_html_e('Booking For To Time','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_charge}} </strong> <?php esc_html_e('Facility Charge','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_link}} </strong> <?php esc_html_e('Facility Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="book_facility_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>


                         <!-----------Book Facility TEMPLATE For Admin------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingtwelve">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesaventeen" aria-expanded="false" aria-controls="collapsesaventeen">
									<?php esc_html_e('Facility Booking Template For Admin','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsesaventeen" class="accordion-collapse collapse" aria-labelledby="headingtwelve" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_book_facility_subject_admin" id="wp_amgt_book_facility_subject_admin" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_book_facility_subject_admin'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Facility Booking Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_book_facility_email_template_admin" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_book_facility_email_template_admin'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_name}} </strong> <?php esc_html_e('Facility Name','apartment_mgt'); ?></label><br>
												<label><strong>{{booked_user_name}} </strong> <?php esc_html_e('Booked User Name','apartment_mgt'); ?></label><br>
												<label><strong>{{activity_name}} </strong> <?php esc_html_e('Activity Name','apartment_mgt'); ?></label><br>
												<label><strong>{{from_date}} </strong> <?php esc_html_e('Booking For From Date','apartment_mgt'); ?></label><br>
												<label><strong>{{to_date}} </strong> <?php esc_html_e('Booking For To Date','apartment_mgt'); ?></label><br>
												<label><strong>{{from_time}} </strong> <?php esc_html_e('Booking For From Time','apartment_mgt'); ?></label><br>
												<label><strong>{{to_time}} </strong> <?php esc_html_e('Booking For To Time','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_charge}} </strong> <?php esc_html_e('Facility Charge','apartment_mgt'); ?></label><br>
												<label><strong>{{facility_link}} </strong> <?php esc_html_e('Facility Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="book_facility_email_template_for_admin_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>							

                        <!-----------Approved Facility Mail TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingthirteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenineteen" aria-expanded="false" aria-controls="collapsenineteen">
									<?php esc_html_e('Approved Facility Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsenineteen" class="accordion-collapse collapse" aria-labelledby="headingthirteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_approved_facility_subject" id="wp_amgt_approved_facility_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_approved_facility_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Facility Approved Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_approved_facility_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_approved_facility_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{admin_name}} </strong> <?php esc_html_e('Name of admin','apartment_mgt'); ?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												</div>
											</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="approved_facility_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>							
						<!-----------GENERATE INVOICE TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headringfourteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten" aria-expanded="false" aria-controls="collapseten">
									<?php esc_html_e('Generate Invoice Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseten" class="accordion-collapse collapse" aria-labelledby="headingfifteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_generate_invoice_subject" id="wp_amgt_generate_invoice_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_generate_invoice_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Generate Invoice Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_generate_invoice_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_generate_invoice_email_template'); ?></textarea>
											</div>
										</div>
									</div>
										<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{Payment Link}} </strong> <?php esc_html_e('Payment Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="generate_invoice_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>

						</div>

						<!-----------PAID INVOICE TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="accordion-header panel-title" id="headingfifteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeleven" aria-expanded="false" aria-controls="collapseeleven">
									<?php esc_html_e('Paid Invoice Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapseeleven" class="accordion-collapse collapse" aria-labelledby="headingfifteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-md-8">
												<input class="form-control validate[required]" name="wp_amgt_paid_invoice_subject" id="wp_amgt_paid_invoice_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_paid_invoice_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Paid Invoice Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_paid_invoice_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_paid_invoice_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												<label><strong>{{invoiceno}} </strong> <?php esc_html_e('Invoice No','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="paid_invoice_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>  
						 <!-----------Message Received------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingsixteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwelve" aria-expanded="false" aria-controls="collapsetwelve">
									<?php esc_html_e('Message Received Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsetwelve" class="accordion-collapse collapse" aria-labelledby="headingsixteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_Message_Received_subject" id="wp_amgt_Message_Received_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_Message_Received_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Message Received Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_Message_Received_Template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_Message_Received_Template'); ?></textarea>
											</div>
										</div>
									</div>
										<div class="form-group">
											<div class="mb-3 row">
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{Receiver Name}} </strong> <?php esc_html_e('Name of Receiver','apartment_mgt'); ?></label><br>
												<label><strong>{{Sender Name}} </strong> <?php esc_html_e('Name Of Sender','apartment_mgt'); ?></label><br>
												<label><strong>{{Message Content}} </strong> <?php esc_html_e('Message Content','apartment_mgt'); ?></label><br>
												<label><strong>{{Apartment Name}} </strong> <?php esc_html_e('Name Of Apartment ','apartment_mgt'); ?></label><br>
												<label><strong>{{Message_Link}} </strong> <?php esc_html_e('Message Link','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="Message_Received_Template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						 </div>	  
						 
						 <!-----------ADD CHARGES TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingseventeen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethirteen" aria-expanded="false" aria-controls="collapsethirteen">
									<?php esc_html_e('Add Charges Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsethirteen" class="accordion-collapse collapse" aria-labelledby="headingseventeen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_add_charges_subject" id="wp_amgt_add_charges_subject" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_add_charges_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Add Charges Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_add_charges_email_template" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_add_charges_email_template'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="add_charges_email_template_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>
						
						<!-----------Visitor Request Template------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingeighteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefifteen" aria-expanded="false" aria-controls="collapsefifteen">
									<?php esc_html_e('Visitor Request Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsefifteen" class="accordion-collapse collapse" aria-labelledby="headingeighteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_visitor_request_subject" id="visitor_request" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_visitor_request_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Visitor Request Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_visitor_request_content" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_visitor_request_content'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{admin_name}} </strong> <?php esc_html_e('Name of admin','apartment_mgt'); ?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{visit_reson}} </strong> <?php esc_html_e('Reson For Visit','apartment_mgt'); ?></label><br>
												<label><strong>{{visit_time}} </strong> <?php esc_html_e('Visit Time','apartment_mgt'); ?></label><br>
												<label><strong>{{Visit Date}} </strong> <?php esc_html_e('Visit Date','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
												
												</div>
											</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="visitor_request_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>	
						
						
						<!-----------Add COMPLAINT FOR ADMIN  TEMPLATE------------------>
						<div class="accordion-item panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title accordion-header" id="headingnineteen">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesixteen" aria-expanded="false" aria-controls="collapsesixteen">
									<?php esc_html_e('Approved Visitor Request Template','apartment_mgt'); ?>
								</button>
							  </h4>
							</div>
							<div id="collapsesixteen" class="accordion-collapse collapse" aria-labelledby="headingnineteen" data-bs-parent="#accordionExample">
							  <div class="accordion-body panel-body">
								<form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
								
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<input class="form-control validate[required]" name="wp_amgt_visitor_request_aproved_subject" id="visitor_request" placeholder="Enter email subject" value="<?php print get_option('wp_amgt_visitor_request_aproved_subject'); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<label for="first_name" class="col-sm-3 control-label form-label"><?php esc_html_e('Approved Visitor Request Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<textarea name="wp_amgt_visitor_request_aproved_content" class="form-control validate[required] min_height_200"><?php print get_option('wp_amgt_visitor_request_aproved_content'); ?></textarea>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="mb-3 row">	
											<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<label><?php esc_html_e('You can use following variables in the email template:','apartment_mgt');?></label><br>
												<label><strong>{{member_name}} </strong> <?php esc_html_e('Name of Member','apartment_mgt'); ?></label><br>
												<label><strong>{{apartment_name}} </strong> <?php esc_html_e('Name Of Apartment','apartment_mgt'); ?></label><br>
											</div>
										</div>
									</div>
									<div class="offset-sm-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">        	
										<input value="<?php esc_html_e('Save','apartment_mgt');?>" name="visitor_request_aproved_save" class="btn btn-success" type="submit">
									</div>
								</form>
							  </div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- END MAIN WRAPPER DIV -->
</div><!-- PAGE INNER DIV -->
