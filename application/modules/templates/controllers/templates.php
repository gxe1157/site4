<?php
class Templates extends MX_Controller
{


function __construct() {
    parent::__construct();
}


function public_main( $page = null, $img_dir = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$img_dir;
    $this->load->module('lib');

    $data = '';
    $data['title'] = 'New Jersey Law Enforcement Police Brotherhood Home Page';
    $data['show_page'] = !isset($page_no) ? 1 : $page_no;
    $data['bm_pages']  = $this->lib->image_pagination( $imgDir );
    $data['img_dir']   = $img_dir;
    $data['page']  = $page == null ? 'main' : $page;
    $data['bread_crumb'] = 'test bread crumb' ;
    $data['contents']  = $page == null ? 'main' : $page;

    $this->load->view('public/html_master_view', $data);
}


function public_blueMass( $page = null, $dir_name1 = null, $dir_name2 = null, $page_no = null ) {
    // get images from directory`
    $imgDir   = 'public/images/'.$dir_name1.'/'.$dir_name2;
    $this->load->module('lib');

    $data = '';
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
