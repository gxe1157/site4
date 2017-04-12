<?php
class Templates extends MX_Controller
{


function __construct() {
    parent::__construct();
    $this->load->module('lib');
    $this->load->module('nav_menu');
    echo $this->uri->segment(1).' | '; // controller
    echo $this->uri->segment(2).' | '; // action
    echo $this->uri->segment(3).' | '; // 1stsegment
    echo $this->uri->segment(4).' | '; // 2ndsegment
    echo $this->uri->segment(5).' | '; // 3ndsegment
    echo $this->uri->segment(6); // 4ndsegment        
}


function public_main( $page = null, $img_dir = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$img_dir;

    $data = '';
    $data['nav']   = $this->nav_menu->index();
    $data['title'] = 'New Jersey Law Enforcement Police Brotherhood Home Page';
    $data['show_page']= !isset($page_no) ? 1 : $page_no;
    $data['bm_pages'] = $this->lib->image_pagination( $imgDir );
    $data['img_dir']  = $img_dir;
    $data['page']     = $this->uri->segment(2) === false ? 'main' : $page;
    $data['bread_crumb'] = 'test bread crumb' ;
    $data['contents']  = $page == null ? 'main' : $page;

    $this->load->view('public/html_master_view', $data);
}


function public_blueMass( $page = null, $dir_name1 = null, $dir_name2 = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$dir_name1.'/'.$dir_name2;

    $data = '';
    $data['nav'] = $this->nav_menu->index();
    $data['title'] = 'New Jersey Law Enforcement Police Brotherhood Home Page';
    $data['show_page'] = !isset($page_no) ? 1 : $page_no;
    $data['bm_pages']  = $this->lib->image_pagination( $imgDir );
    $data['img_dir']   = $dir_name1.'/'.$dir_name2;
    $data['page']  = $page == null ? 'main' : $page;
    $data['bread_crumb'] = 'test bread crumb' ;
    $data['contents']  = $page == null ? 'main' : $page;

    $this->load->view('public/html_master_view', $data);

}

function public_jqm() {
    echo "<h1>public jqm page.............. </h1>";
   // $load->load->view['public_jqm', $data];

}

function admin() {
    echo "<h1>public admin page.............. </h1>";
    // $load->load->view['admin', $data];
}


}
