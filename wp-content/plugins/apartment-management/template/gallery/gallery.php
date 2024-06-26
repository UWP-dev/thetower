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
$active_tab = sanitize_text_field(isset($_GET['tab'])?$_GET['tab']:'gallery-list');
$gallery_data=MJ_amgt_get_all_category('amgt_photo_gallery');
// var_dump($gallery_data);
?>
<div class="panel-body panel-white"><!-- PANEL WHITE DIV -->
	    <ul class="nav nav-tabs panel_tabs" role="tablist"><!-- PANEL_TABS -->
			<li class="<?php if($active_tab=='gallery-list'){?>active<?php }?>">
					<a href="?apartment-dashboard=user&page=gallery&tab=gallery-list" class="nav-tab nav-link px-3 tab <?php echo esc_html($active_tab) == 'gallery-list' ? 'active' : ''; ?>">
					 <i class="fa fa-align-justify"></i> <?php esc_html_e('Gallery', 'apartment_mgt'); ?></a>
			</li>
		</ul> 
		<style>
		.fancybox.col-md-4.amgt-gallary-images {
		  border-bottom: 0 none !important;
		}
		</style>
		<script>	
			jQuery(document).ready(function($){
				  $('a.fancybox').fancybox();
				});
		</script>	
        <div class="tab-content"><!--TAB-CONTENT DIV-->
			<?php
			if($active_tab == 'gallery-list')//GALLERY LIST TAB
			{ 
				if(isset($_REQUEST['action']) && $_REQUEST['action']=='view-gallery')
				{ 
					$single_gallery=get_post($_REQUEST['id']);
					// var_dump($single_gallery);
					$gallary_photos=get_post_meta($_REQUEST['id'],'amgtfld_gallery',true);
					// var_dump($gallary_photos);
					array_pop($gallary_photos['image_url']);
					if(!empty($gallary_photos['image_url']))
					{
					?>
					<div class="panel-body"><!--PANEL BODY-->
						<div class="col-md-12 col-sm-12 col-xs-12 gallery-title"><!--GALLERY-TITLE-->
							<h2><?php echo esc_html($single_gallery->post_title);?></h2>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 row">
							<?php 
							foreach($gallary_photos['image_url'] as $photo_url)
							{								
								?>

								<div class="col-md-4 col-sm-4 col-xs-12 image-gallary">
									<a href="<?php echo esc_url($photo_url);?>" class="fancybox col-md-4 amgt-gallary-images" rel="group_1" >
									
										<img src="<?php echo esc_url($photo_url);?>">
									</a>
								</div>
							<?php
							} ?>
							</p>
						</div>
					</div><!--END PANEL BODY-->
									
					<?php 
					}
					else
					{ ?>
						<div class="panel-body"><!--PANEL BODY-->
							<div class="col-md-12 gallery-title">
								<h2><?php 
								if(!empty($single_gallery->post_title))
								{
									echo esc_html($single_gallery->post_title);
								}
								?></h2>
							</div>
							<div class="col-md-12">
							<p><?php _e("No Any Images In This Gallery Yet.","apartment_mgt"); ?></p>
							</div>
						</div><!--END PANEL BODY-->
							
					<?php
					}
				}
				else
				{ ?>
					<div class="panel-body"><!--PANEL BODY-->
						<div class="col-md-12 col-sm-12 col-xs-12 row">
							<?php 
							foreach($gallery_data as $gallery)
							{
								$image = wp_get_attachment_image_src(get_post_thumbnail_id($gallery->ID),'single-post-thumbnail');
								// var_dump($image);
								?>
								
									<div class="col-md-4 col-sm-4 col-xs-12 image-gallary">
									<h4 class="mt-3"><?php echo esc_html($gallery->post_title);?></h4>
									<a href="?apartment-dashboard=user&page=gallery&tab=gallery-list&action=view-gallery&id=<?php echo esc_attr($gallery->ID);?>" class="fancybox col-md-4 amgt-gallary-images" rel="group_1" >
										<img src="<?php echo esc_url($image[0]);?>">
									</a>
									
								</div>
							<?php 
							} ?>
							</p>
						</div>
					</div><!--END PANEL BODY-->
				 <?php 
				} 
			} ?>
        </div>	
</div>	<!--END  PANEL WHITE DIV -->
<?php ?>