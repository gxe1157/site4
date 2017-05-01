<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
  if( isset($flash) ) echo $flash;  
  $form_location = base_url()."store_items/create/".$update_id;
?>

<?php if( is_numeric($update_id) ) { ?>
  <div class="row-fluid sortable">
  
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2><i class="halflings-icon white edit"></i><span class="break"></span>Item layout</h2>
        <div class="box-icon">
          <a href="<?= base_url() ?>store_items/create/<?= $update_id ?>"><i class="halflings-icon white remove"></i></a>
        </div>
      </div>
      <div class="box-content">
        <a href="<?= base_url() ?>store_items/view/<?= $update_id ?>"><button type="button" class="btn btn-primary">View Item On-Line</button></a>
        <a href="<?= base_url() ?>store_items/create/<?= $update_id ?>"><button type="button" class="btn btn-default">Update Item Details</button></a>
      </div>
    </div><!-- end 12 span -->

  </div><!-- end row-fluid sortable -->
<?php } ?>

<div class="container" style="min-height: 650px; width: 40%; ">
      <?php
          if( isset($view_file) ){
              // This is a preview of page item information
              $this->load->view('store_items/view');
          }
      ?>
</div>

