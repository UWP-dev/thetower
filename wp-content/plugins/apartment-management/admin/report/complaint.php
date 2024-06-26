<?php 
$obj_complaint = new MJ_amgt_Complaint();
$obj_apartment=new MJ_amgt_Apartment_management(get_current_user_id());

$user_id=get_current_user_id();
if($obj_apartment->role=='member')
{
	$user_access=MJ_amgt_get_userrole_wise_access_right_array();
	$own_data=$user_access['own_data'];

	if($own_data == '1')
	{
		$open_complaints = $obj_complaint->MJ_amgt_complaint_countby_status_and_user_id('open',$user_id);
		$close_complaints = $obj_complaint->MJ_amgt_complaint_countby_status_and_user_id('close',$user_id);
	}
	else
	{
		$open_complaints = $obj_complaint->MJ_amgt_complaint_countby_status('open');
		$close_complaints = $obj_complaint->MJ_amgt_complaint_countby_status('close');
	}
}
else
{
	$open_complaints = $obj_complaint->MJ_amgt_complaint_countby_status('open');
	$close_complaints = $obj_complaint->MJ_amgt_complaint_countby_status('close');
}

	$chart_array = array();
	$chart_array[] = array(esc_html__('Source','apartment_mgt'),esc_html__('Count','apartment_mgt'));	
	$chart_array[]=array( esc_html__('Activated','apartment_mgt'),(int)$open_complaints);
	$chart_array[]=array( esc_html__('Deactivated','apartment_mgt'),(int)$close_complaints);
	$options = Array(
		'title' =>  esc_html__('Device BY Activated/Deactivated Status','apartment_mgt')
	); 
$GoogleCharts = new GoogleCharts;
$chart = $GoogleCharts->load( 'PieChart' , 'chart_div' )->get( $chart_array , $options );
?>
<?php if(empty($open_complaints) && empty($close_complaints))
{?>
<div class="nodata">
	<?php  esc_html_e('Records Not Found','apartment_mgt'); die;?>
</div>
<?php } ?>
<div id="chart_div" class="width_100_height_500"></div>
<script type="text/javascript"><?php echo $chart;?></script>