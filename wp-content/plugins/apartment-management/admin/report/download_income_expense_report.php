<script type="text/javascript">
	$(document).ready(function()
	{
		"use strict";
		$(".sdate").datepicker({
       dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 0);
            $(".edate").datepicker("option", "minDate", dt);
        }
	    });
	    $(".edate").datepicker({
	      dateFormat: "yy-mm-dd",
	        onSelect: function (selected) {
	            var dt = new Date(selected);
	            dt.setDate(dt.getDate() - 0);
	            $(".sdate").datepicker("option", "maxDate", dt);
	        }
	    });	
	 
	} );
</script>

<div class="panel-body"><!-- PANEL BODY DIV START-->
	<form method="post"> 
		<div class="mb-3 row">	
			<div class="form-group col-md-3 col-xs-9">
				<label for="exam_id"><?php esc_html_e('Start Date','apartment_mgt');?><span class="require-field">*</span></label>
					<input type="text"  class="form-control sdate validate[required]" name="sdate"   value="<?php if(isset($_REQUEST['sdate'])) echo esc_attr($_REQUEST['sdate']); else echo esc_attr(date("Y-m-d"));?>">
			</div>
			<div class="form-group col-md-3 col-xs-9">
				<label for="exam_id"><?php esc_html_e('End Date','apartment_mgt');?><span class="require-field">*</span></label>
					<input type="text"  class="form-control edate validate[required]" name="edate"   value="<?php if(isset($_REQUEST['edate'])) echo esc_attr($_REQUEST['edate']); else echo esc_attr(date("Y-m-d"));?>">
			</div>
			<div class="form-group col-md-3 col-xs-9 button-possition">
				<label for="subject_id">&nbsp;</label>
				<input type="submit" name="download_report" Value="<?php esc_html_e('Download Report','apartment_mgt');?>"  class="btn btn-success"/>
			</div>
		</div>
	</form>
</div><!-- PANEL BODY DIV END-->
<script type="text/javascript">
	$(document).ready(function() 
	{
		"use strict";
		jQuery('#tbleincome').DataTable({
			"responsive": true,
			 "order": [[ 0, "Desc" ]],
			dom: 'Bfrtip',
			buttons: [
                {
				extend: 'print',
			    title: 'Income List',
                },
				'pdf','csv'
            	],  
			 "aoColumns":[
						  {"bSortable": true},
						  {"bSortable": true},
						  {"bSortable": true},
						  {"bSortable": true}
					   ],
				language:<?php echo MJ_amgt_datatable_multi_language();?>		   
			});
	} );
</script>
<div class="panel-body"><!--PANEL BODY DIV START-->
		<div class="table-responsive"><!--TABLE RESPONSIVE DIV START-->
		  <form name="wcwm_report" action="" method="post"><!--EXPENSE LIST FORM START-->
			<table id="tbleincome" class="display" cellspacing="0" width="100%"><!--EXPENSE LIST TABLE START-->
				<thead>
					<tr>
						<th><?php esc_html_e('Id','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Member Name','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Date','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Amount','apartment_mgt'); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php esc_html_e('Id','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Member Name','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Date','apartment_mgt'); ?></th>
						<th><?php esc_html_e('Amount','apartment_mgt'); ?></th>
						
					</tr>
				</tfoot>
				<tbody>
				 <?php 
					if(isset($_POST['download_report']))
					{
						global $wpdb;
						$sdate=date('Y-m-d',strtotime($_POST['sdate']));
						$edate=date('Y-m-d',strtotime($_POST['edate']));
						$table_name=$wpdb->prefix.'amgt_invoice_payment_history';
						$result = $wpdb->get_results("select *from $table_name where date BETWEEN '$sdate' AND '$edate'"); 
					}
					if(!empty($result))
					{
						$i=1;
						foreach ($result as $retrieved_data)
						{ 
							?>
							<tr>
								<td class="end_date"><?php echo esc_html($i); ?></td>
								<td class="end_date"><?php echo esc_html(MJ_amgt_apartment_get_display_name($retrieved_data->member_id)); ?></td>
								<td class="end_date"><?php echo esc_html($retrieved_data->date); ?></td>
								<td class="end_date"><?php echo esc_html($retrieved_data->amount); ?></td>
							</tr>
							<?php
							$i++;
						}
					}
				   ?>
				</tbody>
			</table><!--EXPENSE LIST TABLE END-->
			</form><!--EXPENSE LIST FORM END-->
		</div><!--TABLE RESPONSIVE DIV END-->
	</div><!--PANEL BODY DIV END-->
<?php
?>