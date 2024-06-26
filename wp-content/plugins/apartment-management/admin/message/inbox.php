<?php 
?>
<div class="mailbox-content"><!-- MAIL BOIX CONTENT DIV -->
 	<div class="table-responsive"><!--TABLE RESPONSIVE-->	
 	<table class="table"><!-- TABLE -->
 		<thead>
 			<tr>
 				<th class="text-right" colspan="5">
					 <?php 
					$message = $obj_message->MJ_amgt_count_inbox_item(get_current_user_id());
				  
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
				    echo $obj_message->MJ_amgt_pagination($totlal_message,$p,$prev,$next,'page=amgt-message&tab=inbox');?>
                </th>
 			</tr>
 		</thead>
	<?php
	$totle_message = $obj_message->MJ_amgt_get_inbox_message(get_current_user_id(),$limit,$max);
	if(!empty($totle_message)){
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
			</tr>
			<?php 
			$message1 = $obj_message->MJ_amgt_get_inbox_message(get_current_user_id(),$limit,$max);
			foreach($message1 as $msg)
			{
				?>
			<tr>
				
				<td class="min_width_110_px"><?php echo esc_html(MJ_amgt_get_display_name($msg->sender));?></td>
				<td class="min_width_150_px">
					<a href="?page=amgt-message&tab=inbox&tab=view_message&from=inbox&id=<?php echo esc_attr($msg->message_id
					);?>"> 
					<?php 
					$subject_char=strlen($msg->msg_subject);
					if($subject_char <= 25)
					{
						echo $msg->msg_subject;
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
					echo $msg->message_body;
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
	}else{
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
			
			
	
		
 		
 	</table><!-- TABLE -->
 </div><!--TABLE RESPONSIVE END-->
</div> <!-- END MAIL BOIX CONTENT DIV -->
 <?php ?>