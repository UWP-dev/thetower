<?php $role='gatekeeper';
?>
<script type="text/javascript">
$(document).ready(function() 
{   //GATEKEEPER FORM VALIDATIONENGINE
	"use strict";
	<?php
	if (is_rtl())
		{
		?>	
			$('#gatekeeper_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#gatekeeper_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
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
			    }
				?>
				<div class="page-title user_header">
		          <h3><?php esc_html_e('Add Gatekeeper','apartment_mgt');?></h3>
	            </div>	
		<div class="panel-body"><!--PANEL BODY-->
		    <!----ADD GATEKEEPER FORM----->
            <form name="gatekeeper_form" action="" method="post" class="form-horizontal" id="gatekeeper_form">
				 <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
				 <input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
				 <input type="hidden" name="user_id" value="<?php echo esc_attr($member_id);?>"  />
				 <input type="hidden" name="role" value="<?php echo esc_attr($role);?>"  />
                <!----ADD GENERAL INFORMATION-----> 
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
				
				
				<!----ASSIGN DATE----->
				 <div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="gate"><?php esc_html_e('Assign Gate','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="assign-gate col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<?php $gateval = "1"; if($edit){ $gateval=$result->aasigned_gate; }elseif(isset($_POST['gate'])) {$gateval=$_POST['gate'];}
							if(!empty($gatedata))
							{
								$i=1;
								foreach($gatedata as $gate)
								{
										if($edit)
										{
										?>
										<label class="radio-inline">
										<input type="radio" value="<?php echo esc_attr($gate->id);?>" class="tog validate[required]" name="gate"  <?php  echo checked( $gate->id, $gateval);  ?>/><?php echo esc_attr($gate->gate_name);?>
										</label>							
										<?php 
										}
										else
										{?>
											<label class="radio-inline">
											<input type="radio" value="<?php echo esc_attr($gate->id);?>" class="tog validate[required]" name="gate"  <?php  if($i==1) echo "checked"; ?>/><?php echo esc_attr($gate->gate_name);?>
											</label>
										<?php 
										}
									$i+=1;
										
										
								}
							}
							else
							{ ?>
								<label class="radio-inline">
								<?php esc_html_e('No Any Gates.','apartment_mgt');
								echo "</label>";
							}
						?>
							
						</div>
						<div class="col-sm-2">
						<a href="?page=amgt-visiter-manage&ab=manage-gates" class="btn btn-default"> <?php esc_html_e('Add Gate','apartment_mgt');?></a>
						</div>
					</div>
				</div><!----END ASSIGN DATE----->
				
				
				<div class="form-group"><!----LOGIN INFORMATION---------->
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
							<input id="mobile" class="form-control validate[required,custom[phone_number]] text-input" type="number" min="0" onKeyPress="if(this.value.length==15) return false;"  name="mobile" value="<?php if($edit){ echo esc_attr($result->mobile);}elseif(isset($_POST['mobile'])) echo esc_attr($_POST['mobile']);?>">
						</div>
					</div>
				</div>
				
				<!----LOGIN INFORMATION---------->
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="username"><?php esc_html_e('User Name','apartment_mgt');?><span class="require-field">*</span></label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input id="username" class="form-control validate[required,custom[username_validation]]"  maxlength="50" type="text"  name="username" 
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
				<!----END LOGIN INFORMATION---------->
				
				<div class="form-group">
					<div class="mb-3 row">	
						<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="photo"><?php esc_html_e('Image','apartment_mgt');?></label>
						<div class="col-sm-2 margin_bottom_10_res">
							<input type="text" id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
							value="<?php if($edit)echo esc_url( $result->amgt_user_avatar );elseif(isset($_POST['amgt_user_avatar'])) echo $_POST['amgt_user_avatar']; ?>" readonly />
						</div>	
						<div class="col-sm-3">
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
				    <?php wp_nonce_field( 'save_gatekeeper_nonce' ); ?>
					<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="submit" value="<?php if($edit){ esc_html_e('Save','apartment_mgt'); }else{ esc_html_e('Add Gatekeeper','apartment_mgt');}?>" name="save_gatekeeper" class="btn btn-success"/>
					</div>
		
            </form><!----END ADD GATEKEEPER FORM----->
        </div><!--END PANEL BODY-->