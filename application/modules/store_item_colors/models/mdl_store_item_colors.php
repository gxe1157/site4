<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_item_colors extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_item_colors";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function get_item_id($update_id){
    /* fetch the item id */
    $item_id = null;
    $query = $this->get_where($update_id);
    foreach($query->result() as $row){
        $item_id = $row->item_id;
    }
    return $item_id ;
}    

function get_item_title_id($id)
{
    $query = $this->db->get_where('store_items', array('id' => $id) );
    foreach ($query->result() as $row)
    {
         $title  = $row->item_title;
         $small_img = $row->small_pic ? : null;
     }

    return array( $title, $small_img );
}

/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}