<?php
		 $show_parent_id = '';
		 $Category_Title = 'Category Title';
 	 	 $Category_button = 'Cancel';
		 // $parent_cat_id = $this->uri->segment(3) ? : 0;

     if( $parent_cat_id > 0 && $mode ){
		     $this->load->module('store_categories');
				 $parent_cat_title = $this->store_categories->_get_cat_title($parent_cat_id);
				 $show_parent_id  ='<h3 style="margin-left: 36px;">Parent Category:<span style="margin-left:20px">'.$parent_cat_title.'</span></h3>';
		 	 	 $Category_Title  = 'Sub Category Title';
		 	 	 $Category_button = 'Finish';
	   }
?>

			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <fieldset>

				<?= form_hidden('parent_cat_id', $parent_cat_id); ?>
				<?= form_hidden('mode', $mode); ?>
				<?= $show_parent_id ?>

				<div class="control-group">
				  <label class="control-label" for="typeahead"><?= $Category_Title ?></label>
				  <div class="controls">
					<input type="text" class="span6" name = "cat_title" value="<?= $columns['cat_title'] ?>">
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="<?= $Category_button ?>"><?= $Category_button ?></button>
				</div>
			  </fieldset>
			</form>
