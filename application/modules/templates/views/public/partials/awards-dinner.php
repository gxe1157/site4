
<div  class="div-wide" style="text-align: left;" >
      <?php 
        // echo '<img src="'.base_url().$bm_pages[$key].'" width="740" height="1200"/>';      
        $img_hgt   = 1000;
        $img_width = 700;
        $this->load->module('lib');
		$get_link = $this->lib->show_partial( $bm_pages, $page, $nav_to, $img_dir, $show_page, $img_hgt, $img_width  );
		echo $get_link;
	?>	

</div>
