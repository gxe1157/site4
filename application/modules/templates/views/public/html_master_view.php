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

    <div id="container">
        <?php  $this->load->view('html_aside.php'); ?>

        <!-- Main Content -->
        <div class="div-menu-message">
            <div id="menu-mess-header"><?= urldecode($nav_to); ?>
              <span style="float: right; align-text: right; margin-top: 6px; font-size: 14px; ">
                  <a href="/members/membership.php">Become A Member</a> &nbsp;|&nbsp;
                  <a href="/members/login.php">Login</a>&nbsp;
              </span>
            </div>
            <?php $this->load->view('partials/'.$contents); ?>
        </div> <!-- End Main Content -->
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
