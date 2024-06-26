<?php ?>
<script type="text/javascript">
$(document).ready(function() {
	"use strict";
	//EXPENCE_LIST
	jQuery('#expence_list').DataTable({
		"responsive": true,
		"order": [[ 1, "desc" ]],
		"aoColumns":[
	                  {"bSortable": false},
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
  
<div class="panel-body"><!--PANEL-BODY-->  
    <div class="table-responsive"><!---TABLE-RESPONSIVE--->
	<form action="" method="post">
        <table id="expence_list" class="display" cellspacing="0" width="100%"><!---EXPENCE_LIST TABLE--->
        	<thead>
				<tr>
					<th><input type="checkbox" id="select_all"></th>
					<th><?php esc_html_e('Expense type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Vendor Name', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Amount', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Payment Date', 'apartment_mgt' ) ;?></th>
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>
					<th><?php esc_html_e('Expense type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Vendor Name', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Amount', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Payment Date', 'apartment_mgt' ) ;?></th>
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>           
			</tfoot> 
			<tbody>
				<?php 		
				$expensedata=$obj_account->MJ_amgt_get_all_expense();
				if(!empty($expensedata))
				{
					foreach ($expensedata as $retrieved_data)
					{ ?>
						<tr>
							<td class="title"><input type="checkbox" name="expense_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>	
							<td class="expense_type"><a href="?page=amgt-accounts&tab=add-expense&action=edit&expense_id=<?php echo esc_attr($retrieved_data->id);?>"><?php echo get_the_title($retrieved_data->type_id);?></a></td>
							<td class="name"><?php echo esc_html($retrieved_data->vender_name);?></td>
							<td class="amount"><?php echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )).' '.$retrieved_data->amount);?></td>
							<td class="paymentdate"><?php echo esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->payment_date)));?></td>
							<td class="action">
							<a  href="#" class="show-invoice-popup btn btn-default" idtest="<?php echo esc_attr($retrieved_data->id); ?>" invoice_type="expense"><i class="fa fa-eye"></i> <?php esc_html_e('View Invoice', 'apartment_mgt');?></a>
						  <a href="?page=amgt-accounts&tab=add-expense&action=edit&expense_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
							<a href="?page=amgt-accounts&tab=invoice-list&action=delete&expense_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
							<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
							</td>
						   
						</tr>
					<?php 
					} 			
				}
				?>     
			</tbody>        
        </table><!---END EXPENCE_LIST TABLE--->
		<div class="print-button pull-left">
			<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
		</div>
	</form>
    </div><!---END TABLE-RESPONSIVE--->
</div><!--END PANEL-BODY-->
<?php  ?>