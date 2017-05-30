

<h1><?= $headline ?></h1>

<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;
	$form_location = base_url()."blog/create/".$update_id;
?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Blog Entry Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post"
				 action="<?= $form_location ?>" >
			  <fieldset>

				<div class="control-group">
				  <label class="control-label" for="typeahead"> Date Published</label>
				  <div class="controls">
					<input type="text" class="input-xlarge datepicker" id="date01" name="date_published" value="<?= $columns['date_published'] ?>">
				  </div>
				</div>				

				<div class="control-group">
				  <label class="control-label" for="typeahead"> Blog Entry Title</label>
				  <div class="controls">
					<input type="text" class="span6" name = "page_title" value="<?= $columns['page_title'] ?>">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Blog Entry Keywords</label>
				  <div class="controls">
					<textarea id="textarea2" rows="3" class="span6" name = "page_keywords">
						<?= $columns['page_keywords']  ?>
					</textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea1">Blog Entry Description</label>
				  <div class="controls">
					<textarea id="textarea1" rows="3" class="span6" name = "page_description">
						<?= $columns['page_description']  ?>
					</textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea3">Blog Entry Content</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea3" rows="2" name = "page_content">
						<?= $columns['page_content']  ?>
					</textarea>
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="typeahead"> Author</label>
				  <div class="controls">
					<input type="text" class="span6" name = "author" value="<?= $columns['author'] ?>">
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

<?php if( is_numeric($update_id) ) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Additional Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<a href="<?= base_url() ?>blog/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Blog Entry</button></a>

			    <?php  if( empty($columns['picture']) ) { ?>
					<a href="<?= base_url() ?>blog/upload_image/<?= $update_id ?> ">
					<button type="button" class="btn btn-primary">Upload Image</button></a>
				<?php  } else { ?>	
					<a href="<?= base_url() ?>blog/delete_image/<?= $update_id ?> ">
					<button type="button" class="btn btn-danger">Delete Image</button></a>	
				<?php  } ?>	
				<a href="<?= base_url().$columns['page_url'] ?>"><button type="button" class="btn btn-default">Preview Blog Entry</button></a>
			</div>
		</div><!-- end 12 span -->
	</div><!-- end row-fluid sortable -->
<?php } ?>

