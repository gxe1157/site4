<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_categories extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'mdl_store_categories';
var $store_controller = 'store_categories';

var $column_rules = array(
        array('field' => 'cat_title', 'label' => 'Category Title', 'rules' => 'required'),
        array('field' => 'parent_cat_id', 'label' => 'Parent Catergory', 'rules' => '')
);

var $columns_not_allowed = array();

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

    $parent_cat_id = $this->uri->segment(3);
    if( !is_numeric($parent_cat_id)){
      $parent_cat_id = 0;
    }

    $redirect_base =  base_url().$this->uri->segment(1);
    $mode = $this->uri->segment(4);
    $data['mode'] = $mode;

    //get form fields structure
    $data['columns']      = $this->get_where_custom('parent_cat_id', $parent_cat_id);
    $data['sub_cats']     = $this->_count_sub_cats();
    $data['redirect_base']= $redirect_base;

    $data['add_button']   = $mode ? "Add Sub Category" : "Add New Category";
    $data['cancel_button_url'] = $redirect_base."/manage";
    $data['add_button_url']= $redirect_base.'/create/'.$this->uri->segment(3).'/add_sub-category';

    $data['headtag']      = "Existing Catagories";
    $data['class_icon']   = "icon-align-justify";
    $data['headline']     =  $mode ? "Manage Sub Catagories" : "Manage Catagories";
    $data['view_file']    = "manage";
    $data['update_id']    = "";

    $this->_render_view('admin', $data);
}


function create()
{
    $this->_security_check();

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);
    $posted_mode   = $this->input->post('mode', true);
    $redirect_posted_mode = $this->store_controller.'/manage/'.$this->input->post('parent_cat_id', TRUE).'/sub-category';

    if( $submit == "Cancel" )
        redirect($this->store_controller.'/manage');

    if( $submit == "Finish" || $submit == "Return")
        redirect( $redirect_posted_mode );

    if( $this->uri->segment(4) == 'add_sub-category'  )
        $update_id = '';

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();
            // make search friendly url
            $data['category_url'] = url_title( $data['cat_title'] );
            if(is_numeric($update_id)){
                //update the category details
                $this->_update($update_id, $data);
                $this->_set_flash_msg("The category details were sucessfully updated");
            } else {
                //insert a new category
                $this->_insert($data);
                $update_id = $this->get_max(); // get the ID of new category
                $this->_set_flash_msg("The category was sucessfully added");
            }

            // redirect( $redirect_posted_mode );
            if( $posted_mode == 'add_sub-category'){
                redirect( $redirect_posted_mode );
            } else {
                redirect($this->store_controller.'/manage');
            }
        }

    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }


    $data['redirect_base']= base_url().$this->uri->segment(1);
    $data['options'] = $this->_get_dropdown_options($update_id);
    $data['num_dropdown_options'] = count( $data['options'] );
    $data['mode'] = $posted_mode ? : $this->uri->segment(4);
    $data['parent_cat_id'] =  $this->input->post('parent_cat_id', false) ? : $this->uri->segment(3);

    $data['button_options'] = "Update Customer Details";
    $data['headline']   = !is_numeric($update_id) ? "Add New Category" : "Update Category Details";
    $data['headtag']    = "Category Details";
    $data['view_file']  = "create";
    $data['update_id']  = $update_id;

    $this->_render_view('admin', $data);
}

function _get_dropdown_options( $update_id )
{
    if(!is_numeric($update_id)) $update_id = 0;

    $options[] = "Please Select .... ";
    // parent category areay
    $mysql_query =  "SELECT * From store_categories where parent_cat_id=0 and id!=$update_id";
    $query = $this->_custom_query($mysql_query);
    foreach($query->result() as $row){
       $options[ $row->id ] = $row->cat_title;
    }
    return $options;

}

function _get_cat_title( $update_id )
{
    $data = $this->fetch_data_from_db( $update_id );
    $cat_title = $data['cat_title'];
    return $cat_title;
}

function _count_sub_cats()
{
    $sub_cats = '';
    $mysql_query  =  "SELECT *, count(*) as parent_id FROM `store_categories` group by parent_cat_id";
    $myResults = $this->_custom_query($mysql_query );
    foreach( $myResults->result() as $key => $line ){
        $sub_cats[ $line->parent_cat_id ] = $line->parent_id;
    }
    return $sub_cats;
}

function _get_sub_cat($parent_id)
{
    $sql  = "SELECT * FROM store_categories where parent_cat_id = $parent_id ORDER BY cat_title";
    $sub_categories = $this->db->query($sql)->result();
    return $sub_categories;
}


function _get_cat_id_from_cat_url( $category_url ) {
    $query   = $this->get_where_custom('category_url', $category_url);
    $num_row = $query->num_rows();

    // show_error('Page was found........... ' );
    if($num_row == 0 ) show_404();

    $cat_id = $query->result()[0]->id;
    return $cat_id;
}

function _draw_top_nav()
{
    $parent_categories = '';
    $mysql_query = "SELECT * FROM store_categories where parent_cat_id = 0 ORDER BY cat_title";
    $query = $this->db->query($mysql_query);
    foreach ($query->result() as $row) {
       $parent_categories[$row->cat_title] = $this->_get_sub_cat($row->id);
    }
    if( $parent_categories == false ) return;

    $this->load->module('site_settings');
    $items_segments = $this->site_settings->_get_items_segments();
    $data['target_url_start'] = base_url().$items_segments;
    $data['parent_categories'] = $parent_categories;
    $this->load->view('top_nav', $data);
}

function view( $update_id )
{
    $this->_numeric_check( $update_id );
    $this->load->module('site_settings');
    $this->load->module('custom_pagination');

    // fetch item details for pubic page
    $data = $this->fetch_data_from_db( $update_id );

    // count items that belong to this category
    $use_limit = FALSE;
    $mysql_query = $this->_generate_mysql_query($update_id, $use_limit);
    $query = $this->_custom_query($mysql_query);
    $total_items = $query->num_rows();

    // fetch items that belong to this category
    $use_limit = TRUE;
    $mysql_query = $this->_generate_mysql_query($update_id, $use_limit);

    $pagination_data['template'] = 'public_bootstrap';
    $pagination_data['target_base_url'] = $this->_get_target_pagination_base_url();
    $pagination_data['total_rows'] = $total_items;
    $pagination_data['offset_segment'] = 4;
    $pagination_data['limit']  = $this->get_limit();
    $pagination_data['offset'] = $this->get_offset();

    $data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);
    $data['showing_statement'] = $this->custom_pagination->_get_showing_statement($pagination_data);
    $data['item_segments'] = $this->site_settings->_get_item_segments();
    $data['currency_symbol'] = $this->site_settings->_get_currency_symbol( 'dollar' );
    $data['query']  = $this->_custom_query($mysql_query);
    $data['headline'] = "";
    $data['view_module'] = "store_categories";
    $data['view_file'] = "view";
    $data['update_id'] = $update_id;

    $this->_render_view('public_bootstrap', $data);
}

function _get_target_pagination_base_url()
{
    $first_seg  = $this->uri->segment(1);
    $second_seg = $this->uri->segment(2);
    $third_seg  = $this->uri->segment(3);
    $target_base_url = base_url().$first_seg.'/'.$second_seg.'/'.$third_seg;
    return $target_base_url;

}


function _generate_mysql_query($update_id, $use_limit )
{
    // note: $use_limit can be true or false

    $mysql_query = "
    SELECT
    store_items.item_title,
    store_items.item_url,
    store_items.item_price,
    store_items.small_pic,
    store_items.was_price
    FROM store_cat_assign INNER JOIN store_items ON store_cat_assign.item_id = store_items.id
    WHERE store_cat_assign.cat_id = $update_id AND store_items.status = 1
    ";

    if( $use_limit) {
        $limit  = $this->get_limit();
        $offset = $this->get_offset();
        $mysql_query .= " Limit ".$offset.", ".$limit;
    }
    return $mysql_query;
}

function get_limit()
{
    $limit = 10;
    return $limit;
}

function get_offset()
{
    $offset = $this->uri->segment(4);
    if(!is_numeric($offset)) $offset = 0;
    return $offset;
}

function test($target_array){
    // $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    asort($target_array);
    // $oldest = end($target_array);
    echo end($target_array);
}

function test2($target_array)
{
   foreach($target_array as $key => $value ){
        if( !isset($key_with_highest_value ))     {
            $key_with_highest_value = $key;
        } elseif ( $value > $target_array[$key_with_highest_value]){
            $key_with_highest_value = $key;
        }
   }
   return $key_with_highest_value;
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
