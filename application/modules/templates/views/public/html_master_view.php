<?php
/* Full Service Mailers August 21 2015  Evelio Velez Jr. */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <title><?= $title ?></title> -->

    <title><?= $title ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Description" content="New Jersey Law Enforcement Police Brotherhood">
    <meta name="KeyWords" content="New Jersey Law Enforcement Police Brotherhood">

    <link rel="stylesheet" href="<?= base_url(); ?>public/css/main.css" type="text/css">
    
    <script language="JavaScript1.2" type="text/javascript" src="<?= base_url(); ?>public/js/html5shiv.js"></script>
    <script language="JavaScript1.2" type="text/javascript" src="<?= base_url(); ?>public/js/myLib.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->  
</head>

<body>
    <header>
    <img class="header_image" src="<?= base_url(); ?>public/images/sec_hdr.jpg" >
    	<?php
    		$this->load->view('html_nav_main.php');
    	?>   	
    </header>
 

    <style>
        .adlinks{
         color: #174098;
         font-weight: bold;
        }

        a.adlinks:link, a.adlinks:visited
        { color: #174098; font-size: 14px; font-weight: bold; text-decoration: none }
        a.adlinks:hover
        { color: red; font-size: 14px; font-weight: bold; text-decoration: none }

        #subscribe_signup {
            height: 50px;
            padding: 10px;
            text-align: center;
        }
    </style>

    <div id="container">
      
        <aside style="float: left;  border-right:1px dashed #aaa; padding: 05px;" >
            <div class="leftNavContainer">
                <div class="leftNavInner"><a  style="color: red;" href="/members/donor-page.php">Make a Donation</a></div>
                <div class="leftNavInner"><a  style="color: red;" href="/members/ad-page.php">Advertise Your Business</a></div>
                <div class="leftNavInner"><a  style="color: red;" href="/members/membership.php">Become A Member</a></div>
                <div class="leftNavInner"><a  style="color: red;" href="/members/login.php">Login</a></div>

                    <div class="leftNavInner"><a  style="color: #000;" href="/members/formFix.php">Admin - Member Form</a></div>    
                <div class="leftNavInner"><a  style="color: #000;" href="/members/reset_emails.php">Admin - Reset Emails</a></div>  
            </div>
            <div class="leftNavContainer2">
                <div class="leftNavInner"><a  style="color: red;"  href="/nav-to-page.php?subNav=7&outputMess=Contact Us&content=contact-us.php">Contact Us</a></div>

                <div class="leftNavInner">
                    <div id="subscribe_signup">
                        <form id="subscribe" action="" method="post" name="subscribe" />
                            Sign up for our Newsletter
                            <input id="mce-EMAIL" type="email" name="EMAIL" value="" />
                            <input id="mc-embedded-subscribe" type="submit" name="subscribe" value="Subscribe" />
                        </form>
                    </div>  
                </div>  
            </div>
            
            <div style="padding: 10px 0px 0px 0px; border:0px solid red; align-text: center; margin: 0 auto; ">
                <a href="#" target="_blank">
                <img src="http://static.viewbook.com/images/social_icons/linkedin_32.png" border="0" alt="Visit our Blog" width="27" height="28" /></a> &nbsp;

                <a href="http://www.youtube.com/user/TheNLEOMF" target="_blank">
                <img src="http://www.nleomf.org/assets/images/icons/social-media/youtube30-fw.png" border="0" alt="Find us on YouTube" width="27" height="28" /></a> &nbsp;

                <a href="https://www.facebook.com/NLEOMF" target="_blank">
                <img src="http://static.viewbook.com/images/social_icons/facebook_32.png" border="0" alt="Visit us on Facebook" width="27" height="28" /></a> &nbsp;

                <a href="http://twitter.com/NLEOMF" target="_blank">
                <img src="http://www.nleomf.org/assets/images/icons/social-media/twitter30-fw.png" border="0" alt="Tweet with Us" width="27" height="28" /></a>  &nbsp;

                <a href="http://www.flickr.com/photos/nleomf/sets/" target="_blank">
                <img src="http://www.nleomf.org/assets/images/icons/social-media/flickr30-fw.png" border="0" alt="View our Flickr Photo Gallery" width="27" height="28" /></a>&nbsp;&nbsp;
            </div>  
        </aside>    

        <?php
        	$this->load->view('partials/'.$contents);
        ?>				
    </div> <!-- end container -->

    <footer>
        <div id="mess-footer">
            <b>POWER * STRENGTH * RESOLVE<br />Together we make the thin blue line stronger!</b><br />
            Copyright &copy; 2013 - 2017 NJLEPOB&nbsp;&nbsp; All rights reserved. <br >
            <a href="#">About Us</a> | <a href="#">Terms and Conditions</a> | <a href="#">Contact Us</a><br >
            Tel 973-256-7390 -- Fax 973-256-7391<br><br>
        </div>
    </footer>
</body>

</html>
