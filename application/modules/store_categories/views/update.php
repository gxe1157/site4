<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;	
	// $store_location = base_url().$store_db_table."/submit/".$update_id;
	$store_location = base_url().$store_db_table."/create/";	
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span> <?= $title ?></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>store_items/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">

			<p>Submit New Sub Category as required. When finished, press 'Finished' </p>

			<form class="form-horizontal" method="post" action="<?= $store_location ?>" >
	 		  <input type="hidden" name="mode" value="update">
	 		  <input type="hidden" id="parent_cat_id"  name="parent_cat_id" value="<?= $parent_cat_id ?>">

			  <fieldset>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Enter New Sub Category</label>
				  <div class="controls">
					<input type="text" class="span6" name = "cat_title" value="">
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Finished">Finished</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div><!--/row-->

<?php if( $num_rows>0 ){ ?>
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"> Existing <?= $options_hdr ?></span></h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" ><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
				  <thead>
					  <tr>
						  <th>Count</th>
						  <th><?= $options_hdr ?></th>
						  <th>Action</th>
					  </tr>
				  </thead>   
				  <tbody>

				    <?php
				         $count = 0;
				    	 foreach( $query->result() as $row ){
				    	 	$count++;
				    	 	$delete_url = base_url().$store_db_table."/delete/".$row->id;
						?> 	
							<tr>
								<td><?=$count ?></td>
								<td class="right"><?= $row->$store_db_column ?></td>
								<td class="center">
									<a class="btn btn-danger" href="<?= $delete_url ?>">
										<i class="halflings-icon white trash"></i> Remove Option  
									</a>
								</td>
							</tr>
				    <?php } ?>

				  </tbody>
			  </table>            
			</div>
		</div><!--/span-->
	</div><!--/row-->
<?php } ?>
