<?php ?>
<script type="text/javascript">
	$(document).ready(function() 
	{    //RECURING_CHARGES_LIST
		"use strict";
		jQuery('#recuring_charges_list').DataTable({
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
<!-- POP UP CODE -->
<div class="popup-bg z_index_100000">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="category_list"> </div>
		</div>
    </div>    
</div>
<!-- END POP-UP CODE --> 
  <div class="panel-body"><!--PANEL-BODY--> 
    <div class="table-responsive"><!--TABLE-RESPONSIVE--> 
	<form action="" method="post">
	    <!--RECURING_CHARGES_LIST--> 
        <table id="recuring_charges_list" class="display" cellspacing="0" width="100%">
        	<thead>
				<tr>
					<th><input type="checkbox" id="select_all"></th>
					<th><?php esc_html_e('Charges type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Charge Period', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Charge Calculate By', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Discount Amount', 'apartment_mgt' ) ;?></th>		
					<th><?php esc_html_e('Amount After Discount', 'apartment_mgt' ) ;?></th>										
					<th><?php esc_html_e('Tax Amount', 'apartment_mgt' ) ;?></th>				
					<th><?php esc_html_e('Total Amount ', 'apartment_mgt' ) ;?></th>				
					<th><?php esc_html_e('Created Date', 'apartment_mgt' ) ;?></th>	
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th></th>			   
					<th><?php esc_html_e('Charges type', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Charge Period', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Charge Calculate By', 'apartment_mgt' ) ;?></th>
					<th><?php esc_html_e('Discount Amount', 'apartment_mgt' ) ;?></th>				
					<th><?php esc_html_e('Amount After Discount', 'apartment_mgt' ) ;?></th>		
					<th><?php esc_html_e('Tax Amount', 'apartment_mgt' ) ;?></th>				
					<th><?php esc_html_e('Total Amount ', 'apartment_mgt' ) ;?></th>				
					<th><?php esc_html_e('Created Date', 'apartment_mgt' ) ;?></th>	
					<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
				</tr>           
			</tfoot> 
			<tbody>
			<?php 		
				$obj_account=new MJ_amgt_Accounts();
				$chargesdata=$obj_account->MJ_amgt_get_all_charges();
				
			if(!empty($chargesdata))
			{
				foreach ($chargesdata as $retrieved_data)
				{
					$chargedata=MJ_amgt_get_invoice_charges_calculate_by($retrieved_data->id);		
					if($chargedata->charges_calculate_by=='fix_charge')
					{
						$charge_cal_by=esc_html__('Fix Charge', 'apartment_mgt' );
					}
					else
					{
						$charge_cal_by=esc_html__('Measurement Charge', 'apartment_mgt' );
					}	
					$building_name=get_the_title($retrieved_data->building_id);
					if($retrieved_data->amgt_charge_period=='0')
					{
						$charge_period=esc_html__('One Time', 'apartment_mgt' );
					}
					elseif($retrieved_data->amgt_charge_period=='1')
					{
						$charge_period=esc_html__('Monthly', 'apartment_mgt' );
					}
					elseif($retrieved_data->amgt_charge_period=='3')
					{
						$charge_period=esc_html__('Quarterly', 'apartment_mgt' );
					}
					elseif($retrieved_data->amgt_charge_period=='12')	
					{
						$charge_period=esc_html__('Yearly', 'apartment_mgt' );
					}
					
					if($retrieved_data->charges_calculate_by=='fix_charge')
					{
						$charge_period=esc_html__('Fix Charges', 'apartment_mgt' );
					}
					elseif($retrieved_data->charges_calculate_by=='measurement_charge')
					{
						$charge_period=esc_html__('Measurement Charges', 'apartment_mgt' );
					}					
				?>
				<tr>
					<td class="title"><input type="checkbox" name="charge_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->id); ?>"></td>	
					<td>
						<?php 
						if($retrieved_data->charges_type_id=='0')
						{	
							echo 'Maintenance Charges'; 
						}
						else
						{
							echo esc_html(get_the_title($retrieved_data->charges_type_id)); 
						}		
						?>
					</td>				
					<td class="amount"><?php echo esc_html($charge_period); ?></td>
					<td class="amount"><?php echo esc_html_e($charge_cal_by); ?></td>
					<td class="amount"><?php if(!empty($retrieved_data->discount_amount)){ echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )).' '.$retrieved_data->discount_amount); }else{echo '-';}?></td>
					<td class="amount"><?php if($retrieved_data->charges_calculate_by=='measurement_charge'){ echo '-'; }else{ echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )).' '.$retrieved_data->amount);} ?></td>
					<td class="amount"><?php if($retrieved_data->charges_calculate_by=='measurement_charge'){echo '-'; }else{ 
						echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )).' '.round($retrieved_data->tax_amount)); }?></td>
					<td class="amount"><?php if($retrieved_data->charges_calculate_by=='measurement_charge'){echo '-'; }else{
						echo esc_html(MJ_amgt_get_currency_symbol(get_option( 'apartment_currency_code' )).' '.round($retrieved_data->total_amount)); } ?></td>
					<td><?php echo  esc_html(date(MJ_amgt_date_formate(),strtotime($retrieved_data->created_date)));?></td>
					<td class="action">
						<a href="?page=amgt-accounts&tab=add-Recurring-Charges&action=edit&pay_charges_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-info"> <?php esc_html_e('Edit', 'apartment_mgt' ) ;?></a>
						<a href="?page=amgt-accounts&tab=recuring_charg_list&action=delete&pay_charges_id=<?php echo esc_attr($retrieved_data->id);?>" class="btn btn-danger" onclick="return confirm('<?php esc_html_e('Do you really want to delete this record?','apartment_mgt');?>');">
						<?php esc_html_e('Delete', 'apartment_mgt' ) ;?> </a>
					</td>               
				</tr>
				<?php 
				} 			
			} 
			?>     
			</tbody>        
		</table><!--END RECURING_CHARGES_LIST-->
		<div class="print-button pull-left">
			<input  type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
		</div>
		</form>
	</div><!--END TABLE-RESPONSIVE-->
</div><!--END PANEL-BODY--> 
<!-- recuring charges list --> 