<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Music extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_';
var $store_controller = '';

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
function instruments()
{
  // get category id from url
  $category_url = $this->uri->segment(3);
  $this->load->module('store_categories');
  $cat_id = $this->store_categories->_get_cat_id_from_cat_url( $category_url );
   $this->store_categories->view($cat_id);
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
