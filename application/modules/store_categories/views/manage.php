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
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th>Category Title</th>
					  <th>Parent Category</th>
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						foreach( $columns->result() as $row ) {
						$edit_url = $redirect_url."/".$row->id;	
					?>
						<tr>
							<td class="right"><?= $row->cat_title ?></td>
							<td class="right"> ---- </td>
							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?= $edit_url ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td>
						</tr>
			    	<?php } ?>			    

					<div class="controls">
						<?php
						$additional_opt = " id = selectCategories";
						$options = array(
						        '' => 'Please Select....',
						        '1' => 'Active',
						        '0' => 'Inactive'
						);
						echo form_dropdown('parent_cat_id', $options, '0', $additional_opt);
						?>
					</div>

			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->