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
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="<?= base_url() ?>store_items/manage" ><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<a href="<?= base_url() ?>store_items/upload_image/<?= $update_id ?> "><button type="button" class="btn btn-primary">Upload Item Image</button></a>
				<a href="<?= base_url() ?>store_items/"><button type="button" class="btn btn-primary">Update Item Color</button></a>
				<a href="<?= base_url() ?>store_items/"><button type="button" class="btn btn-primary">Update Item Size</button></a>
				<a href="<?= base_url() ?>store_items/"><button type="button" class="btn btn-primary">Update Item Categories</button></a>

				<a href=""><button type="button" class="btn btn-danger">Delete Item</button></a>									
			</div>

		</div><!-- end 12 span -->
	</div><!-- end row-fluid sortable -->
<?php } ?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>store_items/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">

			<form class="form-horizontal" method="post"
				 action="<?= $form_location ?>" >
			  <fieldset>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Item Title </label>
				  <div class="controls">
					<input type="text" class="span6" name = "item_title" value="<?= $item_title ?>">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Item Price </label>
				  <div class="controls">
					<input type="text" class="span2" name = "item_price" value="<?= $item_price ?>">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Was Price <span style="color: green;">(Optional)</span> </label>
				  <div class="controls">
					<input type="text" class="span2" name = "was_price" value="<?= $was_price ?>">
				  </div>
				</div>
				<div class="control-group">
					<label class="control-label" for="selectStatus">Status</label>
					<div class="controls">
						<?php
						$additional_opt = " id = selectStatus";
						$options = array(
						        '' => 'Please Select....',
						        '1' => 'Active',
						        '0' => 'Inactive'
						);
						echo form_dropdown('status', $options, $status, $additional_opt);
						?>
					</div>
				  </div>				

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Item Description</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea2" rows="3" name = "item_description">
						<?= $item_description ?>
					</textarea>
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->