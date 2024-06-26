<?php 
	// This is Class at admin side!!!!!!!!! 
?> 
	<div class="mailbox-content">
	<div class="table-responsive">
 	<table class="table">
 		<thead>
 			<tr>
 				<th class="text-right" colspan="5">
               	<?php 
               	$max = 10;
               	if(isset($_GET['pg'])){
               		$p = $_GET['pg'];
               	}else{
               		$p = 1;
               	}
               
               	$limit = ($p - 1) * $max;
               $prev = $p - 1;
               	$next = $p + 1;
               	$limits = (int)($p - 1) * $max;
				if($obj_apartment->role=='staff_member')
				{
               		$totlal_message1 = $obj_message->MJ_amgt_count_all_send_item();
				}
				else
				{
					$totlal_message1 = $obj_message->MJ_amgt_count_send_item(get_current_user_id());
				}
               	$totlal_message = ceil($totlal_message1 / $max);
               	$lpm1 = $totlal_message - 1;               	
               	$offest_value = ($p-1) * $max;
               	echo $obj_message->MJ_amgt_pagination($totlal_message,$p,$lpm1,$prev,$next);
               	
               	?>
                </th>
 			</tr>
 		</thead>
		 <?php  if(!empty($totlal_message)){
		?> 
		<tbody>
 		<tr>
 			<th class="hidden-xs">
            	<b><span><?php esc_html_e('Message For','apartment_mgt');?></b></span>
            </th>
			   
            <th><b><?php esc_html_e('Subject','apartment_mgt');?></b></th>
             <th>
                 <b> <?php esc_html_e('Description','apartment_mgt');?></b>
            </th>
            </tr>
 		<?php 
 		$offset = 0;
 		if(isset($_REQUEST['pg']))
 			$offset = $_REQUEST['pg'];
		if($obj_apartment->role=='staff_member')
		{
			$message = $obj_message->MJ_amgt_get_all_send_message($max,$offset);
		}
		else
		{
			$message = $obj_message->MJ_amgt_get_send_message(get_current_user_id(),$max,$offset);
		}
 		foreach($message as $msg_post)
 		{

 			if($obj_apartment->role=='staff_member' || $msg_post->post_author==get_current_user_id())
 			{ ?>
 			<tr>
 			<td class="hidden-xs">
            	<span><?php 
            		if(get_post_meta( $msg_post->ID, 'message_for',true) == 'user')
					{
						if(get_post_meta( $msg_post->ID, 'message_for_userid',true) == 'employee')
						{
							echo "Employee";
						}
						else
						{

            			   echo esc_html(MJ_amgt_get_display_name(get_post_meta( $msg_post->ID, 'message_for_userid',true)));
						}
					}
            		else 
					{
            			echo MJ_amgt_get_role_name(get_post_meta($msg_post->ID, 'message_for',true));
					}
					?></span>
            </td>
			<td><a href="?apartment-dashboard=user&pages=message&tab=view_message&from=sendbox&id=<?php echo  esc_attr($msg_post->ID);?>"><?php 
         $subject_char=strlen($msg_post->post_title);
          if($subject_char <= 25)
          {
              echo esc_html($msg_post->post_title);
          }
          else
          {
              $char_limit = 25;
              $subject_body= substr(strip_tags($msg_post->post_title), 0, $char_limit)."...";
              echo esc_html($subject_body);
          }
      ?>
	  <?php if(MJ_amgt_count_reply_item($msg_post->ID)>=1){?><span class="badge badge-success pull-right"><?php echo esc_html(MJ_amgt_count_reply_item($msg_post->ID));?></span><?php } ?></a></td>
             <td>                  
				  <?php
          $body_char=strlen($msg_post->post_content);
          if($body_char <= 60)
          {
              echo esc_html($msg_post->post_content);
          }
          else
          {
              $char_limit = 60;
              $msg_body= substr(strip_tags($msg_post->post_content), 0, $char_limit)."...";
              echo esc_html($msg_body);
          }  					
				
				  ?>
            </td>
            </tr>
 			<?php 
 			}
 		}
 		?>
 		</tbody>
		 <?php
	}else{
		?>
		<tr>
		<th class="hidden-xs"><!--HIDDEN-XS---->
            <span><?php esc_html_e('Message For','apartment_mgt');?></span>
            </th>
            <th><?php esc_html_e('Subject','apartment_mgt');?></th>
            <th>
                  <?php esc_html_e('Description','apartment_mgt');?>
            </th>
        </tr>
		<tr>
			<td></td>
			<td><?php esc_html_e('No Record Found','apartment_mgt');?></td>
			<td></td>
		</tr>
		<?php
	} ?>
	
 	</table>
 	</div>
 </div>
 <?php ?>