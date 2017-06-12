<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_items_commercial extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_items_commercial";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function _get_item_id($id){
    $data = $this->db->get_where('store_items_commercial', array('id' => $id) )->result()[0];
    $item_id = $data->item_id;
    return $item_id ;
}    
  
function _get_item_title_byid($id)
{
    $data = $this->db->get_where('store_items', array('id' => $id) )->result()[0];
    $title  = $data->item_title;
    $small_img = $data->small_pic ? : null;
    $item_setup = $data->item_setup;
    $item_price = $data->item_price;    
    return array( $title, $small_img, $item_setup, $item_price );
}


/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}