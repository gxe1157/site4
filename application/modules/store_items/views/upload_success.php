<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;	
	$form_location = base_url()."store_items/create/".$update_id;
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Success</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>store_items/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<ul>
			<?php foreach ($upload_data as $item => $value):?>
			<li><?php echo $item;?>: <?php echo $value;?></li>
			<?php endforeach; ?>
			</ul>

			<p>
			    <?php
		     	$edit_item_url = base_url()."store_items/create/".$update_id;
			    ?>
				<a href="<?= $edit_item_url ?>"><button type="button" class="btn btn-primary">Return To Main Update Item Details Page</button></a>
			</p>
		</div>
	</div><!-- end 12 span -->
</div><!-- end row-fluid sortable -->