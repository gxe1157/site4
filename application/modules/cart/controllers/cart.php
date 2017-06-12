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

function _draw_table_to_cart($item_id)
{

    $this->load->module('site_settings');
    $data['currency_symbol'] = $this->site_settings->_get_currency_symbol( 'dollar' );	

    // get commercial pricing
	$store_db_table = 'store_items_commercial';    
    $data['query'] = $this->cntlr_name->get_view_data_custom('item_id', $item_id, $store_db_table, $orderby = null);

	$data['num_rows'] = $data['query']->num_rows();
	$this->load->view('add_table_to_cart', $data);
}


function _draw_add_to_cart($item_id)
{
	// fetch Unit packing
	$submitted_unit_type = $this->input->post('unit_type', TRUE);
	if($submitted_unit_type == "")
		$unit_type_options[''] = "Select.....";

    $query = $this->cntlr_name->get_view_data_custom('item_id', $item_id, 'store_items_commercial', $orderby = 'unit_type');
	$data['num_unit_types'] = $query->num_rows();
	foreach( $query->result() as $row )	{
		$unit_type_options[$row->id] = $row->unit_type;
	}


    // fetch color options 
	$submitted_color = $this->input->post('item_color', TRUE);
	if($submitted_color == "")
		 $color_options[''] = "Select.....";

    $query = $this->cntlr_name->get_view_data_custom('item_id', $item_id, 'store_item_colors', $orderby = null);
	$data['num_colors'] = $query->num_rows();
	foreach( $query->result() as $row )	{
		$color_options[$row->id] = $row->item_color;
	}

	// fetch size options
	$submitted_size = $this->input->post('item_size', TRUE);
	if($submitted_size == "")
		$size_options[''] = "Select.....";

    $query = $this->cntlr_name->get_view_data_custom('item_id', $item_id, 'store_item_sizes', $orderby = null);
	$data['num_sizes'] = $query->num_rows();
	foreach( $query->result() as $row )	{
		$size_options[$row->id] = $row->item_size;
	}

	$data['submitted_unit_type'] = $submitted_unit_type;
	$data['submitted_color'] = $submitted_color;
	$data['submitted_size'] = $submitted_size;

	$data['unit_type_options'] = $unit_type_options;
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
