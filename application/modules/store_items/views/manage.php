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
					  <th>Item Tile</th>
					  <th>Price</th>
					  <th>Was Price</th>
					  <th>Status</th>
					  <th>Image</th>					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

			    <?php
			    	 foreach( $columns->result() as $row ){
			    	 	$edit_item_url = $redirect_url."/".$row->id;			    	 	
			    	 	$status = $row->status;
			    	 	if( $status == 1) {
			    	 		$status_label = "success";
			    	 		$status_desc  = "Active";
			    	 	} else {
			    	 		$status_label = "defaults";
			    	 		$status_desc  = "Inactive";			    	 		
			    	 	}	
			    	 	$image = $row->big_pic == "" ? "No" : "Yes";
			    ?> 	
						<tr>
							<td class="right"><?= $row->item_title ?></td>
							<td class="right"><?= $row->item_price ?></td>
							<td class="right"><?= $row->was_price ?></td>
							<td class="center">
								<span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
							</td>
							<td class="center">
								<span class="label label-<?= $status_label ?>"><?= $image ?></span>
							</td>
							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?= $edit_item_url ?>">
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