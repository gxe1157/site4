<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_categories extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_categories';
var $store_controller = 'store_categories';

var $column_rules = array(
        array('field' => 'cat_title', 'label' => 'Category Title', 'rules' => 'required|max_length[240]'),
        array('field' => 'parent_cat_id', 'label' => 'Parent Category Id', 'rules' => ''),        
);

// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( '' );


/* fill in these variable names */
var $headline = "Update Categories";        
var $options_hdr = 'Sub Categories'; // should read "New $options_hdr Options" when viewed. $options_hdr dynamic
var $store_redirect = 'store_categories';
var $store_db_table = 'store_categories';
var $store_db_column = 'cat_title';


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
    $data['columns'] = $this->_get_categories('cat_title'); // get form fields structure

    $data['redirect_url'] = base_url().$this->uri->segment(1)."/create"; 
    $data['update_url']   = base_url().$this->uri->segment(1)."/update"; 
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

$this->lib->checkArray($_POST,1);    
    $landing_page = $this->input->post('mode', TRUE);

    if(!isset($landingpage )) $landing_page = "create";
$this->lib->checkField($landing_page,1);    

    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" || $submit == "Finished" ) {
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

                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new category

                if( !is_numeric($data['parent_cat_id']) ) {
                    $data['parent_cat_id'] = $update_id;
                    $this->_update($update_id, $data);
                    //redirect( $this->store_controller.'/update/'.$update_id);
                }

                // $flash_msg 
                $this->_set_flash_msg("The category was sucessfully added");
            }
        }
        redirect( $this->store_controller.'/'.$landing_page.'/'.$update_id);        
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);

    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['button_options'] = "Update Category Details";    
    $data['headtag']   = "Category Details"; 
    $data['class_icon']= "icon-align-justify";          
    $data['headline']  = !is_numeric($update_id) ? "Add New Category" : "Update Category";        
    $data['view_file'] = $landing_page;
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}


function update( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    


    // get existing options
    $data['main_cat_data'] = $this->_get_cat_data($update_id);
    $parent_cat_id = $data['main_cat_data']->result()[0]->parent_cat_id;
    $cat_title     = $data['main_cat_data']->result()[0]->cat_title;

    $data['query'] = $this->_get_sub_categories( $parent_cat_id, $cat_title, 'cat_title');
    $data['store_db_table'] = $this->store_db_table;     
    $data['store_db_column']= $this->store_db_column;        
    $data['options_hdr']    = $this->options_hdr;    

    $data['update_id'] = $update_id;    
    $data['parent_cat_id'] = $parent_cat_id;
    $data['title']     = $cat_title;

    $data['num_rows']  = $data['query']->num_rows();
    $data['headline']  = $this->headline;        
    $data['flash']     = $this->session->flashdata('item');    
    $data['view_file'] = "update";

    $this->load->module('templates');
    $this->templates->admin($data);
}


function _get_cat_data( $update_id )
{
    $mysql_query = "SELECT * FROM $this->store_db_table WHERE `id`=`parent_cat_id` and `id`=$update_id";    
    $query = $this->cntlr_name->_custom_query($mysql_query);
    return $query;
}

function _get_sub_categories($parent_cat_id, $cat_title, $orderby)
{
    $mysql_query = "SELECT * FROM $this->store_db_table WHERE `parent_cat_id`='$parent_cat_id' and `cat_title`!='$cat_title' ORDER BY $orderby";    
    $query = $this->cntlr_name->_custom_query($mysql_query);
    return $query;
}

function _get_categories($orderby)
{
    $mysql_query = "SELECT * FROM $this->store_db_table WHERE `id`=`parent_cat_id` ORDER BY $orderby";    
    $query = $this->cntlr_name->_custom_query($mysql_query);
    return $query;
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
