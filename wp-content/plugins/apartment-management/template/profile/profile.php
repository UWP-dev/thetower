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
	$obj_member=new MJ_amgt_Member;
	$user = wp_get_current_user ();
	$user_data =get_userdata( $user->ID);
	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$wp_hasher = new PasswordHash( 8, true );
	//------------------ SAVE CHANGE -----------------//
	if(isset($_POST['save_change']))
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_change_nonce' ) )
		{
		$referrer = $_SERVER['HTTP_REFERER'];
		$success=0;
		if($wp_hasher->CheckPassword($_REQUEST['current_pass'],$user_data->user_pass))
		{
			if($_REQUEST['new_pass']!="")
			{
				if(isset($_REQUEST['new_pass']) && $_REQUEST['new_pass'] ==$_REQUEST['conform_pass'] && isset($_REQUEST['conform_pass']))
				{
					 wp_set_password( $_REQUEST['new_pass'], $user->ID);
						$success=1;
				}
				else
				{
					wp_redirect($referrer.'&sucess=2');
				}
			}
			else
			{
				wp_redirect($referrer.'&message=5');
			}
		}
		else{
			wp_redirect($referrer.'&sucess=3');
		}
		if($success==1)
		{
			wp_cache_delete($user->ID,'users');
			wp_cache_delete($user_data->user_login,'userlogins');
			wp_logout();
			if(wp_signon(array('user_login'=>$user_data->user_login,'user_password'=>$_REQUEST['new_pass']),false)):
				$referrer = $_SERVER['HTTP_REFERER'];
				
				wp_redirect($referrer.'&sucess=1');
			endif;
			ob_start();
		}else
		{
          wp_set_auth_cookie($user->ID, true);
		}
	}
	}
	$first_name = get_user_meta($user_data->ID,'first_name',true);
	$last_name = get_user_meta($user_data->ID,'last_name',true);	
	if(isset($_POST['save_profile_pic']))
	{
		$referrer = $_SERVER['HTTP_REFERER'];
		if($_FILES['profile']['size'] > 0)
		{
			$image=MJ_amgt_load_documets($_FILES['profile'],$_FILES['profile'],'pimg');
		
			$profile_image_url=content_url().'/uploads/apartment_assets/'.$image;
		}
		$returnans=update_user_meta($user->ID,'amgt_user_avatar',$profile_image_url);
	
		if($returnans)
		{
		 	wp_redirect($referrer.'&message=6');
		}	
	}
?>
<?php 
	$edit=1;
	$coverimage=get_option( 'amgt_apartment_background_image' );
	if($coverimage!="")
	{?>
<style>
.profile-cover
{
	background: url("<?php echo get_option( 'amgt_apartment_background_image' );?>") repeat scroll 0 0 / cover rgba(0, 0, 0, 0);
}
<?php }?>
</style>

<div>
	<!-- POP UP CODE -->
	<div class="popup-bg">
		<div class="overlay-content">
		<div class="modal-content">
		<div class="profile_picture">
		 </div>		 
		</div>
		</div>  
	</div>
	<!-- END POP-UP CODE -->
	<div class="profile-cover"><!-- PROFILE-COVER -->
		<div class="row">
			<div class="col-md-3 profile-image">
						<div class="profile-image-container">
						<?php $umetadata=get_user_meta($user->ID, 'amgt_user_avatar', true);
							
							if(empty($umetadata))
							{
								echo '<img src='.esc_url(get_option( 'amgt_system_logo' )).' height="150px" width="150px" class="img-circle" />';
							}
							else
							{

								echo '<img src='.esc_url($umetadata).' height="150px" width="150px" class="img-circle" />';
							}
										
						?>
						</div>
					<div class="col-md-1 profile_div">
						<button class="btn btn-default btn-file" type="file" name="profile_change" id="profile_change"><?php esc_html_e('Update Profile','apartment_mgt');?></button>
					</div>
			</div>
	    </div>
	</div>				
	<div Id="main-wrapper"> <!-- WRAPPER DIV -->
		<div class="row user-details"><!-- USER DETAILS DIV -->
			<div class="col-md-3 col-sm-12 col-xs-12 user-profile">
				<h3 class="text-center">
					<?php 
						echo esc_html($user_data->display_name);
					?>
				</h3>				
				<hr>
				<ul class="list-unstyled text-center">
					<?php if($user_data->address!='' || $user_data->city!=''){?>
					<li>
					<p><i class="fa fa-map-marker m-r-xs"></i>
						<a href="https://www.google.co.in/maps" target="_blank"><?php echo esc_html($user_data->address) ." , ".esc_html($user_data->city);?></a></p>
					</li>	
					<?php } ?>
					<li><i class="fa fa-envelope m-r-xs"></i>
								<a href="https://mail.google.com" target="_blank"><?php echo esc_html($user_data->user_email);?></a></p>
					</p></li>
				</ul>
			</div>
			
			<div class="col-md-8 col-sm-12 col-xs-12 m-t-lg">
			<?php if(isset($_REQUEST['message']))
			{
				$message =$_REQUEST['message'];
				if($message == 2)
				{?>
					<div id="message_template" class="col-md-12 col-sm-12 col-xs-12 m-t-lg alert_msg alert alert-success alert-dismissible margin_left_0" role="alert">
						<?php
						_e("Record updated successfully.",'apartment_mgt');
						?>
						<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php 
					
				}
				if($message == 3)
				{?>
					<div id="message_template" class="col-md-12 col-sm-12 col-xs-12 m-t-lg alert_msg alert alert-success alert-dismissible margin_left_0" role="alert">
						<?php
						_e("Confirm password does not match.",'apartment_mgt');
						?>
						<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php 
					
				}
				if($message == 4)
				{?>
					<div id="message_template" class="col-md-12 col-sm-12 col-xs-12 m-t-lg alert_msg alert alert-success alert-dismissible margin_left_0" role="alert">
						<?php
						_e("Enter correct current password.",'apartment_mgt');
						?>
						<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php 
					
				}
				if($message == 5)
				{ ?>
					<div id="message_template" class="col-md-12 col-sm-12 col-xs-12 m-t-lg alert_msg alert alert-success alert-dismissible margin_left_0" role="alert">
						<?php
						_e("Enter New password.",'apartment_mgt');
						?>
						<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php 
					
				}if($message == 6)
				{ ?>
					<div id="message_template" class="col-md-12 col-sm-12 col-xs-12 m-t-lg alert_msg alert alert-success alert-dismissible margin_left_0" role="alert">
						<?php
						_e("Profile Successfully updated.",'apartment_mgt');
						?>
						<button type="button" class="close btn-close float-end p-3" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php 
					
				}
			}?>
				<div class="panel panel-white"><!-- PANEL WHITE -->
				    <div class="panel-heading"><!-- PANEL HEADING DIV -->
						<div class="panel-title"><?php esc_html_e('Account Settings ','apartment_mgt');?>	</div>
					</div>
					<div class="panel-body"><!-- PANEL BODY-->
						<form class="form-horizontal" action="#" method="post"><!-- FORM-HORIZONTAL-->
							<div class="form-group">
									<div class="mb-3 row">	
										<label  class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"></label>
										<div class="col-xs-10">	
											<p>
											<h4 class="bg-danger"><?php 
											if(isset($_REQUEST['sucess']))
											{ 
												if($_REQUEST['sucess']==1)
												{
													wp_safe_redirect(home_url()."?apartment-dashboard=user&page=profile&action=edit&message=2" );
												}
												if($_REQUEST['sucess']==2)
												{
													wp_safe_redirect(home_url()."?apartment-dashboard=user&page=profile&action=edit&message=3" );
												}
												if($_REQUEST['sucess']==3)
												{
													wp_safe_redirect(home_url()."?apartment-dashboard=user&page=profile&action=edit&message=4" );
												}
												
												
											}?></h4>
										</p>
										</div>
									</div>
							</div>
							<!---GENERAL INFORMATION--->
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputEmail" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Name','apartment_mgt');?></label>
									<div class="col-sm-10">
										<input type="Name" class="form-control " id="name" placeholder="Full Name" value="<?php echo esc_attr($user->display_name); ?>" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputEmail" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Username','apartment_mgt');?></label>
									<div class="col-sm-10">
										<input type="username" class="form-control " id="name" placeholder="Full Name" value="<?php echo esc_attr($user->user_login); ?>" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputPassword" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Current Password','apartment_mgt');?></label>
									<div class="col-sm-10">
										<input type="password" class="form-control"  id="inputPassword" placeholder="<?php esc_html_e('Current Password','apartment_mgt');?>" name="current_pass">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputPassword" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('New Password','apartment_mgt');?></label>

									<div class="col-sm-10">

										<input type="password" class="validate[required] form-control" minlength="8" maxlength="12" id="inputPassword" placeholder="<?php esc_html_e('New Password','apartment_mgt');?>" name="new_pass">

									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputPassword" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Confirm Password','apartment_mgt');?></label>
									<div class="col-sm-10">
										<input type="password" class="validate[required] form-control" minlength="8" maxlength="12" id="inputPassword" placeholder="<?php esc_html_e('Confirm Password','apartment_mgt');?>" name="conform_pass">
									</div>
								</div>
							</div>
                             <?php wp_nonce_field( 'save_change_nonce' ); ?>
							<div class="form-group">

								<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

									<button type="submit" class="btn btn-success" name="save_change"><?php esc_html_e('Save','apartment_mgt');?></button>

								</div>
							</div>
							<!---GENERAL INFORMATION--->
						</form>
					</div><!-- END PANEL BODY-->		   
				</div>	<!-- END PANEL WHITE -->				
				<?php 	$user_info=get_userdata(get_current_user_id()); ?> 
				<div class="panel panel-white"><!---PANEL-WHITE--->
					<div class="panel-heading"><!---PANEL-HEADING--->
						<div class="panel-title"><?php esc_html_e('Other Information','apartment_mgt');?>	</div>
					</div>
					<div class="panel-body"><!---PANEL BODY--->
						<form class="form-horizontal" action="#" method="post" id="member_form">
							<input type="hidden" value="edit" name="action">
							<input type="hidden" value="<?php echo esc_attr($obj_apartment->role);?>" name="role">
							<input type="hidden" value="<?php echo esc_attr(get_current_user_id());?>" name="user_id">
							<input type="hidden" value="<?php print esc_attr($first_name); ?>" name="first_name" >
							<input type="hidden" value="<?php print esc_attr($last_name); ?>" name="last_name" >
							<div class="form-group">
								<div class="mb-3 row">	
									<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="mobile"><?php esc_html_e('Mobile Number','apartment_mgt');?><span class="require-field">*</span></label>
									<div class="col-sm-2 margin_bottom_10_res">
									
									<input type="text" readonly value="+<?php echo esc_attr(MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' )));?>"  class="form-control" name="phonecode">
									</div>
									<div class="col-sm-8">
										<input id="mobile" class="form-control validate[required,custom[phone]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;"  name="mobile" maxlength="10"
										value="<?php if($edit){ echo esc_attr($user_info->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="mb-3 row">	
									<label for="inputEmail" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label"><?php esc_html_e('Email','apartment_mgt');?></label>
									<div class="col-sm-10">

										<input id="email" class="form-control validate[required,custom[email]] text-input" maxlength="50" type="text"  name="email" value="<?php if($edit){ echo esc_attr($user_info->user_email);}?>">

									</div>
								</div>

							</div>
							
		
							<div class="form-group">
								<div class="mb-3 row">
									<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">

										<button type="submit" class="btn btn-success" name="profile_save_change"><?php esc_html_e('Save','apartment_mgt');?></button>

									</div>
								</div>
							</div>
						</form>
					</div><!---END PANEL BODY--->
				</div><!---END PANEL-WHITE--->
			</div>					
			
		</div>

    </div><!-- WRAPPER DIV -->
</div>
<?php 
	if(isset($_POST['profile_save_change']))
	{
		$result=$obj_member->MJ_amgt_add_member($_POST);
		if($result)
		{ 
			wp_safe_redirect(home_url()."?apartment-dashboard=user&page=profile&action=edit&message=2" );
		}
	}
?>