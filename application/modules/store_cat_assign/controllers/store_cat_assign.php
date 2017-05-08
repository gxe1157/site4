<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_cat_assign extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_cat_assign';
var $store_controller = 'store_cat_assign';

var $column_rules = array(
        array('field' => 'cat_id', 'label' => 'Category', 'rules' => ''),
);

/* fill in these variable names */
var $headline = "Category Assign";        
var $options_hdr = 'Category '; // should read "New $options_hdr Options" when viewed. $options_hdr dynamic
var $store_redirect = 'store_cat_assign';
var $store_db_table = 'store_cat_assign';
var $store_db_column = 'item_color';


function __construct() {
    parent::__construct();

}

function update( $item_id )
{
    $this->_numeric_check( $item_id );    
    $this->_security_check();    

    // store_catergories is accessable through _get_store_categories()
    $sub_categories = $this->cntlr_name->_get_all_sub_cats_for_dropdown();

    $query = $this->cntlr_name->_get_store_categories('id', $item_id, $orderby = null);
    $data['num_rows'] = $query->num_rows();  

    // $this->lib->checkArray($query->result(),0);  

    foreach ($query->result() as $row) {
      $sub_category[$row->id] = $row->cat_title;
    }

    if(!isset($assigned_categories)) $assign_categories ="";

    $data['query']          = $sub_categories;
    $data['options']        = $sub_categories;
    $data['cat_id']         = $this->input->post('cat_id',TRUE);
    $data['store_db_table'] = $this->store_db_table;     
    $data['store_db_column'] = $this->store_db_column;        
    $data['options_hdr'] = $this->options_hdr;    

    $data['item_id']   = $item_id;    
    $data['headline']  = $this->headline;        
    $data['flash']     = $this->session->flashdata('item');    
    $data['view_file'] = "update";

    $this->_render_view('admin', $data);    
}


function submit( $item_id )
{
    $this->_numeric_check($item_id);    
    $this->_security_check();    

    $submit = $this->input->post('submit', TRUE);
    $cat_id = trim($this->input->post('cat_id', TRUE));

    if($submit == "Finished"){
        redirect('store_items/create/'.$item_id);
    } elseif ($submit == "Submit" ){
        // Insert new option
        if($cat_id!=''){
            $data['item_id'] = $item_id;
            $data[ 'cat_id'] = $cat_id;
            $this->_insert($data);
      
            $cat_title = $this->cntlr_name->_get_cat_title($row->cat_id, 'Evelio');
            echo $this->cntlr_name;
                die('');

  

            $this->_set_flash_msg("The item was successfully assigned to the ".$cat_title." category.");          
        }
    }
    redirect( $this->store_redirect.'/update/'.$item_id);    
}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */




/* ===============================================
    Call backs go here...
  =============================================== */




/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
