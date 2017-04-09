<?php
	// get images from directory`
    $this->load->module('templates');
    $show_page = !isset($page_no) ? 1 : $page_no ;
    $imgDir	   = 'public/images/'.$dir_name1.'/'.$dir_name2;  
	$bm_pages  = $this->templates->image_pagination( $imgDir );
?>

<div class='div-menu-message'>
<style>
  #selected_page{ 
	  font-size: 18px;
	  color: red;
  }	  
  
  #page{
	  font-size: 16px;
	  color: #000;
  }		
  
</style>

<div  class="div-wide" style="text-align: left;" >
		<?php
			$x = 0;
			$get_link = 'Page: ';
			foreach( $bm_pages as $key => $value)
			{   
				$x++;
				if( $key == $show_page-1 ){
					echo '<img src="'.base_url().$bm_pages[$key].'" width="720" height="1200"/>';
					$get_link .= '<a id="selected_page" href="'.base_url().'templates/public_blueMass/bluemass_pages.php/blue-mass/'.$dir_name2.'/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';					
				}else{
					$get_link .='<a id="page" href="'.base_url().'templates/public_blueMass/bluemass_pages.php/blue-mass/'.$dir_name2.'/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';
				}
			}
			echo $get_link;
		?>
		
</div>
</div>
