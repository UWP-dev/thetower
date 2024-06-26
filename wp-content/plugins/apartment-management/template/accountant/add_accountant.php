<?php $role='accountant';?>
<script type="text/javascript">
	function member_imgefileCheck(obj)
	{
		"use strict";
		var fileExtension = ['jpg','jpeg','png'];
		if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
		{
			alert("<?php esc_html_e('Only jpg,jpeg,png File allowed','apartment_mgt') ?>");
			$(obj).val('');
		}	
	}
	function fileCheck(obj)
	{
		"use strict";
		var fileExtension = ['pdf','doc','jpg','jpeg','png'];
		if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
		{
			
			alert("<?php esc_html_e('Sorry, only JPG, pdf, docs., JPEG, PNG And GIF files are allowed.','apartment_mgt');?>");
			$(obj).val('');
		}	
	}
	</script>

<script type="text/javascript">
	$(document).ready(function()
	{
		"use strict";
		$('#staffmember_form').validationEngine();
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
		//user name not  allow space validation
		$('#username').keypress(function( e ) {
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
	   if($active_tab == 'add_accountant')
	    {
        	$accountant_id=0;
			if(isset($_REQUEST['accountant_id']))
				$accountant_id=$_REQUEST['accountant_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
				{
					$edit=1;
					$result = get_userdata($accountant_id);
				} ?>
				
		<div class="panel-body"><!--PANEL BODY-->
		    <!--STAFF MEMBER FORM-->
			<form name="staffmember_form" action="" method="post" class="form-horizontal" id="staffmember_form" enctype="multipart/form-data">
				<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				<input type="hidden" name="user_id" value="<?php echo esc_attr($accountant_id);?>"  />
				<input type="hidden" name="role" value="<?php echo esc_attr($role);?>"  />
				
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
								<input id="middle_name" class="form-control validate[custom[onlyLetterSp]]" type="text" maxlength="50" value="<?php if($edit){ echo esc_attr($result->middle_name);}elseif(isset($_POST['middle_name'])) echo esc_attr($_POST['middle_name']);?>" name="middle_name">
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
							.dropdown-menu 
							{
								min-width: 240px;
							}
                    </style>
					
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="email"><?php esc_html_e('Email','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="email" class="form-control validate[required,custom[email]] text-input" type="text" maxlength="50" name="email" 
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
								<input id="mobile" class="form-control validate[required,custom[phone]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;" name="mobile" 
								value="<?php if($edit){ echo esc_attr($result->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="username"><?php esc_html_e('User Name','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="username" class="form-control validate[required,custom[username_validation]]" maxlength="30" type="text"  name="username" 
								value="<?php if($edit){ echo esc_attr($result->user_login);}elseif(isset($_POST['username'])) echo esc_attr($_POST['username']);?>" <?php if($edit) echo "readonly";?>>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="password"><?php esc_html_e('Password','apartment_mgt');?><?php if(!$edit) {?><span class="require-field">*</span><?php }?></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="password" class="form-control <?php if(!$edit) echo 'validate[required]';?>" type="password"  name="password" minlength="8" maxlength="12" value="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Image','apartment_mgt');?></label>
							<div class="col-sm-2">
								<input type="text" id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
								value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['amgt_user_avatar'])) echo $_POST['amgt_user_avatar']; ?>" readonly />
								<input type="hidden" class="form-control" name="hidden_upload_user_avatar_image"  onchange="member_imgefileCheck(this);" 
								value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['hidden_upload_user_avatar_image'])) echo $_POST['hidden_upload_user_avatar_image']; ?>" />
							</div>	
								<div class="col-sm-3 margin_top_10_res">
									 <input id="upload_user_avatar" name="upload_user_avatar_image" class="image-preview-show" onchange="member_imgefileCheck(this);" type="file" />
								</div>
							<div class="clearfix"></div>
							
							<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<div id="upload_user_avatar_preview" >
										 <?php if($edit) 
											{
											if($result->amgt_user_avatar == "")
											{?>
											<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
											<?php }
											else {
												?>
											<img class="user_image" src="<?php if($edit)echo esc_url( $result->amgt_user_avatar ); ?>" />
											<?php 
											}
											}
											else {
												?>
												<img alt="" src="<?php echo esc_url(get_option( 'amgt_system_logo' )); ?>">
												<?php 
											} ?>
									</div>
							</div>
						</div>
					</div>
		</div>
					<?php wp_nonce_field('save_accountant_nonce_frontend'); ?>
					<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add Accountant','apartment_mgt');}?>" name="save_accountant" class="btn btn-success"/>
					</div>
            </form><!--END STAFF MEMBER FORM-->
			<!--End Accountant Information---->
        </div><!--END PANEL BODY-->
  <?php } ?>