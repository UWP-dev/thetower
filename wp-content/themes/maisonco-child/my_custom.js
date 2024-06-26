
    jQuery(document).ready(function($) {

         $('.read-more-btn').click(function() {
        $(this).parent().hide();
        $(this).closest('td').find('.long_dd_popup').show();
    });

    // Close the popup when close button is clicked (using event delegation)
    $(document).on('click', '.close-btn', function() {
        $('.read-more-btn').closest('div').show();
        $(this).parent('.long_dd_popup').hide();
        $(this).closest('td').find('.shor_dd').show();

    });

        $('.delete-file').click(function() {
              alert('File Deleted');
    // Find the associated file input field
    var fileInput = $(this).prev('input[type="file"]');

    // Clear the file input field
    fileInput.val('');
});
         var selectAllCheckbox = document.getElementById("select_all");
        var subCheckboxes = document.querySelectorAll(".sub_chk");

        // Add event listener to the "select all" checkbox
        selectAllCheckbox.addEventListener("click", function() {
            // Loop through all sub checkboxes and update their state
            subCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
     $('#form_list').DataTable();
     $('#owner_list').DataTable();
      $('#maintenanceservices_list').DataTable();
      $('#buildingoperations_list').DataTable();
    $('#officialdocuments_list').DataTable();
$('#boardofdirectors_list').DataTable();
$('#announcements_list').DataTable();

    const urlParams = new URLSearchParams(window.location.search);
    const tabValue = urlParams.get('tab');
    const pageValue = urlParams.get('page');
     const action = urlParams.get('action');

    // Show the corresponding tab content based on the tab value
     if(tabValue === 'add_maintenance-services')
     {
 document.getElementById('add_maintenance-services').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('maintenanceservices_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
     }
   else {
        if(tabValue === 'maintenanceserviceslist' || pageValue ==="amgt-apartment-maintenance-services" )
        {
        document.getElementById('maintenanceservices_list_wrapper').style.display = 'block';
         document.getElementById('add_maintenance-services').style.display = 'none';
                  document.getElementById('maintenanceservices_list').style.display = 'block';

                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }
 if(tabValue === 'add_official-documents')
     {
 document.getElementById('add_official-documents').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('officialdocuments_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
     }
   else {
        if(tabValue === 'officialdocumentslist' || pageValue ==="amgt-apartment-official-documents" )
        {
        document.getElementById('officialdocuments_list_wrapper').style.display = 'block';
         document.getElementById('add_official-documents').style.display = 'none';
                  document.getElementById('officialdocuments_list').style.display = 'block';

                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }
 if(tabValue === 'add_announcements')
     {
 document.getElementById('add_announcements').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('announcements_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
     }
   else {
        if(tabValue === 'announcementslist' || pageValue ==="amgt-apartment-announcements" )
        {
        document.getElementById('announcements_list_wrapper').style.display = 'block';
         document.getElementById('add_announcements').style.display = 'none';
                  document.getElementById('announcements_list').style.display = 'block';

                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }
    if(tabValue === 'add_board-of-directors')
     {
 document.getElementById('add_board-of-directors').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('boardofdirectors_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
     }
   else {
        if(tabValue === 'boardofdirectorslist' || pageValue ==="amgt-apartment-board-of-directors" )
        {
        document.getElementById('boardofdirectors_list_wrapper').style.display = 'block';
         document.getElementById('add_board-of-directors').style.display = 'none';
                  document.getElementById('boardofdirectors_list').style.display = 'block';

                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }

    // Show the corresponding tab content based on the tab value
     if(tabValue === 'add_building-operations')
     {
 document.getElementById('add_building-operations').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('buildingoperations_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
     }
   else {
        if(tabValue === 'buildingoperationslist' || pageValue ==="amgt-apartment-building-operations" )
        {
        document.getElementById('buildingoperations_list_wrapper').style.display = 'block';
         document.getElementById('add_building-operations').style.display = 'none';
                  document.getElementById('buildingoperations_list').style.display = 'block';

                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }
    if (tabValue === 'add_form') {
        document.getElementById('add_form').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('form_list_wrapper').style.display = 'none';
        // document.getElementById('edit-document-form').style.display = 'none';
    } else {
        if(tabValue === 'formlist' || pageValue ==="amgt-apartment-form" )
        {
        document.getElementById('form_list_wrapper').style.display = 'block';
         document.getElementById('add_form').style.display = 'none';
                  //document.getElementById('edit-document-form').style.display = 'none';
        }
    }

     if (tabValue === 'add_owner_tenant') {
       // alert('fhdf');
        document.getElementById('add_owner_tenant').style.display = 'block';
          document.getElementById('delete_selected1').style.display = 'none';
         document.getElementById('owner_list').style.display = 'none';
        document.getElementById('owner_list_wrapper').style.display = 'none';

        // document.getElementById('edit-document-form').style.display = 'none';
    } else {
         if(tabValue === 'ownerlist' || pageValue ==="amgt-apartment-ownwer_tenant" )
        {
        document.getElementById('owner_list').style.display = 'block';
         document.getElementById('add_owner_tenant').style.display = 'none';
                  //document.getElementById('edit-document-form').style.display = 'none';
}
    }
    if(action == "edit")
    {
     $('.form_btn').val('Save');

    }
    else{
         const urlParams = new URLSearchParams(window.location.search);
    const tabValue = urlParams.get('tab');
    const pageValue = urlParams.get('page');
    if (tabValue === 'add_owner_tenant')
    {
$('.form_btn').val('Add Owner/Tanent');
         
    }
    if (tabValue === 'add_form')
    {
        $('.form_btn').val('Add Form');
    }
    }

   

});
    

 function addRepeaterField() {
    var container = document.getElementById('repeater_fields');
    if (container) {
        var repeaterField = document.querySelector('.repeater_field'); // Get the repeater field template
        var clonedField = repeaterField.cloneNode(true); // Clone the template
        
        // Reset input values within the cloned field
        var inputFields = clonedField.querySelectorAll('input[type="hidden"]');
        inputFields.forEach(function(input) {
            input.value = ''; // Reset input value to empty string
        });
        
        // Append a delete button to the cloned field
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete Row'; // Set the button text
        deleteButton.classList.add('btn', 'btn-danger'); // Add the 'btn' and 'btn-danger' classes
        deleteButton.addEventListener('click', function() {
            container.removeChild(clonedField); // Remove the cloned field when the delete button is clicked
        });
        clonedField.appendChild(deleteButton); // Append the delete button to the cloned field
        
        container.appendChild(clonedField); // Append the cloned field to the container
    } else {
        console.error('Container element not found.');
    }
}

