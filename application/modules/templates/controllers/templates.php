<?php
class Templates extends MX_Controller
{


function __construct() {
    parent::__construct();
    $this->load->module('lib');
    $this->load->module('nav_menu');
    
    // echo $this->uri->segment(1).' | '; // controller
    // echo $this->uri->segment(2).' | '; // action
    // echo $this->uri->segment(3).' | '; // 1stsegment
    // echo $this->uri->segment(4).' | '; // 2ndsegment
    // echo $this->uri->segment(5).' | '; // 3ndsegment
    // echo $this->uri->segment(6); // 4ndsegment        
}

function _inner_nav_options( $nav_to = null, $nav) { 
    $menu_title = urldecode($nav_to);
    $this->lib->checkField($menu_title,1);    
    $this->lib->checkArray( $nav['About Us'], 0);    

    $menu_items = $nav[ $menu_title ];
    $menu_view_items = '';

    foreach ( $menu_items as $lines => $value ){
        $menu_view_items .= '<div class="leftNavInner">
            <a style="color: blue;" href="'.$menu_items[$lines][1].'" >
                '.$menu_items[$lines][0].'</a>
          </div>';
    }   

    echo $menu_view_items;
    die();
}

function public_main( $page = null, $nav_to = null, $img_dir = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$img_dir;
    $data = '';

    $nav  = $this->nav_menu->index();
    // if( isset($nav_to) ) $this->_inner_nav_options( $nav_to, $nav );        

    $data['nav']   = $this->nav_menu->index();
    $data['title'] = 'New Jersey Law Enforcement Police Brotherhood Home Page';
    $data['show_page'] = !isset($page_no) ? 1 : $page_no;
    $data['bm_pages']  = $this->lib->image_pagination( $imgDir );
    $data['img_dir']   = $img_dir;
    $data['page']      = $this->uri->segment(2) === false ? 'main' : $page;
    $data['nav_to']    = $nav_to ;
    $data['contents']  = $page == null ? 'main' : $page;

    $this->load->view('public/html_master_view', $data);
}

function public_blueMass( $page = null, $dir_name1 = null, $dir_name2 = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$dir_name1.'/'.$dir_name2;

    $data = '';
    $data['nav'] = $this->nav_menu->index();

    $data['title'] = 'New Jersey Law Enforcement Police Brotherhood Home Page';
    $data['show_page']= !isset($page_no) ? 1 : $page_no;
    $data['bm_pages'] = $this->lib->image_pagination( $imgDir );
    $data['page']     = $page == null ? 'main' : $page;
    $data['dir_name1']= $dir_name1;
    $data['img_dir']  = $dir_name2;    
    $data['nav_to']   = !isset($dir_name2) ? 'Blue Mass ' : 'Blue Mass '.substr( $dir_name2, 2);    
    $data['contents'] = $page == null ? 'main' : $page;

    $this->load->view('public/html_master_view', $data);
}

function public_jqm() {
    echo "<h1>public jqm page.............. </h1>";
   // $load->load->view['public_jqm', $data];
}

function admin() {
    // echo "<h1>public admin page.............. </h1>";
    $this->load->view('admin/index');
}


}
