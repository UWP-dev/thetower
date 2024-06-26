<?php
class MJ_amgt_Document
{	
   //ADD DOCUMENT FUNCTION
	public function MJ_amgt_add_document($data,$upload_docs_array)
	{ 
      	global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
	    $document_title=$data['doc_title'];
	    $document_description=$data['description'];
		
		if($data['action']=='edit')
		{ 
	            $documentdata['doc_title']=MJ_amgt_strip_tags_and_stripslashes($data['doc_title']);
				$documentdata['building_id']=$data['building_id'];
				$documentdata['unit_cat_id']=$data['unit_cat_id'];
				$documentdata['unit_name']=MJ_amgt_strip_tags_and_stripslashes($data['unit_name']);
				$documentdata['member_id']=$data['member_id'];
				$documentdata['document_content']=$upload_docs_array;
				$documentdata['description']=MJ_amgt_strip_tags_and_stripslashes($data['description']);
				$documentdata['created_date']=date('Y-m-d');
				$documentdata['created_by']=get_current_user_id();
			
			$whereid['id']=$data['document_id'];
			$result=$wpdb->update( $table_name, $documentdata ,$whereid);
			
			return $result;
		}
		else
		{
			if(!empty($document_title))
			{	
				foreach($document_title as $key => $value)
				{
					$user_avatar=$upload_docs_array[$key];
					$document_description=$document_description[$key];
					$documentdata['doc_title']=$value;
					$documentdata['building_id']=$data['building_id'];
					$documentdata['unit_cat_id']=$data['unit_cat_id'];
					$documentdata['unit_name']=MJ_amgt_strip_tags_and_stripslashes($data['unit_name']);
					$documentdata['member_id']=$data['member_id'];
					$documentdata['document_content']=$user_avatar;
					$documentdata['description']=$document_description;
					$documentdata['created_date']=date('Y-m-d');
					$documentdata['created_by']=get_current_user_id();
					$result=$wpdb->insert( $table_name, $documentdata );
				}
			}
			return $result;
		}
	
	}
	//GET ALL DOCUMENT FUNCTION
	public function MJ_amgt_get_all_documents()
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name");
		return $result;
	
	}
	//GET ALL DOCUMENT FUNCTION
	public function MJ_amgt_get_own_documents($user_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name where member_id=$user_id OR created_by=".$user_id);
		return $result;
	
	}
	//GET ALL UNIT DOCUMENT 
	public function MJ_amgt_get_units_all_documents($unitname)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name where unit_name='".$unitname."' order by created_date DESC");
		return $result;
	
	}
	// GET ALL DOCUMENT BY UNIT
	public function MJ_amgt_get_units_all_documents_new($unitname,$building_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
	
		$result = $wpdb->get_results("SELECT * FROM $table_name where unit_name='$unitname' AND building_id='$building_id' order by created_date DESC");
		return $result;
	
	}
	//GET SINGLE DOCUMENT FUNCTION
	public function MJ_amgt_get_single_document($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
		$result = $wpdb->get_row("SELECT * FROM $table_name where id=".$id);
		return $result;
	}
	// DELETE DOCUMENTS
	public function MJ_amgt_delete_document($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
		$result = $wpdb->query("DELETE FROM $table_name where id= ".$id);
		return $result;
	}
	//GET MEMBER DOCUMENT
	public function MJ_amgt_get_member_document($id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix. 'amgt_document';
		$result = $wpdb->get_row("SELECT * FROM $table_name where member_id=".$id);
		return $result;
	}

}
?>