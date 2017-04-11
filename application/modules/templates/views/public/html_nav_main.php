<?php
	/*  Main Navigation Colapse
    *  Evelio Velez Jr.  April 2017
   	*/

		  	  // array('menu_opt','text','templates/public_main/mission-statement.php' ),			  	
	$nav =  array(
			'Home' => array(
				 array('Home','Home Page','/Home' )
			),
			'About Us' => array(
				 array('About Us','Mission Statement','templates/public_main/mission-statement.php' ),
				 array('Mission Statement','Mission Statement','templates/public_main/mission-statement.php' ),  
				 array('Introduction and History','Introduction and History','templates/public_main/Intro-History.php' ),
				 array('President Message','Presidents Message','templates/public_main/presidents-message.php' ),	  	
				 array('Board Members', 'Board Members','templates/public_main/hold-page.php' ),	  		  	
				 array('Financial Reports', 'Financial Reports','templates/public_main/hold-page.php' ),
				 array('Contact Us', 'Contact Us','templates/public_main/contact-us.php' )	  		  	
			),
			'Making a Difference' => array(
			  	 array('Making a Difference','Making a Difference','templates/public_main/making-a-difference.php' )
			),
			'Item4' => array(
				 array('Item4','Item4 Page','/Item4' )
			),				 
			'Item5' => array(
				 array('Item5','Item5 Page','/Item5' )
			),				 
	);	

 	// echo $nav['About Us'][0][0].'<br />';
	// echo $nav['About Us'][0][1].'<br />';    
	// echo $nav['About Us'][0][2].'<br />';
    
    foreach ($nav as $menu_title => $menu_item) {
    	echo $menu_title.' | <br />';
      	foreach ($menu_item as $lines => $value){
    	 	echo $nav[$menu_title][$lines][0].'<br />';
    	 	// echo $lines.' | ';
    	}
    }



?>

<nav>
	<ol id="drop-nav">
		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main" >Home</a></li>

 		<li ><a class="nav_menu" href="<?= base_url(); ?><?= $nav['About Us'][0][2]; ?>" ><?= $nav['About Us'][0][0]; ?></a>
		   <ol>
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][1][2]; ?>"><?= $nav['About Us'][1][1]; ?></a></li>	
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][2][2]; ?>"><?= $nav['About Us'][2][1]; ?></a></li>
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][3][2]; ?>"><?= $nav['About Us'][3][1]; ?></a></li>	
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][4][2]; ?>"><?= $nav['About Us'][4][1]; ?></a></li>	
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][5][2]; ?>"><?= $nav['About Us'][5][1]; ?></a></li>
				<li><a href="<?= base_url(); ?><?= $nav['About Us'][6][2]; ?>"><?= $nav['About Us'][6][1]; ?></a></li>	

   		   </ol>
		</li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/making-a-difference.php">Making a Difference</a>
		   <ol>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">10-13 Officer Needs Assistence</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Officer Shot and Down</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/Testimonials.php/Testimonials">Donations and Testimonials</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Protect Vest/Equipment</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page">Program</a></li>
		   </ol>
		</li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/bluemass.php">Blue Mass</a></li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/meeting-schedule.php">Meetings &#038; Events</a>
		   <ol>
				<li><a href="<?= base_url(); ?>templates/public_main/meeting-schedule.php">Meeting Schedule</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Bulletin Board</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Monthly Calender</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/CigarEvents.php/Cigar_Events">Cigar Events</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/awards-dinner.php/award-dinners">Awards Dinners</a></li>
		   </ol>
		</li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/hold-page.php">Political Action</a></li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/hold-page.php">Cop Shop</a></li>

		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/POB_In_Action.php">Brotherhood in Action</a>
			<ol>
				<li><a href="<?= base_url(); ?>templates/public_main/move_over.php/Move_Over_Law">Move Over Law</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/national_blue.php/blue_alert">National Blue Alert</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/POB_Support.php/POB_Supports">POB Support</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/POB_Pays_Tribute.php/POB_Pays_Tribute_AW">POB Pays Tribute</a></li>
	        </ol>
		</li>
	</ol>
</nav>
