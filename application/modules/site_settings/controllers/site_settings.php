<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_settings extends MY_Controller
{

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

function _get_item_segments()
{
  // return segments for store_items page ( product page )
  $segments = "musical/instrument/";

  // echo $this->uri->segment(1).' | '; // controller
  // echo $this->uri->segment(2).' | '; // action
  // echo $this->uri->segment(3).' |<br> '; // 1stsegment
  // echo $this->uri->segment(4).' | '; // 2ndsegment
  // echo $this->uri->segment(5).' | '; // 3ndsegment
  // echo $this->uri->segment(6); // 4ndsegment

}

function _get_items_segments()
{
  // return segments for category pages
  $segments = "music/instruments/";


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
