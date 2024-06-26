<?php
//ASSEETSINVENTORY CLASS
class MJ_amgt_AssetsInventory
{	
    //ADD ASSET FUNCTION
	public function MJ_amgt_add_assets($data)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_assets';
		$assetsdata['assets_no']=$data['assets_no'];
		$assetsdata['assets_name']=MJ_amgt_strip_tags_and_stripslashes($data['assets_name']);
		$assetsdata['vender_name']=MJ_amgt_strip_tags_and_stripslashes($data['vender_name']);
		$assetsdata['assets_cat_id']=$data['assets_cat_id'];
		$assetsdata['location']=MJ_amgt_strip_tags_and_stripslashes($data['location']);
		$assetsdata['purchage_date']=MJ_amgt_get_format_for_db($data['purchage_date']);
		$assetsdata['assets_cost']=MJ_amgt_strip_tags_and_stripslashes($data['asset_cost']);
		$assetsdata['created_date']=date('Y-m-d');
		$assetsdata['created_by']=get_current_user_id();
		if($data['action']=='edit')
		{
			$whereid['id']=$data['assets_id'];
			$result=$wpdb->update( $table_name, $assetsdata ,$whereid);
			return $result;
		}
		else
		{
			
			$result=$wpdb->insert( $table_name, $assetsdata );
			return $result;
		}
	
	}
	 //ADD INVENTORY FUNCTION
	public function MJ_amgt_add_inventory($data)
	{
		
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_inventory';
		$inventorydata['inventory_name']=MJ_amgt_strip_tags_and_stripslashes($data['inventory_name']);
		$inventorydata['inventory_unit_cat']=MJ_amgt_strip_tags_and_stripslashes($data['inventory_unit_cat']);
		$inventorydata['quentity']=MJ_amgt_strip_tags_and_stripslashes($data['quentity']);
		$inventorydata['created_date']=date('Y-m-d');
		$inventorydata['created_by']=get_current_user_id();
		
		if($data['action']=='edit')
		{
			$whereid['id']=$data['inventory_id'];
			$result=$wpdb->update( $table_name, $inventorydata ,$whereid);
			return $result;
		}
		else
		{
			
			$result=$wpdb->insert( $table_name, $inventorydata );
			return $result;
		}
	
	}
	 //GET ALL ASSETS FUNCTION
	public function MJ_amgt_get_all_assets()
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_assets';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name");
		return $result;
	
	}
	 //GET ALL ASSETS FUNCTION
	public function MJ_amgt_get_all_assets_created_by($user_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_assets';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name where created_by=".$user_id);
		return $result;
	
	}
	 //GET SINGE  ASSET FUNCTION
	public function MJ_amgt_get_single_assets($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_assets';
		$result = $wpdb->get_row("SELECT * FROM $table_name where id=".$id);
		return $result;
	}
	 //GET SINGLE INVENTORY FUNCTION
	public function MJ_amgt_get_single_inventory($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_inventory';
		$result = $wpdb->get_row("SELECT * FROM $table_name where id=".$id);
		return $result;
	}
	 //DELETE ASSET FUNCTION
	public function MJ_amgt_delete_assets($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_assets';
		$result = $wpdb->query("DELETE FROM $table_name where id= ".$id);
		return $result;
	}
	// GET ALL INVENTORY
	public function MJ_amgt_get_all_inventory()
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_inventory';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name");
		return $result;
	
	}
	// GET OWN INVENTRY
	public function MJ_amgt_get_own_inventory($user_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_inventory';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name where created_by=".$user_id);
		return $result;
	
	}
	//DELETE INVENTRY
	public function MJ_amgt_delete_inventory($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_inventory';
		$result = $wpdb->query("DELETE FROM $table_name where id= ".$id);
		return $result;
	}
	
}
?>