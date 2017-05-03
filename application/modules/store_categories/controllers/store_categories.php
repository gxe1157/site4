<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_categories extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_categories';
var $store_controller = 'store_categories';

var $column_rules = array(
        array('field' => 'cat_title', 'label' => 'Category Title', 'rules' => 'required|max_length[240]')
        // array('field' => 'parent_cat_id', 'label' => 'Parent Category Id', 'rules' => ''),        
);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'parent_cat_id' );

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */


function manage()
{
    $this->_security_check();    
    $data['columns']    = $this->get('cat_title'); // get form fields structure

    $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";    
    $data['add_button']   = "Add New Category";
    $data['headline']     = "Manage Categories";        
    $data['headtag']      = "Existing Categories";     
    $data['class_icon']   = "icon-align-justify";         
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
                //update the category details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The category details were sucessfully updated");
            } else {
                //insert a new category
                // $data['create_date'] = time();  // timestamp for database
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new category
                // $flash_msg 
                $this->_set_flash_msg("The category was sucessfully added");
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
    $data['button_options'] = "Update Category Details";    
    $data['headtag']   = "Category Details"; 
    $data['class_icon']   = "icon-align-justify";          
    $data['headline']  = !is_numeric($update_id) ? "Add New Category" : "Update Category";        
    $data['view_file'] = "create";
    $data['update_id'] = $update_id;

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
