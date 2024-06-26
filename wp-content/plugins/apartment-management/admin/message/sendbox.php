<div class="mailbox-content"><!-- MAIL BOIX CONTENT DIV -->
	
	<!-- My new custom code start -->
	<style>
		.sendBoxPagination {
			margin: 30px 0 10px;
			text-align: right;
		}

		.sendBoxPagination a,
		.sendBoxPagination span {
			padding: 5px 10px;
			margin: 0 3px;
			border: none;
			background-color: #fff;
			color: #333;
			text-decoration: none;
		}

		.sendBoxPagination .current,
		.sendBoxPagination a:hover{
			background-color: #22BAA0;
			color: #fff;
		}
	</style>
	<?php
		$paged = ( isset( $_GET['paged'] ) && $_GET['paged'] ) ? intval( $_GET['paged'] ) : 1;
		$args = array(
			'post_type'				=> 'amgt_message',
			'posts_per_page'		=> 10,
			'post_status'			=> 'public',
			'paged'          		=> $paged
		);
		$query = new WP_Query( $args );
		$total_posts = $query->found_posts;
		// echo '==> '.$total_posts;
	?>
	<table id="customSendBoxTable" class="customSendBoxTable table">
		<thead>
			<tr>
				<th><?php esc_html_e('Message For', 'apartment_mgt'); ?></th>
				<th><?php esc_html_e('Subject', 'apartment_mgt'); ?></th>
				<th><?php esc_html_e('Description', 'apartment_mgt'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if ( $query->have_posts() ) : ?>
				<?php 
					while ( $query->have_posts() ) : $query->the_post();
					$id = get_the_ID();
					$messageFor = get_post_meta($id, 'message_for', true);
					$messageForUserId = get_post_meta($id, 'message_for_userid', true);
				?>
				<tr>
					<td>
						<span>
							<?php
								if ( $messageFor == 'user' ) {
									echo esc_html(MJ_amgt_get_display_name($messageForUserId));
								} else {
									echo esc_html(MJ_amgt_get_role_name($messageFor));
								}
							?>
						</span>
					</td>
					<td>
						<a href="?page=amgt-message&tab=view_message&from=sendbox&id=<?php echo  esc_attr($id); ?>">
							<?php
								$subject_char = strlen(get_the_title());
								if ($subject_char <= 30) {
									echo esc_html(get_the_title());
								} else {
									$char_limit = 30;
									$subject_body = substr(strip_tags(get_the_title()), 0, $char_limit) . "...";
									echo esc_html($subject_body);
								}
								?><?php if (MJ_amgt_count_reply_item($id) >= 1) { ?><span class="badge badge-success pull-right"><?php echo esc_html(MJ_amgt_count_reply_item($id)); ?></span><?php } 
							?>
						</a>
					</td>
					<td>
						<?php
							$body_char = strlen(get_the_content());
							if ($body_char <= 60) {
								echo esc_html(get_the_content());
							} else {
								$char_limit = 60;
								$msg_body = substr(strip_tags(get_the_content()), 0, $char_limit) . "...";
								echo esc_html($msg_body);
							}
						?>
					</td>
				</tr>
				<?php 
					endwhile;
					wp_reset_postdata();
				?>
			<?php endif; ?>
		</tbody>
	</table>
	<div class="sendBoxPagination">
		<?php
		echo paginate_links( array(
			'base'      => add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'prev_text' => __( '&laquo; Previous' ),
			'next_text' => __( 'Next &raquo;' ),
			'total'     => $query->max_num_pages,
			'current'   => $paged,
		) );
		?>
	</div> <!-- .sendBoxPagination -->
	<!-- My new custom code end -->

</div><!-- MAIL BOIX CONTENT DIV -->