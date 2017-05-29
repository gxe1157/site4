

<h1><?= $headline ?></h1>

<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;
	$form_location = base_url()."webpages/create/".$update_id;
?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Page Details</h2>
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
				  <label class="control-label" for="typeahead"> Page Title</label>
				  <div class="controls">
					<input type="text" class="span6" name = "page_title" value="<?= $columns['page_title'] ?>">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Page Keywords</label>
				  <div class="controls">
					<textarea id="textarea2" rows="3" class="span6" name = "page_keywords">
						<?= $columns['page_keywords']  ?>
					</textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea1">Page Description</label>
				  <div class="controls">
					<textarea id="textarea1" rows="3" class="span6" name = "page_description">
						<?= $columns['page_description']  ?>
					</textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea3">Page Content</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea3" rows="2" name = "page_content">
						<?= $columns['page_content']  ?>
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
				<?php if( $update_id > 2 ){ ?>
					<a href="<?= base_url() ?>webpages/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Page</button></a>
				<?php } ?>

				<a href="<?= base_url().$columns['page_url'] ?>"><button type="button" class="btn btn-default">Preview Page</button></a>
			</div>

		</div><!-- end 12 span -->
	</div><!-- end row-fluid sortable -->
<?php } ?>

