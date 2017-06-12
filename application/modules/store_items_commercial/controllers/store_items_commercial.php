<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_items_commercial extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_items_commercial';
var $store_controller = 'store_items';

var $column_rules = array(
    array('field' => 'unit_type', 'label' => 'Unit Type', 'rules' => 'required'),
    array('field' => 'unit_pkg_count', 'label' => 'Unit Count', 'rules' => 'required'),
    array('field' => 'unit_pkg_wgt', 'label' => 'Unit Weight', 'rules' => ''),
    array('field' => 'level1_qty', 'label' => 'Level 1 Qty', 'rules' => 'required|is_natural'),
    array('field' => 'level1_pricing', 'label' => 'Level 1 Pricing', 'rules' => 'required|decimal'),
    array('field' => 'level2_qty', 'label' => 'Level 2 Qty', 'rules' => ''),
    array('field' => 'level2_pricing', 'label' => 'Level 2 Pricing', 'rules' => ''),
    array('field' => 'level3_qty', 'label' => 'Level 3 Qty', 'rules' => ''),
    array('field' => 'level3_pricing', 'label' => 'Level 3 Pricing', 'rules' => ''),
    array('field' => 'level4_qty', 'label' => 'Level 4 Qty', 'rules' => ''),
    array('field' => 'level4_pricing', 'label' => 'Level 4 Pricing', 'rules' => ''),
    array('field' => 'level5_qty', 'label' => 'Level 5 Qty', 'rules' => ''),
    array('field' => 'level5_pricing', 'label' => 'Level 5 Pricing', 'rules' => '')

);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'mod_dt', 'userid' );


/* fill in these variable names */
var $headline = "Update Item Commercial Pricing";        
var $options_hdr = 'Bulk Pricing'; // should read "New $options_hdr Options" when viewed. $options_hdr dynamic
var $store_redirect = 'store_items_commercial';
var $store_db_table = 'store_items_commercial';
var $store_db_column = 'item_id';


function __construct( )
{
    parent::__construct();

}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function submit( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $submit = $this->input->post('submit', TRUE);

    if($submit == "Finished"){
        redirect('store_items/create/'.$update_id);
    } elseif ($submit == "Submit" ){
        // Insert new option
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            //insert a new item            
            $data = $this->fetch_data_from_post();
            $data['item_id'] = $update_id;    

            $this->_insert($data);
            //$update_id = $this->get_max(); // get the ID of new item
            $this->_set_flash_msg("The Commercial pricing was sucessfully added");
        }else{
            echo 'failed................ ';
            validation_errors("<p style='color: red;'>", "</p>") ;
        }

        $this->update($update_id);
    }
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $item_id = $this->cntlr_name->_get_item_id($update_id);
    $this->_delete($update_id);
    redirect($this->store_redirect.'/update/'.$item_id);
}

function update( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    
    $this->load->module('site_settings');

    // get item title from store_items table
    list ($item_title, $small_img, $item_setup, $item_price) = $this->cntlr_name->_get_item_title_byid($update_id);
    $data['item_title'] = $item_title;
    $data['small_img']  = $small_img;
    $data['item_setup'] = $item_setup;
    $data['item_price'] = $item_price;    

    // get existing options
    $data['query']     = $this->get_where_custom('item_id', $update_id, $this->store_db_column);
    $data['num_rows']  = $data['query']->num_rows();

    $data['store_db_table']  = $this->store_db_table;     
    $data['store_db_column'] = $this->store_db_column;        
    $data['options_hdr'] = $this->options_hdr;    
    $data['currency_symbol'] = $this->site_settings->_get_currency_symbol( 'dollar' );
   
    $data['update_id'] = $update_id;    
    $data['headline']  = $this->headline;        
    $data['flash']     = $this->session->flashdata('item');    
    $data['view_file'] = "update";

    $this->_render_view('admin', $data);

}




/* ===============================================
    Call backs go here...
  =============================================== */


/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


}