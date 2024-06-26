<?php 
    $user_type=sanitize_text_field(isset($_REQUEST['user_type'])?$_REQUEST['user_type']:'member');
	$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'memberlist');
	$obj_member=new MJ_amgt_Member;
	$obj_units=new MJ_amgt_ResidentialUnit;
    $obj_gate=new MJ_amgt_gatekeeper;
    $gatedata=$obj_gate->Amgt_get_all_gates();
	
?>
<!-- POP UP CODE -->
<div class="popup-bg z_index_100000">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"> </div>
		</div>
    </div>    
</div>
<!-- END POP-UP CODE -->
<div class="page-inner min_height_1088"><!-- PAGE INNER DIV -->
	<div class="page-title">
		<h3><img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div>

<!-- import csv of user	 -->

<?php

if(isset($_REQUEST['upload_csv_file']))
{	
  

    if(isset($_FILES['csv_file']))
    {	

		$usert_type=$_POST['user_type'];
		$errors= array();
		$file_name = $_FILES['csv_file']['name'];
		$file_size =$_FILES['csv_file']['size'];
		$file_tmp =$_FILES['csv_file']['tmp_name'];
		$file_type=$_FILES['csv_file']['type'];

		$value = explode(".", $_FILES['csv_file']['name']);
		$file_ext = strtolower(array_pop($value));
		$extensions = array("csv");
		$upload_dir = wp_upload_dir();
		if(in_array($file_ext,$extensions )=== false){
			$errors[]="this file not allowed, please choose a CSV file.";
			wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=importcsvlist&message=16');
		}
		if($file_size > 2097152)
		{
			$errors[]='File size limit 2 MB';
			wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=importcsvlist&message=17');
		}
		
		if(empty($errors)==true)
		{	
			
			$rows = array_map('str_getcsv', file($file_tmp));		
		
			$header = array_map('strtolower',array_shift($rows));
				
			$csv = array();
			foreach ($rows as $row) 
			{	
				$header_size=sizeof($header);
				$row_size=sizeof($row);
				if($header_size == $row_size)
				{
					$csv = array_combine($header, $row);
					
					$username = $csv['username'];
					$email = $csv['email'];
					$user_id = 0;
					
					$password = $csv['password'];
					
					$problematic_row = false;
					
					if( username_exists($username) )
					{ // if user exists, we take his ID by login
						$user_object = get_user_by( "login", $username );
						$user_id = $user_object->ID;
					
						if( !empty($password) )
							wp_set_password( $password, $user_id );
					}
					elseif( email_exists( $email ) )
					{ // if the email is registered, we take the user from this
						$user_object = get_user_by( "email", $email );
						$user_id = $user_object->ID;					
						$problematic_row = true;
					
						if( !empty($password) )
							wp_set_password( $password, $user_id );
					}
					else{
						if( empty($password) ) // if user not exist and password is empty but the column is set, it will be generated
							$password = wp_generate_password();
					
						$user_id = wp_create_user($username, $password, $email);
					}
					
					if( is_wp_error($user_id) )
					{ // in case the user is generating errors after this checks
						echo '<script>alert("'.esc_html__('Problems with user','apartment_mgt').'" : "'.esc_html__($username,'apartment_mgt').'","'.esc_html__('we are going to skip','apartment_mgt').'");</script>';
						continue;
					}

					if(!( in_array("administrator", MJ_amgt_get_roles($user_id), FALSE) || is_multisite() && is_super_admin( $user_id ) ))
					{

						if($usert_type == 'staff_member')
						{
							wp_update_user(array ('ID' => $user_id, 'role' => 'staff_member'));

							if(isset($csv['badge_id']))
								update_user_meta( $user_id, "badge_id", $csv['badge_id'] );
							if(isset($csv['staff_category']))
								update_user_meta( $user_id, "staff_category", $csv['staff_category'] );
							if(isset($csv['qualification']))
								update_user_meta( $user_id, "qualification", $csv['qualification'] );
							if(isset($csv['skills']))
								update_user_meta( $user_id, "skills", $csv['skills'] );
							wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=stafflist&message=19');
						}
						else if($usert_type == 'accountant')
						{
							wp_update_user(array ('ID' => $user_id, 'role' => 'accountant'));

							if(isset($csv['badge_id']))
								update_user_meta( $user_id, "badge_id", $csv['badge_id'] );
							if(isset($csv['qualification']))
								update_user_meta( $user_id, "qualification", $csv['qualification'] );	
							wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=accountantlist&message=19');

						}
						else if($usert_type == 'gatekeeper')
						{
							wp_update_user(array ('ID' => $user_id, 'role' => 'gatekeeper'));
							wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=gatekeeperlist&message=19');

						}
						else if($usert_type == 'member')
						{
							wp_update_user(array ('ID' => $user_id, 'role' => 'member'));
							
							$building_id=$_POST['building_id'];
							$unit_category =$_POST['unit_cat_id'];
							$unit_name =$_POST['unit_name']; 

							if(isset($csv['member_type']))
								update_user_meta( $user_id, "member_type", $csv['member_type'] );	

							if(isset($building_id))
								update_user_meta( $user_id, "building_id", $building_id);	

							if(isset($unit_category))
								update_user_meta( $user_id, "unit_cat_id", $unit_category);
								
							if(isset($csv['unit_name']))
								update_user_meta( $user_id, "unit_name",  $csv['unit_name'] );
							wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=memberlist&message=19');			
							
						}
					}
	             
					wp_update_user(array ('ID' => $user_id, 'display_name' => $csv['first_name'] .' '.$csv['last_name'])) ;
	
					if(isset($csv['first_name']))
						update_user_meta( $user_id, "first_name", $csv['first_name'] );
					if(isset($csv['middle_name']))
						update_user_meta( $user_id, "middle_name", $csv['middle_name'] );
					if(isset($csv['last_name']))
						update_user_meta( $user_id, "last_name", $csv['last_name'] );
					if(isset($csv['gender']))
						update_user_meta( $user_id, "gender", $csv['gender'] );
					if(isset($csv['birth_date']))
						update_user_meta( $user_id, "birth_date",$csv['birth_date']);

					if(isset($csv['address']))
						update_user_meta( $user_id, "address", $csv['address'] );
					
					if(isset($csv['city_name']))
						update_user_meta( $user_id, "city_name", $csv['city_name'] );
					if(isset($csv['state_name']))
						update_user_meta( $user_id, "state_name", $csv['state_name'] );
					if(isset($csv['country_name']))
						update_user_meta( $user_id, "country_name", $csv['country_name'] );
					if(isset($csv['zipcode']))
						update_user_meta( $user_id, "zipcode", $csv['zipcode'] );
					if(isset($csv['mobile']))
						update_user_meta( $user_id, "mobile", $csv['mobile'] );
					$success = 1;
				}
				else
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=importcsvlist&message=18');						
				}
			}
		}
		else
		{
			foreach($errors as &$error) echo $error;
		}
		if(isset($success))
		{
		?>
			<div id="message" class="updated below-h2 notice is-dismissible">
				<p><?php esc_html_e('Import User CSV Successfully Uploaded.','apartment_mgt');?></p>
			</div>
		<?php
		} 
    }
}

?>
   

<!-- ADD MEMBER-->
<?php 
//---------------------- SAVE MEMBER -------------------------//
	if(isset($_POST['save_member']))		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_member_nonce' ) )
		{
			$upload_docs_array=array(); 
			$document_title=array(); 
			
			if($_FILES['id_proof_1']['name'] != "" && $_FILES['id_proof_1']['size'] > 0)
			{
				$id_proof_1=MJ_amgt_load_documets($_FILES['id_proof_1'],$_FILES['id_proof_1'],'id_proof_1');
			}
			else
			{
				$id_proof_1=$_REQUEST['hidden_id_proof_1'];
			} 
			
			if($_FILES['id_proof_2']['name'] != "" && $_FILES['id_proof_2']['size'] > 0)
			{
				$id_proof_2=MJ_amgt_load_documets($_FILES['id_proof_2'],$_FILES['id_proof_2'],'id_proof_2');
			}
			else
			{
				$id_proof_2=$_REQUEST['hidden_id_proof_2'];
			} 
			
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
			$document_title=$_POST['doc_title'];
			if(!empty($_FILES['upload_file']['name']))//UPLOAD FILE

			{

				$count_array=count($_FILES['upload_file']['name']);

				for($a=0;$a<$count_array;$a++)

				{	

					foreach($_FILES['upload_file'] as $image_key=>$image_val)

					{	

						$document_array[$a]=array(

						'name'=>$_FILES['upload_file']['name'][$a],

						'type'=>$_FILES['upload_file']['type'][$a],

						'tmp_name'=>$_FILES['upload_file']['tmp_name'][$a],

						'error'=>$_FILES['upload_file']['error'][$a],

						'size'=>$_FILES['upload_file']['size'][$a]

						);	

					}

				}	

				foreach($document_array as $key=>$value)
				{	

					$get_file_name=$document_array[$key]['name'];	

					$upload_docs_array[]=MJ_amgt_load_documets($value,$value,$get_file_name);

				} 

			}
			else
			{
				
				$upload_docs_array=$_REQUEST['hidden_upload_file'];

			} 
			
			 $imagurl=$_POST['upload_user_avatar_image'];
			  $ext=MJ_amgt_check_valid_extension($imagurl);
			    if(!$ext == 0)
			    {
			         $result=$obj_member->MJ_amgt_add_member($_POST);
					 $obj_member->MJ_amgt_update_upload_documents($id_proof_1,$id_proof_2,$document_title,$upload_docs_array,$result);
						if($result)
						{
							wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=memberlist&message=14');
						}
			   }
				else
					{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
			   <?php }
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] ))
		    {
				$document_title=$_POST['doc_title'];
				if(!empty($_FILES['upload_file']['name']))//UPLOAD FILE
				{

					$count_array=count($_FILES['upload_file']['name']);

					for($a=0;$a<$count_array;$a++)
					{	
						foreach($_FILES['upload_file'] as $image_key=>$image_val)
						{	

							$document_array[$a]=array(

							'name'=>$_FILES['upload_file']['name'][$a],

							'type'=>$_FILES['upload_file']['type'][$a],

							'tmp_name'=>$_FILES['upload_file']['tmp_name'][$a],

							'error'=>$_FILES['upload_file']['error'][$a],

							'size'=>$_FILES['upload_file']['size'][$a]

							);	

						}

					}	

					foreach($document_array as $key=>$value)
					{	

						$get_file_name=$document_array[$key]['name'];	

						$upload_docs_array[]=MJ_amgt_load_documets($value,$value,$get_file_name);	

					} 

				}

				$imagurl=$_POST['amgt_user_avatar'];
			    $ext=MJ_amgt_check_valid_extension($imagurl);
			    if(!$ext == 0)
			     {
				  $result=$obj_member->MJ_amgt_add_member($_POST);
				  $obj_member->MJ_amgt_upload_documents($id_proof_1,$id_proof_2,$document_title,$upload_docs_array,$result);	
				  if($result)
				   {
					 wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=memberlist&message=15');
				    }
				 }
				 
				 else{ ?>
				        <div id="message" class="updated below-h2 notice is-dismissible">
						    <p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
						</div>
		        <?php }
			}
		    else{ ?>
						<div id="message" class="updated below-h2 notice is-dismissible">
						   <p><p><?php esc_html_e('Username Or Emailid Already Exist.','apartment_mgt');?></p></p>
						</div>
	      <?php }
		}
	 }
	}
	
	if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'active_member')
	{
		//---------------- SEND  SMS ------------------//
		include_once(ABSPATH.'wp-admin/includes/plugin.php');
		if(is_plugin_active('sms-pack/sms-pack.php'))
		{
			if(!empty(get_user_meta($_REQUEST['member_id'], 'phonecode',true))){ $phone_code=get_user_meta($_REQUEST['member_id'], 'phonecode',true); }else{ $phone_code='+'.MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' )); }
							
			$user_number[] = $phone_code.get_user_meta($_REQUEST['member_id'], 'mobile',true);
			
			$apartmentname=get_option('amgt_system_name');
			$message_content ="You are successfully registered at $apartmentname .";
			$current_sms_service 	= get_option( 'smgt_sms_service');
			$args = array();
			$args['mobile']=$user_number;
			$args['message_from']="Registration";
			$args['message']=$message_content;					
			if($current_sms_service=='telerivet' || $current_sms_service ="MSG91" || $current_sms_service=='bulksmsgateway.in' || $current_sms_service=='textlocal.in' || $current_sms_service=='bulksmsnigeria' || $current_sms_service=='africastalking' || $current_sms_service == 'clickatell')
			{				
				$send = send_sms($args);							
			}
		}
		$member_id = $_REQUEST['member_id'];
		delete_user_meta($member_id, 'amgt_hash');
		$user_info = get_userdata($member_id);
		$to = $user_info->user_email; 
		$subject =get_option('wp_amgt_Member_approve_subject');
		
		$apartmentname=get_option('amgt_system_name');
		$message_content=get_option('wp_amgt_Member_approve_email_template');
		
		$loginlink=home_url().'/apartment-management/';
		$subject_search=array('{{apartment_name}}');
		$subject_replace=array($apartmentname);
		$search=array('{{member_name}}','{{apartment_name}}','{{loginlink}}');
		$replace = array($user_info->display_name,$apartmentname,$loginlink);
		$message_content = str_replace($search, $replace, $message_content);
		$subject=str_replace($subject_search,$subject_replace,$subject);
		MJ_amgt_SendEmailNotification($to,$subject,$message_content);
		wp_redirect ( admin_url() . 'admin.php?page=amgt-member&tab=memberlist&message=4');
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete_staff')
	{
		
		$result=$obj_member->MJ_amgt_delete_usedata($_REQUEST['member_id']);
		if($result)
		{ 
			wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=stafflist&message=5');
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
					esc_html_e('Record inserted successfully','apartment_mgt');
				?></p></div>
				<?php 
			
		}
		elseif($message == 2)
		{?><div id="message" class="updated below-h2 notice is-dismissible"><p><?php
					_e("Record updated successfully.",'apartment_mgt');
					?></p>
					</div>
				<?php 
			
		}
		elseif($message == 3) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Member Deleted Successfully','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 4) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Member Active Successfully','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 5) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Staff Member deleted successfully','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 6) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Accountant deleted successfully','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 7) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Gatekeeper deleted successfully','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 8) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Gatekeeper updated successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 9) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Gatekeeper inserted successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 10) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Staff Member updated successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 11) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Staff Member inserted successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 12) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Accountant updated successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 13) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Accountant inserted successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 14) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Member updated successfully.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 15) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Member inserted successfully.','apartment_mgt');
		?></div></p><?php		
		}
		elseif($message == 16) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('Only CSV file are allow.','apartment_mgt');
		?></div></p><?php
				
		}		
		elseif($message == 17) 
		{?>
		<div id="message" class="updated below-h2 notice is-dismissible"><p>
		<?php 
			esc_html_e('File size limit 2 MB allow.','apartment_mgt');
		?></div></p><?php
				
		}
		elseif($message == 18) 
		{?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
			<?php 
				esc_html_e('This file formate not proper.Please select CSV file with proper formate.','apartment_mgt');
			?></p></div>
			<?php				
		}
		elseif($message == 19) 
		{?>
			<div id="message" class="updated below-h2 notice is-dismissible"><p>
			<?php 
				esc_html_e('Import User CSV Successfully Uploaded.','apartment_mgt');
			?></p></div>
			<?php				
		}
	}
	?>
	
	<?php 
	if(isset($_POST['save_accountant']))//<!-- SAVE ACCOUNTANT-->		
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_accountant_nonce' ) )
		{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
		$imagurl=$_POST['amgt_user_avatar'];
			  $ext=MJ_amgt_check_valid_extension($imagurl);
			    if(!$ext == 0)
			    {	
					$result=$obj_member->MJ_amgt_add_member($_POST);
					if($result)
					{
						wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=accountantlist&message=12');
					}
				}
				else
				{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
			   <?php 
			   }
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] ))
			{
				$imagurl=$_POST['amgt_user_avatar'];
			    $ext=MJ_amgt_check_valid_extension($imagurl);
			    if(!$ext == 0)
				{
					$result=$obj_member->MJ_amgt_add_member($_POST);
					if($result)
					{
						wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=accountantlist&message=13');
					}
				}
				 else
					{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
			   <?php }
			}	
			else
			{ ?>
				<div id="message" class="updated below-h2">
				<p><p><?php esc_html_e('Username Or Emailid Already Exist.','apartment_mgt');?></p></p>
				</div>
						
	  <?php }
		}
	}
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete_account')
	{
		
		$result=$obj_member->MJ_amgt_delete_usedata($_REQUEST['member_id']);
		if($result)
		{
			wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=accountantlist&message=6');
		}
	}
	
?>
<?php 
	if(isset($_POST['save_gatekeeper']))//<!--ADD GATEKEEPER-->		
	{
		 $nonce = sanitize_text_field($_POST['_wpnonce']);
			if (wp_verify_nonce( $nonce, 'save_gatekeeper_nonce' ) )
			{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
			$imagurl=$_POST['amgt_user_avatar'];
			$ext=MJ_amgt_check_valid_extension($imagurl);
			if(!$ext == 0)
			{
				$result=$obj_member->MJ_amgt_add_member($_POST);
				if($result)
				{
					wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=gatekeeperlist&message=8');
				}
			}
			else
			    { ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
		   <?php }
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] )) {
				$imagurl=$_POST['amgt_user_avatar'];
				$ext=MJ_amgt_check_valid_extension($imagurl);
				if(!$ext == 0)
				{
				 $result=$obj_member->MJ_amgt_add_member($_POST);
					if($result)
					{
						wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=gatekeeperlist&message=9');
					}
				}
				else
			        { ?>
						<div id="message" class="updated below-h2 notice is-dismissible">
							<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
						</div>
		       <?php }
			}
			else
			{ ?>
						<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Username Or Emailid Already Exist.','apartment_mgt');?></p></p>
						</div>
						
	  <?php }		
		}
	}
	}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete_gatekeeper')//<!--DELETE-->
		{
			
			$result=$obj_member->MJ_amgt_delete_usedata($_REQUEST['member_id']);
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=gatekeeperlist&message=7');
			}
		}
		
	?>
	<?php 
	if(isset($_POST['save_staff_member']))//<!--SAVE STAFF-MEMBER-->	
	{
		$nonce = sanitize_text_field($_POST['_wpnonce']);
		if (wp_verify_nonce( $nonce, 'save_staff_member_nonce' ) )
		{
		if(isset($_REQUEST['action'])&& $_REQUEST['action']=='edit')
		{
		    $imagurl=$_POST['amgt_user_avatar'];
			$ext=MJ_amgt_check_valid_extension($imagurl);
			    if(!$ext == 0)
				{
					$result=$obj_member->MJ_amgt_add_member($_POST);
					if($result)
					{
						wp_redirect(admin_url().'admin.php?page=amgt-member&tab=stafflist&message=10');
					}
				}
				else
					{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
						<p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
					</div>
		        <?php }
		}
			else
			{
			if( !email_exists( $_POST['email'] ) && !username_exists( $_POST['username'] )) {
				$imagurl=$_POST['amgt_user_avatar'];
			    $ext=MJ_amgt_check_valid_extension($imagurl);
			     if(!$ext == 0)
				 {
					$result=$obj_member->MJ_amgt_add_member($_POST);
					if($result)
					{
						wp_redirect ( admin_url().'admin.php?page=amgt-member&tab=stafflist&message=11');
					}
				 }
				 else
			            { ?>
				        <div id="message" class="updated below-h2 notice is-dismissible">
						    <p><p><?php esc_html_e('Sorry, only JPG, JPEG, PNG And GIF files are allowed.','apartment_mgt');?></p></p>
						</div>
		           <?php }
			}	
			else
			{ ?>
					<div id="message" class="updated below-h2 notice is-dismissible">
					<p><p><?php esc_html_e('Username Or Emailid Already Exist.','apartment_mgt');?></p></p>
					</div>
						
	  <?php }	
		  }
	 }
	}
	?>
	<div id="main-wrapper"><!--MAIN-WRAPPER-->	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!--PANEL-WHITE-->
					<div class="panel-body"><!--PANEL BODY-->
						<h2 class="nav-tab-wrapper">
							<a href="?page=amgt-member&tab=memberlist" class="nav-tab <?php echo esc_html($active_tab) == 'memberlist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Member List', 'apartment_mgt'); ?></a>
							<a href="?page=amgt-member&tab=accountantlist" class="nav-tab <?php echo esc_html($active_tab) == 'accountantlist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Accountant List', 'apartment_mgt'); ?></a>
							<a href="?page=amgt-member&tab=stafflist" class="nav-tab <?php echo esc_html($active_tab) == 'stafflist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Staff Member List', 'apartment_mgt'); ?></a>
							<a href="?page=amgt-member&tab=gatekeeperlist" class="nav-tab <?php echo esc_html($active_tab) == 'gatekeeperlist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Gatekeeper List', 'apartment_mgt'); ?></a>
                            <a href="?page=amgt-member&tab=importcsvlist" class="nav-tab <?php echo esc_html($active_tab) == 'importcsvlist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Import CSV', 'apartment_mgt'); ?></a>
							
							<?php if($active_tab=='viewmember'){?>
		                    <a href="#" class="nav-tab <?php echo esc_html($active_tab) == 'viewmember' ? 'nav-tab-active' : ''; ?>">
		                    <?php echo '<span class="fa fa-eye"></span> '.esc_html__('View User','apartment_mgt'); ?></a>
		                    <?php } ?>
							
														
							<div class="dropdown">
                               <button class="dropbtn add_user_button"><span class="dashicons dashicons-plus-alt color_white" ></span><span><?php esc_html_e('Add User', 'apartment_mgt');?></span></button>
                                <div class="dropdown-content">
                                  <a href="?page=amgt-member&tab=adduser&user_type=member" class="<?php if($user_type=="member") print "info"; else print "primary" ; ?>" ><span class="dashicons dashicons-plus-alt color_black_m_t_9"></span><span class="span_drop"><?php esc_html_e('Add Member','apartment_mgt'); ?></span></a>
                                 <a href="?page=amgt-member&tab=adduser&user_type=accountant"class="<?php if($user_type=="accountant") print "info"; else print "primary"; ?>" ><span class="dashicons dashicons-plus-alt color_black_m_t_9 "></span><span class="span_drop"><?php esc_html_e('Add Accountant','apartment_mgt'); ?></span></a>
                                  <a href="?page=amgt-member&tab=adduser&user_type=staff-Member"<?php if($user_type=="staff-Member")
			                           print "info"; else print "primary"; ?> ><span class="dashicons dashicons-plus-alt color_black_m_t_9" ></span><span class="span_drop"><?php esc_html_e('Add Staff Member','apartment_mgt'); ?></span></a>
								  <a href="?page=amgt-member&tab=adduser&user_type=gatekeeper"<?php if($user_type=="gatekeeper") print "info"; else print "primary"; ?>><span class="dashicons dashicons-plus-alt color_black_m_t_9"></span><span class="span_drop"><?php esc_html_e('Add Gatekeeper','apartment_mgt'); ?></span></a>
                                </div>
                            </div>	
						</h2>

                         <?php
						 if($active_tab == 'adduser')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/member/add_user.php';
						 }
		
						 if($active_tab == 'memberlist')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/member/member_list.php';
						 }
						 if($active_tab == 'accountantlist')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/member/accountant_list.php';
						 }
						 if($active_tab == 'stafflist')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/member/staff_list.php';
						 }
						 if($active_tab == 'gatekeeperlist')
						 {
							require_once AMS_PLUGIN_DIR.'/admin/member/gatekeeper_list.php';
						 }

						 if($active_tab == 'viewmember')
	                     {		  	  
		                    require_once AMS_PLUGIN_DIR.'/admin/member/view_user.php';
	                     }
						 if($active_tab == 'importcsvlist')
	                     {		  	  
		                    require_once AMS_PLUGIN_DIR.'/admin/member/importcsvlist.php';
	                     }
						?>
                    </div><!--END PANEL BODY-->
                </div><!--END PANEL-WHITE-->
            </div>
        </div>
    </div><!--END MAIN WRAPPER-->
</div>
<!-- END PAGE INNER DIV -->