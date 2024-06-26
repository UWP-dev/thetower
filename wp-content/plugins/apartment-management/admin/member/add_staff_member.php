<?php $role='staff_member';
?>
	<script type="text/javascript">
		$(document).ready(function() {
			//STAFF MEMBER FORM VALIDATIONENGINE
			"use strict";
			<?php
			if (is_rtl())
				{
				?>	
					$('#staffmember_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
				<?php
				}
				else{
					?>
					$('#staffmember_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
					<?php
				}
			?>
			jQuery('#birth_date').datepicker({
			dateFormat: "yy-mm-dd",
			maxDate : 0,
			changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+25',
			beforeShow: function (textbox, instance) 
			{
				instance.dpDiv.css({
					marginTop: (-textbox.offsetHeight) + 'px'                   
				});
			},    
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "/" + year);
	        }                    
		}); 
		   //USERNAME NOT  ALLOW SPACE VALIDATION
			$('#username').keypress(function( e ) 
			{
				"use strict";
			   if(e.which === 32) 
				 return false;
			});
			$('.onlyletter_number_space_validation').keypress(function( e ) 
			{ 
				"use strict";    
				var regex = new RegExp("^[0-9a-zA-Z \b]+$");
				var key = String.fromCharCode(!event.charCode ? event.which: event.charCode);
				if (!regex.test(key)) 
				{
					event.preventDefault();
					return false;
				} 
		   });  
		} );
	</script>
	<?php 	
		$member_id=0;
		if(isset($_REQUEST['member_id']))
			$member_id=$_REQUEST['member_id'];
		$edit=0;
			if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
			{
				$edit=1;
				$result = get_userdata($member_id);
			} ?>
			<div class="page-title user_header"><!--PAGE TITLE---->
		    <h3><?php esc_html_e('Add Staff Member','apartment_mgt');?></h3>
	        </div>
		<div class="panel-body"><!-------PANEL-BODY-------->
		    <!--STAFF MEMBER FORM-->
            <form name="staffmember_form" action="" method="post" class="form-horizontal" id="staffmember_form">
				<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="user_id" value="<?php echo esc_attr($member_id);?>"  />
				<input type="hidden" name="role" value="<?php echo esc_attr($role);?>"  />
                 <!--GENERAL INFORMATION-->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="first_name"><?php esc_html_e('First Name','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="first_name" class="form-control validate[required,custom[address_description_validation]] text-input" maxlength="50" type="text" value="<?php if($edit){ echo esc_attr($result->first_name);}elseif(isset($_POST['first_name'])) echo esc_attr($_POST['first_name']);?>" name="first_name">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="middle_name"><?php esc_html_e('Middle Name','apartment_mgt');?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="middle_name" class="form-control validate[custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->middle_name);}elseif(isset($_POST['middle_name'])) echo esc_attr($_POST['middle_name']);?>" name="middle_name">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="last_name"><?php esc_html_e('Last Name','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="last_name" class="form-control validate[required,custom[address_description_validation]] text-input" maxlength="50" type="text"  value="<?php if($edit){ echo esc_attr($result->last_name);}elseif(isset($_POST['last_name'])) echo esc_attr($_POST['last_name']);?>" name="last_name">
						</div>
					</div>
				</div>
				
				
				 <style>
					.dropdown-menu {
						min-width: 240px;
					}
                    </style>
				
				<div class="form-group"><!--FORM GROUP-->
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="unit_name"><?php esc_html_e('Staff Category','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-select validate[required] staff_category" name="staff_category">
								<option value=""><?php esc_html_e('Select Staff Category','apartment_mgt');?></option>
								<?php 
								if($edit)
									$category =$result->staff_category;
								elseif(isset($_REQUEST['staff_category']))
									$category =$_REQUEST['staff_category'];  
								else 
									$category = "";
								
								$activity_category=MJ_amgt_get_all_category('staff_category');
								if(!empty($activity_category))
								{
									foreach ($activity_category as $retrive_data)
									{
										echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
									}
								}?>
							</select>
						</div>
						<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="staff_category"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
					</div>	
				</div>
				
				 <!--CONTACT INFORMATION----->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="email"><?php esc_html_e('Email','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="email" class="form-control validate[required,custom[email]] text-input" maxlength="50" type="text"  name="email" 
							value="<?php if($edit){ echo esc_attr($result->user_email);}elseif(isset($_POST['email'])) echo esc_attr($_POST['email']);?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="mobile"><?php esc_html_e('Mobile Number','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-1 margin_bottom_10_res">
						
						<input type="text" readonly value="+<?php echo MJ_amgt_get_countery_phonecode(get_option( 'amgt_contry' ));?>"  class="form-control" name="phonecode">
						</div>
						<div class="col-sm-7">
							<input id="mobile" class="form-control validate[required,custom[phone_number]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;"  name="mobile" 
							value="<?php if($edit){ echo esc_attr($result->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
						</div>
					</div>
				</div>
				<!--END CONTACT INFORMATION---->
				
					<!--LOGIN INFORMATION---->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="username"><?php esc_html_e('User Name','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="username" class="form-control validate[required,custom[username_validation]]" maxlength="50" type="text"  name="username" 
							value="<?php if($edit){ echo esc_attr($result->user_login);}elseif(isset($_POST['username'])) echo esc_attr($_POST['username']);?>" <?php if($edit) echo "readonly";?>>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="password"><?php esc_html_e('Password','apartment_mgt');?><?php if(!$edit) {?><span class="require-field">*</span><?php }?></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="password" class="form-control <?php if(!$edit) echo 'validate[required]';?>" type="password" minlength="8" maxlength="12"  name="password" value="">
						</div>
					</div>
				</div>
				<!--END LOGIN INFORMATION---->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Image','apartment_mgt');?></label>
						<div class="col-sm-2 margin_bottom_10_res">
							<input type="text" id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
							value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['amgt_user_avatar'])) echo $_POST['amgt_user_avatar']; ?>" readonly />
						</div>	
					   <div class="col-sm-3 col-md-5 col-lg-5">
									 <input id="upload_user_avatar_button" type="button" class="button" value="<?php esc_html_e('Upload image', 'apartment_mgt' ); ?>" />
									 <span class="description"><?php esc_html_e('Upload image', 'apartment_mgt' ); ?></span>
							
					   </div>
					   <div class="clearfix"></div>
							<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
								 <div id="upload_user_avatar_preview" >
									 <?php if($edit) 
										{
										if($result->amgt_user_avatar == "")
										{?>
										<img class="user_image" alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
										<?php }
										else {
											?>
										<img class="user_image" src="<?php if($edit)echo esc_url( $result->amgt_user_avatar ); ?>" />
										<?php 
										}
										}
										else {
											?>
											<img class="user_image" alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
											<?php 
										}?>
								 </div>
							</div>
						</div>
				</div>
				<?php wp_nonce_field( 'save_staff_member_nonce' ); ?>
				 <div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add Staff Member','apartment_mgt');}?>" name="save_staff_member" class="btn btn-success"/>
				</div>
            </form><!--END MEMBER FORM-->
        </div><!-------END PANEL-BODY-------->