<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_categories extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_store_categories';
var $store_controller = 'store_categories';

var $column_rules = array(
        array('field' => 'cat_title', 'label' => 'Category Title', 'rules' => 'required'),
        array('field' => 'parent_cat_id', 'label' => 'Parent Catergory', 'rules' => '')
);

var $columns_not_allowed = array();

function __construct() {
    parent::__construct();

}

function manage()
{
    $this->_security_check();

    $parent_cat_id = $this->uri->segment(3);
    if( !is_numeric($parent_cat_id)){
      $parent_cat_id = 0;
    }

    $redirect_base =  base_url().$this->uri->segment(1);
    $mode = $this->uri->segment(4);
    $data['mode'] = $mode;

    //get form fields structure
    $data['columns']      = $this->get_where_custom('parent_cat_id', $parent_cat_id);
    $data['redirect_url'] = $redirect_base."/create";

    $data['add_button']   = $mode ? "Add Sub Category" : "Add New Category";
    $data['cancel_button_url'] = $redirect_base."/manage";
    $data['add_button_url']= $redirect_base.'/create/'.$this->uri->segment(3).'/add_sub-category';

    $data['headtag']      = "Existing Catagories";
    $data['class_icon']   = "icon-align-justify";
    $data['headline']     =  $mode ? "Manage Sub Catagories" : "Manage Catagories";
    $data['view_file']    = "manage";
    $data['update_id']    = "";

    $this->_render_view('admin', $data);
}


function create()
{
    $this->_security_check();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    $posted_mode   = $this->input->post('mode', true);
    $redirect_posted_mode = $this->store_controller.'/manage/'.$this->input->post('parent_cat_id', TRUE).'/sub-category';

    if( $submit == "Cancel" )
        redirect($this->store_controller.'/manage');

    if( $submit == "Finish" || $submit == "Return")
        redirect( $redirect_posted_mode );

    if( $this->uri->segment(4) == 'add_sub-category'  )
        $update_id = '';

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            // make search friendly url
            $data['category_url'] = url_title( $data['cat_title'] );
            if(is_numeric($update_id)){
                //update the category details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The category details were sucessfully updated");
            } else {
                //insert a new category
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new category
                $this->_set_flash_msg("The category was sucessfully added");
            }

            // redirect( $redirect_posted_mode );
            if( $posted_mode == 'add_sub-category'){
                redirect( $redirect_posted_mode );
            } else {
                redirect($this->store_controller.'/manage');
            }
        }

    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['options'] = $this->_get_dropdown_options($update_id);
    $data['num_dropdown_options'] = count( $data['options'] );
    $data['mode'] = $posted_mode ? : $this->uri->segment(4);
    $data['parent_cat_id'] =  $this->input->post('parent_cat_id', false) ? : $this->uri->segment(3);

    $data['button_options'] = "Update Customer Details";
    $data['headline']   = !is_numeric($update_id) ? "Add New Category" : "Update Category Details";
    $data['headtag']    = "Category Details";
    $data['view_file']  = "create";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}


function _get_dropdown_options( $update_id )
{
    if(!is_numeric($update_id)){
        $update_id = 0;
    }

    $options[] = "Please Select .... ";
    // parent category areay
    $mysql_query =  "SELECT * From store_categories where parent_cat_id=0 and id!=$update_id";
    $query = $this->_custom_query($mysql_query);
    foreach($query->result() as $row){
       $options[ $row->id ] = $row->cat_title;
    }
    return $options;

}

function _get_cat_title( $update_id )
{
    $data = $this->fetch_data_from_db( $update_id );
    $cat_title = $data['cat_title'];
    return $cat_title;
}

function _count_sub_cats( $update_id )
{
    $query = $this->get_where_custom('parent_cat_id', $update_id );
    $num_rows = $query->num_rows();
    return $num_rows;
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
