<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_items extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_store_items';
var $store_controller = 'store_items';

var $column_rules = array(
        array('field' => 'item_title', 'label' => 'Item Title', 'rules' => 'required|max_length[240]|callback_item_check'),
        array('field' => 'item_url', 'label' => 'Item URL', 'rules' => ''),
        array('field' => 'item_price', 'label' => 'Item Price', 'rules' => 'required'),
        array('field' => 'item_description', 'label' => 'Item Description', 'rules' => 'required'),
        array('field' => 'big_pic', 'label' => 'Image', 'rules' => ''),
        array('field' => 'small_pic', 'label' => 'Thumbnail Img', 'rules' => ''),
        array('field' => 'was_price', 'label' => 'Was Price', 'rules' => ''),
        array('field' => 'status', 'label' => 'Status', 'rules' => 'required'),
        array('field' => 'item_setup', 'label' => 'Item Setup', 'rules' => 'required')        
);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'create_date' );

function __construct() {
    parent::__construct();
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   =================================================== */
function ajaxPost(){
    $data['item_setup']   = $this->input->post('item_setup', TRUE);
    $update_id   = $this->input->post('update_id', TRUE);    
    $this->_update( $update_id, $data);

    echo "Id: ".$update_id." Selected: ".$data['item_setup'];
    return;
}

function manage()
{
    $this->_security_check();

    $data['columns']      = $this->get('item_title'); // get form fields structure
    $data['add_items']    = true;
    if( $data['columns']->num_rows() == 0 ){
        $num_rows = $this->_custom_query('SELECT * FROM store_categories');
        if( $num_rows->num_rows() == 0 ){
            $data['add_items'] = false;
            $this-> _set_flash_danger_msg('New Items can not be added until at least one Category have been created.<br>Go to Manage Categories and click on "Add New Category".');
        }
    }

    $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";
    $data['add_button']   = "Add New Item";
    $data['headtag']      = "Items Inventory";
    $data['class_icon']   = "icon-tag";
    $data['headline']     = "Manage Items";
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
        redirect($this->store_controller.'/manage');
    }

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            // make search friendly url
            $data['item_url'] = url_title( $data['item_title'] );
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
            redirect($this->store_controller.'/create/'.$update_id);
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
    $data['headline']  = !is_numeric($update_id) ? "Add New Line" : "Update Item Details";
    $data['headtag']   = "Item Inventory";
    $data['view_file'] = "create";
    $data['update_id'] = $update_id;

    $this->_render_view('admin', $data);
}


function delete( $update_id )
{
    $this->_numeric_check($update_id);
    $this->_security_check();

    $submit = $this->input->post('submit', TRUE);
    if( $submit =="Cancel" ){
        redirect($this->store_controller.'/create/'.$update_id);
    } elseif( $submit=="Yes - Delete item" ){
        /* get item title from store_items table */
        $row_data = $this->fetch_data_from_db($update_id);
        $data['item_title'] = $row_data['item_title'];
        $data['small_img']  = $row_data['small_pic'];

        $this->_process_delete($update_id);
        $this->_set_flash_msg("The item ".$data['item_title'].", was sucessfully deleted");

        redirect($this->store_controller.'/manage');
    }

}

function _process_delete( $update_id )
{
    /* delete item colors */
    $this->cntlr_name->_delete_for_item( $update_id, 'store_item_colors');
    /* delete item sizes */
    $this->cntlr_name->_delete_for_item( $update_id, 'store_item_sizes');

    /* delete bic_pic and small_pic ( unlink ) */
    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];
    $big_pic_path = './public/big_pic/'.$big_pic;
    $small_pic_path = './public/small_pic/'.$small_pic;

    /* remove the images */
    if(file_exists($big_pic_path)) {
        unlink($big_pic_path);
    }

    if(file_exists($small_pic_path)) {
        unlink($small_pic_path);
    }
    /* delete item */
     $this->_delete( $update_id );
}

function deleteconf( $update_id )
{
    $this->_numeric_check($update_id);
    $this->_security_check();

    /* get item title and small img from store_items table */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];
    $data['small_img']  = $row_data['small_pic'];

    $data['headline']  = "Delete Item";
    $data['view_file'] = "deleteconf";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}

function _generate_thumbnail($file_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image']  = './public/big_pic/'.$file_name;
    $config['new_image']     = './public/small_pic/'.$file_name;
    $config['create_thumb']  = FALSE;
    $config['maintain_ratio']= TRUE;
    $config['width']         = 200;
    $config['height']        = 200;

    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
}


function delete_image( $update_id )
{
    $this->_numeric_check($update_id);
    $this->_security_check();

    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];

    $big_pic_path = './public/big_pic/'.$big_pic;
    $small_pic_path = './public/small_pic/'.$small_pic;

    /* remove the images */
    if(file_exists($big_pic_path)) {
        unlink($big_pic_path);
    }

    if(file_exists($small_pic_path)) {
        unlink($small_pic_path);
    }

    /* update the database */
    unset($data);
    $data['big_pic'] ='';
    $data['small_pic'] ='';
    $this->_update($update_id, $data);

    $this->_set_flash_msg("The item image was sucessfully deleted");
    redirect($this->store_controller.'/create/'.$update_id);
}

function upload_image( $update_id )
{
    $this->_numeric_check($update_id);
    $this->_security_check();

    /* get item title */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];

    $data['headline']  = "Upload Image";
    $data['view_file'] = "upload_image";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}

function do_upload( $update_id )
{
    $is_uploaded = TRUE;
    $this->_numeric_check($update_id);
    $this->_security_check();

    if( !is_numeric($update_id) ){
        redirect('site_security/not_allowed');
    }

    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect($this->store_controller.'/create/'.$update_id);
    }

    $data['update_id']       = $update_id;
    $config['upload_path']   = './public/big_pic/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = 2500;  // kb
    $config['max_width']     = 1024;
    $config['max_height']    = 768;

    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('userfile')) {
        $is_uploaded   = FALSE;
        $data['error'] = array('error' => $this->upload->display_errors( "<p style='color: red'>", "</p>") );
    } else {
        $this->_set_flash_msg("Your file was successfully uploaded!");
        $data = array('upload_data' => $this->upload->data());
        $upload_data = $data['upload_data'];
        $file_name   = $upload_data['file_name'];

        /* Create thumbnail image */
        $this->_generate_thumbnail($file_name);

        /* Update the database */
        $update_data['big_pic'] = $file_name;
        $update_data['small_pic'] = $file_name;
        $this->_update($update_id, $update_data);
    }

    /* get item title */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];

    $data['headline']  = $is_uploaded == TRUE ? "Upload Success" : "Upload Error";
    $data['view_file'] = $is_uploaded == TRUE ? "Upload_success" : "Upload_image";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}

function view( $update_id )
{
    $this->_numeric_check( $update_id );
    // fetch item details for pubic page
    $data = $this->fetch_data_from_db( $update_id );

    // build breadcrumbs_data
    $preview = $this->uri->segment(4) == 'preview' ? true : false; // from store_items update - no breadcrumbs on preview
    $breadcrumbs_data['template'] = 'public_bootstrap';
    $breadcrumbs_data['current_page_title'] = $data['item_title'];
    $breadcrumbs_data['breadcrumbs_array'] = $preview ? '' :  $this->_generate_breadcrumbs_array($update_id);

    $data['breadcrumbs_data'] = $breadcrumbs_data;  //pass this array to data
    $data['headline']  = "";
    $data['view_module'] = "store_items";
    $data['view_file'] = "view";
    $data['update_id'] = $update_id;

    $this->_render_view('public_bootstrap', $data);
}

function _get_item_id_from_item_url($item_url) {
    $query   = $this->get_where_custom('item_url', $item_url);
    $num_row = $query->num_rows();

    // show_error('Page was found........... ' );
    if($num_row == 0 ) show_404();

    $item_id = $query->result()[0]->id;
    return $item_id;
}

function _generate_breadcrumbs_array($update_id)
{
    $homepage_url = base_url();
    $breadcrumbs_array[$homepage_url]  = 'Home';

    //get $sub_cat_id for this item
    $table = 'store_cat_assign';
    $orderby = null;
    $sub_cat_id = $this->_get_sub_cat_id('item_id', $update_id, $table, $orderby);

    //use $sub_cat to get title and the url
    $table = 'store_categories';
    $orderby = null;
    list($get_sub_title, $sub_cat_url ) = $this->_get_cat_data('id', $sub_cat_id, $table, $orderby);

    $this->load->module('site_settings');
    $item_segments = $this->site_settings->_get_items_segments();
    $full_cat_url = base_url().$item_segments.$sub_cat_url;

    $breadcrumbs_array[$full_cat_url]  = $get_sub_title;
    return $breadcrumbs_array;
}

function _get_sub_cat_id( $col, $update_id, $table, $orderby )
{
  $query = $this->cntlr_name->get_view_data_custom($col, $update_id, $table, $orderby);
  $sub_cat_id = $query->result()[0]->cat_id;
  return $sub_cat_id;
}

function _get_cat_data($col, $update_id, $table, $orderby)
{
  $query = $this->cntlr_name->get_view_data_custom($col, $update_id, $table, $orderby);
  $sub_cat_title = $query->result()[0]->cat_title;
  $sub_cat_url = $query->result()[0]->category_url;
  return array( $sub_cat_title, $sub_cat_url );
}

/* ===============================================
    Call backs go here...
  =============================================== */

function item_check($str) {
    $item_url = url_title($str);
    $mysql_query = "select * from store_items where item_title='$str' and item_url='$item_url'";

    $update_id = $this->uri->segment(3);
    if(is_numeric($update_id)) {
        // this is an update
        $mysql_query .= " and id!='$update_id'";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();

    if( $num_rows > 0 ){
        $this->form_validation->set_message('item_check', 'The Item Title you selected is not available.');
        return FALSE;
    } else {
        return TRUE;
    }

}

/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
