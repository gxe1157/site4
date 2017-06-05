<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Custom_pagination extends MX_Controller
{  // Use MX_Controller do not need MY_Controller Here

/* model name goes here */
var $mdl_name = 'mdl_ ... ';
var $store_controller = ' ... ';

var $column_rules = array(
        array('field' => ' ... ', 'label' => ' ... ', 'rules' => ' ... '),
);

function __construct() {
    parent::__construct();

}



/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function _generate_pagination($data)
{

  $template = $data['template'];
  $target_base_url = $data['target_base_url'];
  $total_rows = $data['total_rows'];
  $offset_segment = $data['offset_segment'];
  $limit = $data['limit'];        

  if( $template == 'public_bootstrap') {
      $settings = $this->_get_settings_for_public_boostrap();
  }

  $this->load->library('pagination');

  $config['base_url'] = $target_base_url;
  $config['total_rows']  = $total_rows;
  $config['uri_segment'] = $offset_segment;

  $config['per_page']  = $limit;
  $config['num_links'] = $settings['num_links'];

  $config['full_tag_open']  = $settings['full_tag_open'];
  $config['full_tag_close'] = $settings['full_tag_close'];

  $config['cur_tag_open']  = $settings['cur_tag_open'];
  $config['cur_tag_close'] = $settings['cur_tag_close'];

  $config['num_tag_open']  = $settings['num_tag_open'];
  $config['num_tag_close'] = $settings['num_tag_close'];

  $config['first_link'] =   $settings['first_link'];
  $config['first_tag_open']  = $settings['first_tag_open'];
  $config['first_tag_close'] = $settings['first_tag_close'];

  $config['last_link'] =   $settings['last_link'];
  $config['last_tag_open']  = $settings['last_tag_open'];
  $config['last_tag_close'] = $settings['last_tag_close'];

  $config['prev_link'] =   $settings['prev_link'];
  $config['prev_tag_open']  = $settings['prev_tag_open'];
  $config['prev_tag_close'] = $settings['prev_tag_close'];

  $config['next_link'] =   $settings['next_link'];
  $config['next_tag_open']  = $settings['next_tag_open'];
  $config['next_tag_close'] = $settings['next_tag_close'];


  $this->pagination->initialize($config);
  $pagination = $this->pagination->create_links();  
  return $pagination;
  
}

function _get_showing_statement($data)
{
  //note: limit, offset, total_rows needed
  $limit  = $data['limit'];
  $offset = $data['offset'];
  $total_rows = $data['total_rows'];
  
  $value1 = $offset+1;
  $value2 = $offset+$limit;
  $value3 = $total_rows;

  if( $value2>$value3){
      $value2 = $value3;
  }

  $showing_statement = "Showing ".$value1." to ".$value2." of ".$value3." results.";
  return $showing_statement;

}


function _get_settings_for_public_boostrap()
{

  /* example from boostrap
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
  */

  $settings['num_links'] = 12;

  $settings['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">'; 
  $settings['full_tag_close']= '</ul></nav>';

  $settings['cur_tag_open']  = '<li class="active"><a class="page-link" href="#">';
  $settings['cur_tag_close'] = '</a></li>';

  $settings['num_tag_open']  = '<li>';
  $settings['num_tag_close'] = '</li>';

  $settings['first_link'] =  'First';
  $settings['first_tag_open'] = '<li>';
  $settings['first_tag_close'] = '</li>';

  $settings['last_link'] =   'Last';
  $settings['last_tag_open']  = '<li>';
  $settings['last_tag_close'] = '</li>';

  $settings['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
  $settings['prev_tag_open']  = '<li>';
  $settings['prev_tag_close'] = '</li>';

  $settings['next_link'] = '<span aria-hidden="true">&raquo;</span>'; 
  $settings['next_tag_open']  = '<li>';
  $settings['next_tag_close'] = '</li>';
  return $settings;

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
