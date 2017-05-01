<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Cart extends MY_Controller 
{

/* model name goes here */
var $mdl_name   = '';

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function _draw_add_to_cart($item_id)
{
    // fetch color options 
	$submitted_color = $this->input->post('item_color', TRUE);
	if($submitted_color == "") {
		$color_options[''] = "Select.....";
	}
    $query = $this->cntlr_name->get_view_data_custom('item_id', $item_id, 'store_item_colors', $orderby = null);
	$data['num_colors'] = $query->num_rows();
	foreach( $query->result() as $row )	{
		$color_options[$row->id] = $row->item_color;
	}


	// fetch size options
	$submitted_size = $this->input->post('item_size', TRUE);
	if($submitted_size == ""){
		$size_options[''] = "Select.....";
	}
    $query = $this->cntlr_name->get_view_data_custom('item_id', $item_id, 'store_item_sizes', $orderby = null);
	$data['num_sizes'] = $query->num_rows();
	foreach( $query->result() as $row )	{
		$size_options[$row->id] = $row->item_size;
	}

	$data['submitted_color'] = $submitted_color;
	$data['submitted_size'] = $submitted_size;
	$data['color_options'] = $color_options;
	$data['size_options'] = $size_options;	
	$data['item_id'] = $item_id;
	$this->load->view('add_to_cart', $data);
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
