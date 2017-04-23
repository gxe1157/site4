<?php
class Store_items extends MX_Controller
{


function __construct() {
  parent::__construct();

  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;
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
/* end callbacks */



/* do not change below */
function get($order_by)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by)
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable! '.$id);
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
}

function get_where_custom($col, $value)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
}

function count_where($column, $value)
{
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max()
{
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}



}
