<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Webpages extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_webpages';
var $store_controller = 'webpages';

var $column_rules = array(
        array('field' => 'page_url', 'label' => 'Page URL', 'rules' => ''),
        array('field' => 'page_title', 'label' => 'Page Title', 'rules' => 'required|max_length[250]|callback_item_check'),
        array('field' => 'page_keywords', 'label' => 'Page Keywords', 'rules' => ''),
        array('field' => 'page_description', 'label' => 'Page Description', 'rules' => ''),
        array('field' => 'page_content', 'label' => 'Page Content', 'rules' => 'required'),
        array('field' => 'page_headline', 'label' => 'page_headline', 'rules' => 'required|max_length[250]|callback_item_check'),
        // array('field' => 'status', 'label' => 'Status', 'rules' => ''),
);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array();


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

      $data['columns']      = $this->get('page_url'); // get form fields structure
      $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";
      $data['add_button']   = "Create New Webpage";
      $data['headtag']      = "Webpages listing";
      $data['class_icon']   = "icon-file";
      $data['headline']   = "Content Management System";
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
              $data['page_url'] = url_title( $data['page_title'] );
              if(is_numeric($update_id)){
                  //update the page details
                  $this->_update($update_id, $data);
                  $this->_set_flash_msg("The page details were sucessfully updated.");
              } else {
                  //insert a new page
                  $this->_insert($data);
                  $update_id = $this->get_max(); // get the ID of new page
                  // $flash_msg
                  $this->_set_flash_msg("The page was sucessfully created.");
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
      $data['headline']  = !is_numeric($update_id) ? "Content Management System" : "Update Content Management System Details";
      $data['headtag']   = "Webpages listing";
      $data['view_file'] = "create";
      $data['update_id'] = $update_id;

      $this->_render_view('admin', $data);
  }

  function view( $update_id )
  {
      $this->_numeric_check( $update_id );
      // fetch page details for pubic page
      $data = $this->fetch_data_from_db( $update_id );

      $data['headline']  = "";
      $data['view_module'] = "webpages";
      $data['view_file'] = "view";
      $data['update_id'] = $update_id;

      $this->_render_view('public_bootstrap', $data);
  }


  function delete( $update_id )
  {
      $this->_numeric_check($update_id);
      $this->_security_check();

      $submit = $this->input->post('submit', TRUE);
      if( $submit =="Cancel" ){
          redirect($this->store_controller.'/create/'.$update_id);
      } elseif( $submit=="Yes - Delete page" ){
          /* get page title from webpages table */
          $row_data = $this->fetch_data_from_db($update_id);
          $data['page_title'] = $row_data['page_title'];
          $this->_set_flash_msg("The page ".$data['page_title'].", was sucessfully deleted");

          redirect($this->store_controller.'/manage');
      }

  }


  function deleteconf( $update_id )
  {
      $this->_numeric_check($update_id);
      $this->_security_check();

      /* get page title and small img from webpages table */
      $row_data = $this->fetch_data_from_db($update_id);
      $data['page_title'] = $row_data['page_title'];

      $data['headline']  = "Delete page";
      $data['view_file'] = "deleteconf";
      $data['update_id']  = $update_id;

      $this->_render_view('admin', $data);
  }




/* ===============================================
    Call backs go here...
  =============================================== */


  function item_check($str) {
      $item_url = url_title($str);
      $mysql_query = "select * from webpages where page_title='$str' and page_url='$page_url'";

      $update_id = $this->uri->segment(3);
      if(is_numeric($update_id)) {
          // this is an update
          $mysql_query .= " and id!='$update_id'";
      }

      $query = $this->_custom_query($mysql_query);
      $num_rows = $query->num_rows();

      if( $num_rows > 0 ){
          $this->form_validation->set_message('item_check', 'The Page Title you selected is not available.');
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
