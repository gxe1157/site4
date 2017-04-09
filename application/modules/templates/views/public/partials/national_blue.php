<?php
	// get images from directory`
    $this->load->module('templates');
    $show_page = !isset($param1) ? 1 : $param1 ;
    $imgDir	   = 'public/images/blue_alert';    	
	$bm_pages = $this->templates->image_pagination( $imgDir );
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
					echo '<img src="'.base_url().$bm_pages[$key].'"  width="722" height="1100"/>';
					$get_link .= '<a id="selected_page" href="'.base_url().'templates/public_main/national_blue.php/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';					
				}else{
					$get_link .= '<a id="page" href="'.base_url().'templates/public_main/national_blue.php/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';
				}
			}
			echo $get_link;
		?>
		
</div>
</div>

