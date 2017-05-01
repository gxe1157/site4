<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_accounts extends MY_Controller 
{

/* model name goes here */
var $mdl_name   = 'mdl_store_accounts';
var $store_redirect = 'store_accounts/';

var $column_rules = array(
        array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'company', 'label' => 'Company', 'rules' => ''),
        array('field' => 'address1', 'label' => 'Address1', 'rules' => 'required'),
        array('field' => 'address2', 'label' => 'Address2', 'rules' => 'required'),        
        array('field' => 'city', 'label' => 'City', 'rules' => 'required'),        
        array('field' => 'state', 'label' => 'State', 'rules' => 'required'),        
        array('field' => 'zip', 'label' => 'Zip', 'rules' => 'required'),        
        array('field' => 'country', 'label' => 'Country', 'rules' => ''),        
        array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),        
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),        
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
);


function __construct() {
    parent::__construct();
    $this->load->module('lib');
}



/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function manage()
{
    $this->_security_check();    

    $data['columns']    = $this->get('company'); 
    $data['add_button'] = "Add New Account";
    $data['headtag']    = "Customer Accounts";     

    $data['headline']   = "Manage Accounts";        
    $data['view_file']  = "manage";
    $data['update_id']  = "";    

    $this->_render_view('admin', $data);    
}


function create()
{
    $this->_security_check();    
    // $data['pagelist'] = array();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect( $this->store_redirect.'manage');
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();            

            // make search friendly url
            // $data['item_url'] = url_title( $data['item_title'] );

            if(is_numeric($update_id)){
                //update the item details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The item details were sucessfully updated");
            } else {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new item
                // $flash_msg 
                $this->_set_flash_msg("The item was sucessfully added");
            }
            redirect( $this->store_redirect.'create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['labels']    = $this->_get_column_names('label');        
    $data['button_options'] = "Update Customer Details";    
    $data['headtag']   = "Customer Accounts";     
    $data['headline']  = !is_numeric($update_id) ? "Add New Customer" : "Update Customer Details";        
    $data['view_file'] = "create";
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}


/* ===============================================
    DRY functions go here...
  =============================================== */

function _render_view(  $arg, $data )    
{
    $data['flash'] = $this->session->flashdata('item');                
    $this->load->module('templates');
    $arg == 'public_bootstrap' ? $this->templates->public_bootstrap($data) : $this->templates->admin($data);
}  

function _get_column_names( $key_value )  // we will use for $key_value only "field" or "label"
{
    foreach ($this->column_rules as $key => $value) {
        if( $key_value == 'field' ) {
            $data[] = $this->column_rules[$key][$key_value];
        } else {
            $field  = $this->column_rules[$key]['field'];
            $data[$field] = $this->column_rules[$key]['label'];
        }
    }
    // $this->lib->checkArray($data, 1);
    return $data;
}

 

/* ===============================================
    Call backs go here...
  =============================================== */





/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
