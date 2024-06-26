<?php 
$month =array('1'=>esc_html__('January','apartment_mgt'),'2'=>esc_html__('February','apartment_mgt'),'3'=>esc_html__('March','apartment_mgt'),'4'=>esc_html__('April','apartment_mgt'),
		'5'=>esc_html__('May','apartment_mgt'),'6'=>esc_html__('June','apartment_mgt'),'7'=>esc_html__('July','apartment_mgt'),'8'=>esc_html__('August','apartment_mgt'),
		'9'=>esc_html__('September','apartment_mgt'),'10'=>esc_html__('Octomber','apartment_mgt'),'11'=>esc_html__('November','apartment_mgt'),'12'=>esc_html__('December','apartment_mgt'),);
$year =isset($_POST['year'])?$_POST['year']:date('Y');
$obj_apartment=new MJ_amgt_Apartment_management(get_current_user_id());

$user_id=get_current_user_id();
global $wpdb;
$table_name = $wpdb->prefix."amgt_invoice_payment_history";
if($obj_apartment->role=='member')
{
	$user_access=MJ_amgt_get_userrole_wise_access_right_array();
	$own_data=$user_access['own_data'];

	if($own_data == '1')
	{
		$q="SELECT EXTRACT(MONTH FROM date) as date,sum(amount) as count FROM ".$table_name." WHERE member_id=$user_id AND YEAR(date) =".$year." group by month(date)";

	}
	else
	{
		$q="SELECT EXTRACT(MONTH FROM date) as date,sum(amount) as count FROM ".$table_name." WHERE YEAR(date) =".$year." group by month(date) ORDER BY date ASC";
	}
}
else
{
	$q="SELECT EXTRACT(MONTH FROM date) as date,sum(amount) as count FROM ".$table_name." WHERE YEAR(date) =".$year." group by month(date) ORDER BY date ASC";
}
/**/
$result=$wpdb->get_results($q);

$chart_array = array();
$chart_array[] = array(esc_html__('Month','apartment_mgt'),esc_html__('Payment','apartment_mgt'));	
foreach($result as $r)
{
	$chart_array[]=array( $month[$r->date],(int)$r->count);
}

 $options = Array(
			'title' => esc_html__('Payment Report By Month','apartment_mgt'),
			'titleTextStyle' => Array('color' => '#66707e','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
			'legend' =>Array('position' => 'right',
						'textStyle'=> Array('color' => '#66707e','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),
			
			'hAxis' => Array(
				'title' => esc_html__('Month','apartment_mgt'),
				'titleTextStyle' => Array('color' => '#66707e','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
				'textStyle' => Array('color' => '#66707e','fontSize' => 11),
				'maxAlternation' => 2
				),
			'vAxis' => Array(
				'title' => esc_html__('Payment','apartment_mgt'),
				 'minValue' => 0,
				'maxValue' => 5,
				 'format' => '#',
				'titleTextStyle' => Array('color' => '#66707e','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
				'textStyle' => Array('color' => '#66707e','fontSize' => 12)
				),
 		    'colors' => array('#22BAA0')
			);
			$GoogleCharts = new GoogleCharts;

			$chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );
        ?>
		<?php if(empty($result))
		{?>
		<div class="nodata">
		
		  <?php  esc_html_e('Records Not Found','apartment_mgt');?>
		</div>
		<?php } ?>
		
  <div id="chart_div" class="width_100_height_500"></div>
  <!-- Javascript --> 
    <script type="text/javascript">
		<?php if(!empty($result))
		{
		  echo $chart;
		}
		?>
   </script>
  
   
   
