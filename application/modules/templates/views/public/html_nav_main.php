
<nav>
	<ol id="drop-nav" >
	<?php foreach( $nav as $menu_title => $menu_items ){ ?>
	    <li>
	    	<?= anchor(
						  $nav[$menu_title][0][1],
	    				$menu_title,
							array('class' => 'nav_menu')
	    				);
			?>

	        <!-- if level exist  -->
	        <?php if( count($menu_items) > 1 ) { ?>
	        <ol>
		      	<?php foreach ($menu_items as $lines => $value){ ?>
		            <li>
	    	        <?= anchor(
	    	        			$nav[$menu_title][$lines][1].'/'.$nav[$menu_title][$lines][0] ,
	    	        			$nav[$menu_title][$lines][0],
											array('class' => 'nav_menu')
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
