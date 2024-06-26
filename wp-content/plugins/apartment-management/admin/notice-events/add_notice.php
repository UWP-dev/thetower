<?php ?>
<script type="text/javascript">
	$(document).ready(function() 
	{   //NOTICE FORM VALIDATIONENGINE
		"use strict";
		<?php
			if (is_rtl())
				{
				?>	
					$('#notice_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
				<?php
				}
				else{
					?>
					$('#notice_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
					<?php
				}
			?>
			var date = new Date();
            date.setDate(date.getDate()-0);
            jQuery('#notice_valid').datepicker({
					dateFormat: "yy-mm-dd",
					minDate:'today',
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
	} );
</script>
<script type="text/javascript">
function fileCheck(obj)
{   //FILE VALIDATIONENGINE
	"use strict";
	var fileExtension = ['pdf','doc','jpg','jpeg','png'];
	if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
	{
		alert("<?php esc_html_e('Sorry, only JPG, pdf, docs., JPEG, PNG And GIF files are allowed.','apartment_mgt');?>");
		$(obj).val('');
	}	
}

</script>
    <?php 	
	if($active_tab == 'add_notice')
	{
		$notice_id=0;
		if(isset($_REQUEST['notice_id']))
			$notice_id=$_REQUEST['notice_id'];
		$edit=0;
			if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit')
			{
				
				$edit=1;
				$result = $obj_notice->MJ_amgt_get_single_notice($notice_id);
			} ?>
		    <div class="panel-body"><!--PANEL BODY-->
			    <!--NOTICE FORM-->
				<form name="notice_form" action="" method="post" class="form-horizontal" id="notice_form" enctype="multipart/form-data">
					<?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
					<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
					<input type="hidden" name="notice_id" value="<?php echo esc_attr($notice_id);?>"  />
					<div class="form-group"><!--TITLE-->
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="notice_title"><?php esc_html_e('Notice Title','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-8">
								<input id="notice_title" maxlength="50" class="form-control text-input validate[required]" type="text"  value="<?php if($edit){ echo $result->notice_title;}elseif(isset($_POST['notice_title'])) echo esc_attr($_POST['notice_title']);?>" name="notice_title">
							</div>
						</div>
					</div>
					
					<div class="form-group"><!---NOTICETYPE--->
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="type"><?php esc_html_e('Notice Type','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<?php $noticetype = "Announcement"; if($edit){ $noticetype=$result->notice_type; }elseif(isset($_POST['notice_type'])) {$noticetype=$_POST['notice_type'];}?>
								<label class="radio-inline">
								 <input type="radio" value="Announcement" class="tog" name="notice_type"  <?php  checked( 'Announcement', $noticetype);  ?>/><?php esc_html_e('Announcement','apartment_mgt');?>
								</label>
								<label class="radio-inline">
								  <input type="radio" value="Proposal" class="tog" name="notice_type"  <?php  checked( 'Proposal', $noticetype);  ?>/><?php esc_html_e('Proposal','apartment_mgt');?> 
								</label>
							
							</div>
						</div>
					</div>
					<!---DOCUMENT--->
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="Document"><?php esc_html_e('Document','apartment_mgt');?></label>
							<div class="col-sm-2">
								<input type="text" readonly id="amgt_user_avatar_url" class="form-control" name="amgt_user_avatar"  
								value="<?php if($edit){ echo esc_url( $result->notice_doc );} elseif(isset($_POST['amgt_user_avatar'])){ echo $_POST['amgt_user_avatar']; }?>" />
							</div>	
							<div class="col-sm-3">
							<input type="hidden" name="hidden_upload_file" value="<?php if($edit){ echo $result->notice_doc;}elseif(isset($_POST['upload_file'])) echo $_POST['upload_file'];?>">
								<input id="upload_file" name="upload_file" type="file" onchange="fileCheck(this);" class=""  />		
									
							  </div>
						</div>
					</div>
					<!---DESCRIPTION--->
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								 <textarea name="description" id="description" class="form-control validate[required] text-input"><?php if($edit){ echo esc_textarea($result->description); }elseif(isset($_POST['description'])) echo esc_textarea($_POST['description']);?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="notice_valid"><?php esc_html_e('Notice Valid Until','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input id="notice_valid" class="form-control validate[required]" type="text"  autocomplete="off" name="notice_valid" 
								value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->valid_date)));}elseif(isset($_POST['notice_valid'])) echo esc_attr($_POST['notice_valid']);?>">
							</div>
						</div>
					</div>
						<div class="form-group margin_bottom_5px">
							<div class="mb-3 row">	
								<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="enable"><?php esc_html_e('Send SMS','apartment_mgt');?></label>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 margin_bottom_5px">
									 <div class="margin_top_3px checkbox">
										<label>
											<input class="mt-2" id="chk_sms_sent" type="checkbox" <?php $smgt_sms_service_enable = 0;if($smgt_sms_service_enable) echo "checked";?> value="1" name="amgt_sms_service_enable">
										</label>
									</div>
							 
								</div>
							</div>
						</div>
		
				<div id="hmsg_message_sent" class="hmsg_message_none margin_bottom_5px">
					<div class="form-group">
						<div class="mb-3 row">	
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="sms_template"><?php esc_html_e('SMS Text','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<textarea name="sms_template" class="form-control validate[required,custom[address_description_validation]]" maxlength="160"></textarea>
								<label><?php esc_html_e('Max. 160 Character','apartment_mgt');?></label>
							</div>
						</div>
					</div>
				</div>
					<?php wp_nonce_field( 'save_notice_nonce' ); ?>
					<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="submit" value="<?php if($edit){ esc_html_e('Submit','apartment_mgt'); }else{ esc_html_e('Submit','apartment_mgt');}?>" name="save_notice" class="btn btn-success"/>
					</div>
				</form><!--END NOTICE FORM-->
            </div><!--END PANEL BODY-->
     <?php 
	 } ?>