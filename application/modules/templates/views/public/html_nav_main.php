<? /*  Main Navigation Colapse
    *  Evelio Velez Jr.  April 2017
   */
	 $nav = array(            // controller, function, url
	    				'About Us' => array( 'templates', 'public_main', 'Mission Statement' ),
				        						array( 'Introduction and History','Intro-History.php' )
					     );


   );
	 	//echo $current_file." : ".$siteNav[$current_file][0].'<br />';

?>
<nav>
	<ol id="drop-nav">
		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main" >Home</a></li>

 		<li ><a class="nav_menu" href="<?= base_url(); ?>templates/public_main/mission-statement.php" >About Us</a>
		   <ol>
				<li><a href="<?= base_url(); ?>templates/public_main/mission-statement.php">Mission Statement</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/Intro-History.php">Introduction and History</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/presidents-message.php">President's Message</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Board Members</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page.php">Staff</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/hold-page">Financial Reports</a></li>
				<li><a href="<?= base_url(); ?>templates/public_main/contact-us.php">Contact Us</a></li>
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
