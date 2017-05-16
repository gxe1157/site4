<?php
	if( isset($flash) ) echo $flash;
?>

<h1><?= $headline ?></h1>

<p style="margin-top: 30px,">
	<a href="<?= $redirect_url ?>" ><button type="button" class="btn btn-primary"><?= $add_button ?></button></a>
</p>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title >
			<h2><i class="<?= $class_icon ?>" ></i><span class="break"></span><?= $headtag ?></h2>
			<div class="box-icon">
				<a href="#" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">  <!-- bootstrap-datatable datatable -->
			  <thead>
				  <tr>
					  <th>Category Tile</th>
					  <th>Parent Category</th>
					  <th>Sub Categories</th>
					  <th>Actions</th>
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	$this->load->module('store_categories');

			    	foreach( $columns->result() as $row ){
						$num_sub_cats = $this->store_categories->_count_sub_cats( $row->id );
			    	 	 $edit_item_url = $redirect_url."/".$row->id;
			    	 	 $view_item_url = $redirect_url."/".$row->id;

			    	 	 if($row->parent_cat_id==0) {
			    	 	 	$parent_cat_title='--';
			    	 	 } else {
			    	 	 	$parent_cat_title = $this->store_categories->_get_cat_title($row->parent_cat_id);
				    	 }
			    ?>
						<tr>
							<td class="right"><?= $row->cat_title ?></td>
							<td class="right"><?= $parent_cat_title ?></td>
							<td class="right">
							    <?php if( $num_sub_cats < 1  ){
							           echo '-';
							        } else {
								       	$entity = $num_sub_cats == 1 ? "Category" : "Catagories";
								    	$sub_cat_url = base_url().$this->uri->segment(1).'/manage/'.$row->id.'/sub-category';
										?><a class="btn btn-default" href="<?= $sub_cat_url ?>">
											<i class="halflings-icon white eye-open"></i> <?= $num_sub_cats." ".$entity ?>
										</a>
								<?php } ?>

					        </td>
							<td class="center">
								<a class="btn btn-success" href="<?= $view_item_url ?>">
									<i class="halflings-icon white eye-open"></i>
								</a>
								<a class="btn btn-info" href="<?= $edit_item_url ?>/<?= $mode ?>">
									<i class="halflings-icon white edit"></i>
								</a>
							</td>
						</tr>
			    <?php } ?>

			  </tbody>
		  </table>
		</div>
	</div><!--/span-->

</div><!--/row-->