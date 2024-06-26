<?php
$obj_assets=new MJ_amgt_AssetsInventory;
?>
<script type="text/javascript">
$(document).ready(function() {
	 //INVENTORY_LIST DATATABLE
	 "use strict";
	jQuery('#inventory_list').DataTable({
		"responsive": true,
		"order": [[ 1, "desc" ]],
		"aoColumns":[
	                  {"bSortable": false},
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
		$("body").on("change",".sub_chk",function()
		{
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
    <form name="inventory_form" action="" method="post"><!--INVENTORY FORM-->
        <div class="panel-body"><!-- PANEL BODY-->
        	<div class="table-responsive"><!---TABLE-RESPONSIVE--->
				<table id="inventory_list" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><input type="checkbox" id="select_all"></th>
							<th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Unit', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Quantity', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
				    </thead>
					<tfoot>
						<tr>
							<th></th>
							<th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Unit', 'apartment_mgt' ) ;?></th>
							<th><?php esc_html_e('Quantity', 'apartment_mgt' ) ;?></th>
							<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
						</tr>
					</tfoot>
					<tbody>
						 <?php 
						$inventorydata=$obj_assets->MJ_amgt_get_all_inventory();
						if(!empty($inventorydata))
						{
							foreach ($inventorydata as $retrieved_data)
							{ ?>
							<tr>
								<td class="title"><input type="checkbox" name="inventory_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->ID); ?>"></td>	
								<td class="name"><a href="?page=amgt-assets-inventory&tab=add_inventory&action=edit&inventory_id=<?php echo esc_attr($retrieved_data->id);?>"><?php echo esc_html($retrieved_data->inventory_name);?></a></td>
								<td class="inventory_uni"><?php echo esc_html(get_the_title($retrieved_data->inventory_unit_cat));?></td>
								<td class="quentity"><?php echo esc_html($retrieved_data->quentity);?></td>
								<td class="action">
								   <a href="?page=amgt-assets-inventory&tab=add_inventory&action=edit&inventory_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
								 
									<a href="?page=amgt-assets-inventory&tab=inventory_list&action=delete&inventory_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" 
									onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
									<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
								
								</td>
							   
							</tr>
							<?php 
							} 
						}  ?>
					</tbody>
				
				</table>
				<div class="print-button pull-left">
					<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
				</div>
            </div><!--END INVENTORY FORM-->
        </div><!--END PANEL BODY-->
    </form><!--END INVENTORY FORM-->