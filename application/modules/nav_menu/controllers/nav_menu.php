<?php
class Nav_menu extends MX_Controller
{

function __construct() {
parent::__construct();
}


function index()
{
    $nav =  array(
            'Home' => array(
                 array('Home','templates/public_main/' )
            ),
            'About Us' => array(
                 array('Mission Statement','templates/public_main/mission-statement.php' ),
                 array('Introduction and History','templates/public_main/Intro-History.php' ),
                 array('President Message','templates/public_main/presidents-message.php' ),
                 array('Board Members','templates/public_main/hold-page.php' ),
                 array('Financial Reports','templates/public_main/hold-page.php' ),
                 array('Contact Us','templates/public_main/contact-us.php' )
            ),
            'Making a Difference' => array(
                 array('Making a Difference', 'templates/public_main/making-a-difference.php' ),
                 array('10-13 Officer Needs Assistence', 'templates/public_main/hold-page.php' ),
                 array('Officer Shot and Down', 'templates/public_main/hold-page' ),
                 array('Donations and Testimonials', 'templates/public_main/Testimonials.php/Testimonials'),
                 array('Protect Vest/Equipment', 'templates/public_main/hold-page.php' )
             ),
            'Blue Mass' => array(
                 array('Blue Mass','templates/public_main/bluemass.php' )
            ),
            'Meetings &#038; Events' => array(
                 array('Meetings &#038; Events', 'templates/public_main/meeting-schedule.php' ),
                 array('Bulletin Board', 'templates/public_main/hold-page.php' ),
                 array('Monthly Calender', 'templates/public_main/hold-page.php' ),
                 array('Cigar Events', 'templates/public_main/CigarEvents.php/Cigar_Events' ),
                 array('Awards Dinners', 'templates/public_main/awards-dinner.php/award-dinners' )
            ),
            'Political Action' => array(
                 array('Political Action', 'templates/public_main/hold-page.php' )
            ),
            'Cop Shop' => array(
                 array('Cop Shop', 'templates/public_main/hold-page.php' )
            ),
            'Brotherhood in Action' => array(
                 array('Brotherhood in Action', 'templates/public_main/POB_In_Action.php' ),
                 array('Move Over Law', 'templates/public_main/move_over.php/Move_Over_Law' ),
                 array('National Blue Alert', 'templates/public_main/national_blue.php/blue_alert' ),
                 array('POB Support', 'templates/public_main/POB_Support.php/POB_Supports' ),
                 array('POB Pays Tribute', 'templates/public_main/POB_Pays_Tribute.php/POB_Pays_Tribute_AW' )
            )
    );

    return $nav;

} // end index




function get($order_by)
{
    $this->load->model('mdl_nav_menu');
    $query = $this->mdl_nav_menu->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by)
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_nav_menu');
    $query = $this->mdl_nav_menu->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_nav_menu');
    $query = $this->mdl_nav_menu->get_where($id);
    return $query;
}

function get_where_custom($col, $value)
{
    $this->load->model('mdl_nav_menu');
    $query = $this->mdl_nav_menu->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_nav_menu');
    $this->mdl_nav_menu->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_nav_menu');
    $this->mdl_nav_menu->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_nav_menu');
    $this->mdl_nav_menu->_delete($id);
}

function count_where($column, $value)
{
    $this->load->model('mdl_nav_menu');
    $count = $this->mdl_nav_menu->count_where($column, $value);
    return $count;
}

function get_max()
{
    $this->load->model('mdl_nav_menu');
    $max_id = $this->mdl_nav_menu->get_max();
    return $max_id;
}

function _custom_query($mysql_query)
{
    $this->load->model('mdl_nav_menu');
    $query = $this->mdl_nav_menu->_custom_query($mysql_query);
    return $query;
}

}
