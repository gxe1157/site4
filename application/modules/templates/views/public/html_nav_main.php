<?php

	$this->load->module('nav_menu');   	
	$this->load->module('lib');   	

	$nav = $this->nav_menu->index();
	// $this->lib->checkArray($nav,1);

?>

<nav>
	<ol id="drop-nav" >
	<?php foreach( $nav as $menu_title => $menu_items ){ ?>
	    <li>
	    	<?= anchor( 
						base_url().$nav[$menu_title][0][2],
	    				$menu_title, array('class' => 'nav_menu')
	    				);
			?>

	        <!-- if level exist  -->
	        <?php if( count($menu_items) > 1 ) { ?>
	        <ol>    
		      	<?php foreach ($menu_items as $lines => $value){ ?>
		            <li>
	    	        <?= anchor(
	    	        			base_url().$nav[$menu_title][$lines][2] ,
	    	        			$nav[$menu_title][$lines][0], array('class' => 'nav_menu')
	    	        		  );
	    	        ?>
	   	    		</li>
		    	<?php } ?>
	        </ol>
	        <?php } ?>
		</li>
	<?php } ?>
	</ol>
</nav>	
