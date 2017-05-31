<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;	
	$form_location = base_url()."blog/create/".$update_id;
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Success</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>blog/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<!-- show image -->
			<img src="<?= base_url() ?>public/blog_pics/<?= $thumbnail_name ?>" >
			<h2>Item Title: <?= $page_title ?></h2>				
	
			<ul>
				<li>File Name    : <?= $upload_data['file_name'] ?></li>
				<li>File Type    : <?= $upload_data['file_type'] ?></li>
				<li>File Size    : <?= $upload_data['file_size'] ?></li>
				<li>Image height : <?= $upload_data['image_height'] ?></li>
				<li>Image width  : <?= $upload_data['image_width'] ?></li>
			</ul>

			<p>
			    <?php
		     	$edit_item_url = base_url()."blog/create/".$update_id;
			    ?>
				<a href="<?= $edit_item_url ?>"><button type="button" class="btn btn-primary">Return To Blog Entry Page</button></a>
			</p>
		</div>
	</div><!-- end 12 span -->
</div><!-- end row-fluid sortable -->