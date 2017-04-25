<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_item_colors extends MY_Controller 
{

/* model name goes here */
var $mdl_name   = 'mdl_store_item_colors';

function __construct() {
    parent::__construct();

}



function update( $update_id )
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

    $data['headline'] = "Update Item Colors";        
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file']   = "upload";

    $this->load->module('templates');
    $this->templates->admin($data);

}




/* Add custom controller functions here */

/* End custom functions   */

/* Call backs go here...  */

/* End call backs         */

// David Connelly's work from perfectcontroller
// is in applications/core/My_Controller.php which
// is extened here.


}