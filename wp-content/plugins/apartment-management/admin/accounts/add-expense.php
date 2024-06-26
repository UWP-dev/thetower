<script type="text/javascript">
$(document).ready(function() {
	"use strict";
	//EXPENSE_FORM VALIDATIONENGINE
	<?php
	if (is_rtl())
		{
		?>	
			$('#expense_form').validationEngine({promptPosition : "topLeft",maxErrorsPerField: 1});
		<?php
		}
		else{
			?>
			$('#expense_form').validationEngine({promptPosition : "topRight",maxErrorsPerField: 1});
			<?php
		}
	?>
    var date = new Date();
            date.setDate(date.getDate()-0);
             jQuery('#payment_date').datepicker({
					dateFormat: "yy-mm-dd",
					changeMonth: true,
			        changeYear: true,
			        yearRange:'-65:+25',
					beforeShow: function (textbox, instance) 
					{
						instance.dpDiv.css({
							marginTop: (-textbox.offsetHeight) + 'px'                   
						});
					},    
			        onChangeMonthYear: function(year, month, inst) {
			            jQuery(this).val(month + "/" + year);
			        }                    
				});  	
             jQuery('#bill_date').datepicker({
					dateFormat: "yy-mm-dd",
					changeMonth: true,
			        changeYear: true,
			        yearRange:'-65:+25',
					beforeShow: function (textbox, instance) 
					{
						instance.dpDiv.css({
							marginTop: (-textbox.offsetHeight) + 'px'                   
						});
					},    
			        onChangeMonthYear: function(year, month, inst) {
			            jQuery(this).val(month + "/" + year);
			        }                    
				});  	
          //ONLYLETTER_NUMBER_SPACE_VALIDATION		   
	    $('.onlyletter_number_space_validation').keypress(function( e ) 
		{ 
			"use strict";    
			var regex = new RegExp("^[0-9a-zA-Z \b]+$");
			var key = String.fromCharCode(!event.charCode ? event.which: event.charCode);
			if (!regex.test(key)) 
			{
				event.preventDefault();
				return false;
			} 
	   });
} );
</script>
<style>
.dropdown-menu {
    min-width: 240px;
}
</style>
     <?php 	
$expense_id=0;
if(isset($_REQUEST['expense_id']))
	$expense_id=$_REQUEST['expense_id'];
	$edit=0;
	if(isset($_REQUEST['action']) && sanitize_text_field($_REQUEST['action']) == 'edit'){
		$edit=1;
		$result = $obj_account->MJ_amgt_get_single_expense($expense_id);
	} ?>

<div class="panel-body"><!--PANEL-BODY-->
    <!--EXPENSE_FORM-->
    <form name="expense_form" action="" method="post" class="form-horizontal" id="expense_form">
        <?php $action = sanitize_text_field(isset($_REQUEST['action'])?$_REQUEST['action']:'insert');?>
		<input id="action" type="hidden" name="action" value="<?php echo esc_attr($action);?>">
		<input type="hidden" name="expense_id" value="<?php echo esc_attr($expense_id);?>"  />
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="expense_type">
				<?php esc_html_e('Expense Type','apartment_mgt');?><span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select class="form-select validate[required] expense_types" name="expense_type" id="expense_types">
						<option value=""><?php esc_html_e('Select Expense Type','apartment_mgt');?></option>
						<?php 
						if($edit)
							$category =$result->type_id;
						elseif(isset($_REQUEST['expense_type']))
							$category =$_REQUEST['expense_type'];
						else 
							$category = "";
						
						$activity_category=MJ_amgt_get_all_category('expense_types');
						if(!empty($activity_category))
						{
							foreach ($activity_category as $retrive_data)
							{
								echo '<option value="'.$retrive_data->ID.'" '.selected($category,$retrive_data->ID).'>'.$retrive_data->post_title.'</option>';
							}
						} ?>		
					</select>
				</div>
				<div class="col-sm-2"><button class="btn btn-default" id="addremove" model="expense_types"><?php esc_html_e('Add Or Remove','apartment_mgt');?></button></div>
			</div>	
		</div>		
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="from_date">
				<?php esc_html_e('Vendor Name','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="vender_name" maxlength="50" class="form-control validate[required,custom[onlyLetter_specialcharacter]]" type="text" value="<?php if($edit){ echo esc_attr($result->vender_name);}
					elseif(isset($_POST['vender_name'])) echo esc_attr($_POST['vender_name']);?>" name="vender_name">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="bill_date">
				<?php esc_html_e('Bill Date','apartment_mgt');?><span class="require-field">*</span></label></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="bill_date" class="form-control validate[required]" autocomplete="off" type="text"  
					value="<?php if($edit){ 
					 if(isset($result->bill_date)){ echo esc_attr(date("Y-m-d",strtotime($result->bill_date)));} }
					elseif(isset($_POST['bill_date'])) if(!empty($_POST['bill_date'])) { echo esc_attr($_POST['bill_date']);  } ?>" name="bill_date">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="amount">
				<?php esc_html_e('Amount','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="amount" class="form-control validate[required]" type="number" min="0"
					value="<?php if($edit){ echo esc_attr($result->amount);}
					elseif(isset($_POST['amount'])) echo esc_attr($_POST['amount']);?>" name="amount">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="due_date">
				<?php esc_html_e('Payment Date','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<input id="payment_date" class="form-control validate[required]" autocomplete="off" type="text"  
					value="<?php if($edit){ echo esc_attr(date("Y-m-d",strtotime($result->payment_date)));}
					elseif(isset($_POST['payment_date'])) echo esc_attr($_POST['payment_date']);?>" name="payment_date">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="mb-3 row">	
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label form-label" for="desc"><?php esc_html_e('Description','apartment_mgt');?></label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					 <textarea name="description" maxlength="150" class="form-control validate[custom[address_description_validation]] text-input"><?php if($edit) echo esc_textarea($result->description);?></textarea>
				</div>
			</div>
		</div>
		<?php wp_nonce_field('add_expense_nonce'); ?>
		<div class="offset-sm-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">
        	<input type="submit" value="<?php if($edit){ esc_html_e('save','apartment_mgt'); }else{ esc_html_e('Add Expense','apartment_mgt');}?>" 
			name="add_expense" class="btn btn-success"/>
        </div>		
    </form><!--EXPENSE_FORM-->
</div><!--PANEL-BODY-->