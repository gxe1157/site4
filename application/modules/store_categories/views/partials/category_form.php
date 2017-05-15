			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <fieldset>
			  
				<?= form_hidden('parent_cat_id', $this->uri->segment(3) ? : 0 ) ?>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Category Title</label>
				  <div class="controls">
					<input type="text" class="span6" name = "cat_title" value="<?= $columns['cat_title'] ?>">
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
				</div>
			  </fieldset>
			</form>
