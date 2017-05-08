<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_cat_assign extends MY_Model
{

function __construct( ) {
    parent::__construct();
    $this->load->module('lib');

}

function get_table() {
	// table name goes here	
    $table = "store_cat_assign";
    return $table;
}



/* ===================================================
    Add custom model functions here
   =================================================== */

function _get_store_categories($col, $value, $orderby)
{
    $table = "store_categories";
    $this->db->where($col, $value);
    $this->db->order_by($orderby);        
    $query=$this->db->get($table);
    return $query;
}


function _get_all_sub_cats_for_dropdown()
{
    $table = "store_categories";  
    $mysql_query = "SELECT * FROM store_categories where parent_cat_id !=0 ORDER BY parent_cat_id, cat_title"; 
      $query = $this->db->query($mysql_query); 
      foreach ($query->result() as $row) {
         $parent_cat_title = $this->_get_cat_title($row->parent_cat_id);
         $sub_categories[$row->id] = $parent_cat_title." > ".$row->cat_title;
      }
      if(!isset($sub_categories)) $sub_categories = "";
      return $sub_categories;
}

function _get_cat_title( $id, $test = null )
{
    $table = "store_categories";
    $this->db->where('id', $id);
    $data=$this->db->get($table)->result()[0];
    $cat_title = $data->cat_title;

$this->load->module('lib');
$this->lib->checkField($test,1);      
    return $cat_title;
}



/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class