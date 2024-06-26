<?php 
?>
<div class="mailbox-content">
<div class="table-responsive">
 	<table class="table">
 		<thead>
 			<tr>
            <th class="text-right" colspan="5">
            <?php $message = $obj_message->MJ_amgt_count_inbox_item(get_current_user_id());
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
 		$totlal_message =count($message);
 		$totlal_message = ceil($totlal_message / $max);
 		$lpm1 = $totlal_message - 1;
 		$offest_value = ($p-1) * $max;
 		echo $obj_message->MJ_amgt_pagination($totlal_message,$p,$prev,$next,'church-dashboard=user&&page=message&tab=inbox');?>
                </th>
 			</tr>
 		</thead>
    <?php
    	$totle_message = $obj_message->MJ_amgt_get_inbox_message(get_current_user_id(),$limit,$max);
        if(!empty($totle_message)){
            ?>
             <tbody>
            <tr>
                
                <th class="hidden-xs">
                   <b><span><?php esc_html_e('Message For','apartment_mgt');?></b></span>
               </th>
               <th><b><?php esc_html_e('Subject','apartment_mgt');?></b></th>
                <th><b><?php esc_html_e('Description','apartment_mgt');?></b></th>
                <th><b><?php esc_html_e('Date','apartment_mgt');?></b></th>
               </tr>
            <?php 
            
            
            $message = $obj_message->MJ_amgt_get_inbox_message(get_current_user_id(),$limit,$max);
            
            foreach($message as $msg)
            {
                ?>
                <tr>
               <td class="min_width_110_px"><?php echo MJ_amgt_get_display_name($msg->sender);//echo get_user_name_byid($msg->sender);?></td>
                <td class="min_width_150_px">
                    <a href="?apartment-dashboard=user&page=message&tab=view_message&from=inbox&id=<?php echo esc_attr($msg->message_id);?>"> <?php 
                   $subject_char=strlen($msg->msg_subject);
                   if($subject_char <= 25)
                   {
                       echo esc_html($msg->msg_subject);
                   }
                   else
                   {
                       $char_limit = 25;
                       $subject_body= substr(strip_tags($msg->msg_subject), 0, $char_limit)."...";
                       echo esc_html($subject_body);
                   }
                    ?><?php if(MJ_amgt_count_reply_item($msg->post_id)>=1){?><span class="badge badge-success pull-right"><?php echo esc_html(MJ_amgt_count_reply_item($msg->post_id));?></span><?php } ?></a>
               </td>
               <td class="max_width_400_px">
               <?php 
               $body_char=strlen($msg->message_body);
               if($body_char <= 60)
               {
                   echo esc_html($msg->message_body);
               }
               else
               {
                   $char_limit = 60;
                   $msg_body= substr(strip_tags($msg->message_body), 0, $char_limit)."...";
                   echo esc_html($msg_body);
               }
               ?>
               </td>
               <td>
                   <?php  echo esc_html(date(MJ_amgt_date_formate(),strtotime($msg->msg_date)));?> 
               </td>
              
               </tr>
                <?php 
            }
            ?>
            
            </tbody>
            <?php
        }
        else{
            ?>
			<tbody>
			<tr>
				<th class=""><!--HIDDEN-XS -->
					<span><?php esc_html_e('Message For','apartment_mgt');?></span>
				</th>
				<th><?php esc_html_e('Subject','apartment_mgt');?></th>
				<th>
					<?php esc_html_e('Description','apartment_mgt');?>
				</th>
				<th>
					<?php esc_html_e('Date','apartment_mgt');?>
				</th>
				<th></th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th><?php esc_html_e('No Record Found','apartment_mgt');?></th>
				<th></th>
				<th></th>
			</tr>
			</tbody>
				<?php 
        }
    ?>
           
 		
 	</table>
 	</div>
 </div>
 <?php ?>