 <?php 
	$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'commitee_memberlist');
	$obj_member=new MJ_amgt_Member;
	$obj_units=new MJ_amgt_ResidentialUnit;
 ?>

<script type="text/javascript">
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


<?php

if(isset($_REQUEST['delete_selected2']))
{		
	if(!empty($_REQUEST['selected_id']))
	{	
		foreach($_REQUEST['selected_id'] as $id)
		{
			$result=$obj_member->MJ_amgt_delete_all_user($id);
		
		}
		if($result) 
		{
			wp_redirect ( admin_url() . 'admin.php?page=amgt-member&tab=memberlist&message=3');
		}
	}
	else
	{
		
		echo '<script language="javascript">';
		echo 'alert("'.esc_html__('Please select at least one record.','apartment_mgt').'")';
		echo '</script>';
	}

}


?>
<div class="page-inner min_height_1088"><!-- PAGE INNER DIV -->
    
	<div class="page-title"><!--PAGE-TITLE---->
		<h3>
		  <img src="<?php echo esc_url(get_option( 'amgt_system_logo' )) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo esc_html(get_option( 'amgt_system_name' ));?>
		</h3>
	</div><!--END PAGE-TITLE---->
	<div id="main-wrapper"><!--MAIN WRAPPER-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white"><!--PANEL-WHITE-->
					<div class="panel-body"><!--PANEL BODY-->
						<h2 class="nav-tab-wrapper">
							<a href="?page=amgt-committee-member&tab=commitee_memberlist" class="nav-tab <?php echo esc_html($active_tab) == 'commitee_memberlist' ? 'nav-tab-active' : ''; ?>">
							<?php echo '<span class="dashicons dashicons-menu"></span> '.esc_html__('Committee Member List', 'apartment_mgt'); ?></a>
						</h2>
						 <?php 
						    //COMMITEE_MEMBERLIST TAB
							if($active_tab == 'commitee_memberlist')
							{ ?>	
								<script type="text/javascript">
							    $(document).ready(function() 
								{
									"use strict";
								 jQuery('#member_list').DataTable({
									"responsive":true,
									"order": [[ 1, "asc" ]],
									"aoColumns":[
												  {"bSortable": false},
												  {"bSortable": false},
												  {"bSortable": true},
												  {"bSortable": true},
												  {"bSortable": true},
												  {"bSortable": true},
												  {"bSortable": true},
												  {"bSortable": true},
												  {"bSortable": false}
												  ],
												  language:<?php echo MJ_amgt_datatable_multi_language();?>
									});
							    } );
							   </script>
							 <!--MEMBER_FORM-->
							<form name="member_form" action="" method="post">
								<div class="panel-body"><!--PANEL BODY-->
									<div class="table-responsive"><!---TABLE-RESPONSIVE--->
										<table id="member_list" class="display" cellspacing="0" width="100%">
										  <thead>
											<tr>
											   <th><input type="checkbox" id="select_all"></th>
											   <th><?php  esc_html_e('Photo', 'apartment_mgt' ) ;?></th>
											   <th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
											   <th><?php esc_html_e('Designation', 'apartment_mgt' ) ;?></th>
											   <th><?php esc_html_e('Building Name', 'apartment_mgt' ) ;?></th>
			                                   <th><?php esc_html_e('Unit Name', 'apartment_mgt' ) ;?></th>
											   <th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
											   <th> <?php esc_html_e('Mobile', 'apartment_mgt' ) ;?></th>
											   <th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
											</tr>
										</thead>
										<tfoot>
											<tr>
											  <th></th>
											  <th><?php  esc_html_e('Photo', 'apartment_mgt' ) ;?></th>
											  <th><?php esc_html_e('Name', 'apartment_mgt' ) ;?></th>
											  <th><?php esc_html_e('Designation', 'apartment_mgt' ) ;?></th>
											  <th><?php esc_html_e('Building Name', 'apartment_mgt' ) ;?></th>
			                                  <th><?php esc_html_e('Unit Name', 'apartment_mgt' ) ;?></th>
											  <th> <?php esc_html_e('Email', 'apartment_mgt' ) ;?></th>
											  <th> <?php esc_html_e('Mobile', 'apartment_mgt' ) ;?></th>
											<th><?php  esc_html_e('Action', 'apartment_mgt' ) ;?></th>
											</tr>
										   
										</tfoot>
	
										<tbody>
										 <?php 
											$get_members = array('role' => 'member','meta_key' => 'committee_member','meta_value'=> 'yes','order' => 'DESC');
											$membersdata=get_users($get_members);
											 if(!empty($membersdata))
											 {
												foreach ($membersdata as $retrieved_data){
                                                $building_name=get_the_title($retrieved_data->building_id);													?>
											<tr>
												<td class="title"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo esc_attr($retrieved_data->ID); ?>"></td>
												<td class="user_image"><?php $uid=$retrieved_data->ID;
												  $userimage=get_user_meta($uid, 'amgt_user_avatar', true);
														if(empty($userimage))
														{
														 echo '<img src='.esc_url(get_option( 'amgt_system_logo' )).' height="50px" width="50px" class="img-circle" />';
														}
														else
														{
														 echo '<img src='.esc_url($userimage).' height="50px" width="50px" class="img-circle"/>';
														}
												?>
												</td>
												<td class="name"><?php echo esc_html($retrieved_data->display_name);?></td>
												<td class="designation"><?php echo esc_html(get_the_title($retrieved_data->designation_id));?></td>
												<td class="activitydate"><?php echo esc_html($building_name);?></td>
				                                <td class="activitydate"><?php echo esc_html($retrieved_data->unit_name);?></td>
												<td class=""><?php echo esc_html($retrieved_data->user_email);?></td>
												<td class=""><?php echo esc_html($retrieved_data->mobile);?></td> 
												<td class="action">
													<a href="?page=amgt-member&tab=viewmember&action=view&member_id=<?php echo esc_attr($retrieved_data->ID);?>" class="btn btn-success"> <?php esc_html_e('View Details', 'apartment_mgt' ) ;?></a>
												</td>
											   
											</tr>
											<?php } 
											
											 }?>
									 
										</tbody>
								      </table>
									  <div class="print-button pull-left">
											<input type="submit" id="delete_selected" value="<?php esc_html_e('Delete Selected','apartment_mgt');?>" name="delete_selected2" class="btn btn-danger delete_selected "/>
									  </div>
								   </div>
								</div><!--END PANEL BODY-->
                            </form>
							 <?php 
							}
							//ADDMEMBER TAB
							if($active_tab == 'addmember')
							{
								require_once AMS_PLUGIN_DIR.'/admin/member/add_member.php';
							} ?>
                    </div><!--END PANEL BODY-->
	            </div><!--END PANEL-WHITE-->
	        </div>
        </div>
    </div><!--END MAIN WRAPPER-->
</div><!-- END  INNER DIV -->