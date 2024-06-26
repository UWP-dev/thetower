<?php 

function render_apartment_board_of_directors_page() {
    ?>
    <div class="page-inner min_height_1088">
    <div class="page-title"><!--PAGE TITLE--->
        <h3><img src="/wp-content/uploads/2022/06/cropped-T-site-icon-e1659613089593.png" class="img-circle head_logo" width="40" height="40">The Towers At Harbor Court</h3>
    <div id="main-wrapper">
        <div class="row">
        <div class="col-md-12">
                <div class="panel panel-white"><!--PANEL-WHITE-->
                    <div class="panel-body"><!--PANEL BODY-->
                            <!--NAV-TAB-WRAPPER-->
                            <h2 class="nav-tab-wrapper">
                                <a href="?page=amgt-apartment-board-of-directors&amp;tab=boardofdirectorslist" class="nav-tab nav-tab-active">
                                <span class="dashicons dashicons-menu"></span>Board of Directors List</a>
                                
                                                                    <a href="?page=amgt-apartment-board-of-directors&amp;tab=add_board-of-directors" class="nav-tab ">
                                <span class="dashicons dashicons-plus-alt"></span> Add Board of Directors</a>
                                                            </h2>     

        <form method="post"> <table id="boardofdirectors_list" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;"><!---form_list TABLE--->
                         <thead>
                        <tr role="row"><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""><input type="checkbox" id="select_all"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th><th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Decription</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th></tr>
                    </thead>
                    <tfoot>
                        <tr><th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1">Title</th><th rowspan="1" colspan="1">Description</th><th rowspan="1" colspan="1">Action</th></tr>
                       
                    </tfoot>
             
                    <tbody>
   <?php                                                             


$forms_posts = new WP_Query(array(
    'post_type' => 'the_tower', // Custom post type
    'posts_per_page' => -1, // Retrieve all posts
    'tax_query' => array(
        array(
            'taxonomy' => 'tower_taxonomies', // Your custom taxonomy slug
            'field' => 'slug',
            'terms' => 'board-of-directors', // Slug of the term you want to filter by
        ),
    ),
));

// Output posts from the "forms" taxonomy
if ($forms_posts->have_posts()) :
     $post_count = 0;
    echo '<ul>';
    while ($forms_posts->have_posts()) :
        $forms_posts->the_post();
         $post_count++;
        ?>
        <?php $post_id = get_the_ID(); ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>   
        <tr class="odd">
        <td class="title dtr-control" tabindex="0"><input type="checkbox" name="selected_id[]" class="sub_chk" value="<?php echo $post_id; ?>"></td>   
        <td class="title sorting_1"><a href="?page=amgt-apartment-board-of-directors&tab=add_board-of-directors&action=edit&form_id=<?php echo $post_id; ?>"><?php the_title() ?></a></td>
        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
        <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
        <div class="long_dd_content"><?php the_content() ?></div>
        <span class="close-btn">&times;</span>
    </div></td>
  
        <td class="action">
           <a href="?page=amgt-apartment-board-of-directors&amp;tab=add_board-of-directors&amp;action=edit&amp;form_id=<?php echo $post_id; ?>" class="btn btn-info">Edit</a>
         
            <a href="?page=amgt-apartment-board-of-directors&amp;action=delete&amp;form_did=<?php echo $post_id; ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete this record?');">
            Delete</a>
                     
<?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Board of Directors</a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Board of Directors URL</a><?php endif; ?>
                                                                                
        </td>
      
    </tr>
 <?php } ?>
    </form><?php
    endwhile; endif;
    ?></tbody><?php
       
    echo '</ul>';
?></table>                                                  
                        
<input type="submit" id="delete_selected1" value="Delete Selected" name="delete_selected" name="delete_selected2" class="btn btn-danger delete_selected "></form> 
                    
                    <?php if (isset($_GET['form_id'])) {
    $document_id = $_GET['form_id'];

    // Retrieve post data based on the document ID
    $post = get_post($document_id);
    if ($post) {

        $post_title = $post->post_title;
        $post_content = $post->post_content;
        // Retrieve repeater field data if it exists in post meta
        // $repeater_titles = get_post_meta($document_id, 'repeater_title', true);
        $repeater_files = get_post_meta($document_id, 'repeater_file', false);
        $repeater_urls = get_post_meta($document_id, 'repeater_url', false);

         //                add_post_meta($post_id, 'repeater_file', true);
    }
}
?>
                 
                 <?php
if (isset($_POST['save_owner'])) {
    // Sanitize and validate form inputs
   $repeater_titles = isset($_POST['repeater_title']) ? $_POST['repeater_title'] : array();
    $repeater_contents = isset($_POST['repeater_content']) ? $_POST['repeater_content'] : array();
    $repeater_files = isset($_FILES['repeater_file']) ? $_FILES['repeater_file'] : array();
     $repeater_urls = isset($_POST['repeater_url']) ? $_POST['repeater_url'] : array();
$repeater_form_ids = isset($_POST['form_id']) ? $_POST['form_id'] : array();
foreach ($repeater_titles as $index => $repeater_title) {
    // Check if the post ID exists
         $post_id = isset($repeater_form_ids[$index]) ? intval($repeater_form_ids[$index]) : 0;

    if ($post_id > 0 && get_post_status($post_id)) {

        // Post exists, update the post
        $updated_post = array(
            'ID'            => $post_id,
            'post_title'    => sanitize_text_field($repeater_title),
            'post_content'  =>isset($repeater_contents[$index]) ? wp_kses_post($repeater_contents[$index]) : '', // Sanitize
             
            'post_type'     => 'the_tower',
        );

        // Update the post in the database
        $updated_post_id = wp_update_post($updated_post);

        if (is_wp_error($updated_post_id)) {
            // Handle post update error
            echo 'Error updating post: ' . $updated_post_id->get_error_message();
        } else {
            // Handle successful post update
            $file_name = isset($repeater_files['name'][$index]) ? $repeater_files['name'][$index] : '';
            $file_tmp = isset($repeater_files['tmp_name'][$index]) ? $repeater_files['tmp_name'][$index] : '';
             $url_name = isset($repeater_urls[$index]) ? $repeater_urls[$index] : '';


            if (!empty($file_name) && !empty($file_tmp)) {
                // Upload file and get the URL
                $file_url = wp_upload_bits($file_name, null, file_get_contents($file_tmp));

                if ($file_url['error']) {
                    // Handle file upload error
                    echo 'Error uploading file: ' . $file_url['error'];
                } else {
                    // Save file URL as post meta
                    update_post_meta($post_id, 'repeater_file', $file_url['url']);
                    
                }
            }
            // else
            // {
            //     update_post_meta($post_id, 'repeater_file', '');
            // }
           if (!empty($url_name)) {
        // Fetch contents from the URL
        // $url_contents = file_get_contents($url_name);

        // if ($url_contents === false) {
        //     // Handle URL fetch error
        //     echo 'Error fetching URL contents.';
        // } else {
            // Save URL contents as post meta
            update_post_meta($post_id, 'repeater_url', $url_name);
        //}

    }
    else
            {
                update_post_meta($post_id, 'repeater_url', '');
            }
             $taxonomy_term_ids = wp_set_object_terms($post_id, 'Board of Directors', 'tower_taxonomies');
                
            if (is_wp_error($taxonomy_term_ids)) {
                // Handle taxonomy assignment error
                echo 'Error assigning taxonomy term: ' . $taxonomy_term_ids->get_error_message();
            } else {
                // Handle successful post creation and taxonomy assignment
                       wp_redirect(admin_url('admin.php?page=amgt-apartment-board-of-directors&tab=boardofdirectorslist'));
                      }
    } 
}

    else {
        // Prepare data for the new post
        $new_post = array(
            'post_title'    => sanitize_text_field($repeater_title),
            'post_content'  =>isset($repeater_contents[$index]) ? wp_kses_post($repeater_contents[$index]) : '', // Sanitize and set repeater content
            'post_status'   => 'publish',
            'post_type'     => 'the_tower',
        );


        // Insert the post into the database
        $post_id = wp_insert_post($new_post);

        if (!is_wp_error($post_id)) {
            // Handle file uploads
            $file_name = isset($repeater_files['name'][$index]) ? $repeater_files['name'][$index] : '';
            $file_tmp = isset($repeater_files['tmp_name'][$index]) ? $repeater_files['tmp_name'][$index] : '';
               $url_name = isset($repeater_urls[$index]) ? $repeater_urls[$index] : '';


            if (!empty($file_name) && !empty($file_tmp)) {
                // Upload file and get the URL
                $file_url = wp_upload_bits($file_name, null, file_get_contents($file_tmp));

                if ($file_url['error']) {
                    // Handle file upload error
                    echo 'Error uploading file: ' . $file_url['error'];
                } else {
                    // Save file URL as post meta
                    add_post_meta($post_id, 'repeater_file', $file_url['url']);
                    
                }
            }
            if (!empty($url_name)) {
   
       add_post_meta($post_id, 'repeater_url',$url_name);
            
    //     }
    }
      $taxonomy_term_ids = wp_set_object_terms($post_id, 'Board of Directors', 'tower_taxonomies');
                
            if (is_wp_error($taxonomy_term_ids)) {
                // Handle taxonomy assignment error
                echo 'Error assigning taxonomy term: ' . $taxonomy_term_ids->get_error_message();
            } else {
                // Handle successful post creation and taxonomy assignment
                       wp_redirect(admin_url('admin.php?page=amgt-apartment-board-of-directors&tab=boardofdirectorslist'));

            }
        } else {
            // Handle post creation error
            echo 'Error adding post: ' . $post_id->get_error_message();
        }

        }
    }

    // Redirect or display success message
    exit;
}

 // If you want to handle non-authenticated users as well

 if (isset($_GET['form_did']) ) {
        $post_id = intval($_GET['form_did']);
         $file_path = get_post_meta($post_id, 'repeater_file', true);
        // Check if the current user has permission to delete the post
      //  if (current_user_can('delete_post', $post_id)) {
            // Delete the post
          if ($file_path) {
    // Construct the full file path
  $full_file_path = str_replace(site_url('/'), ABSPATH, $file_path);
// Get file permissions

// Check if the file is writable

    // Check if the file exists
    if (file_exists($full_file_path)) {
        // Attempt to delete the file
        if (unlink($full_file_path)) {
            echo "File deleted successfully!";
        } else {
            echo "Failed to delete the file!";
        }
    } else {
        echo "File does not exist!";
    }
} else {
    echo "File path is empty!";
}
 wp_delete_post($post_id, true);
            // Redirect to the appropriate page after deletion
           wp_redirect(admin_url('admin.php?page=amgt-apartment-board-of-directors&tab=boardofdirectorslist'));
            exit;
        //}
    }

    if (isset($_POST['delete_selected'])) {
    // Check if any checkboxes are checked
    if (isset($_POST['selected_id']) && is_array($_POST['selected_id']) && !empty($_POST['selected_id'])) {
        $selectedIds = $_POST['selected_id'];
        
        // Loop through selected IDs and delete records
        foreach ($selectedIds as $postId) {
            // Perform the deletion logic based on the IDs received
            wp_delete_post($postId, true); // Set the second parameter to true to permanently delete the post
        }
        
        // Redirect or show a success message after deletion
        wp_redirect(admin_url('admin.php?page=amgt-apartment-board-of-directors&tab=boardofdirectorslist'));
        exit;
    } else {
        // Show an error message if no checkboxes are checked
        // echo 'Please select at least one record to delete.';
    }
}

?>
</div>
   <form name="add_board-of-directors" action="" method="post" class="form-horizontal" id="add_board-of-directors" enctype="multipart/form-data">
    <div class="col-lg-8 col-sm-12 margin_bottom_10_res form-title-row">
        
  
    </div>  
    <div id="repeater_fields">
       <?php if (!empty($post_title) ) : ?>
    
        <div class="repeater_field">
            <!-- Title input for the field -->
             <input  name="form_id[]" type="hidden" class="validate[required] margin_left_15_res margin_top_5_res" value="<?php echo $document_id ?? ''; ?>">
           <label>Board of Directors title <span class="require-field">*</span></label> <input type="text" name="repeater_title[]"  value="<?php echo esc_attr($post_title ?? ''); ?>">
            <label>Board of Directors Description</label>  <input type="textarea" name="repeater_content[]"  value="<?php echo esc_textarea($post_content ?? ''); ?>  ">
            <!-- File input for the field -->
          
           
           <?php 
if (!empty($repeater_files)) {
    foreach ($repeater_files as $index => $repeater_file) : 
?>
        <p><a href="<?php echo $repeater_file; ?>" target="_blank" class="btn btn-default"><i class="fa fa-eye"></i>View Board of Directors</a></p>
        <input type="file" name="repeater_file[]"><button type="button" class="delete-file btn btn-danger">Delete File</button>
<?php 
    endforeach;
} else {
?>
    <input type="file" name="repeater_file[]"><button type="button" class="delete-file btn btn-danger">Delete File</button>
<?php
}
?>
      <?php 
if (!empty($repeater_urls)) {
       foreach ($repeater_urls as $index => $repeater_url) : 
       ?> <label class="ml30">Enter URL</label><input type="text" name="repeater_url[]"  value="<?php echo $repeater_url; ?>" >
        <?php endforeach;
}else
{
    ?>  <label class="ml30">Enter URL</label><input type="text" name="repeater_url[]"  value="<?php echo $repeater_url; ?>" ><?php
}

        ?>

        </div>
<?php else : ?>
    <div class="repeater_field">
       <label>Board of Directors title <span class="require-field">*</span></label> <input type="text" name="repeater_title[]"  class="upload_file" value="<?php echo esc_attr($post_title ?? ''); ?>" required>
       <label>Board of Directors Description</label> <input type="text" name="repeater_content[]"  value="<?php echo esc_textarea($post_content ?? ''); ?>" class="upload_contet" >
       <?php if($repeater_file): ?> <p><a href="<?php echo $repeater_file; ?>" target="_blank" class="btn btn-default"><i class="fa fa-eye"></i>View Form</a></p><?php endif;?>
        <input type="file" name="repeater_file[]"   value="<?php echo $repeater_file; ?>"  ><button type="button" class="delete-file btn btn-danger">Delete File</button>

        <div><label class="ml30">Enter URL</label></div><input type="text" class="ddf" name="repeater_url[]"   value="<?php echo $repeater_url; ?>"  >
    </div>
<?php endif; ?>
    </div>

    <div class="form-group">
        <div class="mb-3 row">  
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="invoice_entry"></label>
            <div class="col-sm-12">              
                <p id="add_new_document_entry_frontend" class="btn btn-default" name="add_new_entry" onclick="addRepeaterField()">Add More Board of Directors</p>
            </div>
        </div>
    </div>

   
    <input type="hidden" id="_wpnonce" name="_wpnonce" value="0f4a8d46d0">
    <input type="hidden" name="_wp_http_referer" value="/wp-admin/admin.php?page=amgt-board-of-directors&amp;tab=add_board-of-directors">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <input type="submit" value="Add Board of Directors" name="save_owner" class="form_btn btn btn-success">
    </div>
</form>
</div></div>
        </div>
    </div>
    </div>
    </div>
    <?php

?>


    <?php
}

?>