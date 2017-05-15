<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;
	$data['form_location'] = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>
			<?= $headtag ?></h2>
			<div class="box-icon">
				<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
				$category_form = $mode == 'sub-category' ? 'sub_category_form' : 'category_form';
				echo $this->load->view($view_module.'/partials/'.$category_form ,$data );
    		?>
		</div>
	</div><!--/span-->

</div><!--/row-->
