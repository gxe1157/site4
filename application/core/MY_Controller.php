<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

function __construct() {
  parent::__construct();

  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;

  /* model name is assigned a different object name specified
     in second parameter of the loading method for dynamic query.   
  */

  $this->load->model( $this->mdl_name, 'cntlr_name');
}


function get($order_by)
{    

    $query = $this->cntlr_name->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by)
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $query = $this->cntlr_name->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable! '.$id);
    }

    $query = $this->cntlr_name->get_where($id);
    return $query;
}

function get_where_custom($col, $value)
{
    $query = $this->cntlr_name->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->cntlr_name->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->cntlr_name->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->cntlr_name->_delete($id);
}

function count_where($column, $value)
{
    $count = $this->cntlr_name->count_where($column, $value);
    return $count;
}

function get_max()
{
    $max_id = $this->cntlr_name->get_max();
    return $max_id;
}

function _custom_query($mysql_query)
{
    $query = $this->cntlr_name->_custom_query($mysql_query);
    return $query;
}



}
