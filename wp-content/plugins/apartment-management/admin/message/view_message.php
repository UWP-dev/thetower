<script>
jQuery(document).ready(function() {
	"use strict";
  jQuery("span.timeago").timeago();
});
</script>
<?php 
//----------------- SEND BOX -------------------//
if($_REQUEST['from']=='sendbox')
{
	$message = get_post($_REQUEST['id']);
	MJ_amgt_change_read_status_reply($_REQUEST['id']);
	$author = $message->post_author;	
	$box='sendbox';
	if(isset($_REQUEST['delete']))
	{
		echo $_REQUEST['delete'];
		wp_delete_post($_REQUEST['id']);
		$obj_message->MJ_amgt_delete_message($_REQUEST['id']);
		wp_safe_redirect(admin_url()."admin.php?page=amgt-message&tab=sentbox&message=2" );
		exit();
	}
}

if($_REQUEST['from']=='inbox')//INBOX
{
	$message = $obj_message->MJ_amgt_get_message_by_id($_REQUEST['id']);
	$message1 = get_post($message->post_id);
	$author = $message1->post_author;
	MJ_amgt_change_read_status($_REQUEST['id']);
	MJ_amgt_change_read_status_reply($message->post_id);
	$box='inbox';
	
	if(isset($_REQUEST['delete']))
	{
		
		wp_delete_post($message->post_id);
		$obj_message->MJ_amgt_delete_message($message->post_id);
		wp_safe_redirect(admin_url()."admin.php?page=amgt-message&tab=inbox&message=2" );
		exit();
	}

}
if(isset($_POST['replay_message']))//REPLAY MESSAGE
{
	$message_id=$_REQUEST['id'];
	$message_from=$_REQUEST['from'];
	$result=$obj_message->MJ_amgt_send_replay_message($_POST);
	if($result)
	{
		wp_safe_redirect(admin_url()."admin.php?page=amgt-message&tab=view_message&from=".$message_from."&id=$message_id&message=1" );
	}
}
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete-reply')//DELETE REPLAY
{
	$message_id=$_REQUEST['id'];
	$message_from=$_REQUEST['from'];
	$result=$obj_message->MJ_amgt_delete_reply($_REQUEST['reply_id']);
	if($result)
	{
		wp_redirect ( admin_url().'admin.php?page=amgt-message&tab=view_message&from='.$message_from.'&id='.$message_id.'&message=2');
	}
}
?>
<div class="mailbox-content"><!-- MAIL BOIX CONTENT DIV -->
 	<div class="message-header"><!--MESSAGE HEADER---->
		<h3><span><?php esc_html_e('Subject','apartment_mgt')?> :</span>  <?php if($box=='sendbox'){ echo esc_html($message->post_title); } else{ echo esc_html($message->msg_subject); } ?></h3>
        <p class="message-date"><?php  if($box=='sendbox') {  echo  esc_html(date(MJ_amgt_date_formate(),strtotime($message->post_date))); } else  {  echo  esc_html(date(MJ_amgt_date_formate(),strtotime($message->msg_date ))) ;  }?></p>
	</div>
	<div class="message-sender"><!--MESSAGE HEADER---->                                
    	<p><?php if($box=='sendbox'){
				$message_for=get_post_meta($_REQUEST['id'],'message_for',true);
				echo esc_html__('From: ','apartment_mgt').MJ_amgt_get_display_name($message->post_author)."<span>&lt;".MJ_amgt_get_emailid_byuser_id($message->post_author)."&gt;</span><br>";
				if($message_for == 'user'){
				echo esc_html__('To: ','apartment_mgt').MJ_amgt_get_display_name(get_post_meta($_REQUEST['id'],'message_for_userid',true))."<span>&lt;".MJ_amgt_get_emailid_byuser_id(get_post_meta($_REQUEST['id'],'message_for_userid',true))."&gt;</span><br>";}
				else{
				echo esc_html__('To: ','apartment_mgt').esc_html__('Group','apartment_mgt');}?>
			<?php } 
			else
			{ 
				echo  esc_html_e('From :','apartment_mgt') .MJ_amgt_get_display_name($message->sender)."<span>&lt;".MJ_amgt_get_emailid_byuser_id($message->sender) ?> &gt; </span> <br> <?php esc_html_e('To :','apartment_mgt');MJ_amgt_get_display_name($message->receiver);  ?> <span>&lt; <?php echo MJ_amgt_get_emailid_byuser_id($message->receiver);?>&gt;</span>
			<?php 
			}?>
		</p>
    </div>
    <div class="message-content"><!--MESSAGE CONTENT---->
    	<p><?php $receiver_id=0;
		if($box=='sendbox'){ 
		echo wordwrap($message->post_content,120,"<br>\n",TRUE);
		$receiver_id=(get_post_meta($_REQUEST['id'],'message_for_userid',true));} else{ echo wordwrap($message->message_body,120,"<br>\n",TRUE);
		$receiver_id=$message->sender;}?></p>
		<div class="message-options pull-right">
			<a class="btn btn-default" href="?page=amgt-message&tab=view_message&id=<?php echo $_REQUEST['id'];?>&from=<?php echo $box;?>&delete=1" onclick="return confirm('<?php esc_html_e('Are you sure you want to delete this record?','apartment_mgt');?>');"><i class="fa fa-trash m-r-xs"></i><?php esc_html_e('Delete','apartment_mgt')?></a> 
	   </div>
   </div>
   <?php 
		if(isset($_REQUEST['from']) && $_REQUEST['from']=='inbox')
	  	{
	   		$allreply_data=$obj_message->MJ_amgt_get_all_replies($message->post_id);
	   	}
		else
		{
			$allreply_data=$obj_message->MJ_amgt_get_all_replies($_REQUEST['id']);
		}
		if(!empty($allreply_data))
		{
			
			foreach($allreply_data as $reply)
			{
				$receiver_name=MJ_amgt_get_receiver_name_array($reply->message_id,$reply->sender_id,$reply->created_date,$reply->message_comment);
				
		    ?>
				<div class="message-content"><!--MESSAGE CONTENT---->
					<p><?php echo $reply->message_comment;?><br>
						<h5>
						<?php
						_e('Reply By :','apartment_mgt'); 
						echo esc_html(MJ_amgt_get_display_name($reply->sender_id)); 
						_e(' || ','apartment_mgt'); 	
						_e('Reply To :','apartment_mgt'); 
						echo esc_html($receiver_name); 
						_e(' || ','apartment_mgt'); 	
						?>
					<span class="timeago" title="<?php echo esc_html(MJ_amgt_convert_time($reply->created_date));?>"></span>
					<span class="comment-delete">
					<a href="admin.php?page=amgt-message&tab=view_message&action=delete-reply&from=<?php echo $_REQUEST['from'];?>&id=<?php echo esc_attr($_REQUEST['id']);?>&reply_id=<?php echo esc_attr($reply->id);?>"><?php esc_html_e('Delete','apartment_mgt');?></a></span>
					</h5> 
					</p>
				</div>
			<?php
			}  
		}
		?>
		<script type="text/javascript">
			$(document).ready(function() 
			{
				"use strict";
				<?php
					if (is_rtl())
						{
						?>	
							$('#message-replay').validationEngine({promptPosition : "bottomLeft",maxErrorsPerField: 1});
						<?php
						}
						else{
							?>
							$('#message-replay').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
							<?php
						}
					?>
			} );
		</script>
		<script type="text/javascript">
		$(document).ready(function() 
		{	
			"use strict";
			  $('#selected_users').multiselect({ 
				nonSelectedText :'<?php _e("Select users to reply","apartment_mgt");?>',
				includeSelectAllOption: true,
				enableFiltering: true,
				selectAllText : '<?php esc_html_e('Select all','apartment_mgt'); ?>',
				enableCaseInsensitiveFiltering: true,
				filterPlaceholder: '<?php _e('Search for Users...','apartment_mgt');?>',
					templates: {
					button: '<button type="button" class="multiselect btn btn-default dropdown-toggle" data-bs-toggle="dropdown" data-flip="false"><span class="multiselect-selected-text"></span><b class="caret"></b></button>',
				},
				buttonContainer: '<div class="dropdown" />'				
			 });
			 $("body").on("click","#check_reply_user",function()
			 {
				"use strict";
				var checked = $(".dropdown-menu input:checked").length;

				if(!checked)
				{
					alert("<?php esc_html_e('Please select atleast one users to reply','apartment_mgt');?>");
					return false;
				}		
			}); 
			$("body").on("click","#replay_message_btn",function()
			{
				"use strict";
				$(".replay_message_div").show();	
				$(".replay_message_btn").hide();	
			});   
		});
		</script>
		<form name="message-replay" method="post" id="message-replay"><!--MESSAGE REPLAY FORM---->
			<input type="hidden" name="message_id" value="<?php if($_REQUEST['from']=='sendbox') echo esc_attr($_REQUEST['id']); else echo esc_attr($message->post_id);?>">
			<input type="hidden" name="user_id" value="<?php echo get_current_user_id();?>">
			<?php
			global $wpdb;
			$tbl_name = $wpdb->prefix .'amgt_message';
			$current_user_id=get_current_user_id();
			if((string)$current_user_id == $author)
			{		
				if($_REQUEST['from']=='sendbox')
				{
					$msg_id=$_REQUEST['id']; 
					$msg_id_integer=(int)$msg_id;
					$reply_to_users =$wpdb->get_results("SELECT *  FROM $tbl_name where post_id = $msg_id_integer");			
				}
				else
				{
					$msg_id=$message->post_id;			
					$msg_id_integer=(int)$msg_id;
					$reply_to_users =$wpdb->get_results("SELECT *  FROM $tbl_name where post_id = $msg_id_integer");			
				}		
			}
			else
			{
				$reply_to_users=array();
				$reply_to_users[]=(object)array('receiver'=>$author);
			}
			?>
			
			<div class="message-options pull-right">
				<button type="button" name="replay_message_btn" class="btn btn-default replay_message_btn" id="replay_message_btn"><i class="fa fa-reply m-r-xs"></i><?php esc_html_e('Reply','apartment_mgt')?></button>
		 	</div>

			<div class="message-content float_left_width_100 replay_message_div">
				<div class="col-sm-12">
					<div class="form-group" >
						<div class="mb-3 row">	
							<label class="col-sm-3 control-label form-label" ><?php _e('Select user to reply','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-9 margin_bottom_20">			
								<select name="receiver_id[]" class="form-select" id="selected_users" multiple="true">
									<?php						
									foreach($reply_to_users as $reply_to_user)
									{  	
										$user_data=get_userdata($reply_to_user->receiver);
										if(!empty($user_data))
										{								
											if($reply_to_user->receiver != get_current_user_id())
											{
												?>
												<option  value="<?php echo esc_attr($reply_to_user->receiver);?>" ><?php echo esc_html(MJ_amgt_apartment_get_display_name($reply_to_user->receiver)); ?></option>
												<?php
											}
										}							
									} 
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">	
					<div class="form-group">
					<div class="mb-3 row">
							<label class="col-sm-3 control-label form-label" for="photo"><?php _e('Message Comment','apartment_mgt');?><span class="require-field">*</span></label>
							<div class="col-sm-8 margin_bottom_10">
								<textarea name="replay_message_body" maxlength="150" id="replay_message_body" class=" form-control validate[required] text-input"></textarea>
							</div>
						</div>
					</div>
				</div>	  
			  	<div class="message-options pull-right reply-message-btn">
					<button type="submit" name="replay_message" class="btn btn-success" id="check_reply_user"><?php esc_html_e('Send','apartment_mgt')?></button>
				
			 	</div>
			</div>
		</form><!--END MESSAGE REPLAY FORM---->
 </div><!-- MAIL BOIX CONTENT DIV -->
<?php ?>