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
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th class="span6">Page URL</th>
					  <th class="span4">Page Title</th>
					  <th class="span2">Actions</th>
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	 foreach( $columns->result() as $row ){
			    	 	$edit_page_url = $redirect_url."/".$row->id;
			    	 	$view_page_url =base_url().$row->page_url;
			    ?>
						<tr>
							<td class="right"><?=  $view_page_url ?></td>
							<td class="right"><?= $row->page_title ?></td>
							<td class="center">
								<a class="btn btn-success" href="<?= $view_page_url ?>">
									<i class="halflings-icon white zoom-in"></i>
								</a>
								<a class="btn btn-info" href="<?= $edit_page_url ?>">
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
