<script type="text/javascript">
		$(document).ready(function()
         {
            "use strict";
			<?php
			if (is_rtl())
				{
				?>	
					$('#category_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
				<?php
				}
				else{
					?>
					$('#category_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
					<?php
				}
			?>
		} );
	</script>

    <div class="panel-body">
        <div class="page-title user_header"><!---TITLE--->	
		      <h3><?php echo esc_attr__('Import CSV','apartment_mgt'); ?></h3>
	    </div>
    </div>  
    <div class="panel-body"> 
        <div class="panel panel-white"><!--PANEL WHITE---->
           
                <form name="category_form" action="" method="post" class="building_information1 form-horizontal" id="category_form" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('User Role','apartment_mgt');?><span class="require-field">*</span></label>
                            <div class="col-sm-8 user-type">
                              <select class="form-select validate[required] import_csv" name="user_type" id="form-validation-field-0">
                                  <option value=""><?php esc_html_e('Select User Type','apartment_mgt');?></option>
                                  <option value="member"><?php esc_html_e('Member','apartment_mgt');?></option>
                                  <option value="staff_member"><?php esc_html_e('Staff Member','apartment_mgt');?></option>
                                  <option value="accountant"><?php esc_html_e('Accountant','apartment_mgt');?></option>
                                 <option value="gatekeeper"><?php esc_html_e('gatekeeper','apartment_mgt');?></option>
                             </select>
                         </div>
                    </div>

                    <div class="building_information111" style="display: none;">
                        <div class="mb-3 row">	
                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Building','apartment_mgt');?><span class="require-field">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-select validate[required] building_category" name="building_id">
                                    <option value=""><?php esc_html_e('Select Building','apartment_mgt');?></option>
                                    <?php 
                                    if($edit)
                                    {
                                    $category =$result->building_id;
                                    }
                                    elseif(isset($_REQUEST['building_id']))
                                    {
                                    $category =$_REQUEST['building_id'];
                                    }
                                    else
                                    {
                                    $category = "";
                                    }
                                    $activity_category=MJ_amgt_get_all_category('building_category');
                                    if(!empty($activity_category))
                                    {
                                        foreach ($activity_category as $retrive_data)
                                        {
                                            echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
                                        }
                                    } ?>
                                </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3 row">	
                                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="activity_category"><?php esc_html_e('Unit Category','apartment_mgt');?><span class="require-field">*</span></label>
                                <div class="col-sm-8">			
                                    <select class="form-select validate[required] unit_categorys unit_category" name="unit_cat_id">
                                        <option value=""><?php esc_html_e('Select Unit Category','apartment_mgt');?></option>
                                        <?php 
                                            if($edit)
                                                $category =$result->unit_cat_id;
                                            elseif(isset($_REQUEST['unit_cat_id']))
                                                $category =$_REQUEST['unit_cat_id'];  
                                            else 
                                                $category = "";
                                            
                                            $activity_category=MJ_amgt_get_all_category('unit_category');
                                            if(!empty($activity_category))
                                            {
                                                foreach ($activity_category as $retrive_data)
                                                {
                                                    echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
                                                }
                                            } 	
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label padding_top_0"><?php echo esc_attr__('Select CSV File','apartment_mgt'); ?></label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
                                    <input id="input-1" name="csv_file" type="file" class="form-control button margin_top_10_res file">
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="offset-sm-2 col-lg-8 col-md-8 col-sm-10 col-xs-10 margin_bottom_15">
                            <button type="submit" class="btn btn-success" name="upload_csv_file"><?php echo esc_attr__('Save','apartment_mgt');?></button>
                        </div>
                    </div>
                </form>
        </div>
    </div>