<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_items extends MY_Controller 
{

/* model name goes here */
var $mdl_name   = 'mdl_store_items';

function __construct() {
    parent::__construct();

}


/* Add custom controller functions here */
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


function delete_image( $update_id ) {
    if( !is_numeric($update_id) ){
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');  
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

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

    $flash_msg = "The item image was sucessfully deleted";          
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);

    redirect('store_items/create/'.$update_id);

}

function upload_image( $update_id )
{
    if( !is_numeric($update_id) ){
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');  
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    /* get item title */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];        

    $data['headline'] = "Upload Image";        
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file']   = "upload_image";

    $this->load->module('templates');
    $this->templates->admin($data);

}

function do_upload( $update_id )
{

    $this->load->library('session');  
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    if( !is_numeric($update_id) ){
        redirect('site_security/not_allowed');
    }

    $submit = $this->input->post('submit', TRUE);
    if( $submit == "Cancel" ) {
        redirect('store_items/create/'.$update_id);
    } 

    $data['update_id']       = $update_id;
    $config['upload_path']   = './public/big_pic/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = 2500;  // kb
    $config['max_width']     = 1024;
    $config['max_height']    = 768;

    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('userfile')) {
       $data['error']= array('error' => $this->upload->display_errors( "<p style='color: red'>", "</p>") );
        $data['headline']  = "Upload Error";        
        $data['view_file'] = "upload_image";
    } else {
        $flash_msg = "Your file was successfully uploaded!";
        $value     = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('image', $value);

        $data = array('upload_data' => $this->upload->data());        
        $upload_data = $data['upload_data'];
        $file_name   = $upload_data['file_name'];

        /* Create thumbnail image */
        $this->_generate_thumbnail($file_name);

        /* Update the database */
        $update_data['big_pic'] = $file_name;
        $update_data['small_pic'] = $file_name;
        $this->_update($update_id, $update_data);


        $data['headline']  = "Upload Success";        
        $data['view_file'] = "upload_success";
    }

    /* get item title */
    $row_data = $this->fetch_data_from_db($update_id);
    $data['item_title'] = $row_data['item_title'];        

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('image');    
    $this->load->module('templates');
    $this->templates->admin($data);
}

function create()
{
    $this->load->library('session');  
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( $submit == "Cancel" ) {
        redirect('store_items/manage');
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[240]|callback_item_check');
        $this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
        $this->form_validation->set_rules('was_price',  'Was Price',  'numeric');
        $this->form_validation->set_rules('status',  'Status',  'required|numeric');        
        $this->form_validation->set_rules('item_description',  'Item Description',  'required');

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            // make search friendly url
            $data['item_url'] = url_title( $data['item_title'] );
            if(is_numeric($update_id)){
                //update the item details
                $this->_update($update_id, $data);
                $flash_msg = "The item details were sucessfully updated";
            } else {
                //insert a new item
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new item
                $flash_msg = "The item was sucessfully added";
            }
            $value     = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('item', $value);
            redirect('store_items/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
    }

    if( !is_numeric($update_id) ) {
        $data['headline'] = "Add New Line";
    } else {
        $data['headline'] = "Update Item Details";        
    }

    $data['flash'] = $this->session->item;
    $data['update_id'] = $update_id;
    $data['view_file']   = "create";

    $this->load->module('templates');
    $this->templates->admin($data);

}


function manage() {
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['query'] = $this->get('item_title'); 
    $data['view_file'] = "manage";

    $this->load->module('templates');
    $this->templates->admin($data);
}


function fetch_data_from_post() {
    $data['item_title'] = $this->input->post('item_title', TRUE);
    $data['item_price'] = $this->input->post('item_price', TRUE);
    $data['was_price']  = $this->input->post('was_price', TRUE);    
    $data['item_description'] = $this->input->post('item_description', TRUE);
    $data['status'] = $this->input->post('status', TRUE);    
    return $data;
}


function fetch_data_from_db($update_id) {

    if( !is_numeric($update_id) ){
        redirect('site_security/not_allowed');
    }    

    $query = $this->get_where($update_id);
    foreach( $query->result() as $row ) {
        $data['item_title'] = $row->item_title;
        $data['item_url']   = $row->item_url;        
        $data['item_price'] = $row->item_price;
        $data['item_description'] = $row->item_description;
        $data['big_pic']    = $row->big_pic;
        $data['small_pic']  = $row->small_pic;                                        
        $data['was_price']  = $row->was_price;
        $data['status']  = $row->status;        
    }

    if( !isset($data) ) {
        // No records found send to manage item page
        redirect( 'store_items/manage');
    }

    return $data;    

}
/* End custom functions   */

/* Call backs go here...  */
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
/* End callbacks */


// David Connelly's work from perfectcontroller
// is in applications/core/My_Controller.php which
// is extened here.

} // End class Controller
