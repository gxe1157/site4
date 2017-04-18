<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('html_head'); ?>

<body>
    <header>
        <img class="header_image" src="<?= base_url(); ?>public/images/sec_hdr.jpg" >
    	  <?php $this->load->view('html_nav_main.php'); ?>
    </header>

    <div id="container">
        <?php  $this->load->view('html_aside.php'); ?>

        <!-- Main Content -->
        <div class="div-menu-message">
            <div id="menu-mess-header">&nbsp;<?= urldecode($nav_to); ?>
              <span style="float: right; align-text: right; margin-top: 6px; font-size: 14px; ">
                  <a href="/members/membership.php">Become A Member</a> &nbsp;|&nbsp;
                  <a href="/members/login.php">Login</a>&nbsp;
              </span>
            </div>
            <?php $this->load->view('partials/'.$contents); ?>
        </div> <!-- End Main Content -->
        
    </div> <!-- end container -->

    <?php $this->load->view('html_footer'); ?>

</body>

</html>
