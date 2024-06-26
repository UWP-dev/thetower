<?php
//-------- CHECK BROWSER JAVA SCRIPT ----------//
MJ_amgt_browser_javascript_check(); 
//--------------- ACCESS WISE ROLE -----------//
$user_access=MJ_amgt_get_userrole_wise_access_right_array();
if (isset ( $_REQUEST ['page'] ))
{	
	if($user_access['view']=='0')
	{	
		MJ_amgt_access_right_page_not_access_message();
		die;
	}
	if(!empty($_REQUEST['action']))
	{
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='edit'))
		{
			if($user_access['edit']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die;
			}			
		}
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='delete'))
		{
			if($user_access['delete']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die;
			}	
		}
		if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $user_access['page_link'] && ($_REQUEST['action']=='insert'))
		{
			if($user_access['add']=='0')
			{	
				MJ_amgt_access_right_page_not_access_message();
				die;
			}	
		} 
	}
}
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'faq-list');
?>
<div class="panel-body panel-white"><!-- PANEL WHITE DIV -->
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--PANEL_TABS -->
        <li class="<?php if($active_tab=='faq-list'){?>active<?php }?>">
			<a href="?apartment-dashboard=user&page=faq&tab=faq-list" class="nav-link px-3 tab <?php echo esc_html($active_tab) == 'faq-list' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php esc_html_e('FAQ List', 'apartment_mgt'); ?></a>
        </li>
	</ul> 
	<div class="tab-content"><!-- TAB CONTENT DIV -->
		<?php if($active_tab == 'faq-list')
		{ ?>
			<div class="panel-body"><!--PANEL BODY-->
				<div class="panel-group accordion" id="accordionExample">
			     <?php 
					$i = 0;
					$faq_data=MJ_amgt_get_all_category('amgt_faq');
					
					//die;
					foreach ( $faq_data as $faq ) 
					{
						//var_dump($faq->post_content);
						$i ++;
						?>
							<div class="accordion-item panel panel-default"> <!---PANEL-DEFAULT--->
								<div class="panel-heading">
									<h4 class="accordion-header panel-title" id="headingone">
									  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
											<?php echo esc_html($faq->post_title); ?>
										  </button>
									</h4>
								</div>
								<div id="collapse<?php echo $i;?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body panel-body">
									
										<?php //echo apply_filters('the_content',$faq->post_content);  //POST_CONTENT ?>
										<?php echo $faq->post_content;  //POST_CONTENT ?>
										
									</div>
								</div>
							</div>
							
				    <?php
				    }
					?>
		 	    </div>
	        </div><!--END PANEL BODY-->
	    <?php
	    }
		?>
    </div><!-- END TAB CONTENT DIV -->
</div><!-- END PANEL WHITE DIV -->