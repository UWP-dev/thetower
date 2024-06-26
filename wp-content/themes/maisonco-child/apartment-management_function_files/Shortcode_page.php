<?php

// Define the shortcode function
function custom_forms_table_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=forms&amp;tab=formlist" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Resident Form List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="form_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'form', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Form </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Form URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_forms_table', 'custom_forms_table_shortcode');

// Define the shortcode function
function custom_owner_table_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=ownerlist" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Owner/Tenants Essentials List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="owner_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'owner-tenants-essentials', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Owner/Tenants Essentials </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Owner/Tenants Essentials</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_owner_tenants_table', 'custom_owner_table_shortcode');


function custom_maintenance_services_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=maintenanceservices_list" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Maintenance Services List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="maintenanceservices_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'maintenance-services', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Maintenance Services </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Maintenance Services URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_maintenance_services_table', 'custom_maintenance_services_shortcode');


function custom_building_operations_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=buildingoperations_list" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Building Operations List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="buildingoperations_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'building-operations', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Building Operations </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Building Operations URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_building_operations_table', 'custom_building_operations_shortcode');

function custom_official_documents_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=officialdocuments_list" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Official Documents List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="officialdocuments_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'official-documents', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Official Documents </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Official Documents URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_official_documents_table', 'custom_official_documents_shortcode');


function custom_board_of_directors_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=boardofdirectors_list" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Board of Directors List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="boardofdirectors_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Board of Directors </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Board of Directors URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_board_of_directors_table', 'custom_board_of_directors_shortcode');


function custom_announcements_shortcode() {
    ob_start(); // Start output buffering
    ?>
<div class="panel-body panel-white">
    <ul class="nav nav-tabs panel_tabs" role="tablist"><!--NAV-TABS-->
        <li class="active">
     
            <a href="?apartment-dashboard=user&amp;page=owner&amp;tab=announcements_list" class="nav-link px-3 tab active">
             <i class="fa fa-align-justify"></i> Announcements List</a>
          
        </li>
        <li class="">
              
        </li>
    </ul>
    <div class="tab-content">
        <div class="panel-body">
    <table id="announcements_list1" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="document_list_info" style="width: 100%;">
        <!---form_list TABLE--->
        <thead>
            <tr role="row">
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 20px;" aria-label=""></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 45%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Title</th>
                <th class="" tabindex="0" aria-controls="form_list" rowspan="1" colspan="1" style="width: 35%;" aria-sort="descending" aria-label="Title: activate to sort column ascending">Description</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 25%;" aria-label="Action">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1"></th>
                <th rowspan="1" colspan="1">Title</th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
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
            'terms' => 'announcements', // Slug of the term you want to filter by
        ),
    ),
));
            // Output posts from the "forms" taxonomy
            if ($forms_posts->have_posts()) :
                $post_count = 0;
                while ($forms_posts->have_posts()) :
                    $forms_posts->the_post();
                    $post_count++;
                    $post_id = get_the_ID();
            ?>
            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
if($form_li || $form_v)
{
?>
                    <tr class="odd">
                        <td class="title dtr-control" tabindex="0"></td>
                        <td class="title sorting_1"><?php the_title() ?></td>
                        <?php $content = get_the_content();
    
    // Split the content into an array of words
    $words = explode(' ', $content);
    
    // Extract the first 5 words
    $first_five_words = implode(' ', array_slice($words, 0, 12));?>
 <td class="title sorting_1"><span class="shor_dd"><?php echo $first_five_words; ?><?php if($content!=""){ ?><div><span class="read-more-btn">Read More</span></div><?php } ?>
</span><div class="long_dd_popup">
       <span class="close-btn">&times;</span>
        <div class="long_dd_content"><?php the_content() ?></div>
    </div></td>
                        <td class="action">
                            <?php $form_v=get_post_meta($post_id, 'repeater_file', true);
$form_li=get_post_meta($post_id, 'repeater_url', true);
?>
           <?php if($form_v!=""):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_file', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Announcements </a><?php endif; ?>

            <?php if($form_li):?> <a target="_blank" href="<?php echo get_post_meta($post_id, 'repeater_url', true); ?>" class="btn btn-default"> <i class="fa fa-eye"></i> View Announcements URL</a><?php endif; ?>
                        </td>
                    </tr>
            <?php
        }
                endwhile;
            endif;
            ?>
        </tbody>
    </table>
</div></div></div>
    <?php
    $output = ob_get_clean(); // Get the output buffer contents and clean the buffer
    return $output; // Return the HTML content
}
// Register the shortcode
add_shortcode('custom_announcements_table', 'custom_announcements_shortcode');

?>