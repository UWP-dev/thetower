<?php ?>
<script type="text/javascript">
$(document).ready(function() {
	//ASSIGNED SLOT LIST
	"use strict";
	jQuery('#assigned_sloat_list').DataTable({
		"responsive": true,
		"order": [[ 1, "desc" ]],
		"aoColumns":[
			{"bSortable": false},
			{"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": false}],
			language:<?php echo MJ_amgt_datatable_multi_language();?>
		});
	
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

<?php 
//ASSIGNED SLOT LIST TAB	
if($active_tab == 'assigned-sloat-list')
{
	$assignedsloatdata=$obj_parking->MJ_amgt_get_all_assigned_sloats();
?>
<div class="panel-body"><!--PANEL BODY-->
  	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
	  <form action="" method="post">
		<table id="assigned_sloat_list" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><input type="checkbox" id="select_all"></th>
					<th><?php esc_html_e('Slot No', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Slot Type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Building Block', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Member Name', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Vehicle Number', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('From Date', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('To Date', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php esc_html_e('Slot No', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Slot Type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Building Block', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Member Name', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Vehicle Number', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('From Date', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('To Date', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Status', 'apartment_mgt' ) ;?></th>
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>			   
			</tfoot>
 
			<tbody>
			<?php 
			$assignedsloatdata=$obj_parking->MJ_amgt_get_all_assigned_sloats();
			// var_dump($assignedsloatdata);
			if(!empty($assignedsloatdata))
			{
				foreach ($assignedsloatdata as $retrieved_data){ 
					$sloat=MJ_amgt_get_sloat_name($retrieved_data->sloat_id);
			?>
				<tr>
					<td class="title"><input type="checkbox" name="sloat_assign_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>
					<td class="sloatname"><a href="?page=amgt-parking-mgt&tab=assign_sloat&action=edit&sloat_assign_id=<?php echo esc_attr($retrieved_data->id);?>"><?php echo esc_html($sloat->sloat_name); ?></a></td>
					<td class="sloattype"><?php if($sloat->sloat_type=='Staff') echo esc_html__('Staff Member','apartment_mgt'); else echo esc_html__('Member','apartment_mgt');?></td>
					<td class="building"><?php if($sloat->sloat_type=='member'){ echo esc_html(get_the_title($retrieved_data->building_id)); }else { echo "-"; } ?></td>
					<td class="member"><?php
					if(!empty($retrieved_data->member_id))
					{
						echo esc_html(MJ_amgt_get_display_name($retrieved_data->member_id));
					}
					else
					{
						echo "-";
					}
					// var_dump($retrieved_data->member_id);
					 ?></td>
					<td class="vehicle"><?php echo esc_html($retrieved_data->vehicle_number);?></td>
					<td class="from"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->from_date)));?></td>
					<td class="to"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->to_date)));?></td>
					<td class="to"><?php if($retrieved_data->status=='alloted'){ echo esc_html__('Allotted','apartment_mgt');}else{ echo esc_html__('Unallocated','apartment_mgt');}?></td>
					<td class="action">
						<a href="?page=amgt-parking-mgt&tab=assign_sloat&action=edit&sloat_assign_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
						<a href="?page=amgt-parking-mgt&ab=sloat-list&action=delete&sloat_assign_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
						onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
						<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
				   
					</td>				   
				</tr>
				<?php } 				
			} ?>     
			</tbody>        
        </table>
		<div class="print-button pull-left">
			<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="slot_list_delete" class="btn btn-danger delete_selected "/>
		</div>
		</form>
    </div><!---END TABLE-RESPONSIVE--->
</div><!--END PANEL BODY-->
        
<?php 
} ?>