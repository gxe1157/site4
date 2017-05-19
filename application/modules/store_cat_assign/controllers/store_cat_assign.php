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
var $options_hdr = 'Assign New Categories '; // should read "New 
var $options_dtls = 'Assigned categories for this item';
var $store_redirect = 'store_cat_assign';
var $store_db_table = 'store_cat_assign';
var $store_db_column = '#';


function __construct() {
    parent::__construct();

}

function update( $item_id )
{
    $this->_numeric_check( $item_id );
    $this->_security_check();

    // get item title and image from store_items table
    list ($item_title, $small_img) = $this->cntlr_name->_get_item_title_byid($item_id);

    // get sub_catergories from store_catergories
    $sub_categories = $this->cntlr_name->_get_all_sub_cats_for_dropdown();

    // get an array of all assigned to item_id from store_cat_assign
    $query = $this->cntlr_name->_get_assigned_categories('item_id', $item_id, $orderby = null);
    $data['query'] = $query;
    $data['num_rows'] = $query->num_rows();
    foreach ($query->result() as $row) {
       list ($cat_title, $parent_cat_title) = $this->cntlr_name->_get_parent_cat_title($row->cat_id);
       $assigned_categories[$row->cat_id] = $parent_cat_title." > ".$cat_title;
    }

// $this->lib->checkField($item_id,1);
// $this->lib->checkArray($query->result(),1);
// $this->lib->checkArray( $assigned_categories,1 );

    if(!isset($assigned_categories)){
        $assign_categories ="";
     } else {
        // Item has been assigned to at least one catergory 
        $sub_categories = array_diff( $sub_categories, $assigned_categories );
     }   

    $data['assigned_categories'] = $assigned_categories;
    $data['options']         = $sub_categories;
    $data['cat_id']          = $this->input->post('cat_id',TRUE);
    $data['store_db_table']  = $this->store_db_table;
    $data['store_db_column'] = $this->store_db_column;
    $data['options_hdr']     = $this->options_hdr;
    $data['options_dtls']    = $this->options_dtls;

    $data['item_title']= $item_title; 
    $data['small_img']= $small_img;   
    $data['item_id']   = $item_id;
    $data['headline']  = $this->headline;
    $data['flash']     = $this->session->flashdata('item');
    $data['view_file'] = "update";

    $this->_render_view('admin', $data);
}


function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $item_id = $this->cntlr_name->_get_assigned_id($update_id);
    $this->_delete($update_id);
    $this->_set_flash_msg("The item was successfully removed.");

    // redirect($this->store_redirect.'/update/'.$item_id);
    $this->update( $item_id );       
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

            $cat_title = $this->cntlr_name->_get_cat_title( $cat_id );

            $this->_set_flash_msg("The item was successfully assigned to the ".$cat_title." category.");
        }
    }
    // redirect( $this->store_redirect.'/update/'.$item_id);
    $this->update( $item_id );    
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
