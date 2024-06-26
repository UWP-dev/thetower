<script type="text/javascript">
$(document).ready(function() {
	//EVENT LIST
	"use strict";
	jQuery('#event_list').DataTable({
		"responsive": true,
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
} );

$(document).ready(function()
	{	
		"use strict";
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

    <form name="event_form" action="" method="post"><!------EVENT LIST FORM------->
        <div class="panel-body"><!------PANEL BODY------->
        	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
				<table id="event_list" class="display" cellspacing="0" width="100%"><!---EVENT LIST TABLE--->
					<thead>
						<tr>
							<th><input type="checkbox" id="select_all"></th>
							<th><?php esc_html_e('Event Title', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Start Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('End Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Start Time', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('End Time', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th><?php esc_html_e('Event Title', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Start Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('End Date', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Start Time', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('End Time', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
					</tfoot>
					<tbody>
					 <?php 
					  $eventdata=$obj_notice->MJ_amgt_get_all_events();
					  
						if(!empty($eventdata))
						{
						    foreach ($eventdata as $retrieved_data)
						    {
							  ?>
							<tr>
								<td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
								<td class="title"><a href="?page=amgt-notice-event&tab=add_event&action=edit&event_id=<?php echo esc_attr($retrieved_data->id);?>"><?php echo esc_html($retrieved_data->event_title);?></a></td>
								<td class="start date"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->start_date)));?></td>
								<td class="end date"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->end_date)));?></td>
								<td class=""><?php echo esc_html($retrieved_data->start_time);?></td>
								
								<td class=""><?php echo esc_html($retrieved_data->end_time);?></td>
								
								<td class="action">
									<?php if($retrieved_data->publish_status=='no'){ ?>
									<a href="?page=amgt-notice-event&tab=notice_list&action=approve_notice&event_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-default"> <?php esc_html_e('Approve', 'apartment_mgt' );?></a>
									<?php } ?>
									 <a href="#" class="btn btn-primary view-event" id="<?php echo esc_attr($retrieved_data->id);?>"> <?php esc_html_e('View','apartment_mgt');?></a>
								   <a href="?page=amgt-notice-event&tab=add_event&action=edit&event_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' );?></a>
									<a href="?page=amgt-notice-event&tab=notice_list&action=delete&event_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
									onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
									<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
									<?php if($retrieved_data->event_doc!='')
									{ ?>
									<a target="blank" href="<?php echo content_url().'/uploads/apartment_assets/'.$retrieved_data->event_doc;?>" class="btn btn-default"> <i class="fa fa-eye"></i> <?php esc_html_e('View Document', 'apartment_mgt' ) ;?> 
									</a>
									<?php
									} ?>
								</td>
						   
							</tr>
						<?php 
						    } 
					    }?>
				    </tbody>
				</table><!---END EVENT LIST TABLE--->
				<div class="print-button pull-left">
					<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
				</div>
            </div><!---TABLE-RESPONSIVE--->
        </div><!------END PANEL BODY------->
    </form>
	<!------End Event List------->