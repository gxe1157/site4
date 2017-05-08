<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_item_colors extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_item_colors';

/* fill in these variable names */
var $headline = "Update Item Colors";        
var $options_hdr = 'Color'; // should read "New $options_hdr Options" when viewed. $options_hdr dynamic
var $store_redirect = 'store_item_colors';
var $store_db_table = 'store_item_colors';
var $store_db_column = 'item_color';

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
    $new_option = trim($this->input->post('new_option', TRUE));

    if($submit == "Finished"){
        redirect('store_items/create/'.$update_id);
    } elseif ($submit == "Submit" ){
        // Insert new option
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'new_option', 'New Option', 'required');

        if($this->form_validation->run() == TRUE) {
            $data['item_id'] = $update_id;
            $data[ $this->store_db_column ] = $new_option;
            $this->_insert($data);
            $this->_set_flash_msg("The new option was sucessfully added.");          
        }
        $this->update($update_id);
    }
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $item_id = $this->cntlr_name->get_item_id($update_id);
    $this->_delete($update_id);
    redirect($this->store_redirect.'/update/'.$item_id);
}

function update( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    // get item color from store_items_color table
    list ($item_title, $small_img) = $this->cntlr_name->get_item_title_id($update_id);
    $data['item_title'] = $item_title;
    $data['small_img']  = $small_img;

    // get existing options
    $data['query']     = $this->get_where_custom('item_id', $update_id, $this->store_db_column);

    $data['store_db_table'] = $this->store_db_table;     
    $data['store_db_column'] = $this->store_db_column;        
    $data['options_hdr'] = $this->options_hdr;    

    $data['update_id'] = $update_id;    
    $data['num_rows']  = $data['query']->num_rows();
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