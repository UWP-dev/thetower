<?php ?>
<script type="text/javascript">
$(document).ready(function() {
	//STAFF_CHECKIN_LIST
	"use strict";
	jQuery('#staff_checkin_list').DataTable({
		"responsive":true,
		"order": [[ 1, "desc" ]],
		"aoColumns":[
	                  {"bSortable": false},
					  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": false}],
					  language:<?php echo MJ_amgt_datatable_multi_language();?>
		});


		jQuery('#select_all').on('click', function(e)
		{
			 if($(this).is(':checked',true))  
			 {
				$(".sub_chk").prop('checked', true);  
			 }  
			 else  
			 {  
				$(".sub_chk").prop('checked',false);  
			 } 
		});
		$("body").on("change",".sub_chk",function(){
			if(false == $(this).prop("checked"))
			{ 
				$("#select_all").prop('checked', false); 
			}
			if ($('.sub_chk:checked').length == $('.sub_chk').length )
			{
				$("#select_all").prop('checked', true);
			}
		});
	});
	
</script>

    <?php 
    //STAFF-CHECKINLIST	TAB
	if($active_tab == 'staff-checkinlist')
	{
    ?>
		<div class="panel-body"><!--PANEL BODY-->
        	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
			<form action="" method="post">
				<table id="staff_checkin_list" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><input type="checkbox" id="select_all"></th>
							<th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Gate Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked In Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked in On Time', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked Out Time', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
				    </thead>
					<tfoot>
						<tr>
							<th></th>
							<th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Gate Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked In Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked In On Time', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Checked Out Time', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
					   
					</tfoot>
		 
					<tbody>
					 <?php 
					
						$visitor_checkindata=$obj_gate->MJ_amgt_get_all_staff_checkinentries();
					 if(!empty($visitor_checkindata))
					 {
						foreach ($visitor_checkindata as $retrieved_data){
						global $wpdb;		  
						$table_name = $wpdb->prefix. 'amgt_gates';
						$result = $wpdb->get_row("SELECT * FROM $table_name where id=".$retrieved_data->gate_id);?>
						<tr>
							<td class="title"><input type="checkbox" name="visitor_request_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
							<td class="name"><a href="?page=amgt-visiter-manage&tab=staff-checkin&action=edit&staff_checkin_id=<?php echo esc_attr($retrieved_data->id);?>"><?php echo  esc_html(MJ_amgt_get_display_name($retrieved_data->member_id));?></a></td>
							<td class="gate_name"><?php echo  esc_html($result->gate_name);?></td>
							<td class="vehicle"><?php echo  esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->checkin_date)));?></td>
							<td class="checkin"><?php echo esc_html($retrieved_data->checkin_time);?></td>
							<td class="checkout"><?php echo esc_html($retrieved_data->checkout_time);?></td>
							<td class="action">
								<a href="?page=amgt-visiter-manage&tab=staff-checkin&action=edit&staff_checkin_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
								<a href="?page=amgt-visiter-manage&ab=manage-gates&action=delete&staff_checkin_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
								onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
								<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
								<?php if($retrieved_data->checkout_time==''){ ?>
									
									<a checkin_id="<?php echo esc_attr($retrieved_data->id); ?>" checkout-type="staff" class="btn btn-success check-out"> <?php esc_html_e('Check Out', 'apartment_mgt' ) ;?></a>
								<?php } ?>
							</td>
						   
						</tr>
						<?php } 
						
					} ?>
					</tbody>
			    </table>
				
					<div class="print-button pull-left">
						<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
					</div>
				</form>
				
            </div><!---END TABLE-RESPONSIVE--->
        </div><!--END PANEL BODY-->
     <?php } ?>
	