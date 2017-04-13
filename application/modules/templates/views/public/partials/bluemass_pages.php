
<div  class="div-wide" style="text-align: left;" >
      <?php 
        $img_hgt   = 1000;
        $img_width = 700;
        $dir_function = 'public_blueMass';

        $this->load->module('lib');
		$get_link = $this->lib->show_partial( $bm_pages, $page, $dir_name1, $img_dir, $show_page, $img_hgt, $img_width, $dir_function  );
		echo $get_link;
	?>	

</div>
