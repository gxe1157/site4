<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Blog extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_blog';
var $store_controller = 'blog';

var $column_rules = array(
        array('field' => 'page_url', 'label' => 'Blog Entry URL', 'rules' => ''),
        array('field' => 'page_title', 'label' => 'Blog Entry Title', 'rules' => 'required|max_length[250]'),
        array('field' => 'page_keywords', 'label' => 'Blog Entry Keywords', 'rules' => ''),
        array('field' => 'page_description', 'label' => 'Blog Entry Description', 'rules' => ''),
        array('field' => 'page_content', 'label' => 'Blog Entry Content', 'rules' => 'required'),
        array('field' => 'date_published', 'label' => 'Date Published', 'rules' => 'required'),        
        array('field' => 'author', 'label' => 'Author', 'rules' => ''),
        array('field' => 'picture', 'label' => 'Picture', 'rules' => ''),                        
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
  function test()
  {
    $this->load->module('timedates');
    $nowtime = time();
    $datepicker_time = $this->timedates->get_nice_date($nowtime, 'datepicker_us');
    echo $datepicker_time;
    echo '<hr>';


    $timestamp = $this->timedates->make_timestamp_from_datepicker_us($datepicker_time);
    echo $timestamp;
    echo '<hr>';
    echo $this->timedates->get_nice_date($timestamp, 'cool');

  }  

  function manage()
  {
      $this->_security_check();

      $data['columns']      = $this->get('page_url'); // get form fields structure
      $data['redirect_url'] = base_url().$this->uri->segment(1)."/create";
      $data['add_button']   = "Create New Blog Entry";
      $data['headtag']      = "Blog Entry Details";
      $data['class_icon']   = "icon-file";
      $data['headline']     = "Create New Blog Entry";
      $data['view_file']    = "manage";
      $data['update_id']    = "";

      $this->_render_view('admin', $data);
  }



  function create()
  {
      $this->_security_check();

      $update_id = $this->uri->segment(3);
      $submit = $this->input->post('submit', TRUE);
      $this->load->module('timedates');      

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
              //convert datepicker to unix timestamp
              $data['date_published'] = $this->timedates->make_timestamp_from_datepicker_us($data['date_published']);


              if(is_numeric($update_id)){
                  //update the blog entry details
                  $this->_update($update_id, $data);
                  $this->_set_flash_msg("The blog entry details were sucessfully updated.");
              } else {
                  //insert a new Blog entry
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

      if( $data['columns']['date_published']  > 0 ) {
        //convert unix timestamp to datepicker timestamp
        $data['columns']['date_published'] = $this->timedates->get_nice_date( $data['columns']['date_published'], 'datepicker_us' );
      }



      $data['columns_not_allowed'] = $this->columns_not_allowed;
      $data['labels'] = $this->_get_column_names('label');
      $data['button_options'] = "Update Blog Details";
      $data['headline']  = !is_numeric($update_id) ? "Create New Blog Entry" : "Update Blog Entry Details";
      $data['headtag']   = "Blog listing";
      $data['view_file'] = "create";
      $data['update_id'] = $update_id;

      $this->_render_view('admin', $data);
  }

  function view( $update_id )
  {
      $this->_numeric_check( $update_id );
      // fetch blog Entry details for pubic page
      $data = $this->fetch_data_from_db( $update_id );

      $data['headline']  = "";
      $data['view_module'] = "blog";
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
      } elseif( $submit=="Yes - Delete Blog Entry" ){
          /* get blog title from blog table */
          $row_data = $this->fetch_data_from_db($update_id);
          $data['page_title'] = $row_data['page_title'];

          /* delete item */
          $this->_delete( $update_id );          
          $this->_set_flash_msg("The page ".$data['page_title'].", was sucessfully deleted");

          redirect($this->store_controller.'/manage');
      }

  }


  function deleteconf( $update_id )
  {
      $this->_numeric_check($update_id);
      $this->_security_check();

      /* get page title and small img from blog table */
      $row_data = $this->fetch_data_from_db($update_id);
      $data['page_title'] = $row_data['page_title'];

      $data['headline']  = "Delete Blog";
      $data['view_file'] = "deleteconf";
      $data['update_id']  = $update_id;

      $this->_render_view('admin', $data);
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


/* ===============================================
    Call backs go here...
  =============================================== */


  function item_check($str) {
      $item_url = url_title($str);
      $mysql_query = "select * from blog where page_title='$str' and page_url='$page_url'";

      $update_id = $this->uri->segment(3);
      if(is_numeric($update_id)) {
          // this is an update
          $mysql_query .= " and id!='$update_id'";
      }

      $query = $this->_custom_query($mysql_query);
      $num_rows = $query->num_rows();

      if( $num_rows > 0 ){
          $this->form_validation->set_message('item_check', 'The Blog Entry Title you selected is not available.');
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
