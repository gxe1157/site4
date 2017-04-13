
<nav>
	<ol id="drop-nav" >
	<?php foreach( $nav as $menu_title => $menu_items ){
		  /* Needed for return to Home link */
		  $menu_opt1 = $nav[$menu_title][0][1];      // url
		  $menu_opt2 = $nav[$menu_title][0][1].'/'.urldecode($menu_title); // url and nav_to
          $top_menu_line = $menu_title == 'Home' ? $menu_opt1 : $menu_opt2;
	?>

	    <li>
	    	<?= anchor(
						base_url($top_menu_line),
	    				$menu_title,
							array('class' => 'nav_menu')
	    				);
			?>

	        <!-- if level exist  -->
	        <!-- <?php if( count($menu_items) > 1 ) { ?> -->
	        <ol>
		      	<?php foreach ($menu_items as $lines => $value){ ?>
					<?php if( $lines>0) {
						$build_url = $nav[$menu_title][$lines][1];      // url
						$build_url .= '/'.urldecode($nav[$menu_title][$lines][0]); // nav_to
						// img_folder	
						$build_url .= $nav[$menu_title][$lines][2] ? $nav[$menu_title][$lines][2] : null;
					?>
			            <li>
		    	        <?= anchor(
									base_url($build_url),
		    	        			$nav[$menu_title][$lines][0],
										array('class' => 'nav_menu')
		    	        		  );
		    	        ?>
		   	    		</li>
		    		<?php } ?>
		    	<?php } ?>
	        </ol>
	        <!-- <?php } ?> -->
		</li>
	<?php } ?>
	</ol>
</nav>
