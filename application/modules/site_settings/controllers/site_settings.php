<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_settings extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_ ... ';
var $store_controller = ' ... ';

var $column_rules = array(
        array('field' => ' ... ', 'label' => ' ... ', 'rules' => ' ... ')
);

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function _get_currency_symbol( $money_symbol )
{
  if( $money_symbol =='dollar'){
      return '$';
  } 

  if( $money_symbol =='pound'){
      return '&pound';
  } 


}

function _get_item_segments()
{
  // return segments for store_items page ( product page )
  $segments = "musical/instrument/";
  return $segments;
}

function _get_items_segments()
{
  // return segments for category pages
  $segments = "music/instruments/";
  return $segments;

}

function _get_page_not_found_msg()
{
    $msg ='<h4> Page Not Found ............ </h4>';
    $msg .='Please try again...........';
    return $msg;
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
