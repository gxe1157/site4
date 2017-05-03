<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_accounts extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_accounts';
var $store_controller = 'store_accounts';

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
        array('field' => 'create_date', 'label' => 'Create Date', 'rules' => '')        
);


var $column_pword_rules  = array(
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required|min_length[7]|max_length[35]'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')

);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'create_date' );


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

    $data['columns']      = $this->get('company'); // get form fields structure
    $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";    
    $data['add_button']   = "Add New Account";
    $data['headtag']      = "Customer Accounts";     
    $data['headline']     = "Manage Accounts"; 
    $data['class_icon']   = "icon-briefcase";
    $data['view_file']    = "manage";
    $data['update_id']    = "";    

    $this->_render_view('admin', $data);    
}


function create()
{
    $this->_security_check();    
 
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect( $this->store_controller.'/manage');
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();            

            if(is_numeric($update_id)){
                //update the account details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The account details were sucessfully updated");
            } else {
                //insert a new account
                $data['create_date'] = time();  // timestamp for database
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new account
                // $flash_msg 
                $this->_set_flash_msg("The account was sucessfully added");
            }
            redirect( $this->store_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['labels']    = $this->_get_column_names('label');        
    $data['button_options'] = "Update Customer Details";    
    $data['headtag']   = "Customer Accounts";     
    $data['class_icon']   = "icon-briefcase";    
    $data['headline']  = !is_numeric($update_id) ? "Add New Customer" : "Update Customer Details";        
    $data['view_file'] = "create";
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}


function update_password()
{
    $this->_security_check();    

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( !is_numeric($update_id) ){
        redirect( $this->store_controller.'/manage');
    } elseif( $submit == "Cancel" ) {
        redirect( $this->store_controller.'/create/'.$update_id);
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_pword_rules );

        if($this->form_validation->run() == TRUE) {
            $password = $this->input->post('password', TRUE);
            $this->load->module('site_security');
            $data['password'] = $this->site_security->_hash_string($password);

            //update the account details
            $this->_update($update_id, $data);
            $this->_set_flash_msg("The account password was sucessfully updated");
            redirect( $this->store_controller.'/create/'.$update_id);
        }
    }

    $data['headline']  = "Update Account Password";
    $data['headtag']   = "Update Form";     
    $data['view_file'] = "update_password";
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}

function _process_delete( $update_id )
{
    /* delete account colors */
    // $this->cntlr_name->_delete_for_account( $update_id, 'store_account_colors');
    /* delete account sizes */
    // $this->cntlr_name->_delete_for_account( $update_id, 'store_account_sizes');

    /* delete bic_pic and small_pic ( unlink ) */
    // $data = $this->fetch_data_from_db($update_id);
    // $big_pic = $data['big_pic'];
    // $small_pic = $data['small_pic'];
    // $big_pic_path = './public/big_pic/'.$big_pic;
    // $small_pic_path = './public/small_pic/'.$small_pic;  

    /* remove the images */
    // if(file_exists($big_pic_path)) {
    //     unlink($big_pic_path);
    // } 

    // if(file_exists($small_pic_path)) {
    //     unlink($small_pic_path);
    // }  

    /* delete account */
     $this->_delete( $update_id );
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $submit = $this->input->post('submit', TRUE);

    if( $submit =="Cancel" ){
        redirect('store_accounts/create/'.$update_id);
    } elseif( $submit=="Yes - Delete Account" ){
        /* get account title from store_accounts table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['firstname'] = $row_data['firstname'];            
        $this->_process_delete($update_id);
        $this->_set_flash_msg("The account ".$data['firstname'].", was sucessfully deleted");

        redirect('store_accounts/manage');
    }

}

function deleteconf( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    /* get account title and small img from store_accounts table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['firstname'] = $row_data['firstname'];            
    // $data['small_img']  = $row_data['small_pic'];

    $data['headline']  = "Delete Item";        
    $data['view_file'] = "deleteconf";
    $data['update_id']  = $update_id;

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


} // End class Controller
