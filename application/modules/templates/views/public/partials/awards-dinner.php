<?php
	// get images from directory
    $show_page = !isset($_GET['page']) ? 1 : $_GET['page'] ;
	$bm_pages = image_pagination( 'images/award-dinners/');

?>

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
					echo '<img src="images/award-dinners/2004Dinner Dance_Page_'.$x.'.jpg" width="722" height="1500"/>';
					$get_link .= '<a id="selected_page" href="'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';					
				}else{
					$get_link .= '<a id="page" href="nav-to-page.php?subNav=4&outputMess=Awards Dinner&content=awards-dinner.php&page='.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';
				}
			}
			echo $get_link;
		?>
		
</div>
